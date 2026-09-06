@extends('layouts.app')
@section('title', 'NPW Deferred Directory')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">NPW Deferred Directory</h4>
                    <p class="text-muted fs-13 mb-0">Manage and track NPW Deferred client status, policies details, and
                        adviser actions.</p>
                </div>

            </div>

            <!-- Top Filter Search Bar -->
            <section class="dash-filter-card">
                <div class="d-flex align-items-end justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3 flex-wrap flex-fill">
                        <div style="min-width: 170px;" class="flex-fill">
                            <label class="fs-11 fw-bold text-muted mb-1 d-block">Client Search</label>
                            <div class="dash-filter-input-group">
                                <i class="feather-search"></i>
                                <input type="text" id="filterClientSearch" class="form-control dash-filter-input"
                                    placeholder="Search by client name" />
                            </div>
                        </div>
                        <div style="min-width: 170px;" class="flex-fill">
                            <label class="fs-11 fw-bold text-muted mb-1 d-block">Number Search</label>
                            <div class="dash-filter-input-group">
                                <i class="feather-search"></i>
                                <input type="text" id="filterNumberSearch" class="form-control dash-filter-input"
                                    placeholder="Search by phone number" />
                            </div>
                        </div>
                        <div style="min-width: 170px;" class="flex-fill">
                            <label class="fs-11 fw-bold text-muted mb-1 d-block">Address Search</label>
                            <div class="dash-filter-input-group">
                                <i class="feather-search"></i>
                                <input type="text" id="filterAddressSearch" class="form-control dash-filter-input"
                                    placeholder="Search by address" />
                            </div>
                        </div>
                        <div style="min-width: 150px;" class="flex-fill">
                            <label class="fs-11 fw-bold text-muted mb-1 d-block">Date of Birth Search</label>
                            <div class="dash-filter-input-group">
                                <i class="feather-calendar"></i>
                                <input type="text" id="filterDobSearch" class="form-control dash-filter-input"
                                    placeholder="DD / MM / YYYY" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                        <button id="btnExecuteSearch" class="btn btn-navy px-3 py-2 fw-bold"><i
                                class="feather-search me-1"></i> Search</button>
                        <button id="btnClearSearch" class="btn btn-light px-3 py-2 fw-semibold">Clear</button>
                    </div>
                </div>
            </section>

            <!-- Table Card -->
            <div class="card-widget">
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100" id="npwDeferredTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Client Name</th>
                                <th>Policy No.</th>
                                <th>Company</th>
                                <th>Mobile</th>
                                <th>Issue Date</th>
                                <th>Premium</th>
                                <th>Admin</th>
                                <th>Pending</th>
                                <th>Comments</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr>
                                <td class="fw-bold text-dark fs-13">{{ $client->first_name }} {{ $client->last_name }}</td>
                                <td class="fs-13 text-muted">{{ $client->policy_no }}</td>
                                <td class="fs-13 fw-semibold text-dark">{{ $client->company }}</td>
                                <td class="fs-13 text-muted">{{ $client->phone }}</td>
                                <td class="fs-13 text-muted">{{ $client->npw_issue_date ? $client->npw_issue_date->format('d/m/Y') : 'N/A' }}</td>
                                <td class="fs-13 fw-bold text-dark">${{ number_format($client->npw_premium ?: $client->anp, 2) }} <small class="text-muted">({{ $client->npw_premium_mode ?? 'Monthly' }})</small></td>
                                <td class="fs-13 text-muted">{{ $client->npw_admin ?? 'N/A' }}</td>
                                <td>
                                    @if($client->npw_pending == 'Yes')
                                        <span class="badge bg-soft-warning text-warning fs-11">Yes</span>
                                    @else
                                        <span class="badge bg-soft-success text-success fs-11">No</span>
                                    @endif
                                </td>
                                <td class="fs-13 text-muted">{{ Str::limit($client->npw_comments ?? 'No comments.', 50) }}</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewNpwDetails('{{ addslashes($client->first_name) }}', '{{ addslashes($client->last_name) }}', '{{ addslashes($client->policy_no) }}', '{{ addslashes($client->company) }}', '{{ $client->dob ? $client->dob->format('d/m/Y') : '' }}', '{{ addslashes($client->phone) }}', '{{ addslashes($client->email) }}', '{{ addslashes($client->address) }}', '{{ addslashes($client->suburb ?? '') }}', '{{ addslashes($client->city) }}', '{{ addslashes($client->zip_code) }}', '{{ $client->npw_issue_date ? $client->npw_issue_date->format('d/m/Y') : '' }}', '{{ $client->npw_premium ?: $client->anp }}', '{{ addslashes($client->npw_premium_mode) }}', '{{ addslashes($client->npw_admin) }}', '{{ addslashes($client->npw_comments) }}', '{{ addslashes($client->npw_pending) }}', '{{ addslashes($client->npw_comments) }}')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="10" class="text-center text-muted py-4">No NPW Deferred records found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            

