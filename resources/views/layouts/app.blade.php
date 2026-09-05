<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Dashboard') | SS Advisory Insurance Brokerage</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Modular Design System -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css?v=10.0') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ss-custom.css?v=2.1') }}" />

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
    
    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div class="nxl-preloader" id="preloader">
        <div class="preloader-content text-center">
            <div class="preloader-logo mb-3">
                <img src="{{ asset('assets/images/logo.png') }}" alt="SS Advisory Logo" class="brand-logo-img" />
            </div>
            <div class="spinner-border text-primary" role="status"
                style="width: 2.2rem; height: 2.2rem; color: var(--color-cyan) !important;">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    @include('partials.sidebar')
    @include('partials.header')

    <!-- Main Responsive Dashboard Container -->
    <main class="nxl-container">
        <div class="nxl-content d-flex flex-column gap-4">
            @yield('content')
        </div>

        <!-- RESPONSIVE FOOTER (DEVELOPED BY SITESOCH) -->
        <footer class="nxl-footer">
            <div
                class="d-flex align-items-center justify-content-between flex-wrap gap-2 py-3 px-4 fs-12 text-muted border-top bg-white">
                <div>© {{ date('Y') }} <span class="fw-bold text-dark">SS Advisory Lead Engine</span>. All Rights Reserved.</div>
                <div>Developed with <i class="feather-heart text-danger mx-1"></i> by <a href="https://sitesoch.com"
                        target="_blank" class="fw-bold text-primary text-decoration-none">Sitesoch</a></div>
            </div>
        </footer>
    </main>

    @include('partials.modals')

    <!-- JavaScript Vendor & Init Files -->
    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/nxlNavigation.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js?v=1.4') }}"></script>
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
