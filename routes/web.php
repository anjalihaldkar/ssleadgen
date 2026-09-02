<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function () {
    return view('pages.dashboard.index');
});
Route::get('/dashboard', function () {
    return view('pages.dashboard.dashboard');
});
Route::get('/analytics', function () {
    return view('pages.dashboard.analytics');
});

// Auth
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

use App\Http\Controllers\Crm\ClientController;
use App\Http\Controllers\Crm\LeadController;
use App\Http\Controllers\Crm\PolicyController;

// CRM Leads
Route::get('/crm/pipeline', [LeadController::class, 'index'])->name('crm.pipeline');
Route::get('/crm/create', [LeadController::class, 'create'])->name('crm.create');
Route::post('/crm/leads', [LeadController::class, 'store'])->name('crm.store');
Route::post('/crm/leads/{lead}/convert', [LeadController::class, 'convert'])->name('crm.convert');
Route::get('/crm/reports', function () {
    return view('pages.crm.reports');
});

// Clients
Route::get('/clients/{status?}', [ClientController::class, 'index'])->name('clients.index');

// Policies
Route::get('/policies', [PolicyController::class, 'index'])->name('policies.index');
Route::post('/policies', [PolicyController::class, 'store'])->name('policies.store');
Route::get('/policies/claims', function () {
    return view('pages.policies.claims');
});

// Utilities
Route::get('/utilities/calendar', function () {
    return view('pages.utilities.calendar');
});
Route::get('/utilities/tasks', function () {
    return view('pages.utilities.tasks');
});
Route::get('/utilities/documents', function () {
    return view('pages.utilities.documents');
});
Route::get('/utilities/communications', function () {
    return view('pages.utilities.communications');
});

// Settings
Route::get('/settings/users', function () {
    return view('pages.settings.users');
});
Route::get('/settings/access', function () {
    return view('pages.settings.access');
});
Route::get('/settings/commissions', function () {
    return view('pages.settings.commissions');
});
Route::get('/settings/sources', function () {
    return view('pages.settings.sources');
});
