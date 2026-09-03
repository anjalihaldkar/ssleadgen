@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')
    <h1 class="auth-title">Welcome back</h1>
    <p class="auth-subtitle">Sign in to your SS Advisory account</p>

    {{-- Global error (credentials / throttle) --}}
    @if ($errors->has('email') && !$errors->has('email'))
    @endif

    @if (session('status'))
        <div class="alert-auth-error" style="background:#f0fdf4;border-color:#bbf7d0;color:#166534;">
            <i class="fas fa-check-circle"></i>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                autocomplete="email"
                autofocus
                placeholder="you@example.com"
                required
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    autocomplete="current-password"
                    placeholder="••••••••"
                    required
                />
                <button type="button" class="btn btn-toggle-pw" tabindex="-1" aria-label="Toggle password visibility">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="mb-4 d-flex align-items-center">
            <input
                type="checkbox"
                id="remember"
                name="remember"
                class="form-check-input me-2"
                {{ old('remember') ? 'checked' : '' }}
            />
            <label for="remember" class="form-check-label mb-0">Remember me</label>
        </div>

        <button type="submit" id="btn-login-submit" class="btn-auth-submit">
            Sign In
        </button>
    </form>

    <p class="auth-divider mt-4">
        Don't have an account? <a href="{{ route('register') }}">Create one</a>
    </p>
@endsection
