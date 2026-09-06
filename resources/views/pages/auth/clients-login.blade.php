@extends('layouts.app')
@section('title', 'Login Client Directory')
@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        <i class="feather-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        <i class="feather-alert-circle me-2"></i> <strong>Validation Errors:</strong>
        <ul class="mb-0 mt-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Login Client Directory ({{ $loginClients->count() }} Clients)</h4>
                    <p class="text-muted fs-13 mb-0">Clients with pending policy submissions, compliance audits, and RoA requirements.</p>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <button class="btn btn-outline-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#importLoginClientsModal">
                        <i class="feather-upload me-1"></i> Import Clients
                    </button>
                    <button class="btn btn-primary btn-sm px-3 fw-bold" onclick="$('#loginModalTitle').text('Add New Login Client Entry'); $('#addLoginClientForm')[0].reset(); $('#addLoginClientModal').modal('show');">
                        <i class="feather-plus me-1"></i> Add Login Client
                    </button>
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
                    <table class="table table-hover align-middle w-100" id="loginClientsTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Policy No.</th>
                                <th>Company</th>
                                <th>Client Name</th>
                                <th>Mobile</th>
                                <th>Login Date</th>
                                <th>ANP</th>
                                <th>Status - Sent to Compliance</th>
                                <th>Sent to Client</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loginClients as $client)
                            <tr>
                                <td class="fw-bold text-dark fs-12">{{ $client->policy_no ?? '-' }}</td>
                                <td class="fs-13 fw-semibold text-dark">{{ $client->company ?? '-' }}</td>
                                <td class="fs-13 fw-bold text-dark">{{ $client->first_name }} {{ $client->last_name }}</td>
                                <td class="fs-13 text-muted">{{ $client->phone ?? '-' }}</td>
                                <td class="fs-13 text-muted">{{ $client->login_date?->format('d/m/Y') ?? '-' }}</td>
                                <td class="fs-13 fw-bold text-dark">${{ number_format($client->anp ?? 0) }}</td>
                                <td>
                                    @php
                                        $complianceBadge = match($client->status_compliance) {
                                            'Completed' => 'bg-soft-success text-success',
                                            'Approved'  => 'bg-soft-success text-success',
                                            'In Review' => 'bg-soft-orange text-orange',
                                            default     => 'bg-soft-warning text-warning',
                                        };
                                    @endphp
                                    <span class="badge {{ $complianceBadge }} fs-11">{{ $client->status_compliance ?? 'Pending' }}</span>
                                </td>
                                <td>
                                    @if($client->sent_to_client === 'Yes')
                                        <span class="badge bg-soft-success text-success fs-11"><i class="feather-check me-1"></i>Yes</span>
                                    @else
                                        <span class="badge bg-soft-warning text-warning fs-11">{{ $client->sent_to_client ?? 'Pending' }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper"
                                        data-id="{{ $client->id }}"
                                        data-policy_no="{{ $client->policy_no }}"
                                        data-company="{{ $client->company }}"
                                        data-first_name="{{ $client->first_name }}"
                                        data-last_name="{{ $client->last_name }}"
                                        data-dob="{{ $client->dob?->format('Y-m-d') }}"
                                        data-phone="{{ $client->phone }}"
                                        data-email="{{ $client->email }}"
                                        data-address="{{ $client->address }}"
                                        data-suburb="{{ $client->suburb }}"
                                        data-city="{{ $client->city }}"
                                        data-post_code="{{ $client->post_code }}"
                                        data-login_date="{{ $client->login_date?->format('Y-m-d') }}"
                                        data-anp="{{ $client->anp }}"
                                        data-adviser="{{ $client->adviser }}"
                                        data-not_counting="{{ $client->not_counting ? '1' : '0' }}"
                                        data-compliance_by="{{ $client->compliance_by }}"
                                        data-roa_due_date="{{ $client->roa_due_date?->format('Y-m-d') }}"
                                        data-status_compliance="{{ $client->status_compliance }}"
                                        data-sent_to_client="{{ $client->sent_to_client }}"
                                        data-outcome="{{ $client->outcome }}"
                                    >
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewLoginClientFromRow(this.closest('.action-kebab-wrapper'))"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="editLoginClientFromRow(this.closest('.action-kebab-wrapper'))"><i class="feather-edit text-success me-1"></i> Edit Client</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('{{ $client->first_name }} {{ $client->last_name }}', '{{ $client->company }}')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('{{ $client->first_name }} {{ $client->last_name }}', '{{ $client->company }}')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('{{ $client->first_name }} {{ $client->last_name }}', '{{ $client->company }}')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                            <form action="{{ route('clients.login.destroy', $client->id) }}" method="POST" class="m-0" onsubmit="confirmFormSubmit(event, 'Delete this client?', this)">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="action-kebab-item border-0 bg-transparent w-100 text-start text-danger"><i class="feather-trash-2 text-danger me-1"></i> Delete Client</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="9" class="text-center text-muted py-4">No login clients found.</td></tr>
                            @endforelse
</tbody>
                    </table>
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
                        
                        <!-- SECTION 1: REQUEST OVERVIEW -->
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

                        <!-- SECTION 2: REQUEST TYPE & PROCESSING -->
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

                        <!-- SECTION 3: OUTCOME & COMPLETION -->
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

    <!-- Modal: View Login Client Details (Read-only Form Layout) -->
    <div class="modal fade" id="viewLoginClientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-user-check me-2"></i> Client Profile Details - <span id="viewPolicyNoHeader"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                    
                    <!-- SECTION 1: POLICY & PROVIDER INFO -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-shield text-primary fs-15"></i> 1. Policy & Insurance Provider
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Policy No.</label>
                                <input type="text" class="form-control text-primary" id="viewPolicyNo" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Insurance Company</label>
                                <input type="text" class="form-control" id="viewCompany" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Login Date</label>
                                <input type="text" class="form-control" id="viewLoginDate" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">ANP ($)</label>
                                <input type="text" class="form-control text-success fw-bold" id="viewAnp" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: CLIENT PERSONAL & CONTACT -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-user text-primary fs-15"></i> 2. Client Contact Information
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">First Name</label>
                                <input type="text" class="form-control" id="viewFirstName" readonly>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Last Name</label>
                                <input type="text" class="form-control" id="viewLastName" readonly>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Date of Birth</label>
                                <input type="text" class="form-control" id="viewDob" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Mobile Number</label>
                                <input type="text" class="form-control" id="viewMobile" readonly>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label fw-semibold fs-13 text-dark">Email Address</label>
                                <input type="text" class="form-control" id="viewEmail" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: RESIDENTIAL ADDRESS -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-map-pin text-primary fs-15"></i> 3. Address Details
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label fw-semibold fs-13 text-dark">Street Address</label>
                                <input type="text" class="form-control" id="viewAddress" readonly>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Suburb</label>
                                <input type="text" class="form-control" id="viewSuburb" readonly>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label fw-semibold fs-13 text-dark">City</label>
                                <input type="text" class="form-control" id="viewCity" readonly>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Post Code</label>
                                <input type="text" class="form-control" id="viewPostCode" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 4: COMPLIANCE & STATUS -->
                    <div class="modal-section-card mb-0">
                        <div class="modal-section-title">
                            <i class="feather-clipboard text-primary fs-15"></i> 4. Compliance & Processing Status
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Adviser</label>
                                <input type="text" class="form-control" id="viewAdviser" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Not Counting</label>
                                <input type="text" class="form-control" id="viewNotCounting" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Compliance by</label>
                                <input type="text" class="form-control" id="viewComplianceBy" readonly>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">RoA Due on</label>
                                <input type="text" class="form-control text-danger fw-semibold" id="viewRoaDueDate" readonly>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Status - Sent to Compliance</label>
                                <input type="text" class="form-control text-primary fw-semibold" id="viewStatusCompliance" readonly>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Sent to Client</label>
                                <input type="text" class="form-control text-success fw-semibold" id="viewSentToClient" readonly>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label fw-semibold fs-13 text-dark">Outcome / Pending Requirements</label>
                                <input type="text" class="form-control" id="viewOutcome" readonly>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm px-4 fw-bold" onclick="editCurrentViewedLoginClient()"><i class="feather-edit me-1"></i> Edit Client</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Import Clients -->
    <div class="modal fade" id="importLoginClientsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-upload me-2"></i> Import Login Clients</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="importForm" onsubmit="event.preventDefault(); handleImportClients();">
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-semibold fs-13 text-dark mb-2">Upload Excel or CSV File *</label>
                            <div class="drag-drop-box" onclick="document.getElementById('importFileInput').click();">
                                <i class="feather-file-text fs-1 text-primary mb-2"></i>
                                <h6 class="fw-bold text-dark mb-1">Click to browse or drag & drop file here</h6>
                                <p class="text-muted fs-12 mb-0">Supports .CSV, .XLS, or .XLSX spreadsheets</p>
                                <input type="file" id="importFileInput" accept=".csv, .xls, .xlsx" style="display: none;" onchange="if(this.files[0]) $('#fileNameDisplay').text('Selected: ' + this.files[0].name);">
                            </div>
                            <div id="fileNameDisplay" class="fs-12 fw-bold text-primary mt-2"></div>
                        </div>

                        <div class="bg-light p-3 rounded-3 mb-3 border">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="fw-bold fs-13 text-dark"><i class="feather-info me-1 text-info"></i> Standard Column Mapping Header</span>
                                <a href="javascript:void(0);" onclick="alert('Sample template CSV downloaded!');" class="fs-12 text-primary text-decoration-none fw-semibold"><i class="feather-download me-1"></i> Download CSV Template</a>
                            </div>
                            <p class="fs-12 text-muted mb-0">Ensure your spreadsheet header contains matching columns: <code>Policy No, Company, First Name, Last Name, DOB, Mobile, Email, Address, Suburb, City, Post Code, Login Date, ANP, Outcome, Adviser, Not Counting, Compliance by, RoA Due on, Status, Sent to Client</code>.</p>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="overwriteExistingCheck" checked>
                                <label class="form-check-label fs-13 text-dark" for="overwriteExistingCheck">
                                    Update existing client if Policy No. matches
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="skipErrorsCheck" checked>
                                <label class="form-check-label fs-13 text-dark" for="skipErrorsCheck">
                                    Skip rows with missing required values
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold"><i class="feather-upload me-1"></i> Upload & Import Records</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Add New Login Client (Organized Sections) -->
    <div class="modal fade" id="addLoginClientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-user-plus me-2"></i> <span id="loginModalTitle">Add New Login Client Entry</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addLoginClientForm" method="POST" action="{{ route('clients.login.store') }}">
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        @csrf
                        <input type="hidden" name="_method" id="loginFormMethod" value="POST">
                        <input type="hidden" name="client_id" id="loginClientId" value="">
                        <!-- SECTION 1: POLICY & PROVIDER INFO -->
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-shield text-primary fs-15"></i> 1. Policy & Insurance Provider
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Policy No.</label>
                                    <input type="text" class="form-control" id="loginPolicyNoInput" name="policy_no" placeholder="e.g. POL-2026-9912">
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Insurance Company *</label>
                                    <select class="form-select" id="loginCompanyInput" name="company">
                                        <option value="AIA Life">AIA Life</option>
                                        <option value="Fidelity Life">Fidelity Life</option>
                                        <option value="Chubb Life">Chubb Life</option>
                                        <option value="Partners Life">Partners Life</option>
                                        <option value="Asteron Life">Asteron Life</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Login Date</label>
                                    <input type="date" class="form-control" id="loginDateInput" name="login_date">
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">ANP ($)</label>
                                    <input type="number" class="form-control" id="loginAnpInput" name="anp" placeholder="2500">
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: CLIENT PERSONAL & CONTACT -->
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-user text-primary fs-15"></i> 2. Client Contact Information
                            </div>
                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">First Name *</label>
                                    <input type="text" class="form-control" id="loginFirstNameInput" name="first_name" placeholder="e.g. Rahul" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Last Name *</label>
                                    <input type="text" class="form-control" id="loginLastNameInput" name="last_name" placeholder="e.g. Sharma" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Date of Birth</label>
                                    <input type="date" class="form-control" id="loginDobInput" name="dob">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Mobile Number *</label>
                                    <input type="text" class="form-control" id="loginMobileInput" name="phone" placeholder="021 XXX XXXX" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Email Address</label>
                                    <input type="email" class="form-control" id="loginEmailInput" name="email" placeholder="client@example.com">
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: RESIDENTIAL ADDRESS -->
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-map-pin text-primary fs-15"></i> 3. Address Details
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Street Address</label>
                                    <input type="text" class="form-control" id="loginAddressInput" name="address" placeholder="e.g. 42 Queen Street">
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Suburb</label>
                                    <input type="text" class="form-control" id="loginSuburbInput" name="suburb" placeholder="e.g. Central">
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">City</label>
                                    <input type="text" class="form-control" id="loginCityInput" name="city" placeholder="e.g. Auckland">
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Post Code</label>
                                    <input type="text" class="form-control" id="loginPostCodeInput" name="post_code" placeholder="1010">
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 4: COMPLIANCE & STATUS -->
                        <div class="modal-section-card mb-0">
                            <div class="modal-section-title">
                                <i class="feather-clipboard text-primary fs-15"></i> 4. Compliance & Processing Status
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Adviser</label>
                                    <select class="form-select" id="loginAdviserInput" name="adviser">
                                        <option value="Sushant Yadav">Sushant Yadav</option>
                                        <option value="Royson Pinto">Royson Pinto</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Not Counting</label>
                                    <select class="form-select" id="loginNotCountingSelect" name="not_counting">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Compliance by</label>
                                    <input type="text" class="form-control" id="loginComplianceByInput" name="compliance_by" placeholder="Officer Name">
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">RoA Due on</label>
                                    <input type="date" class="form-control" id="loginRoaDueDateInput" name="roa_due_date">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Status - Sent to Compliance</label>
                                    <select class="form-select" id="loginStatusComplianceSelect" name="status_compliance">
                                        <option value="Sent to Compliance">Sent to Compliance</option>
                                        <option value="In Review">In Review</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Sent to Client</label>
                                    <select class="form-select" id="loginSentToClientSelect" name="sent_to_client">
                                        <option value="Pending">Pending</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Outcome / Pending Requirements</label>
                                    <input type="text" class="form-control" id="loginOutcomeInput" name="outcome" placeholder="e.g. Pending Medical Test">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Save Login Client Record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    
        </div>
    </div>

﻿    <!-- Modal: Client Request Popup -->
    <div class="modal fade" id="clientRequestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-git-pull-request me-2"></i> Client Service Request - <span id="reqClientNameHeader"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="clientRequestForm" onsubmit="event.preventDefault(); handleSaveClientRequest();">
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        
                        <!-- SECTION 1: REQUEST OVERVIEW -->
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

                        <!-- SECTION 2: REQUEST TYPE & PROCESSING -->
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

                        <!-- SECTION 3: OUTCOME & COMPLETION -->
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
    <script src="{{ asset('assets/js/pages/clients-login.js') }}"></script>
@endpush

@endsection