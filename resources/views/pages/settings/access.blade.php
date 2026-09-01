@extends('layouts.app')
@section('title', 'Access Control & Role Permissions')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Access Control & Role Permissions</h4>
                    <p class="text-muted fs-13 mb-0">Manage active advisor accounts, FSPR numbers, and assigned module permissions.</p>
                </div>
            </div>

            <!-- Tab Navigation Bar -->
            <ul class="nav nav-tabs task-filter-tabs mb-2" id="accessTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="users-tab" data-bs-toggle="tab" data-bs-target="#usersTabContent" type="button" role="tab" aria-controls="usersTabContent" aria-selected="true"><i class="feather-users me-1"></i> Users Management</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="roles-tab" data-bs-toggle="tab" data-bs-target="#rolesTabContent" type="button" role="tab" aria-controls="rolesTabContent" aria-selected="false"><i class="feather-shield me-1"></i> Roles & Permissions</button>
                </li>
            </ul>

            <div class="tab-content" id="accessTabContent">
                <!-- Tab 1: Users Management -->
                <div class="tab-pane fade show active" id="usersTabContent" role="tabpanel" aria-labelledby="users-tab">
                    <div class="card-widget">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <h6 class="widget-title mb-0">Advisor Directory</h6>
                            <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#addUserModal"><i class="feather-user-plus me-1"></i> Add New User</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle w-100" id="usersTable">
                                <thead>
                                    <tr class="fs-12 text-muted text-uppercase fw-semibold">
                                        <th>User Name</th>
                                        <th>Email Address</th>
                                        <th>Role Assigned</th>
                                        <th>FSPR Number</th>
                                        <th>Status</th>
                                        <th>Last Login</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-dark fs-13">Sushant Yadav</td>
                                        <td class="fs-13 text-muted">sushant@ssadvisory.co.nz</td>
                                        <td><span class="badge bg-soft-primary text-primary fs-11 fw-bold">Super Admin</span></td>
                                        <td class="fs-13 fw-semibold">FSP-771892</td>
                                        <td><span class="status-pill-inforce">Active</span></td>
                                        <td class="fs-13 text-muted">18 Aug 2026, 09:12 AM</td>
                                        <td class="text-center">
                                            <div class="action-kebab-wrapper">
                                                <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                                <div class="action-kebab-dropdown">
                                                    <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-edit text-primary me-1"></i> Edit User</a>
                                                    <a href="javascript:void(0);" class="action-kebab-item text-danger"><i class="feather-user-x text-danger me-1"></i> Deactivate</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark fs-13">Priya Patel</td>
                                        <td class="fs-13 text-muted">priya@ssadvisory.co.nz</td>
                                        <td><span class="badge bg-soft-info text-info fs-11 fw-bold">Insurance Advisor</span></td>
                                        <td class="fs-13 fw-semibold">FSP-449102</td>
                                        <td><span class="status-pill-inforce">Active</span></td>
                                        <td class="fs-13 text-muted">17 Aug 2026, 04:45 PM</td>
                                        <td class="text-center">
                                            <div class="action-kebab-wrapper">
                                                <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                                <div class="action-kebab-dropdown">
                                                    <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-edit text-primary me-1"></i> Edit User</a>
                                                    <a href="javascript:void(0);" class="action-kebab-item text-danger"><i class="feather-user-x text-danger me-1"></i> Deactivate</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Roles & Permissions Matrix -->
                <div class="tab-pane fade" id="rolesTabContent" role="tabpanel" aria-labelledby="roles-tab">
                    <div class="card-widget">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <h6 class="widget-title mb-0">Role Permissions Matrix</h6>
                            <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#addRoleModal"><i class="feather-plus me-1"></i> Add New Role</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle w-100" id="rolesTable">
                                <thead>
                                    <tr class="fs-12 text-muted text-uppercase fw-semibold">
                                        <th>Role Title</th>
                                        <th>Description</th>
                                        <th>Clients</th>
                                        <th>Policies</th>
                                        <th>Leads</th>
                                        <th>Reports</th>
                                        <th>Documents</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-dark fs-13">Super Administrator</td>
                                        <td class="fs-13 text-muted">Full system read/write access to all resources</td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td class="text-center">
                                            <div class="action-kebab-wrapper">
                                                <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                                <div class="action-kebab-dropdown">
                                                    <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-settings text-primary me-1"></i> Configure</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-dark fs-13">Insurance Advisor</td>
                                        <td class="fs-13 text-muted">Can manage assigned clients, leads, and policies</td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td><span class="badge bg-info fs-11">Read Only</span></td>
                                        <td><span class="badge bg-success fs-11">Read / Write</span></td>
                                        <td class="text-center">
                                            <div class="action-kebab-wrapper">
                                                <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                                <div class="action-kebab-dropdown">
                                                    <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-settings text-primary me-1"></i> Configure</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            

