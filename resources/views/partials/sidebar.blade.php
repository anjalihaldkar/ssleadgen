<!-- Navigation Sidebar (Consistent across all 15 pages) -->
    <nav class="nxl-navigation" id="mainSidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ url('/') }}" class="b-brand d-flex align-items-center gap-3 text-decoration-none"
                    title="SS Advisory Lead Engine Home">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="SS Advisory Logo" class="brand-logo-img" />
                    <div class="nxl-mtext d-flex flex-column">
                        <span class="fs-14 fw-bolder text-white tracking-wide"
                            style="letter-spacing: 0.05em; line-height: 1.1;">SS <span
                                style="color: var(--color-cyan);">ADVISORY</span></span>
                        <span class="fs-10 text-muted fw-semibold text-uppercase mt-1"
                            style="letter-spacing: 0.12em; color: #94A3B8 !important;">LEAD ENGINE</span>
                    </div>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item {{ request()->is('/') || request()->is('dashboard*') ? 'active' : '' }}">
                        <a href="{{ url('/') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-grid"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="nxl-item nxl-hasmenu {{ request()->is('clients*') || request()->is('claims*') ? 'active nxl-trigger' : '' }}">
                        <a href="{{ url('clients') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Clients</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu" style="{{ request()->is('clients*') || request()->is('claims*') ? 'display: block !important;' : '' }}">
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('auth/clients-login') }}">Login Client</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/inforce') }}">Inforce Clients</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/inactive') }}">Inactive Clients</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('policies/claims') }}">Claim update</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/cancellation') }}">Cancellation update</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/npw-deferred') }}">NPW Deferred</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients') }}">All Clients</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item {{ request()->is('crm*') ? 'active' : '' }}">
                        <a href="{{ url('crm/pipeline') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-target"></i></span>
                            <span class="nxl-mtext">Leads</span>
                        </a>
                    </li>
                    <li class="nxl-item {{ request()->is('utilities/tasks') ? 'active' : '' }}">
                        <a href="{{ url('utilities/tasks') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-check-square"></i></span>
                            <span class="nxl-mtext">Tasks & Follow ups</span>
                        </a>
                    </li>
                    <li class="nxl-item {{ request()->is('utilities/calendar') ? 'active' : '' }}">
                        <a href="{{ url('utilities/calendar') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-calendar"></i></span>
                            <span class="nxl-mtext">Calendar</span>
                        </a>
                    </li>
                    <li class="nxl-item {{ request()->is('crm/reports') ? 'active' : '' }}">
                        <a href="{{ url('crm/reports') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
                            <span class="nxl-mtext">Reports</span>
                        </a>
                    </li>
                    <li class="nxl-item {{ request()->is('utilities/documents') ? 'active' : '' }}">
                        <a href="{{ url('utilities/documents') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-folder"></i></span>
                            <span class="nxl-mtext">Documents</span>
                        </a>
                    </li>
                    <li class="nxl-item {{ request()->is('settings/access') ? 'active' : '' }}">
                        <a href="{{ url('settings/access') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-lock"></i></span>
                            <span class="nxl-mtext">Access Control</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
