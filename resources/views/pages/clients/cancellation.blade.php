@extends('layouts.app')
@section('title', 'Cancellation Update Directory')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Cancellation update Directory</h4>
                    <p class="text-muted fs-13 mb-0">Track policy cancellation notices, retention attempts, and insurer
                        completions.</p>
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
                    <table class="table table-hover align-middle w-100" id="cancellationTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Client Name</th>
                                <th>Company</th>
                                <th>Cancellation Sent</th>
                                <th>Completed</th>
                                <th>Outcome</th>
                                <th>Admin</th>
                                <th>Comments</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Evelyn Jackson</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">14/08/2026</span></td>
                                <td class="fs-13 text-muted">Moved Overseas</td>
                                <td class="fs-13 text-muted">Royson Pinto</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to moved overseas.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Evelyn Jackson', 'Chubb Life', '10/08/2026', '14/08/2026', 'Moved Overseas', 'Royson Pinto', 'Client requested policy cancellation due to moved overseas.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Evelyn Jackson', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Evelyn Jackson', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Evelyn Jackson', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Joshua Martin</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">08/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Cover No Longer Needed</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to cover no longer
                                    needed.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Joshua Martin', 'AIA Life', '08/08/2026', '17/08/2026', 'Cover No Longer Needed', 'Sushant Yadav', 'Client requested policy cancellation due to cover no longer needed.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Joshua Martin', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Joshua Martin', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Joshua Martin', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Abigail Lee</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">02/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Cover No Longer Needed</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to cover no longer
                                    needed.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Abigail Lee', 'Asteron Life', '02/08/2026', '17/08/2026', 'Cover No Longer Needed', 'Sushant Yadav', 'Client requested policy cancellation due to cover no longer needed.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Abigail Lee', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Abigail Lee', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Abigail Lee', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Ryan Perez</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">08/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">11/08/2026</span></td>
                                <td class="fs-13 text-muted">Dissatisfied with Claim</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to dissatisfied
                                    with claim.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Ryan Perez', 'AIA Life', '08/08/2026', '11/08/2026', 'Dissatisfied with Claim', 'Sushant Yadav', 'Client requested policy cancellation due to dissatisfied with claim.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Ryan Perez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Ryan Perez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Ryan Perez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Emily Thompson</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">08/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">13/08/2026</span></td>
                                <td class="fs-13 text-muted">Underwriting Terms</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to underwriting
                                    terms.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Emily Thompson', 'Asteron Life', '08/08/2026', '13/08/2026', 'Underwriting Terms', 'Priya Patel', 'Client requested policy cancellation due to underwriting terms.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Emily Thompson', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Emily Thompson', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Emily Thompson', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Jacob White</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">09/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">20/08/2026</span></td>
                                <td class="fs-13 text-muted">Switching Insurer</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to switching
                                    insurer.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Jacob White', 'Asteron Life', '09/08/2026', '20/08/2026', 'Switching Insurer', 'Priya Patel', 'Client requested policy cancellation due to switching insurer.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Jacob White', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Jacob White', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Jacob White', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Elizabeth Harris</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">09/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Underwriting Terms</td>
                                <td class="fs-13 text-muted">Royson Pinto</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to underwriting
                                    terms.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Elizabeth Harris', 'Chubb Life', '09/08/2026', '17/08/2026', 'Underwriting Terms', 'Royson Pinto', 'Client requested policy cancellation due to underwriting terms.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Elizabeth Harris', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Elizabeth Harris', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Elizabeth Harris', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Justin Sanchez</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">03/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">18/08/2026</span></td>
                                <td class="fs-13 text-muted">Non-Payment</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to non-payment.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Justin Sanchez', 'Fidelity Life', '03/08/2026', '18/08/2026', 'Non-Payment', 'Priya Patel', 'Client requested policy cancellation due to non-payment.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Justin Sanchez', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Justin Sanchez', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Justin Sanchez', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Sofia Clark</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">19/08/2026</span></td>
                                <td class="fs-13 text-muted">Non-Payment</td>
                                <td class="fs-13 text-muted">Royson Pinto</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to non-payment.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Sofia Clark', 'Fidelity Life', '05/08/2026', '19/08/2026', 'Non-Payment', 'Royson Pinto', 'Client requested policy cancellation due to non-payment.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Sofia Clark', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Sofia Clark', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Sofia Clark', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Benjamin Ramirez</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">18/08/2026</span></td>
                                <td class="fs-13 text-muted">Premium Cost Concerns</td>
                                <td class="fs-13 text-muted">Royson Pinto</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to premium cost
                                    concerns.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Benjamin Ramirez', 'Partners Life', '05/08/2026', '18/08/2026', 'Premium Cost Concerns', 'Royson Pinto', 'Client requested policy cancellation due to premium cost concerns.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Benjamin Ramirez', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Benjamin Ramirez', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Benjamin Ramirez', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Liam Chen</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">04/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">15/08/2026</span></td>
                                <td class="fs-13 text-muted">Switching Insurer</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to switching
                                    insurer.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Liam Chen', 'Asteron Life', '04/08/2026', '15/08/2026', 'Switching Insurer', 'Priya Patel', 'Client requested policy cancellation due to switching insurer.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Liam Chen', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Liam Chen', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Liam Chen', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Lucas Davis</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">02/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">13/08/2026</span></td>
                                <td class="fs-13 text-muted">Cover No Longer Needed</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to cover no longer
                                    needed.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Lucas Davis', 'Chubb Life', '02/08/2026', '13/08/2026', 'Cover No Longer Needed', 'Sushant Yadav', 'Client requested policy cancellation due to cover no longer needed.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Lucas Davis', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Lucas Davis', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Lucas Davis', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Mason Evans</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">03/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">14/08/2026</span></td>
                                <td class="fs-13 text-muted">Premium Cost Concerns</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to premium cost
                                    concerns.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Mason Evans', 'Chubb Life', '03/08/2026', '14/08/2026', 'Premium Cost Concerns', 'Priya Patel', 'Client requested policy cancellation due to premium cost concerns.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Mason Evans', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Mason Evans', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Mason Evans', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Logan Te Kuru</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">06/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">19/08/2026</span></td>
                                <td class="fs-13 text-muted">Non-Payment</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to non-payment.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Logan Te Kuru', 'AIA Life', '06/08/2026', '19/08/2026', 'Non-Payment', 'Priya Patel', 'Client requested policy cancellation due to non-payment.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Logan Te Kuru', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Logan Te Kuru', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Logan Te Kuru', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Elijah Taylor</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">04/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Non-Payment</td>
                                <td class="fs-13 text-muted">Royson Pinto</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to non-payment.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Elijah Taylor', 'AIA Life', '04/08/2026', '17/08/2026', 'Non-Payment', 'Royson Pinto', 'Client requested policy cancellation due to non-payment.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Elijah Taylor', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Elijah Taylor', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Elijah Taylor', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Oliver Grey</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Non-Payment</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to non-payment.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Oliver Grey', 'Partners Life', '10/08/2026', '17/08/2026', 'Non-Payment', 'Sushant Yadav', 'Client requested policy cancellation due to non-payment.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Oliver Grey', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Oliver Grey', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Oliver Grey', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Carter Green</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Underwriting Terms</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to underwriting
                                    terms.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Carter Green', 'Asteron Life', '05/08/2026', '17/08/2026', 'Underwriting Terms', 'Priya Patel', 'Client requested policy cancellation due to underwriting terms.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Carter Green', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Carter Green', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Carter Green', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Alexander Hall</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">09/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">20/08/2026</span></td>
                                <td class="fs-13 text-muted">Cover No Longer Needed</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to cover no longer
                                    needed.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Alexander Hall', 'Fidelity Life', '09/08/2026', '20/08/2026', 'Cover No Longer Needed', 'Priya Patel', 'Client requested policy cancellation due to cover no longer needed.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Alexander Hall', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Alexander Hall', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Alexander Hall', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">James Allen</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">05/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Non-Payment</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to non-payment.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('James Allen', 'Chubb Life', '05/08/2026', '17/08/2026', 'Non-Payment', 'Sushant Yadav', 'Client requested policy cancellation due to non-payment.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('James Allen', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('James Allen', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('James Allen', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Benjamin Young</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">06/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">17/08/2026</span></td>
                                <td class="fs-13 text-muted">Moved Overseas</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to moved overseas.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Benjamin Young', 'Chubb Life', '06/08/2026', '17/08/2026', 'Moved Overseas', 'Sushant Yadav', 'Client requested policy cancellation due to moved overseas.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Benjamin Young', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Benjamin Young', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Benjamin Young', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Aria King</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">03/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">20/08/2026</span></td>
                                <td class="fs-13 text-muted">Dissatisfied with Claim</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to dissatisfied
                                    with claim.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Aria King', 'Chubb Life', '03/08/2026', '20/08/2026', 'Dissatisfied with Claim', 'Sushant Yadav', 'Client requested policy cancellation due to dissatisfied with claim.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Aria King', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Aria King', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Aria King', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Chloe Wright</td>
                                <td class="fs-13 fw-semibold text-dark">AIA Life</td>
                                <td class="fs-13 text-muted">10/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">20/08/2026</span></td>
                                <td class="fs-13 text-muted">Moved Overseas</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to moved overseas.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Chloe Wright', 'AIA Life', '10/08/2026', '20/08/2026', 'Moved Overseas', 'Sushant Yadav', 'Client requested policy cancellation due to moved overseas.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Chloe Wright', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Chloe Wright', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Chloe Wright', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Grace Hill</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">07/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">13/08/2026</span></td>
                                <td class="fs-13 text-muted">Underwriting Terms</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to underwriting
                                    terms.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Grace Hill', 'Fidelity Life', '07/08/2026', '13/08/2026', 'Underwriting Terms', 'Priya Patel', 'Client requested policy cancellation due to underwriting terms.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Grace Hill', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Grace Hill', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Grace Hill', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Zoey Scott</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">01/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">15/08/2026</span></td>
                                <td class="fs-13 text-muted">Non-Payment</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to non-payment.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Zoey Scott', 'Fidelity Life', '01/08/2026', '15/08/2026', 'Non-Payment', 'Priya Patel', 'Client requested policy cancellation due to non-payment.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Zoey Scott', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Zoey Scott', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Zoey Scott', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Lily Green</td>
                                <td class="fs-13 fw-semibold text-dark">Partners Life</td>
                                <td class="fs-13 text-muted">08/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">16/08/2026</span></td>
                                <td class="fs-13 text-muted">Switching Insurer</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to switching
                                    insurer.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Lily Green', 'Partners Life', '08/08/2026', '16/08/2026', 'Switching Insurer', 'Priya Patel', 'Client requested policy cancellation due to switching insurer.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Lily Green', 'Partners Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Lily Green', 'Partners Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Lily Green', 'Partners Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Lillian Adams</td>
                                <td class="fs-13 fw-semibold text-dark">Chubb Life</td>
                                <td class="fs-13 text-muted">07/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">15/08/2026</span></td>
                                <td class="fs-13 text-muted">Underwriting Terms</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to underwriting
                                    terms.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Lillian Adams', 'Chubb Life', '07/08/2026', '15/08/2026', 'Underwriting Terms', 'Sushant Yadav', 'Client requested policy cancellation due to underwriting terms.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Lillian Adams', 'Chubb Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Lillian Adams', 'Chubb Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Lillian Adams', 'Chubb Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Hannah Baker</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">01/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">19/08/2026</span></td>
                                <td class="fs-13 text-muted">Premium Cost Concerns</td>
                                <td class="fs-13 text-muted">Priya Patel</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to premium cost
                                    concerns.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Hannah Baker', 'Fidelity Life', '01/08/2026', '19/08/2026', 'Premium Cost Concerns', 'Priya Patel', 'Client requested policy cancellation due to premium cost concerns.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Hannah Baker', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Hannah Baker', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Hannah Baker', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Avery Nelson</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">02/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">11/08/2026</span></td>
                                <td class="fs-13 text-muted">Underwriting Terms</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to underwriting
                                    terms.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Avery Nelson', 'Fidelity Life', '02/08/2026', '11/08/2026', 'Underwriting Terms', 'Sushant Yadav', 'Client requested policy cancellation due to underwriting terms.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Avery Nelson', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Avery Nelson', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Avery Nelson', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Layla Carter</td>
                                <td class="fs-13 fw-semibold text-dark">Fidelity Life</td>
                                <td class="fs-13 text-muted">04/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">11/08/2026</span></td>
                                <td class="fs-13 text-muted">Dissatisfied with Claim</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to dissatisfied
                                    with claim.</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Layla Carter', 'Fidelity Life', '04/08/2026', '11/08/2026', 'Dissatisfied with Claim', 'Sushant Yadav', 'Client requested policy cancellation due to dissatisfied with claim.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Layla Carter', 'Fidelity Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Layla Carter', 'Fidelity Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Layla Carter', 'Fidelity Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Brooklyn Mitchell</td>
                                <td class="fs-13 fw-semibold text-dark">Asteron Life</td>
                                <td class="fs-13 text-muted">03/08/2026</td>
                                <td><span class="badge bg-soft-success text-success fs-11">18/08/2026</span></td>
                                <td class="fs-13 text-muted">Moved Overseas</td>
                                <td class="fs-13 text-muted">Sushant Yadav</td>
                                <td class="fs-13 text-muted">Client requested policy cancellation due to moved overseas.
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails('Brooklyn Mitchell', 'Asteron Life', '03/08/2026', '18/08/2026', 'Moved Overseas', 'Sushant Yadav', 'Client requested policy cancellation due to moved overseas.')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Brooklyn Mitchell', 'Asteron Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Brooklyn Mitchell', 'Asteron Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Brooklyn Mitchell', 'Asteron Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            

<!-- Modal: View Cancellation Details (Read-only Form Layout) -->
    <div class="modal fade" id="viewCancellationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-file-text me-2"></i> Cancellation Record
                        Details - <span id="viewCancClientHeader"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">

                    <!-- SECTION 1: CLIENT & PROVIDER INFO -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-user text-primary fs-15"></i> 1. Client & Insurance Company
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Client Name</label>
                                <input type="text" class="form-control" id="viewCancClientName" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Company</label>
                                <input type="text" class="form-control" id="viewCancCompany" readonly>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Admin (Handler)</label>
                                <input type="text" class="form-control" id="viewCancAdmin" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: CANCELLATION TIMELINE & OUTCOME -->
                    <div class="modal-section-card">
                        <div class="modal-section-title">
                            <i class="feather-clock text-primary fs-15"></i> 2. Cancellation Timeline & Outcome
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Cancellation Sent</label>
                                <input type="text" class="form-control" id="viewCancDateSent" readonly>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Completed Date / Status</label>
                                <input type="text" class="form-control text-primary fw-semibold"
                                    id="viewCancCompletedDate" readonly>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label fw-semibold fs-13 text-dark">Outcome</label>
                                <input type="text" class="form-control text-danger fw-semibold" id="viewCancOutcome"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 3: COMMENTS & NOTES -->
                    <div class="modal-section-card mb-0">
                        <div class="modal-section-title">
                            <i class="feather-message-square text-primary fs-15"></i> 3. Comments & Internal Notes
                        </div>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-semibold fs-13 text-dark">Comments</label>
                                <textarea class="form-control" id="viewCancComments" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm px-4 fw-bold"
                        onclick="$('#viewCancellationModal').modal('hide'); editCancellationDetails($('#viewCancClientName').val(), $('#viewCancCompany').val(), $('#viewCancDateSent').val(), $('#viewCancCompletedDate').val(), $('#viewCancOutcome').val(), $('#viewCancAdmin').val(), $('#viewCancComments').val());"><i
                            class="feather-edit me-1"></i> Edit Record</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Log / Edit Cancellation -->
    <div class="modal fade" id="addCancellationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-file-minus me-2"></i> <span
                            id="cancModalTitle">Log Policy Cancellation</span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                        <option value="Vandana Singh">Vandana Singh</option>
                                        <option value="Suman Pappula">Suman Pappula</option>
                                        <option value="Amanda Miller">Amanda Miller</option>
                                        <option value="Kishore Kumar">Kishore Kumar</option>
                                        <option value="Rahul Sharma">Rahul Sharma</option>
                                        <option value="Jason Te Kuru">Jason Te Kuru</option>
                                        <option value="Priya Patel">Priya Patel</option>
                                        <option value="David Chen">David Chen</option>
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
                                    <input type="text" class="form-control" id="cancCompletedInput"
                                        placeholder="e.g. 15/08/2026 or Pending">
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
                                    <input type="text" class="form-control" id="cancOutcomeInput"
                                        placeholder="e.g. Cancelled - Premium Cost Concerns">
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
                                    <textarea class="form-control" id="cancCommentsInput" rows="3"
                                        placeholder="Enter comments or cancellation reason..."></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold">Save Cancellation
                            Record</button>
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
    <script src="{{ asset('assets/js/pages/clients-cancellation.js') }}"></script>
@endpush

@endsection