<!-- Modal: View Details -->
    <div class="modal fade" id="viewNpwModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-eye me-2"></i> NPW Deferred Details -
                        <span id="viewNpwClientHeader"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">

                    <!-- SECTION 1: PERSONAL DETAILS -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-user text-primary fs-15"></i> 1. Personal Details
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">First Name</label>
                                <input type="text" class="form-control" id="viewNpwFirstName" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Last Name</label>
                                <input type="text" class="form-control" id="viewNpwLastName" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">DOB</label>
                                <input type="text" class="form-control" id="viewNpwDob" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Mobile</label>
                                <input type="text" class="form-control" id="viewNpwMobile" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Email</label>
                                <input type="text" class="form-control" id="viewNpwEmail" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: ADDRESS -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-map-pin text-primary fs-15"></i> 2. Address Details
                        </div>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-semibold fs-13 text-dark">Address</label>
                                <input type="text" class="form-control" id="viewNpwAddress" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold fs-13 text-dark">Suburb</label>
                                <input type="text" class="form-control" id="viewNpwSuburb" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-13 text-dark">City</label>
                                <input type="text" class="form-control" id="viewNpwCity" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-semibold fs-13 text-dark">Post Code</label>
                                <input type="text" class="form-control" id="viewNpwPostCode" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: POLICY & ACTION -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-file-text text-primary fs-15"></i> 3. Policy & Admin Details
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label fw-semibold fs-13 text-dark">Policy No.</label>
                                <input type="text" class="form-control text-primary fw-semibold" id="viewNpwPolicyNo"
                                    readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold fs-13 text-dark">Company</label>
                                <input type="text" class="form-control fw-semibold" id="viewNpwCompany" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold fs-13 text-dark">Issue Date</label>
                                <input type="text" class="form-control" id="viewNpwIssueDate" readonly>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold fs-13 text-dark">Admin</label>
                                <input type="text" class="form-control" id="viewNpwAdmin" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Premium</label>
                                <input type="text" class="form-control text-dark fw-bold" id="viewNpwPremium" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Premium Mode</label>
                                <input type="text" class="form-control" id="viewNpwPremiumMode" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Pending</label>
                                <input type="text" class="form-control text-warning fw-bold" id="viewNpwPending"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: NOTES & COMMENTS -->
                    <div class="modal-section-card mb-0">
                        <div class="modal-section-title">
                            <i class="feather-message-square text-primary fs-15"></i> 4. Comments & Notes
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Notes/Comments</label>
                                <textarea class="form-control" id="viewNpwNotesComments" rows="3" readonly></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Comments</label>
                                <textarea class="form-control" id="viewNpwComments" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm px-4 fw-bold"
                        onclick="$('#viewNpwModal').modal('hide'); editNpwDetails($('#viewNpwFirstName').val(), $('#viewNpwLastName').val(), $('#viewNpwPolicyNo').val(), $('#viewNpwCompany').val(), $('#viewNpwDob').val(), $('#viewNpwMobile').val(), $('#viewNpwEmail').val(), $('#viewNpwAddress').val(), $('#viewNpwSuburb').val(), $('#viewNpwCity').val(), $('#viewNpwPostCode').val(), $('#viewNpwIssueDate').val(), $('#viewNpwPremium').val(), $('#viewNpwPremiumMode').val(), $('#viewNpwAdmin').val(), $('#viewNpwNotesComments').val(), $('#viewNpwPending').val(), $('#viewNpwComments').val());"><i
                            class="feather-edit me-1"></i> Edit Record</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add / Edit NPW Record -->
    <div class="modal fade" id="addNpwModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-plus me-2"></i> <span
                            id="npwModalTitle">Add NPW Deferred Record</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="addNpwDeferredForm" onsubmit="event.preventDefault(); handleAddNewNpw();">
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">

                        <!-- SECTION 1: PERSONAL DETAILS -->
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-user text-primary fs-15"></i> 1. Personal Details
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">First Name *</label>
                                    <input type="text" class="form-control" id="npwFirstNameInput"
                                        placeholder="First name" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Last Name *</label>
                                    <input type="text" class="form-control" id="npwLastNameInput"
                                        placeholder="Last name" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">DOB *</label>
                                    <input type="date" class="form-control" id="npwDobInput" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Mobile *</label>
                                    <input type="text" class="form-control" id="npwMobileInput"
                                        placeholder="02X XXX XXXX" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Email *</label>
                                    <input type="email" class="form-control" id="npwEmailInput"
                                        placeholder="name@example.com" required>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: ADDRESS -->
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-map-pin text-primary fs-15"></i> 2. Address Details
                            </div>
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold fs-13 text-dark">Address *</label>
                                    <input type="text" class="form-control" id="npwAddressInput"
                                        placeholder="Street Address" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold fs-13 text-dark">Suburb *</label>
                                    <input type="text" class="form-control" id="npwSuburbInput" placeholder="Suburb"
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold fs-13 text-dark">City *</label>
                                    <input type="text" class="form-control" id="npwCityInput" placeholder="City"
                                        required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label fw-semibold fs-13 text-dark">Post Code *</label>
                                    <input type="text" class="form-control" id="npwPostCodeInput"
                                        placeholder="Post Code" required>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: POLICY & ADMIN -->
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-file-text text-primary fs-15"></i> 3. Policy & Admin Details
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Policy No. *</label>
                                    <input type="text" class="form-control" id="npwPolicyNoInput" placeholder="POL-XXXX"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Company *</label>
                                    <input type="text" class="form-control" id="npwCompanyInput"
                                        placeholder="Insurance Company (e.g. AIA Life)" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Issue Date *</label>
                                    <input type="date" class="form-control" id="npwIssueDateInput" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold fs-13 text-dark">Premium *</label>
                                    <input type="text" class="form-control" id="npwPremiumInput"
                                        placeholder="e.g. 150.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold fs-13 text-dark">Premium Mode</label>
                                    <select class="form-select" id="npwPremiumModeSelect">
                                        <option value="Weekly">Weekly</option>
                                        <option value="Fortnightly">Fortnightly</option>
                                        <option value="Monthly" selected>Monthly</option>
                                        <option value="Annually">Annually</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold fs-13 text-dark">Admin (Handler)</label>
                                    <select class="form-select" id="npwAdminSelect">
                                        <option value="Sushant Yadav" selected>Sushant Yadav</option>
                                        <option value="Royson Pinto">Royson Pinto</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold fs-13 text-dark">Pending</label>
                                    <select class="form-select" id="npwPendingSelect">
                                        <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 4: COMMENTS -->
                        <div class="modal-section-card mb-0">
                            <div class="modal-section-title">
                                <i class="feather-message-square text-primary fs-15"></i> 4. Notes & Comments
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Notes/Comments</label>
                                    <textarea class="form-control" id="npwNotesCommentsInput" rows="3"
                                        placeholder="Enter notes or explanation for deferral..."></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Comments</label>
                                    <textarea class="form-control" id="npwCommentsInput" rows="3"
                                        placeholder="Enter any additional comments..."></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold">Save Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    
        </div>
    </div>

    
    
    
    
    
    
    
    
    
    
    

    <!-- Modal: Client Request Popup -->
    <div class="modal fade" id="clientRequestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-git-pull-request me-2"></i> Client Service Request - <span id="reqClientNameHeader"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="clientRequestForm" onsubmit="event.preventDefault(); handleSaveClientRequest();">
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-calendar text-primary fs-15"></i> 1. Request Overview
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Date *</label>
                                    <input type="date" class="form-control" id="reqDateInput" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Client Name *</label>
                                    <input type="text" class="form-control" id="reqClientNameInput" placeholder="Client Name" required>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Insurance Company *</label>
                                    <input type="text" class="form-control" id="reqCompanyInput" placeholder="Insurance Company" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-layers text-primary fs-15"></i> 2. Service Request & Processing
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Request Type *</label>
                                    <select class="form-select" id="reqTypeSelect" required>
                                        <option value="LOA">LOA</option>
                                        <option value="Update Address">Update Address</option>
                                        <option value="Put the premium on hold">Put the premium on hold</option>
                                        <option value="LOA / Change of Adviser">LOA / Change of Adviser</option>
                                        <option value="Correctify Name">Correctify Name</option>
                                        <option value="Premium Deduction of 1 month">Premium Deduction of 1 month</option>
                                        <option value="Birth Certificate to add name inbuilt cover">Birth Certificate to add name inbuilt cover</option>
                                        <option value="Update Payment Details - DD">Update Payment Details - DD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Process Status</label>
                                    <select class="form-select" id="reqProcessSelect">
                                        <option value="Logged">Logged</option>
                                        <option value="In Processing">In Processing</option>
                                        <option value="Submitted to Insurer">Submitted to Insurer</option>
                                        <option value="Pending Information">Pending Information</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Process by *</label>
                                    <select class="form-select" id="reqProcessBySelect" required>
                                        <option value="Sushant Yadav">Sushant Yadav</option>
                                        <option value="Royson Pinto">Royson Pinto</option>
                                        <option value="Operations Team">Operations Team</option>
                                        <option value="Compliance Officer">Compliance Officer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-section-card mb-0">
                            <div class="modal-section-title">
                                <i class="feather-check-circle text-primary fs-15"></i> 3. Outcome & Completion Details
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Results / Outcome</label>
                                    <textarea class="form-control" id="reqOutcomeInput" rows="2" placeholder="e.g. Address updated with AIA portal successfully."></textarea>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Comments</label>
                                    <textarea class="form-control" id="reqCommentsInput" rows="2" placeholder="Internal notes or adviser instructions..."></textarea>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Finished Day (Date)</label>
                                    <input type="date" class="form-control" id="reqFinishedDateInput">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold"><i class="feather-save me-1"></i> Save Client Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Claim Update Popup -->
    <div class="modal fade" id="lodgeClaimModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-shield me-2"></i> <span id="claimModalTitle">New Claim Update</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="lodgeClaimForm" onsubmit="event.preventDefault(); handleAddNewClaim();">
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-user text-primary fs-15"></i> 1. Client & Provider Info
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Client Name *</label>
                                    <select class="form-select" id="claimClientSelect" required>
                                        <option value="Rahul Sharma">Rahul Sharma</option>
                                        <option value="Amanda Miller">Amanda Miller</option>
                                        <option value="Jason Te Kuru">Jason Te Kuru</option>
                                        <option value="Priya Patel">Priya Patel</option>
                                        <option value="David Chen">David Chen</option>
                                        <option value="Kishore Kumar">Kishore Kumar</option>
                                        <option value="Suman Pappula">Suman Pappula</option>
                                        <option value="Vandana Singh">Vandana Singh</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Insurance Company *</label>
                                    <select class="form-select" id="claimCompanySelect">
                                        <option value="AIA Life">AIA Life</option>
                                        <option value="Fidelity Life">Fidelity Life</option>
                                        <option value="Chubb Life">Chubb Life</option>
                                        <option value="Partners Life">Partners Life</option>
                                        <option value="Asteron Life">Asteron Life</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Claims (Type / Description) *</label>
                                    <input type="text" class="form-control" id="claimTypeInput" placeholder="e.g. Medical Surgery / Trauma" required>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Admin (Claim Handler)</label>
                                    <select class="form-select" id="claimAdminSelect">
                                        <option value="Sushant Yadav">Sushant Yadav</option>
                                        <option value="Royson Pinto">Royson Pinto</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-section-card mb-0">
                            <div class="modal-section-title">
                                <i class="feather-clock text-primary fs-15"></i> 2. Timeline & Status Outcome
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Processed Date</label>
                                    <input type="date" class="form-control" id="claimProcessedDateInput">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Update (Status)</label>
                                    <select class="form-select" id="claimUpdateSelect">
                                        <option value="Under Assessment">Under Assessment</option>
                                        <option value="Medical Review">Medical Review</option>
                                        <option value="Document Verification">Document Verification</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Declined">Declined</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Approved Date</label>
                                    <input type="date" class="form-control" id="claimApprovedDateInput">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Result / Outcome</label>
                                    <input type="text" class="form-control" id="claimOutcomeInput" placeholder="e.g. Approved / Paid $18,500">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold">Save Claim Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Cancellation Update Popup -->
    <div class="modal fade" id="addCancellationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-file-minus me-2"></i> <span id="cancModalTitle">New Cancellation Update</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addCancellationForm" onsubmit="event.preventDefault(); handleAddNewCancellation();">
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-user text-primary fs-15"></i> 1. Client & Insurance Provider
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Client Name *</label>
                                    <select class="form-select" id="cancClientSelect" required>
                                        <option value="Rahul Sharma">Rahul Sharma</option>
                                        <option value="Amanda Miller">Amanda Miller</option>
                                        <option value="Jason Te Kuru">Jason Te Kuru</option>
                                        <option value="Priya Patel">Priya Patel</option>
                                        <option value="David Chen">David Chen</option>
                                        <option value="Kishore Kumar">Kishore Kumar</option>
                                        <option value="Suman Pappula">Suman Pappula</option>
                                        <option value="Vandana Singh">Vandana Singh</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Company *</label>
                                    <select class="form-select" id="cancCompanySelect">
                                        <option value="AIA Life">AIA Life</option>
                                        <option value="Fidelity Life">Fidelity Life</option>
                                        <option value="Chubb Life">Chubb Life</option>
                                        <option value="Partners Life">Partners Life</option>
                                        <option value="Asteron Life">Asteron Life</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-clock text-primary fs-15"></i> 2. Cancellation Timeline & Outcome
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Cancellation Sent</label>
                                    <input type="date" class="form-control" id="cancDateSentInput">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Completed</label>
                                    <input type="text" class="form-control" id="cancCompletedInput" placeholder="e.g. 15/08/2026 or Pending">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Admin (Handler)</label>
                                    <select class="form-select" id="cancAdminSelect">
                                        <option value="Sushant Yadav">Sushant Yadav</option>
                                        <option value="Royson Pinto">Royson Pinto</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Outcome</label>
                                    <input type="text" class="form-control" id="cancOutcomeInput" placeholder="e.g. Cancelled - Premium Cost Concerns">
                                </div>
                            </div>
                        </div>

                        <div class="modal-section-card mb-0">
                            <div class="modal-section-title">
                                <i class="feather-message-square text-primary fs-15"></i> 3. Comments & Internal Notes
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Comments</label>
                                    <textarea class="form-control" id="cancCommentsInput" rows="3" placeholder="Enter comments or cancellation reason..."></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold">Save Cancellation Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    <script src="{{ asset('assets/js/pages/clients-npw-deferred.js?v=1.2') }}"></script>
@endpush

@endsection
