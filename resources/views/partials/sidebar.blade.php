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
                    {{-- 1. Dashboard Overview --}}
                    @if(auth()->user()?->hasPermission('dashboard'))
                    <li class="nxl-item {{ request()->is('/') || request()->is('dashboard*') || request()->is('analytics*') ? 'active' : '' }}">
                        <a href="{{ url('/') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-grid"></i></span>
                            <span class="nxl-mtext">Dashboard</span>
                        </a>
                    </li>
                    @endif

                    {{-- 2. Clients Directory --}}
                    @if(auth()->user()?->hasPermission('clients'))
                    <li class="nxl-item nxl-hasmenu {{ request()->is('clients*') ? 'active nxl-trigger' : '' }}">
                        <a href="{{ url('clients') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-users"></i></span>
                            <span class="nxl-mtext">Clients</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu" style="{{ request()->is('clients*') ? 'display: block !important;' : '' }}">
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('auth/clients-login') }}">Login Client</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/inforce') }}">Inforce Clients</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/inactive') }}">Inactive Clients</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/cancellation') }}">Cancellation update</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients/npw-deferred') }}">NPW Deferred</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('clients') }}">All Clients</a></li>
                        </ul>
                    </li>
                    @endif

                    {{-- 3. Policies Portfolio --}}
                    @if(auth()->user()?->hasPermission('policies'))
                    <li class="nxl-item {{ request()->is('policies') ? 'active' : '' }}">
                        <a href="{{ url('policies') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-file-text"></i></span>
                            <span class="nxl-mtext">Policies Portfolio</span>
                        </a>
                    </li>
                    @endif

                    {{-- 4. Leads Pipeline --}}
                    @if(auth()->user()?->hasPermission('leads'))
                    <li class="nxl-item {{ request()->is('crm/pipeline*') || request()->is('crm/create*') ? 'active' : '' }}">
                        <a href="{{ url('crm/pipeline') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-target"></i></span>
                            <span class="nxl-mtext">Leads</span>
                        </a>
                    </li>
                    @endif

                    {{-- 5. Tasks & Follow-ups --}}
                    @if(auth()->user()?->hasPermission('tasks'))
                    <li class="nxl-item {{ request()->is('utilities/tasks*') ? 'active' : '' }}">
                        <a href="{{ url('utilities/tasks') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-check-square"></i></span>
                            <span class="nxl-mtext">Tasks & Follow ups</span>
                        </a>
                    </li>
                    @endif

                    {{-- 6. Calendar & Consultations --}}
                    @if(auth()->user()?->hasPermission('calendar'))
                    <li class="nxl-item {{ request()->is('utilities/calendar*') ? 'active' : '' }}">
                        <a href="{{ url('utilities/calendar') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-calendar"></i></span>
                            <span class="nxl-mtext">Calendar</span>
                        </a>
                    </li>
                    @endif

                    {{-- 7. Reports & Analytics --}}
                    @if(auth()->user()?->hasPermission('reports'))
                    <li class="nxl-item {{ request()->is('crm/reports*') ? 'active' : '' }}">
                        <a href="{{ url('crm/reports') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
                            <span class="nxl-mtext">Reports</span>
                        </a>
                    </li>
                    @endif

                    {{-- 8. Document Vault --}}
                    @if(auth()->user()?->hasPermission('documents'))
                    <li class="nxl-item {{ request()->is('utilities/documents*') ? 'active' : '' }}">
                        <a href="{{ url('utilities/documents') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-folder"></i></span>
                            <span class="nxl-mtext">Documents</span>
                        </a>
                    </li>
                    @endif

                    {{-- 9. Claims Advocacy --}}
                    @if(auth()->user()?->hasPermission('claims'))
                    <li class="nxl-item {{ request()->is('policies/claims*') ? 'active' : '' }}">
                        <a href="{{ url('policies/claims') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-shield"></i></span>
                            <span class="nxl-mtext">Claims Advocacy</span>
                        </a>
                    </li>
                    @endif

                    {{-- 10. Settings & Sources --}}
                    @if(auth()->user()?->hasPermission('settings'))
                    <li class="nxl-item nxl-hasmenu {{ request()->is('settings/sources*') || request()->is('settings/commissions*') ? 'active nxl-trigger' : '' }}">
                        <a href="{{ url('settings/sources') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-settings"></i></span>
                            <span class="nxl-mtext">Settings & Sources</span>
                            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu" style="{{ request()->is('settings/sources*') || request()->is('settings/commissions*') ? 'display: block !important;' : '' }}">
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('settings/sources') }}">Lead Sources</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ url('settings/commissions') }}">Commissions</a></li>
                        </ul>
                    </li>
                    @endif

                    {{-- 11. Access Control --}}
                    @if(auth()->user()?->hasPermission('access'))
                    <li class="nxl-item {{ request()->is('settings/access*') ? 'active' : '' }}">
                        <a href="{{ url('settings/access') }}" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-lock"></i></span>
                            <span class="nxl-mtext">Access Control</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