</div>
    </div>

    <!-- Modal: Add New Role with Full Sidebar Menu Permission Matrix -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-shield me-2"></i> Add New Access Role & Permissions</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addRoleForm" onsubmit="event.preventDefault(); handleAddNewRole();">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Role Title *</label>
                            <input type="text" class="form-control" id="roleTitleInput" placeholder="e.g. Underwriting Specialist" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Role Description</label>
                            <textarea class="form-control" id="roleDescInput" rows="2" placeholder="Brief description of role capabilities"></textarea>
                        </div>

                        <!-- ALL MENU ITEMS FROM SIDEBAR PERMISSION MATRIX -->
                        <h6 class="fw-bold text-dark mt-4 mb-2">Module Permission Levels (All Sidebar Menus)</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle fs-13">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Sidebar Navigation Menu</th>
                                        <th class="text-center">Read Only</th>
                                        <th class="text-center">Read / Write</th>
                                        <th class="text-center">None</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i class="feather-grid me-2 text-primary"></i> 1. Dashboard Overview</td>
                                        <td class="text-center"><input type="radio" name="perm_dash" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_dash" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_dash" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-users me-2 text-primary"></i> 2. Clients Directory</td>
                                        <td class="text-center"><input type="radio" name="perm_clients" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_clients" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_clients" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-file-text me-2 text-primary"></i> 3. Policies Portfolio</td>
                                        <td class="text-center"><input type="radio" name="perm_policies" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_policies" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_policies" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-target me-2 text-primary"></i> 4. Leads Pipeline</td>
                                        <td class="text-center"><input type="radio" name="perm_leads" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_leads" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_leads" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-check-square me-2 text-primary"></i> 5. Tasks & Follow ups</td>
                                        <td class="text-center"><input type="radio" name="perm_tasks" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_tasks" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_tasks" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-calendar me-2 text-primary"></i> 6. Calendar & Consultations</td>
                                        <td class="text-center"><input type="radio" name="perm_calendar" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_calendar" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_calendar" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-bar-chart-2 me-2 text-primary"></i> 7. Reports & Analytics</td>
                                        <td class="text-center"><input type="radio" name="perm_reports" value="Read" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_reports" value="Read / Write"></td>
                                        <td class="text-center"><input type="radio" name="perm_reports" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-folder me-2 text-primary"></i> 8. Document Vault</td>
                                        <td class="text-center"><input type="radio" name="perm_docs" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_docs" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_docs" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-shield me-2 text-primary"></i> 9. Claims Advocacy</td>
                                        <td class="text-center"><input type="radio" name="perm_claims" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_claims" value="Read / Write" checked></td>
                                        <td class="text-center"><input type="radio" name="perm_claims" value="None"></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-settings me-2 text-primary"></i> 10. Settings & Sources</td>
                                        <td class="text-center"><input type="radio" name="perm_settings" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_settings" value="Read / Write"></td>
                                        <td class="text-center"><input type="radio" name="perm_settings" value="None" checked></td>
                                    </tr>
                                    <tr>
                                        <td><i class="feather-lock me-2 text-primary"></i> 11. Access Control</td>
                                        <td class="text-center"><input type="radio" name="perm_access" value="Read"></td>
                                        <td class="text-center"><input type="radio" name="perm_access" value="Read / Write"></td>
                                        <td class="text-center"><input type="radio" name="perm_access" value="None" checked></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Save Role Configuration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Add New User -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-user-plus me-2"></i> Add New System User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addUserForm" onsubmit="event.preventDefault(); handleAddNewUser();">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">User Full Name *</label>
                            <input type="text" class="form-control" id="userNameInput" placeholder="e.g. Sushant Yadav" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Email Address *</label>
                            <input type="email" class="form-control" id="userEmailInput" placeholder="user@ssadvisory.co.nz" required>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Role Assigned</label>
                                <select class="form-select" id="userRoleSelect">
                                    <option value="Super Admin">Super Administrator</option>
                                    <option value="Insurance Advisor">Insurance Advisor</option>
                                    <option value="Compliance Specialist">Compliance Specialist</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">FSPR Number</label>
                                <input type="text" class="form-control" id="userFsprInput" placeholder="FSP-XXXXXX">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Create User Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    <script src="{{ asset('assets/js/pages/access.js') }}"></script>
@endpush

@endsection