<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAuditLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('role')->latest()->get();
        $roles = Role::orderBy('name')->get();

        return view('pages.settings.access', compact('users', 'roles'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $role = Role::findOrFail($request->role_id);

        try {
            DB::transaction(function () use ($request, $role) {
                // Race-safe Super Admin check: lock the roles row
                if ($role->is_super_admin) {
                    $existingAdmin = User::whereHas('role', fn ($q) => $q->where('is_super_admin', true))
                        ->where('status', 'active')
                        ->lockForUpdate()
                        ->exists();

                    if ($existingAdmin) {
                        throw new \DomainException('An active Super Admin already exists. Deactivate them first or assign a different role.');
                    }
                }

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role_id,
                    'fspr_number' => $request->fspr_number ?: null,
                    'status' => 'active',
                    'password' => bcrypt(Str::random(32)),
                ]);

                // ponytail: email skipped — add when password.reset route is configured

                UserAuditLog::create([
                    'actor_id' => auth()->id(),
                    'target_user_id' => $user->id,
                    'action' => 'user_created',
                    'meta' => ['role' => $role->name],
                ]);
            });
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }

        return back()->with('success', 'User created. Ask them to use "Forgot Password" on the login page to set their password.');
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $changes = [];

        try {
            DB::transaction(function () use ($request, $user, &$changes) {
                if ($request->filled('role_id') && $request->role_id != $user->role_id) {
                    $newRole = Role::findOrFail($request->role_id);

                    if ($newRole->is_super_admin) {
                        $existingAdmin = User::whereHas('role', fn ($q) => $q->where('is_super_admin', true))
                            ->where('status', 'active')
                            ->where('id', '!=', $user->id)
                            ->lockForUpdate()
                            ->exists();

                        if ($existingAdmin) {
                            throw new \DomainException('An active Super Admin already exists.');
                        }
                    }

                    $changes['role'] = ['old' => $user->role?->name, 'new' => $newRole->name];
                    $user->role_id = $request->role_id;
                }

                if ($request->filled('status') && $request->status !== $user->status) {
                    if ($request->status === 'inactive' && $user->isSuperAdmin()) {
                        $otherAdmins = User::whereHas('role', fn ($q) => $q->where('is_super_admin', true))
                            ->where('status', 'active')
                            ->where('id', '!=', $user->id)
                            ->lockForUpdate()
                            ->exists();

                        if (! $otherAdmins) {
                            throw new \DomainException('Cannot deactivate the only active Super Admin.');
                        }
                    }

                    if ($request->status === 'inactive' && $user->id === auth()->id()) {
                        throw new \DomainException('You cannot deactivate your own account.');
                    }

                    $changes['status'] = ['old' => $user->status, 'new' => $request->status];
                    $user->status = $request->status;

                    if ($request->status === 'inactive') {
                        DB::table('sessions')->where('user_id', $user->id)->delete();
                    }
                }

                if ($request->has('fspr_number')) {
                    $user->fspr_number = $request->fspr_number ?: null;
                }

                $user->save();

                if (! empty($changes)) {
                    $action = count($changes) === 1
                        ? (isset($changes['role']) ? 'role_changed' : 'status_changed')
                        : 'role_and_status_changed';

                    UserAuditLog::create([
                        'actor_id' => auth()->id(),
                        'target_user_id' => $user->id,
                        'action' => $action,
                        'meta' => $changes,
                    ]);
                }
            });
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'User updated successfully.');
    }

    public function deactivate(User $user): RedirectResponse
    {
        // Only Super Admin can deactivate
        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        try {
            DB::transaction(function () use ($user) {
                if ($user->id === auth()->id()) {
                    throw new \DomainException('You cannot deactivate your own account.');
                }

                if ($user->isSuperAdmin()) {
                    $otherAdmins = User::whereHas('role', fn ($q) => $q->where('is_super_admin', true))
                        ->where('status', 'active')
                        ->where('id', '!=', $user->id)
                        ->lockForUpdate()
                        ->exists();

                    if (! $otherAdmins) {
                        throw new \DomainException('Cannot deactivate the only active Super Admin.');
                    }
                }

                $user->status = 'inactive';
                $user->save();

                DB::table('sessions')->where('user_id', $user->id)->delete();

                UserAuditLog::create([
                    'actor_id' => auth()->id(),
                    'target_user_id' => $user->id,
                    'action' => 'status_changed',
                    'meta' => ['old' => 'active', 'new' => 'inactive'],
                ]);
            });
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'User deactivated and their session has been terminated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->isSuperAdmin()) {
            return back()->with('error', 'Cannot delete a Super Admin account.');
        }

        $name = $user->name;
        $user->delete();

        return back()->with('success', "User \"{$name}\" deleted successfully.");
    }

    // ─── Roles ────────────────────────────────────────────────────────────────

    public function storeRole(Request $request): RedirectResponse
    {
        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'in:none,read,write'],
        ]);

        $slug = Str::slug($data['name']);

        // Fill any missing modules with 'none'
        $permissions = collect(Role::modules())
            ->mapWithKeys(fn ($m) => [$m => $data['permissions'][$m] ?? 'none'])
            ->all();

        Role::create([
            'name' => $data['name'],
            'slug' => $slug,
            'description' => $data['description'] ?? null,
            'permissions' => $permissions,
            'is_super_admin' => false,
        ]);

        return back()->with('success', "Role \"{$data['name']}\" created successfully.");
    }

    public function updateRole(Request $request, Role $role): RedirectResponse
    {
        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('roles', 'name')->ignore($role->id)],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['required', 'in:none,read,write'],
        ]);

        $permissions = collect(Role::modules())
            ->mapWithKeys(fn ($m) => [$m => $data['permissions'][$m] ?? 'none'])
            ->all();

        $role->update([
            'name' => $data['name'],
            'slug' => $role->is_super_admin ? $role->slug : Str::slug($data['name']),
            'description' => $data['description'] ?? null,
            'permissions' => $permissions,
        ]);

        return back()->with('success', "Role \"{$role->name}\" permissions updated successfully.");
    }

    public function destroyRole(Role $role): RedirectResponse
    {
        if (! auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        if ($role->is_super_admin) {
            return back()->with('error', 'Cannot delete a Super Admin role.');
        }

        if (User::where('role_id', $role->id)->exists()) {
            return back()->with('error', 'Cannot delete role because it is still assigned to one or more users.');
        }

        $role->delete();

        return back()->with('success', "Role \"{$role->name}\" deleted successfully.");
    }
}
