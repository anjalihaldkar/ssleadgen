@extends('layouts.app')
@section('title', 'Policy Management')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Active Policy Portfolio (2,134 Policies)</h4>
                    <p class="text-muted fs-13 mb-0">Track policy terms, insured amounts, renewal dates, and underwriter details.</p>
                </div>
                <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#newPolicyModal"><i class="feather-plus me-1"></i> Issue New Policy</button>
            </div>

            <!-- Policy Table -->
            <div class="card-widget">
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100" id="policyDirectoryTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Policy #</th>
                                <th>Policy Holder</th>
                                <th>Insurer</th>
                                <th>Cover Type</th>
                                <th>Sum Assured</th>
                                <th>Annual Premium</th>
                                <th>Renewal Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-insurer="AIA New Zealand" data-type="Life & Disability">
                                <td class="fw-bold text-dark fs-13">POL-2026-8812</td>
                                <td class="fs-13">Kishore Kumar</td>
                                <td class="fs-13">AIA New Zealand</td>
                                <td class="fs-13"><span class="badge bg-soft-primary text-primary">Life & Disability</span></td>
                                <td class="fs-13 fw-semibold">$1,000,000</td>
                                <td class="fs-13 fw-semibold text-success">$3,420</td>
                                <td class="fs-13 text-muted">15 Sep 2026</td>
                                <td><span class="status-pill-inforce">Active</span></td>
                                <td class="text-center"><button class="btn btn-sm btn-light py-1 px-2">Manage</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            

</div>
    </div>

    <!-- Modal: Issue New Policy -->
    <div class="modal fade" id="newPolicyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-file-text me-2"></i> Issue New Policy</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="newPolicyForm" onsubmit="event.preventDefault(); handleIssueNewPolicy();">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Policy Holder Name *</label>
                            <input type="text" class="form-control" id="policyHolderInput" placeholder="Select or type client name" required>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Policy Number *</label>
                                <input type="text" class="form-control" id="policyNumberInput" placeholder="POL-2026-XXXX" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Underwriter Insurer</label>
                                <select class="form-select" id="policyInsurerInput">
                                    <option value="AIA New Zealand">AIA New Zealand</option>
                                    <option value="Partners Life">Partners Life</option>
                                    <option value="Chubb Life">Chubb Life</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Sum Assured ($)</label>
                                <input type="number" class="form-control" id="policySumInput" placeholder="e.g. 500000">
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Annual Premium ($)</label>
                                <input type="number" class="form-control" id="policyPremiumInput" placeholder="e.g. 2400">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Issue Policy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    <script src="{{ asset('assets/js/pages/policies.js') }}"></script>
@endpush

@endsection