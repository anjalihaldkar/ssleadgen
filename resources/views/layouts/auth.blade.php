<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Sign In') | SS Advisory Insurance Brokerage</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css?v=10.0') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ss-custom.css?v=2.1') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />

    <style>
        :root {
            --auth-bg: #f0f4ff;
            --auth-card-bg: #ffffff;
            --auth-accent: #4f46e5;
            --auth-accent-hover: #4338ca;
            --auth-border: #e2e8f0;
            --auth-text-muted: #64748b;
            --auth-shadow: 0 20px 60px rgba(79, 70, 229, 0.12), 0 4px 16px rgba(0,0,0,0.06);
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--auth-bg);
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            background: linear-gradient(135deg, #f0f4ff 0%, #e8eeff 50%, #f5f0ff 100%);
            position: relative;
            overflow: hidden;
        }

        /* Decorative blobs */
        .auth-wrapper::before,
        .auth-wrapper::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }
        .auth-wrapper::before {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #818cf8, transparent 70%);
            top: -150px;
            right: -100px;
        }
        .auth-wrapper::after {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #a78bfa, transparent 70%);
            bottom: -100px;
            left: -80px;
        }

        .auth-card {
            background: var(--auth-card-bg);
            border-radius: 20px;
            box-shadow: var(--auth-shadow);
            padding: 2.75rem 2.5rem;
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255,255,255,0.8);
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo img {
            height: 48px;
            width: auto;
        }

        .auth-logo .brand-name {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--auth-text-muted);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 0.5rem;
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.35rem;
            text-align: center;
        }

        .auth-subtitle {
            font-size: 0.875rem;
            color: var(--auth-text-muted);
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-label {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.375rem;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid var(--auth-border);
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
            color: #1e293b;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: var(--auth-accent);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
            background: #fff;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            background: #fff8f8;
        }

        .invalid-feedback {
            font-size: 0.78rem;
            color: #ef4444;
        }

        .input-group .form-control {
            border-right: none;
            border-radius: 10px 0 0 10px;
        }

        .input-group .btn-toggle-pw {
            border: 1.5px solid var(--auth-border);
            border-left: none;
            border-radius: 0 10px 10px 0;
            background: #f8fafc;
            color: var(--auth-text-muted);
            padding: 0 1rem;
            transition: color 0.2s;
        }

        .input-group .btn-toggle-pw:hover {
            color: var(--auth-accent);
        }

        .input-group .form-control.is-invalid ~ .btn-toggle-pw {
            border-color: #ef4444;
        }

        .btn-auth-submit {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, var(--auth-accent), #7c3aed);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 0.9375rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
            cursor: pointer;
        }

        .btn-auth-submit:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-auth-submit:active {
            transform: translateY(0);
        }

        .auth-divider {
            text-align: center;
            font-size: 0.8125rem;
            color: var(--auth-text-muted);
            margin-top: 1.5rem;
        }

        .auth-divider a {
            color: var(--auth-accent);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .auth-divider a:hover {
            color: var(--auth-accent-hover);
            text-decoration: underline;
        }

        .form-check-label {
            font-size: 0.8125rem;
            color: var(--auth-text-muted);
        }

        .form-check-input:checked {
            background-color: var(--auth-accent);
            border-color: var(--auth-accent);
        }

        .alert-auth-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 10px;
            color: #b91c1c;
            font-size: 0.85rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="SS Advisory Logo" />
                <span class="brand-name">SS Advisory Lead Engine</span>
            </div>

            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.btn-toggle-pw').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const input = this.closest('.input-group').querySelector('input');
                const icon  = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
