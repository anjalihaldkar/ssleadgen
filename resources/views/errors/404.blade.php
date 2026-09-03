<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>404 - Page Not Found | SS Advisory Lead Engine</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />

    <style>
        :root {
            --brand-navy: #0B192C;
            --brand-navy-light: #1E3E62;
            --brand-accent: #4F46E5;
            --brand-accent-hover: #4338CA;
            --brand-cyan: #00ADB5;
            --text-muted: #64748B;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #F8FAFC;
            color: #1E293B;
        }

        .error-page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 1.25rem;
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at 10% 20%, rgba(79, 70, 229, 0.05) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(0, 173, 181, 0.06) 0%, transparent 45%),
                        linear-gradient(135deg, #F8FAFC 0%, #EEF2F6 100%);
        }

        /* Decorative blur circles */
        .blur-circle-1 {
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15), transparent 70%);
            top: -120px;
            right: -100px;
            filter: blur(60px);
            pointer-events: none;
        }

        .blur-circle-2 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.12), transparent 70%);
            bottom: -100px;
            left: -100px;
            filter: blur(60px);
            pointer-events: none;
        }

        .error-card {
            background: #FFFFFF;
            border-radius: 24px;
            padding: 3.5rem 3rem;
            max-width: 580px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08), 0 1px 3px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            z-index: 1;
            animation: fadeInScale 0.4s ease-out;
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(12px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .brand-header {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            text-decoration: none;
        }

        .brand-logo {
            height: 44px;
            width: auto;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            text-align: left;
        }

        .brand-title {
            font-size: 0.95rem;
            font-weight: 800;
            color: #0F172A;
            letter-spacing: 0.04em;
            line-height: 1.1;
        }

        .brand-subtitle {
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--brand-cyan);
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .error-badge-wrapper {
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .error-number {
            font-size: 6.5rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.04em;
            background: linear-gradient(135deg, #4F46E5 0%, #06B6D4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
            user-select: none;
        }

        .error-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .error-desc {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 2rem;
            max-width: 440px;
            margin-left: auto;
            margin-right: auto;
        }

        .action-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.85rem;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--brand-accent), #6366F1);
            color: #FFFFFF;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.8rem 1.6rem;
            border-radius: 12px;
            border: none;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-primary-custom:hover {
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.45);
        }

        .btn-secondary-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #F1F5F9;
            color: #334155;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.8rem 1.4rem;
            border-radius: 12px;
            border: 1px solid #E2E8F0;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-secondary-custom:hover {
            background: #E2E8F0;
            color: #0F172A;
            transform: translateY(-2px);
        }

        .quick-links {
            margin-top: 2.5rem;
            padding-top: 1.75rem;
            border-top: 1px solid #F1F5F9;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .quick-link-item {
            font-size: 0.82rem;
            font-weight: 600;
            color: #64748B;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            transition: color 0.15s;
        }

        .quick-link-item:hover {
            color: var(--brand-accent);
        }

        @media (max-width: 576px) {
            .error-card {
                padding: 2.25rem 1.5rem;
            }
            .error-number {
                font-size: 5rem;
            }
            .action-group {
                flex-direction: column;
                width: 100%;
            }
            .btn-primary-custom,
            .btn-secondary-custom {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="error-page-wrapper">
        <div class="blur-circle-1"></div>
        <div class="blur-circle-2"></div>

        <div class="error-card">
            <!-- Brand Header -->
            <a href="{{ url('/') }}" class="brand-header">
                <img src="{{ asset('assets/images/logo.png') }}" alt="SS Advisory Logo" class="brand-logo" />
                <div class="brand-text">
                    <span class="brand-title">SS ADVISORY</span>
                    <span class="brand-subtitle">Lead Engine</span>
                </div>
            </a>

            <!-- Big 404 Display -->
            <div class="error-badge-wrapper">
                <h1 class="error-number">404</h1>
            </div>

            <h2 class="error-title">Page Not Found</h2>
            <p class="error-desc">
                The URL you requested does not exist or may have been moved. Double-check the address or return to the main application.
            </p>

            <!-- Navigation Buttons -->
            <div class="action-group">
                <a href="{{ auth()->check() ? route('dashboard') : url('/login') }}" class="btn-primary-custom">
                    <i class="fa-solid {{ auth()->check() ? 'fa-gauge-high' : 'fa-right-to-bracket' }}"></i>
                    {{ auth()->check() ? 'Back to Dashboard' : 'Sign In to Account' }}
                </a>

                <button type="button" onclick="window.history.back();" class="btn-secondary-custom">
                    <i class="fa-solid fa-arrow-left"></i>
                    Go Back
                </button>
            </div>

            <!-- Quick Access Links -->
            @auth
            <div class="quick-links">
                @if(auth()->user()->hasPermission('clients'))
                <a href="{{ url('clients') }}" class="quick-link-item">
                    <i class="fa-solid fa-users text-primary"></i> Clients
                </a>
                @endif
                @if(auth()->user()->hasPermission('leads'))
                <a href="{{ url('crm/pipeline') }}" class="quick-link-item">
                    <i class="fa-solid fa-bullseye text-primary"></i> Leads
                </a>
                @endif
                @if(auth()->user()->hasPermission('tasks'))
                <a href="{{ url('utilities/tasks') }}" class="quick-link-item">
                    <i class="fa-solid fa-list-check text-primary"></i> Tasks
                </a>
                @endif
                @if(auth()->user()->hasPermission('calendar'))
                <a href="{{ url('utilities/calendar') }}" class="quick-link-item">
                    <i class="fa-solid fa-calendar-days text-primary"></i> Calendar
                </a>
                @endif
            </div>
            @endauth
        </div>
    </div>
</body>

</html>
