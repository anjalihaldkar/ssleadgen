@extends('layouts.app')
@section('title', 'Inforce Clients')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Inforce Clients Directory (892 Active)</h4>
                    <p class="text-muted fs-13 mb-0">Clients with active insurance policies currently earning premium
                        trail.</p>
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
                    <table class="table table-hover align-middle w-100" id="inforceClientsTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Client Name</th>
                                <th>Phone Number</th>
                                <th>Date of Birth</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Source</th>
                                <th>Active Policies</th>
                                <th>Last Contact</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-source="Existing Client" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Kishore Kumar</td>
                                <td class="fs-13 text-muted">021 754 2824</td>
                                <td class="fs-13 text-muted">01/12/1983</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Existing Client</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">04 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Kishore Kumar', '021 754 2824', 'Christchurch, NZ', 'Inforce', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Kishore Kumar', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Kishore Kumar', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Kishore Kumar', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Suman Pappula</td>
                                <td class="fs-13 text-muted">021 792 9935</td>
                                <td class="fs-13 text-muted">03/10/1988</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">07 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Suman Pappula', '021 792 9935', 'Auckland, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Suman Pappula', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Suman Pappula', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Suman Pappula', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Rahul Sharma</td>
                                <td class="fs-13 text-muted">021 338 9279</td>
                                <td class="fs-13 text-muted">20/01/1992</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">08 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Rahul Sharma', '021 338 9279', 'Christchurch, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Rahul Sharma', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Rahul Sharma', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Rahul Sharma', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Priya Patel</td>
                                <td class="fs-13 text-muted">021 559 5557</td>
                                <td class="fs-13 text-muted">26/01/1980</td>
                                <td class="fs-13 text-muted">Nelson, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">3</td>
                                <td class="fs-13 text-muted">05 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Priya Patel', '021 559 5557', 'Nelson, NZ', 'Inforce', '3')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Priya Patel', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Priya Patel', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Priya Patel', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Sarah Connor</td>
                                <td class="fs-13 text-muted">021 320 6514</td>
                                <td class="fs-13 text-muted">04/02/1987</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">3</td>
                                <td class="fs-13 text-muted">20 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Sarah Connor', '021 320 6514', 'Hamilton, NZ', 'Inforce', '3')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Sarah Connor', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Sarah Connor', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Sarah Connor', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Amit Miller</td>
                                <td class="fs-13 text-muted">021 370 1711</td>
                                <td class="fs-13 text-muted">24/08/1992</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">18 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Amit Miller', '021 370 1711', 'Hamilton, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Amit Miller', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Amit Miller', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Amit Miller', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">David Chang</td>
                                <td class="fs-13 text-muted">021 400 6925</td>
                                <td class="fs-13 text-muted">19/04/1977</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">10 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('David Chang', '021 400 6925', 'Auckland, NZ', 'Inforce', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('David Chang', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('David Chang', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('David Chang', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Michael Singh</td>
                                <td class="fs-13 text-muted">021 181 4814</td>
                                <td class="fs-13 text-muted">28/02/1987</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">3</td>
                                <td class="fs-13 text-muted">06 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Michael Singh', '021 181 4814', 'Tauranga, NZ', 'Inforce', '3')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Michael Singh', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Michael Singh', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Michael Singh', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Meta Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Aarav Cooper</td>
                                <td class="fs-13 text-muted">021 479 6820</td>
                                <td class="fs-13 text-muted">07/11/1983</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Meta Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">18 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Aarav Cooper', '021 479 6820', 'Hamilton, NZ', 'Inforce', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Aarav Cooper', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Aarav Cooper', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Aarav Cooper', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Vandana Taylor</td>
                                <td class="fs-13 text-muted">021 846 5010</td>
                                <td class="fs-13 text-muted">06/08/1987</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">11 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Vandana Taylor', '021 846 5010', 'Tauranga, NZ', 'Inforce', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Vandana Taylor', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Vandana Taylor', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Vandana Taylor', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">James Walker</td>
                                <td class="fs-13 text-muted">021 963 1916</td>
                                <td class="fs-13 text-muted">08/01/1985</td>
                                <td class="fs-13 text-muted">Nelson, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">07 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('James Walker', '021 963 1916', 'Nelson, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('James Walker', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('James Walker', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('James Walker', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Olivia Patel</td>
                                <td class="fs-13 text-muted">021 680 6155</td>
                                <td class="fs-13 text-muted">07/11/1990</td>
                                <td class="fs-13 text-muted">Nelson, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">05 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Olivia Patel', '021 680 6155', 'Nelson, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Olivia Patel', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Olivia Patel', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Olivia Patel', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Ethan Smith</td>
                                <td class="fs-13 text-muted">021 371 3287</td>
                                <td class="fs-13 text-muted">08/12/1992</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">19 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Ethan Smith', '021 371 3287', 'Tauranga, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Ethan Smith', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Ethan Smith', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Ethan Smith', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Arjun Johnson</td>
                                <td class="fs-13 text-muted">021 508 6930</td>
                                <td class="fs-13 text-muted">08/03/1991</td>
                                <td class="fs-13 text-muted">Napier, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">04 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Arjun Johnson', '021 508 6930', 'Napier, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Arjun Johnson', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Arjun Johnson', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Arjun Johnson', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Neha Williams</td>
                                <td class="fs-13 text-muted">021 256 3621</td>
                                <td class="fs-13 text-muted">26/11/1988</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">20 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Neha Williams', '021 256 3621', 'Hamilton, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Neha Williams', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Neha Williams', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Neha Williams', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">John Brown</td>
                                <td class="fs-13 text-muted">021 579 9669</td>
                                <td class="fs-13 text-muted">09/09/1975</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">3</td>
                                <td class="fs-13 text-muted">11 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('John Brown', '021 579 9669', 'Hamilton, NZ', 'Inforce', '3')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('John Brown', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('John Brown', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('John Brown', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Emma Jones</td>
                                <td class="fs-13 text-muted">021 214 5808</td>
                                <td class="fs-13 text-muted">14/03/1989</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">3</td>
                                <td class="fs-13 text-muted">17 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Emma Jones', '021 214 5808', 'Auckland, NZ', 'Inforce', '3')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Emma Jones', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Emma Jones', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Emma Jones', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Door to Door" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Robert Garcia</td>
                                <td class="fs-13 text-muted">021 880 3927</td>
                                <td class="fs-13 text-muted">17/02/1995</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Door to Door</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">05 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Robert Garcia', '021 880 3927', 'Tauranga, NZ', 'Inforce', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Robert Garcia', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Robert Garcia', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Robert Garcia', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Sophia Miller</td>
                                <td class="fs-13 text-muted">021 482 3646</td>
                                <td class="fs-13 text-muted">18/09/1975</td>
                                <td class="fs-13 text-muted">Dunedin, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">04 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Sophia Miller', '021 482 3646', 'Dunedin, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Sophia Miller', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Sophia Miller', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Sophia Miller', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">William Davis</td>
                                <td class="fs-13 text-muted">021 471 6038</td>
                                <td class="fs-13 text-muted">08/01/1982</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">03 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('William Davis', '021 471 6038', 'Hamilton, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('William Davis', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('William Davis', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('William Davis', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Meta Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Isabella Rodriguez</td>
                                <td class="fs-13 text-muted">021 878 9727</td>
                                <td class="fs-13 text-muted">25/03/1979</td>
                                <td class="fs-13 text-muted">Napier, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Meta Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">09 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Isabella Rodriguez', '021 878 9727', 'Napier, NZ', 'Inforce', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Isabella Rodriguez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Isabella Rodriguez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Isabella Rodriguez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Daniel Martinez</td>
                                <td class="fs-13 text-muted">021 640 7932</td>
                                <td class="fs-13 text-muted">07/09/1981</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">3</td>
                                <td class="fs-13 text-muted">15 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Daniel Martinez', '021 640 7932', 'Tauranga, NZ', 'Inforce', '3')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Daniel Martinez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Daniel Martinez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Daniel Martinez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Mia Hernandez</td>
                                <td class="fs-13 text-muted">021 629 8397</td>
                                <td class="fs-13 text-muted">04/04/1982</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">19 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Mia Hernandez', '021 629 8397', 'Hamilton, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Mia Hernandez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Mia Hernandez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Mia Hernandez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Joseph Lopez</td>
                                <td class="fs-13 text-muted">021 667 4770</td>
                                <td class="fs-13 text-muted">19/04/1975</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">08 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Joseph Lopez', '021 667 4770', 'Hamilton, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Joseph Lopez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Joseph Lopez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Joseph Lopez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Charlotte Gonzalez</td>
                                <td class="fs-13 text-muted">021 169 1514</td>
                                <td class="fs-13 text-muted">28/06/1977</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">07 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Charlotte Gonzalez', '021 169 1514', 'Christchurch, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Charlotte Gonzalez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Charlotte Gonzalez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Charlotte Gonzalez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Existing Client" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Matthew Wilson</td>
                                <td class="fs-13 text-muted">021 652 3167</td>
                                <td class="fs-13 text-muted">24/10/1993</td>
                                <td class="fs-13 text-muted">Napier, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Existing Client</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">14 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Matthew Wilson', '021 652 3167', 'Napier, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Matthew Wilson', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Matthew Wilson', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Matthew Wilson', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Amelia Anderson</td>
                                <td class="fs-13 text-muted">021 294 2545</td>
                                <td class="fs-13 text-muted">04/11/1988</td>
                                <td class="fs-13 text-muted">Dunedin, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">15 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Amelia Anderson', '021 294 2545', 'Dunedin, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Amelia Anderson', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Amelia Anderson', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Amelia Anderson', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">David Thomas</td>
                                <td class="fs-13 text-muted">021 984 1887</td>
                                <td class="fs-13 text-muted">22/11/1995</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">11 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('David Thomas', '021 984 1887', 'Hamilton, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('David Thomas', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('David Thomas', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('David Thomas', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Existing Client" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Harper Taylor</td>
                                <td class="fs-13 text-muted">021 919 2790</td>
                                <td class="fs-13 text-muted">08/04/1981</td>
                                <td class="fs-13 text-muted">Napier, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Existing Client</td>
                                <td class="fs-13 fw-semibold text-dark text-center">4</td>
                                <td class="fs-13 text-muted">06 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Harper Taylor', '021 919 2790', 'Napier, NZ', 'Inforce', '4')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Harper Taylor', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Harper Taylor', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Harper Taylor', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inforce">
                                <td class="fw-bold text-dark fs-13">Andrew Moore</td>
                                <td class="fs-13 text-muted">021 385 8579</td>
                                <td class="fs-13 text-muted">08/02/1989</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inforce">Inforce</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">03 Aug 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Andrew Moore', '021 385 8579', 'Hamilton, NZ', 'Inforce', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Andrew Moore', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Andrew Moore', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Andrew Moore', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
</tbody>
                    </table>
                </div>
            

</div>
    </div>

    <!-- Modal: Add New Client -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-user-plus me-2"></i> Add New Client
                        Profile</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="addClientForm" onsubmit="event.preventDefault(); handleAddNewClient();">
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Client Full Name *</label>
                                <input type="text" class="form-control" id="clientNameInput"
                                    placeholder="e.g. Ramesh Patel" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Phone Number *</label>
                                <input type="text" class="form-control" id="clientPhoneInput" placeholder="021 XXX XXXX"
                                    required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Date of Birth</label>
                                <input type="date" class="form-control" id="clientDobInput">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Residential Address</label>
                                <input type="text" class="form-control" id="clientAddressInput"
                                    placeholder="e.g. Auckland, NZ">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Policy Status</label>
                                <select class="form-select" id="clientStatusSelect">
                                    <option value="Inforce">Inforce</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Lead Source</label>
                                <select class="form-select" id="clientSourceSelect">
                                    <option value="Referral">Referral</option>
                                    <option value="Existing Client">Existing Client</option>
                                    <option value="Meta Ads">Meta Ads</option>
                                    <option value="Website">Website Inbound</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold fs-13 text-dark">Initial Active Policies</label>
                                <input type="number" class="form-control" id="clientPoliciesInput" placeholder="1"
                                    value="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Save Client Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    
        </div>
    </div>

    
    
    
    
    
    
    
    

    


    

    <div class="modal fade" id="clientRequestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-git-pull-request me-2"></i> Client Service
                        Request - <span id="reqClientNameHeader"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
                                    <input type="text" class="form-control" id="reqClientNameInput"
                                        placeholder="Client Name" required>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Insurance Company *</label>
                                    <input type="text" class="form-control" id="reqCompanyInput"
                                        placeholder="Insurance Company" required>
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
                                        <option value="Premium Deduction of 1 month">Premium Deduction of 1 month
                                        </option>
                                        <option value="Birth Certificate to add name inbuilt cover">Birth Certificate to
                                            add name inbuilt cover</option>
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
                                    <textarea class="form-control" id="reqOutcomeInput" rows="2"
                                        placeholder="e.g. Address updated with AIA portal successfully."></textarea>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Comments</label>
                                    <textarea class="form-control" id="reqCommentsInput" rows="2"
                                        placeholder="Internal notes or adviser instructions..."></textarea>
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
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold"><i
                                class="feather-save me-1"></i> Save Client Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lodgeClaimModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-shield me-2"></i> <span
                            id="claimModalTitle">New Claim Update</span></h5>
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

    <div class="modal fade" id="addCancellationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-file-minus me-2"></i> <span
                            id="cancModalTitle">New Cancellation Update</span></h5>
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

@push('scripts')
    <script src="{{ asset('assets/js/pages/clients-login.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    <script src="{{ asset('assets/js/pages/clients-inforce.js') }}"></script>
@endpush

@endsection