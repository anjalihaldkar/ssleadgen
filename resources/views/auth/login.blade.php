@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1" style="font-size:20px;color:#0F172A;">Welcome Back 👋</h3>
        <p class="mb-0" style="font-size:13px;color:#64748B;">Sign in to access your advisor dashboard and client records.</p>
    </div>

    {{-- Session status (e.g. password reset link sent) --}}
    @if (session('status'))
        <div class="alert-auth-error" style="background:#f0fdf4;border-color:#bbf7d0;color:#166534;">
            <i class="fas fa-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    {{-- Credential / throttle errors --}}
    @if ($errors->any())
        <div class="alert-auth-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Work Email Address *</label>
            <div class="auth-input-group">
                <i class="fas fa-envelope auth-icon"></i>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    autofocus
                    placeholder="advisor@ssadvisory.co.nz"
                    required
                />
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between mb-1">
                <label for="password" class="form-label mb-0">Password *</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none fw-semibold" style="font-size:12px;color:#00A8B5;">Forgot Password?</a>
                @endif
            </div>
            <div class="auth-input-group">
                <i class="fas fa-lock auth-icon"></i>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    autocomplete="current-password"
                    placeholder="••••••••••••"
                    required
                />
                <button type="button" class="password-toggle" tabindex="-1" aria-label="Toggle password visibility">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="form-check-input"
                    {{ old('remember') ? 'checked' : '' }}
                />
                <label for="remember" class="form-check-label mb-0 fw-semibold" style="font-size:13px;">Remember me for 30 days</label>
            </div>
        </div>

        <button type="submit" id="btn-login-submit" class="btn-auth-primary d-flex align-items-center justify-content-center gap-2">
            <span>Sign In</span>
            <i class="fas fa-arrow-right" style="font-size:14px;"></i>
        </button>
    </form>
@endsection
