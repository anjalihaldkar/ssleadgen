@extends('layouts.app')
@section('title', 'Claims Management | SS Advisory Insurance Brokerage')

@push('styles')
<style>
.modal-section-card {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .modal-section-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--color-navy-dark, #0F172A);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 1px solid #E2E8F0;
            padding-bottom: 8px;
        }

        .form-control[readonly] {
            background-color: #FFFFFF !important;
            color: #0F172A !important;
            font-weight: 600;
            border-color: #E2E8F0;
        }
</style>
@endpush

@section('content')
<div class="nxl-content d-flex flex-column gap-4">
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Insurance Claims Advocacy</h4>
                    <p class="text-muted fs-13 mb-0">Monitor claim progress, underwriter assessments, and client payouts.</p>
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

            <div class="card-widget">
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100" id="claimsTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Client Name</th>
                                <th>Insurance Company</th>
                                <th>Claims</th>
                                <th>Processed Date</th>
                                <th>Update</th>
                                <th>Approved Date</th>
                                <th>Result / Outcome</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Kishore Kumar</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">Redundancy Benefit</td>
                                <td class="fs-13 text-muted">02/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">Approved</span></td>
                                <td class="fs-13 text-muted">18/08/2026</td>
                                <td class="fs-13 text-muted">Approved / Paid $26000</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Kishore Kumar', 'AIA Life', 'Redundancy Benefit', '02/08/2026', 'Approved', '18/08/2026', 'Approved / Paid $26000', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Kishore Kumar', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Kishore Kumar', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Kishore Kumar', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Suman Pappula</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Medical Surgery</td>
                                <td class="fs-13 text-muted">01/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Suman Pappula', 'Partners Life', 'Medical Surgery', '01/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Suman Pappula', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Suman Pappula', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Suman Pappula', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Rahul Sharma</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Total Permanent Disability</td>
                                <td class="fs-13 text-muted">06/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">13/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Rahul Sharma', 'Partners Life', 'Total Permanent Disability', '06/08/2026', 'Declined', '13/08/2026', 'Declined - Excluded policy clause', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Rahul Sharma', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Rahul Sharma', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Rahul Sharma', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Priya Patel</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">Redundancy Benefit</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Priya Patel', 'Asteron Life', 'Redundancy Benefit', '10/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Priya Patel', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Priya Patel', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Priya Patel', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Sarah Connor</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">Trauma Benefit</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">20/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Sarah Connor', 'Fidelity Life', 'Trauma Benefit', '10/08/2026', 'Declined', '20/08/2026', 'Declined - Excluded policy clause', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Sarah Connor', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Sarah Connor', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Sarah Connor', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Amit Miller</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">Specialist Consultation</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Amit Miller', 'Fidelity Life', 'Specialist Consultation', '10/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Amit Miller', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Amit Miller', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Amit Miller', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">David Chang</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">Heart Bypass Claim</td>
                                <td class="fs-13 text-muted">08/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('David Chang', 'Chubb Life', 'Heart Bypass Claim', '08/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('David Chang', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('David Chang', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('David Chang', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Michael Singh</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">Specialist Consultation</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Michael Singh', 'AIA Life', 'Specialist Consultation', '05/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Michael Singh', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Michael Singh', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Michael Singh', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Aarav Cooper</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">Total Permanent Disability</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Aarav Cooper', 'Chubb Life', 'Total Permanent Disability', '10/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Aarav Cooper', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Aarav Cooper', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Aarav Cooper', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Vandana Taylor</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">Heart Bypass Claim</td>
                                <td class="fs-13 text-muted">08/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Vandana Taylor', 'Chubb Life', 'Heart Bypass Claim', '08/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Vandana Taylor', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Vandana Taylor', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Vandana Taylor', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">James Walker</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">Specialist Consultation</td>
                                <td class="fs-13 text-muted">02/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('James Walker', 'Chubb Life', 'Specialist Consultation', '02/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Priya Patel')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('James Walker', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('James Walker', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('James Walker', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Olivia Patel</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">Total Permanent Disability</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Olivia Patel', 'Asteron Life', 'Total Permanent Disability', '10/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Olivia Patel', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Olivia Patel', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Olivia Patel', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Ethan Smith</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Medical Surgery</td>
                                <td class="fs-13 text-muted">07/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Ethan Smith', 'Partners Life', 'Medical Surgery', '07/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Ethan Smith', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Ethan Smith', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Ethan Smith', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Arjun Johnson</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">Medical Surgery</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">15/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Arjun Johnson', 'Asteron Life', 'Medical Surgery', '10/08/2026', 'Declined', '15/08/2026', 'Declined - Excluded policy clause', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Arjun Johnson', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Arjun Johnson', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Arjun Johnson', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Neha Williams</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">Total Permanent Disability</td>
                                <td class="fs-13 text-muted">04/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Neha Williams', 'Asteron Life', 'Total Permanent Disability', '04/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Neha Williams', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Neha Williams', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Neha Williams', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">John Brown</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Income Protection</td>
                                <td class="fs-13 text-muted">02/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">Approved</span></td>
                                <td class="fs-13 text-muted">15/08/2026</td>
                                <td class="fs-13 text-muted">Approved / Paid $61000</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('John Brown', 'Partners Life', 'Income Protection', '02/08/2026', 'Approved', '15/08/2026', 'Approved / Paid $61000', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('John Brown', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('John Brown', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('John Brown', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Emma Jones</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">Total Permanent Disability</td>
                                <td class="fs-13 text-muted">03/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">Approved</span></td>
                                <td class="fs-13 text-muted">15/08/2026</td>
                                <td class="fs-13 text-muted">Approved / Paid $46000</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Emma Jones', 'Asteron Life', 'Total Permanent Disability', '03/08/2026', 'Approved', '15/08/2026', 'Approved / Paid $46000', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Emma Jones', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Emma Jones', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Emma Jones', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Robert Garcia</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">Income Protection</td>
                                <td class="fs-13 text-muted">04/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Robert Garcia', 'Chubb Life', 'Income Protection', '04/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Robert Garcia', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Robert Garcia', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Robert Garcia', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Sophia Miller</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Heart Bypass Claim</td>
                                <td class="fs-13 text-muted">03/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Sophia Miller', 'Partners Life', 'Heart Bypass Claim', '03/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Priya Patel')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Sophia Miller', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Sophia Miller', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Sophia Miller', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">William Davis</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Total Permanent Disability</td>
                                <td class="fs-13 text-muted">02/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">12/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('William Davis', 'Partners Life', 'Total Permanent Disability', '02/08/2026', 'Declined', '12/08/2026', 'Declined - Excluded policy clause', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('William Davis', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('William Davis', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('William Davis', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Isabella Rodriguez</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">Redundancy Benefit</td>
                                <td class="fs-13 text-muted">09/08/2026</td>
                                <td><span class="badge bg-soft-info text-info fs-11">Pending Info</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Isabella Rodriguez', 'Fidelity Life', 'Redundancy Benefit', '09/08/2026', 'Pending Info', '-', 'Awaiting documentation review', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Isabella Rodriguez', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Isabella Rodriguez', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Isabella Rodriguez', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Daniel Martinez</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">Medical Surgery</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">Approved</span></td>
                                <td class="fs-13 text-muted">18/08/2026</td>
                                <td class="fs-13 text-muted">Approved / Paid $52000</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Daniel Martinez', 'Chubb Life', 'Medical Surgery', '05/08/2026', 'Approved', '18/08/2026', 'Approved / Paid $52000', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Daniel Martinez', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Daniel Martinez', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Daniel Martinez', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Mia Hernandez</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Redundancy Benefit</td>
                                <td class="fs-13 text-muted">06/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">Approved</span></td>
                                <td class="fs-13 text-muted">14/08/2026</td>
                                <td class="fs-13 text-muted">Approved / Paid $65000</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Mia Hernandez', 'Partners Life', 'Redundancy Benefit', '06/08/2026', 'Approved', '14/08/2026', 'Approved / Paid $65000', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Mia Hernandez', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Mia Hernandez', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Mia Hernandez', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Joseph Lopez</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">Total Permanent Disability</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Joseph Lopez', 'Asteron Life', 'Total Permanent Disability', '10/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Joseph Lopez', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Joseph Lopez', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Joseph Lopez', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Charlotte Gonzalez</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">Specialist Consultation</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">12/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Charlotte Gonzalez', 'AIA Life', 'Specialist Consultation', '05/08/2026', 'Declined', '12/08/2026', 'Declined - Excluded policy clause', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Charlotte Gonzalez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Charlotte Gonzalez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Charlotte Gonzalez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Matthew Wilson</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">Medical Surgery</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">12/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Matthew Wilson', 'AIA Life', 'Medical Surgery', '05/08/2026', 'Declined', '12/08/2026', 'Declined - Excluded policy clause', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Matthew Wilson', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Matthew Wilson', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Matthew Wilson', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Amelia Anderson</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">Income Protection</td>
                                <td class="fs-13 text-muted">07/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">16/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Amelia Anderson', 'Fidelity Life', 'Income Protection', '07/08/2026', 'Declined', '16/08/2026', 'Declined - Excluded policy clause', 'Royson Pinto')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Amelia Anderson', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Amelia Anderson', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Amelia Anderson', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">David Thomas</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">Redundancy Benefit</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-warning text-warning fs-11">Under Assessment</span></td>
                                <td class="fs-13 text-muted">-</td>
                                <td class="fs-13 text-muted">Awaiting documentation review</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('David Thomas', 'Asteron Life', 'Redundancy Benefit', '10/08/2026', 'Under Assessment', '-', 'Awaiting documentation review', 'Priya Patel')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('David Thomas', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('David Thomas', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('David Thomas', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Harper Taylor</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">Specialist Consultation</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">15/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Harper Taylor', 'AIA Life', 'Specialist Consultation', '10/08/2026', 'Declined', '15/08/2026', 'Declined - Excluded policy clause', 'Sushant Yadav')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Harper Taylor', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Harper Taylor', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Harper Taylor', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Andrew Moore</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">Life Claim</td>
                                <td class="fs-13 text-muted">08/08/2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">Declined</span></td>
                                <td class="fs-13 text-muted">14/08/2026</td>
                                <td class="fs-13 text-muted">Declined - Excluded policy clause</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails('Andrew Moore', 'Partners Life', 'Life Claim', '08/08/2026', 'Declined', '14/08/2026', 'Declined - Excluded policy clause', 'Priya Patel')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Andrew Moore', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Andrew Moore', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Andrew Moore', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RESPONSIVE FOOTER (DEVELOPED BY SITESOCH) -->
        <footer class="nxl-footer">
            <div
                class="d-flex align-items-center justify-content-between flex-wrap gap-2 py-3 px-4 fs-12 text-muted border-top bg-white">
                <div>© 2026 <span class="fw-bold text-dark">SS Advisory Lead Engine</span>. All Rights Reserved.</div>
                <div>Developed with <i class="feather-heart text-danger mx-1"></i> by <a href="https://sitesoch.com"
                        target="_blank" class="fw-bold text-primary text-decoration-none">Sitesoch</a></div>
            </div>
        </footer>
    

    <!-- Modal: View Claim Details (Read-only Form Layout) -->
    <div class="modal fade" id="viewClaimModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-shield me-2"></i> Claim Record Details -
                        <span id="viewClaimClientHeader"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">

                    <!-- SECTION 1: CLAIM & PROVIDER DETAILS -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-user text-primary fs-15"></i> 1. Client & Insurance Provider
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Client Name</label>
                                <input type="text" class="form-control" id="viewClaimClientName" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Insurance Company</label>
                                <input type="text" class="form-control" id="viewClaimCompany" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Claims (Type /
                                    Description)</label>
                                <input type="text" class="form-control text-primary" id="viewClaimType" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Admin (Claim Handler)</label>
                                <input type="text" class="form-control" id="viewClaimAdmin" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: TIMELINE & STATUS -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-clock text-primary fs-15"></i> 2. Processing Timeline & Status
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Processed Date</label>
                                <input type="text" class="form-control" id="viewClaimProcessedDate" readonly>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Update (Status)</label>
                                <input type="text" class="form-control text-warning fw-semibold" id="viewClaimUpdate"
                                    readonly>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Approved Date</label>
                                <input type="text" class="form-control text-success fw-semibold"
                                    id="viewClaimApprovedDate" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: OUTCOME & RESULTS -->
                    <div class="modal-section-card mb-0">
                        <div class="modal-section-title">
                            <i class="feather-check-circle text-primary fs-15"></i> 3. Result / Outcome
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold fs-13 text-dark">Result / Outcome</label>
                                <input type="text" class="form-control fw-semibold" id="viewClaimOutcome" readonly>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm px-4 fw-bold"
                        onclick="$('#viewClaimModal').modal('hide'); editClaimDetails($('#viewClaimClientName').val(), $('#viewClaimCompany').val(), $('#viewClaimType').val(), $('#viewClaimProcessedDate').val(), $('#viewClaimUpdate').val(), $('#viewClaimApprovedDate').val(), $('#viewClaimOutcome').val(), $('#viewClaimAdmin').val());"><i
                            class="feather-edit me-1"></i> Edit Claim</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Reset Password -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-key me-2"></i> Reset Advisor Password</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="resetPasswordForm"
                    onsubmit="event.preventDefault(); alert('Password updated successfully!'); $('#resetPasswordModal').modal('hide');">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Current Password *</label>
                            <input type="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">New Password *</label>
                            <input type="password" class="form-control" placeholder="Minimum 8 characters" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Confirm New Password *</label>
                            <input type="password" class="form-control" placeholder="Repeat new password" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Logout Confirmation -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body p-4 text-center">
                    <div class="avatar-text avatar-lg bg-soft-danger text-danger rounded-circle mx-auto mb-3"
                        style="width: 50px; height: 50px; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="feather-log-out fs-3"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Confirm Logout</h5>
                    <p class="text-muted fs-13 mb-4">Are you sure you want to log out of your session?</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger btn-sm px-4 fw-bold"
                            onclick="window.location.href='login.html'">Yes, Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Lodge / Edit Claim -->
    <div class="modal fade" id="lodgeClaimModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-shield me-2"></i> <span
                            id="claimModalTitle">Lodge New Claim</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                        <option value="Kishore Kumar">Kishore Kumar</option>
                                        <option value="Rahul Sharma">Rahul Sharma</option>
                                        <option value="Amanda Miller">Amanda Miller</option>
                                        <option value="Jason Te Kuru">Jason Te Kuru</option>
                                        <option value="Priya Patel">Priya Patel</option>
                                        <option value="David Chen">David Chen</option>
                                        <option value="Suman Pappula">Suman Pappula</option>
                                        <option value="Vandana Singh">Vandana Singh</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Insurance Company *</label>
                                    <select class="form-select" id="claimCompanySelect">
                                        <option value="AIA New Zealand">AIA New Zealand</option>
                                        <option value="Fidelity Life">Fidelity Life</option>
                                        <option value="Chubb Life">Chubb Life</option>
                                        <option value="Partners Life">Partners Life</option>
                                        <option value="Asteron Life">Asteron Life</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Claims (Type / Description)
                                        *</label>
                                    <input type="text" class="form-control" id="claimTypeInput"
                                        placeholder="e.g. Medical Surgery / Trauma" required>
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
                                    <input type="text" class="form-control" id="claimOutcomeInput"
                                        placeholder="e.g. Approved / Paid $18,500">
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

    <!-- Scripts -->
    <script src="assets/vendors/js/vendors.min.js"></script>
    <script src="assets/vendors/js/nxlNavigation.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/js/common-init.min.js"></script>
    <script src="assets/js/script.js?v=1.3"></script>
    <script src="assets/js/dashboard-redesign.js"></script>
    <script src="assets/js/pages/claims.js"></script>

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
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/pages/claims.js?v=1.1') }}"></script>
@endpush
