@extends('layouts.app')
@section('title', 'Leads Management')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Leads Pipeline & Acquisition Hub</h4>
                    <p class="text-muted fs-13 mb-0">Drag and drop prospect cards between columns to advance lead stages, or click any card for full details.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <!-- View Toggle -->
                    <div class="btn-group btn-group-sm" role="group" id="leadViewToggle">
                        <button type="button" class="btn btn-primary fw-bold" onclick="switchLeadView('kanban', this)"><i class="feather-columns me-1"></i> Kanban</button>
                        <button type="button" class="btn btn-outline-primary fw-bold" onclick="switchLeadView('list', this)"><i class="feather-list me-1"></i> List View</button>
                    </div>
                    @if(auth()->user()->canWrite('leads'))
                        <button class="btn btn-light btn-sm px-3 fw-bold text-success border-success" data-bs-toggle="modal" data-bs-target="#importLeadsModal"><i class="feather-upload me-1"></i> Import Leads</button>
                        <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#createLeadModal"><i class="feather-plus me-1"></i> Add Lead</button>
                    @endif
                </div>
            </div>

                                    <!-- 1. KANBAN VIEW CONTAINER WITH FULL INTERACTIVE DRAG AND DROP -->
                        <div id="kanbanViewContainer" class="row g-3">
                @php
                    $stages = [
                        'new' => ['label' => 'New Leads', 'color' => 'primary'],
                        'contacted' => ['label' => 'Contacted', 'color' => 'info'],
                        'proposal' => ['label' => 'Underwriting', 'color' => 'warning'],
                        'won' => ['label' => 'Policy Issued', 'color' => 'success']
                    ];
                @endphp

                @foreach($stages as $status => $stage)
                <div class="col-md-3 kanban-column-box" data-status-class="border-{{ $stage['color'] }}">
                    <div class="card-widget p-3 bg-light border min-vh-50" data-status="{{ $status }}" ondragover="handleKanbanDragOver(event)" ondrop="handleKanbanDrop(event, this)">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-dark mb-0"><i class="feather-circle text-{{ $stage['color'] }} me-2"></i> {{ $stage['label'] }} <span class="kanban-count text-{{ $stage['color'] }}">({{ isset($leadsByStatus[$status]) ? count($leadsByStatus[$status]) : 0 }})</span></h6>
                        </div>
                        <div class="kanban-card-dropzone d-flex flex-column gap-2" style="min-height: 250px;">
                            @if(isset($leadsByStatus[$status]))
                                @foreach($leadsByStatus[$status] as $lead)
                                <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-{{ $stage['color'] }}" data-lead-id="{{ $lead->id }}" draggable="{{ auth()->user()->canWrite('leads') ? 'true' : 'false' }}" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: {{ auth()->user()->canWrite('leads') ? 'grab' : 'pointer' }};" onclick="openLeadDetailModal('{{ addslashes($lead->first_name) }} {{ addslashes($lead->last_name) }}', '{{ addslashes($lead->phone) }}', '{{ addslashes($lead->email) }}', '{{ addslashes($lead->leadSource->name ?? 'Unknown') }}', '${{ $lead->estimated_cover }}/yr', '{{ $stage['label'] }}', 'Sushant Yadav', '{{ addslashes($lead->notes) }}')">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="fw-bold text-dark fs-13">{{ $lead->first_name }} {{ $lead->last_name }}</div>
                                        <span class="badge bg-soft-{{ $stage['color'] }} text-{{ $stage['color'] }} fs-10">{{ $lead->leadSource->name ?? 'Unknown' }}</span>
                                    </div>
                                    <div class="text-muted fs-12 mt-1">Cover Premium (${{ $lead->estimated_cover }}/yr)</div>
                                    <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> {{ $lead->created_at->diffForHumans() }}</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- 2. LIST VIEW CONTAINER (Initially Hidden) -->
            <div id="listViewContainer" class="card-widget d-none">
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100" id="leadsDataTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold">
                                <th>Lead Name</th>
                                <th>Contact Info</th>
                                <th>Source</th>
                                <th>Cover Target</th>
                                <th>Stage</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                            @php
                                $color = $stages[$lead->status]['color'] ?? 'primary';
                                $label = $stages[$lead->status]['label'] ?? 'New';
                            @endphp
                            <tr>
                                <td class="fw-bold text-dark fs-13">{{ $lead->first_name }} {{ $lead->last_name }}</td>
                                <td class="fs-13 text-muted">{{ $lead->phone }} | {{ $lead->email }}</td>
                                <td><span class="badge bg-soft-{{ $color }} text-{{ $color }} fs-11">{{ $lead->leadSource->name ?? 'Unknown' }}</span></td>
                                <td class="fs-13 fw-semibold text-dark">${{ $lead->estimated_cover }}/yr</td>
                                <td><span class="badge bg-{{ $color }} fs-11">{{ $label }}</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('{{ addslashes($lead->first_name) }} {{ addslashes($lead->last_name) }}', '{{ addslashes($lead->phone) }}', '{{ addslashes($lead->email) }}', '{{ addslashes($lead->leadSource->name ?? 'Unknown') }}', '${{ $lead->estimated_cover }}/yr', '{{ $label }}', 'Sushant Yadav', '{{ addslashes($lead->notes) }}')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            @if(auth()->user()->canWrite('leads') && $lead->status !== 'won')
                                                <form action="{{ route('crm.convert', $lead->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="action-kebab-item border-0 bg-transparent w-100 text-start" onclick="return confirm('Convert this lead to a client?');">
                                                        <i class="feather-arrow-right text-success me-1"></i> Convert to Client
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="modal fade" id="leadDetailModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                            <h5 class="modal-title text-white mb-0" id="leadDetailModalTitle">
                                <i class="feather-user me-2"></i> Prospect Lead Overview
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4" id="leadDetailModalBody" style="max-height: 75vh; overflow-y: auto;">
                            {{-- Content is injected by openLeadDetailModal() JS function --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="createLeadModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                            <h5 class="modal-title text-white mb-0"><i class="feather-user-plus me-2"></i> Add New Login Client Entry</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('crm.store') }}" method="POST">
                            @csrf
                            <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- SECTION 1: POLICY & PROVIDER INFO -->
                                <div class="modal-section-card">
                                    <div class="modal-section-title">
                                        <i class="feather-shield text-primary fs-15"></i> 1. Policy & Insurance Provider
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-3 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Policy No.</label>
                                            <input type="text" class="form-control" name="policy_no" placeholder="e.g. POL-2026-9912">
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Insurance Company *</label>
                                            <select class="form-select" name="insurance_company">
                                                <option value="AIA Life">AIA Life</option>
                                                <option value="Fidelity Life">Fidelity Life</option>
                                                <option value="Chubb Life">Chubb Life</option>
                                                <option value="Partners Life">Partners Life</option>
                                                <option value="Asteron Life">Asteron Life</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Login Date</label>
                                            <input type="date" class="form-control" name="login_date">
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">ANP ($)</label>
                                            <input type="number" class="form-control" name="anp" placeholder="2500">
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
                                            <input type="text" name="first_name" class="form-control" required placeholder="e.g. Rahul" value="{{ old('first_name') }}">
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Last Name *</label>
                                            <input type="text" name="last_name" class="form-control" required placeholder="e.g. Sharma" value="{{ old('last_name') }}">
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Mobile Number *</label>
                                            <input type="text" name="phone" class="form-control" required placeholder="021 XXX XXXX" value="{{ old('phone') }}">
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label fw-semibold fs-13 text-dark">Email Address</label>
                                            <input type="email" name="email" class="form-control" placeholder="client@example.com" value="{{ old('email') }}">
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
                                            <input type="text" class="form-control" name="street_address" placeholder="e.g. 42 Queen Street">
                                        </div>
                                        <div class="col-md-2 col-sm-4">
                                            <label class="form-label fw-semibold fs-13 text-dark">Suburb</label>
                                            <input type="text" class="form-control" name="suburb" placeholder="e.g. Central">
                                        </div>
                                        <div class="col-md-2 col-sm-4">
                                            <label class="form-label fw-semibold fs-13 text-dark">City</label>
                                            <input type="text" class="form-control" name="city" placeholder="e.g. Auckland">
                                        </div>
                                        <div class="col-md-2 col-sm-4">
                                            <label class="form-label fw-semibold fs-13 text-dark">Post Code</label>
                                            <input type="text" class="form-control" name="post_code" placeholder="1010">
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
                                            <select class="form-select" name="adviser">
                                                <option value="Sushant Yadav">Sushant Yadav</option>
                                                <option value="Royson Pinto">Royson Pinto</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Not Counting</label>
                                            <select class="form-select" name="not_counting">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Compliance by</label>
                                            <input type="text" class="form-control" name="compliance_by" placeholder="Officer Name">
                                        </div>
                                        <div class="col-md-3 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">RoA Due on</label>
                                            <input type="date" class="form-control" name="roa_due_date">
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-4 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Status - Sent to Compliance</label>
                                            <select class="form-select" name="status_compliance">
                                                <option value="Sent to Compliance">Sent to Compliance</option>
                                                <option value="In Review">In Review</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <label class="form-label fw-semibold fs-13 text-dark">Sent to Client</label>
                                            <select class="form-select" name="sent_to_client">
                                                <option value="Pending">Pending</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="form-label fw-semibold fs-13 text-dark">Outcome / Pending Requirements</label>
                                            <input type="text" class="form-control" name="outcome" placeholder="e.g. Pending Medical Test">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm fw-bold">Create Lead</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js?v=9.0') }}"></script>
    <script src="{{ asset('assets/js/pages/crm-leads-pipeline.js?v=1.6') }}"></script>
@endpush

@endsection