<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Crm\ClientController;
use App\Http\Controllers\Crm\LeadController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

// ─── Auth Routes ──────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password reset
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
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
        Route::get('/crm/pipeline', [LeadController::class, 'index'])->name('crm.pipeline');
        Route::get('/crm/reports', function () {
            return view('pages.crm.reports');
        });
        Route::middleware('permission:leads,write')->group(function () {
            Route::get('/crm/create', [LeadController::class, 'create'])->name('crm.create');
            Route::post('/crm/leads', [LeadController::class, 'store'])->name('crm.store');
            Route::post('/crm/leads/{lead}/convert', [LeadController::class, 'convert'])->name('crm.convert');
            Route::patch('/crm/leads/{lead}/status', [LeadController::class, 'updateStatus'])->name('crm.updateStatus');
        });
    });

    // Clients
    Route::middleware('permission:clients,read')->group(function () {
        Route::get('/clients/{status?}', [ClientController::class, 'index'])->name('clients.index');
    });

    // Utilities
    Route::middleware('permission:calendar,read')->group(function () {
        Route::get('/utilities/calendar', [AppointmentController::class, 'index'])->name('calendar.index');
        Route::post('/utilities/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
        Route::delete('/utilities/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    });
    Route::middleware('permission:tasks,read')->group(function () {
        Route::get('/utilities/tasks', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
        Route::post('/utilities/tasks', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
        Route::patch('/utilities/tasks/{task}/status', [\App\Http\Controllers\TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
        Route::post('/utilities/tasks/{task}/notes', [\App\Http\Controllers\TaskController::class, 'storeNote'])->name('tasks.notes.store');
        Route::delete('/utilities/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
    });
    Route::middleware('permission:documents,read')->group(function () {
        Route::get('/utilities/documents', [DocumentController::class, 'index'])->name('documents.index');
        Route::post('/utilities/documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('/utilities/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
        Route::delete('/utilities/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    });

    // Public share route for documents
    Route::get('/share/document/{token}', [DocumentController::class, 'share'])->name('documents.share');

    // ─── Access Control ──────────────────────────────────────────────────────
    Route::middleware('permission:access,read')->group(function () {
        Route::get('/settings/access', [UserController::class, 'index'])->name('settings.access');

        Route::middleware('permission:access,write')->group(function () {
            Route::post('/settings/users', [UserController::class, 'store'])->name('users.store');
            Route::patch('/settings/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::patch('/settings/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
            Route::delete('/settings/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::post('/settings/roles', [UserController::class, 'storeRole'])->name('roles.store');
            Route::patch('/settings/roles/{role}', [UserController::class, 'updateRole'])->name('roles.update');
            Route::delete('/settings/roles/{role}', [UserController::class, 'destroyRole'])->name('roles.destroy');
        });
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
