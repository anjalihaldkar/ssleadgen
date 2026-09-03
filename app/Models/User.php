<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role_id', 'status', 'fspr_number', 'last_login_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function auditLogsAsActor(): HasMany
    {
        return $this->hasMany(UserAuditLog::class, 'actor_id');
    }

    public function auditLogsAsTarget(): HasMany
    {
        return $this->hasMany(UserAuditLog::class, 'target_user_id');
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    public function isSuperAdmin(): bool
    {
        return $this->role?->is_super_admin === true;
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function hasPermission(string $module, string $level = 'read'): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return $this->role?->can($module, $level) ?? false;
    }

    public function canWrite(string $module): bool
    {
        return $this->hasPermission($module, 'write');
    }

    public function canRead(string $module): bool
    {
        return $this->hasPermission($module, 'read');
    }
}
