<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// ─── Auth Routes ──────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ─── Dashboard & App Routes ────────────────────────────────────────────────────
Route::middleware(['auth', 'user.active'])->group(function () {
    // Dashboard
    Route::middleware('permission:dashboard,read')->group(function () {
        Route::get('/', function () {
            return view('pages.dashboard.index');
        });
        Route::get('/dashboard', function () {
            return view('pages.dashboard.dashboard');
        })->name('dashboard');
        Route::get('/analytics', function () {
            return view('pages.dashboard.analytics');
        });
    });

    // CRM / Leads
    Route::middleware('permission:leads,read')->group(function () {
        Route::get('/crm/pipeline', function () {
            return view('pages.crm.pipeline');
        });
        Route::get('/crm/create', function () {
            return view('pages.crm.create');
        });
    });

    // Reports
    Route::middleware('permission:reports,read')->group(function () {
        Route::get('/crm/reports', function () {
            return view('pages.crm.reports');
        });
    });

    // Clients
    Route::middleware('permission:clients,read')->group(function () {
        Route::get('/clients', function () {
            return view('pages.clients.index');
        });
        Route::get('/clients/inforce', function () {
            return view('pages.clients.inforce');
        });
        Route::get('/clients/inactive', function () {
            return view('pages.clients.inactive');
        });
        Route::get('/clients/cancellation', function () {
            return view('pages.clients.cancellation');
        });
        Route::get('/clients/npw-deferred', function () {
            return view('pages.clients.npw-deferred');
        });
    });

    // Policies & Claims
    Route::middleware('permission:policies,read')->group(function () {
        Route::get('/policies', function () {
            return view('pages.policies.index');
        });
    });
    Route::middleware('permission:claims,read')->group(function () {
        Route::get('/policies/claims', function () {
            return view('pages.policies.claims');
        });
    });

    // Utilities
    Route::middleware('permission:calendar,read')->group(function () {
        Route::get('/utilities/calendar', function () {
            return view('pages.utilities.calendar');
        });
    });
    Route::middleware('permission:tasks,read')->group(function () {
        Route::get('/utilities/tasks', function () {
            return view('pages.utilities.tasks');
        });
    });
    Route::middleware('permission:documents,read')->group(function () {
        Route::get('/utilities/documents', function () {
            return view('pages.utilities.documents');
        });
    });

    // Settings
    Route::middleware('permission:settings,read')->group(function () {
        Route::get('/utilities/communications', function () {
            return view('pages.utilities.communications');
        });
        Route::get('/settings/users', function () {
            return view('pages.settings.users');
        });
        Route::get('/settings/commissions', function () {
            return view('pages.settings.commissions');
        });
        Route::get('/settings/sources', function () {
            return view('pages.settings.sources');
        });
    });

    // ─── Access Control (Super Admin only) ───────────────────────────────────
    Route::middleware('permission:access,write')->group(function () {
        Route::get('/settings/access', [UserController::class, 'index'])->name('settings.access');
        Route::post('/settings/users', [UserController::class, 'store'])->name('users.store');
        Route::patch('/settings/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::patch('/settings/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
        Route::post('/settings/roles', [UserController::class, 'storeRole'])->name('roles.store');
        Route::patch('/settings/roles/{role}', [UserController::class, 'updateRole'])->name('roles.update');
    });
});

// Auth Static Views
Route::get('/auth/login', function () {
    return view('pages.auth.login');
});
Route::get('/auth/forgot-password', function () {
    return view('pages.auth.forgot-password');
});
Route::get('/auth/reset-password', function () {
    return view('pages.auth.reset-password');
});
Route::get('/auth/clients-login', function () {
    return view('pages.auth.clients-login');
});
