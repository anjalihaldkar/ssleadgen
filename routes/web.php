<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', function () { return view('pages.dashboard.index'); });
Route::get('/dashboard', function () { return view('pages.dashboard.dashboard'); });
Route::get('/analytics', function () { return view('pages.dashboard.analytics'); });

// Auth
Route::get('/auth/login', function () { return view('pages.auth.login'); });
Route::get('/auth/forgot-password', function () { return view('pages.auth.forgot-password'); });
Route::get('/auth/reset-password', function () { return view('pages.auth.reset-password'); });
Route::get('/auth/clients-login', function () { return view('pages.auth.clients-login'); });

// CRM
Route::get('/crm/pipeline', function () { return view('pages.crm.pipeline'); });
Route::get('/crm/create', function () { return view('pages.crm.create'); });
Route::get('/crm/reports', function () { return view('pages.crm.reports'); });

// Clients
Route::get('/clients', function () { return view('pages.clients.index'); });
Route::get('/clients/inforce', function () { return view('pages.clients.inforce'); });
Route::get('/clients/inactive', function () { return view('pages.clients.inactive'); });
Route::get('/clients/cancellation', function () { return view('pages.clients.cancellation'); });
Route::get('/clients/npw-deferred', function () { return view('pages.clients.npw-deferred'); });

// Policies
Route::get('/policies', function () { return view('pages.policies.index'); });
Route::get('/policies/claims', function () { return view('pages.policies.claims'); });

// Utilities
Route::get('/utilities/calendar', function () { return view('pages.utilities.calendar'); });
Route::get('/utilities/tasks', function () { return view('pages.utilities.tasks'); });
Route::get('/utilities/documents', function () { return view('pages.utilities.documents'); });
Route::get('/utilities/communications', function () { return view('pages.utilities.communications'); });

// Settings
Route::get('/settings/users', function () { return view('pages.settings.users'); });
Route::get('/settings/access', function () { return view('pages.settings.access'); });
Route::get('/settings/commissions', function () { return view('pages.settings.commissions'); });
Route::get('/settings/sources', function () { return view('pages.settings.sources'); });
