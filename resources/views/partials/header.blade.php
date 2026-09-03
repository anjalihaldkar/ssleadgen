<!-- Header Bar -->
    <header class="nxl-header">
        <div class="header-wrapper">
            <div class="header-left">
                <a href="javascript:void(0);" id="menu-mini-button" class="header-single-toggle-btn"
                    title="Toggle Sidebar Navigation">
                    <i class="feather-menu"></i>
                </a>
                <div class="header-title-block ms-2">
                    <h4 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h4>
                </div>
            </div>

            <div class="header-right">
                <!-- NOTIFICATION HOVER POPUP -->
                <div class="header-action-bell-wrapper">
                    <div class="header-action-bell" title="Notifications">
                        <i class="feather-bell"></i>
                        <span class="header-bell-badge">5</span>
                    </div>
                    <div class="header-notification-dropdown">
                        <div class="notification-header">
                            <h6 class="fw-bold text-dark mb-0 fs-13">Notifications</h6>
                            <span class="badge bg-soft-primary text-primary fs-10">5 New</span>
                        </div>
                        <div class="notification-list">
                            <a href="{{ url('crm/pipeline') }}" class="notification-item">
                                <div class="avatar-text bg-soft-primary text-primary rounded-circle flex-shrink-0"><i
                                        class="feather-user-plus"></i></div>
                                <div>
                                    <div class="fs-12 fw-bold text-dark">New Lead Assigned</div>
                                    <div class="fs-11 text-muted">Michael Chang was assigned to your pipeline.</div>
                                    <div class="fs-10 text-muted mt-1">10 mins ago</div>
                                </div>
                            </a>
                            <a href="{{ url('policies') }}" class="notification-item">
                                <div class="avatar-text bg-soft-success text-success rounded-circle flex-shrink-0"><i
                                        class="feather-shield"></i></div>
                                <div>
                                    <div class="fs-12 fw-bold text-dark">Policy Issued</div>
                                    <div class="fs-11 text-muted">AIA Life policy POL-2026-8812 is active.</div>
                                    <div class="fs-10 text-muted mt-1">1 hour ago</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- USER AVATAR HOVER DROPDOWN -->
                <div class="header-user-profile-wrapper">
                    <div class="d-flex align-items-center gap-2">
                        <div class="header-avatar-circle">
                            <img src="{{ asset('assets/images/user-avatar.svg') }}" alt="User Avatar" />
                        </div>
                        <div class="d-none d-md-block text-start">
                            <div class="fs-13 fw-bold text-dark mb-0" style="line-height: 1.1;">
                                {{ auth()->user()?->name ?? 'User' }}
                                <i class="feather-chevron-down ms-1 fs-11 text-muted"></i>
                            </div>
                            <div class="fs-11 text-muted fw-semibold">
                                {{ auth()->user()?->role?->name ?? (auth()->user()?->isSuperAdmin() ? 'Super Administrator' : 'User') }}
                            </div>
                        </div>
                    </div>
                    <div class="header-user-dropdown">
                        <div class="px-3 py-2 border-bottom mb-1">
                            <div class="fw-bold text-dark fs-13">{{ auth()->user()?->name ?? 'User' }}</div>
                            <div class="fs-11 text-muted">{{ auth()->user()?->email ?? '' }}</div>
                        </div>
                        <button class="user-dropdown-item" data-bs-toggle="modal" data-bs-target="#resetPasswordModal">
                            <i class="feather-key text-primary me-2"></i> Reset Password
                        </button>
                        <button class="user-dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            <i class="feather-log-out text-danger me-2"></i> Logout Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
