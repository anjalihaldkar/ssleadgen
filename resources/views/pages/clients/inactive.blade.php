@extends('layouts.app')
@section('title', 'Inactive Clients')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Inactive Clients Directory (353 Profiles)</h4>
                    <p class="text-muted fs-13 mb-0">Clients whose policies have lapsed or are currently inactive.</p>
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
                    <table class="table table-hover align-middle w-100" id="inactiveClientsTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Client Name</th>
                                <th>Phone Number</th>
                                <th>Date of Birth</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Source</th>
                                <th>Previous Policies</th>
                                <th>Last Contact</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-source="Existing Client" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Evelyn Jackson</td>
                                <td class="fs-13 text-muted">022 871 4872</td>
                                <td class="fs-13 text-muted">06/07/1985</td>
                                <td class="fs-13 text-muted">Napier, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Existing Client</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">02 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Evelyn Jackson', '022 871 4872', 'Napier, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Evelyn Jackson', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Evelyn Jackson', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Evelyn Jackson', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Joshua Martin</td>
                                <td class="fs-13 text-muted">022 488 1035</td>
                                <td class="fs-13 text-muted">13/05/1984</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">05 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Joshua Martin', '022 488 1035', 'Tauranga, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Joshua Martin', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Joshua Martin', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Joshua Martin', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Abigail Lee</td>
                                <td class="fs-13 text-muted">022 403 4566</td>
                                <td class="fs-13 text-muted">02/10/1987</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">02 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Abigail Lee', '022 403 4566', 'Auckland, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Abigail Lee', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Abigail Lee', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Abigail Lee', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Meta Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Ryan Perez</td>
                                <td class="fs-13 text-muted">022 698 8811</td>
                                <td class="fs-13 text-muted">17/09/1975</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Meta Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">28 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Ryan Perez', '022 698 8811', 'Auckland, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Ryan Perez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Ryan Perez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Ryan Perez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Meta Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Emily Thompson</td>
                                <td class="fs-13 text-muted">022 170 2113</td>
                                <td class="fs-13 text-muted">22/04/1982</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Meta Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">19 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Emily Thompson', '022 170 2113', 'Hamilton, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Emily Thompson', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Emily Thompson', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Emily Thompson', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Jacob White</td>
                                <td class="fs-13 text-muted">022 140 2343</td>
                                <td class="fs-13 text-muted">14/11/1988</td>
                                <td class="fs-13 text-muted">Dunedin, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">22 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Jacob White', '022 140 2343', 'Dunedin, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Jacob White', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Jacob White', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Jacob White', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Elizabeth Harris</td>
                                <td class="fs-13 text-muted">022 421 4910</td>
                                <td class="fs-13 text-muted">09/07/1974</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">25 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Elizabeth Harris', '022 421 4910', 'Tauranga, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Elizabeth Harris', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Elizabeth Harris', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Elizabeth Harris', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Meta Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Justin Sanchez</td>
                                <td class="fs-13 text-muted">022 109 8508</td>
                                <td class="fs-13 text-muted">20/10/1973</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Meta Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">17 Jun 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Justin Sanchez', '022 109 8508', 'Hamilton, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Justin Sanchez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Justin Sanchez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Justin Sanchez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Existing Client" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Sofia Clark</td>
                                <td class="fs-13 text-muted">022 235 6718</td>
                                <td class="fs-13 text-muted">03/04/1981</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Existing Client</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">27 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Sofia Clark', '022 235 6718', 'Tauranga, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Sofia Clark', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Sofia Clark', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Sofia Clark', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Benjamin Ramirez</td>
                                <td class="fs-13 text-muted">022 820 5956</td>
                                <td class="fs-13 text-muted">20/11/1986</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">22 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Benjamin Ramirez', '022 820 5956', 'Auckland, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Benjamin Ramirez', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Benjamin Ramirez', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Benjamin Ramirez', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Liam Chen</td>
                                <td class="fs-13 text-muted">022 999 3200</td>
                                <td class="fs-13 text-muted">09/02/1973</td>
                                <td class="fs-13 text-muted">Wellington, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">20 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Liam Chen', '022 999 3200', 'Wellington, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Liam Chen', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Liam Chen', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Liam Chen', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Meta Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Lucas Davis</td>
                                <td class="fs-13 text-muted">022 834 6617</td>
                                <td class="fs-13 text-muted">07/11/1990</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Meta Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">09 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Lucas Davis', '022 834 6617', 'Tauranga, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Lucas Davis', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Lucas Davis', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Lucas Davis', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Mason Evans</td>
                                <td class="fs-13 text-muted">022 194 7939</td>
                                <td class="fs-13 text-muted">27/05/1971</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">21 Jun 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Mason Evans', '022 194 7939', 'Auckland, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Mason Evans', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Mason Evans', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Mason Evans', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Logan Te Kuru</td>
                                <td class="fs-13 text-muted">022 265 8239</td>
                                <td class="fs-13 text-muted">18/12/1983</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">23 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Logan Te Kuru', '022 265 8239', 'Auckland, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Logan Te Kuru', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Logan Te Kuru', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Logan Te Kuru', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Elijah Taylor</td>
                                <td class="fs-13 text-muted">022 658 1590</td>
                                <td class="fs-13 text-muted">27/06/1988</td>
                                <td class="fs-13 text-muted">Wellington, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">02 Jun 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Elijah Taylor', '022 658 1590', 'Wellington, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Elijah Taylor', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Elijah Taylor', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Elijah Taylor', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Oliver Grey</td>
                                <td class="fs-13 text-muted">022 473 1653</td>
                                <td class="fs-13 text-muted">12/04/1991</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">12 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Oliver Grey', '022 473 1653', 'Christchurch, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Oliver Grey', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Oliver Grey', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Oliver Grey', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Door to Door" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Carter Green</td>
                                <td class="fs-13 text-muted">022 995 7658</td>
                                <td class="fs-13 text-muted">20/12/1974</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Door to Door</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">26 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Carter Green', '022 995 7658', 'Christchurch, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Carter Green', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Carter Green', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Carter Green', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Door to Door" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Alexander Hall</td>
                                <td class="fs-13 text-muted">022 522 1406</td>
                                <td class="fs-13 text-muted">06/12/1980</td>
                                <td class="fs-13 text-muted">Nelson, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Door to Door</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">09 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Alexander Hall', '022 522 1406', 'Nelson, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Alexander Hall', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Alexander Hall', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Alexander Hall', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Existing Client" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">James Allen</td>
                                <td class="fs-13 text-muted">022 906 2771</td>
                                <td class="fs-13 text-muted">13/01/1985</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Existing Client</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">12 Jun 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('James Allen', '022 906 2771', 'Christchurch, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('James Allen', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('James Allen', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('James Allen', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Benjamin Young</td>
                                <td class="fs-13 text-muted">022 940 4728</td>
                                <td class="fs-13 text-muted">08/01/1991</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">09 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Benjamin Young', '022 940 4728', 'Christchurch, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Benjamin Young', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Benjamin Young', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Benjamin Young', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Aria King</td>
                                <td class="fs-13 text-muted">022 891 5573</td>
                                <td class="fs-13 text-muted">12/11/1986</td>
                                <td class="fs-13 text-muted">Nelson, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">01 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Aria King', '022 891 5573', 'Nelson, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Aria King', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Aria King', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Aria King', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Chloe Wright</td>
                                <td class="fs-13 text-muted">022 998 5279</td>
                                <td class="fs-13 text-muted">06/10/1978</td>
                                <td class="fs-13 text-muted">Auckland, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">12 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Chloe Wright', '022 998 5279', 'Auckland, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Chloe Wright', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Chloe Wright', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Chloe Wright', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Grace Hill</td>
                                <td class="fs-13 text-muted">022 905 6139</td>
                                <td class="fs-13 text-muted">14/10/1986</td>
                                <td class="fs-13 text-muted">Hamilton, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">09 May 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Grace Hill', '022 905 6139', 'Hamilton, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Grace Hill', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Grace Hill', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Grace Hill', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Zoey Scott</td>
                                <td class="fs-13 text-muted">022 825 8144</td>
                                <td class="fs-13 text-muted">01/09/1987</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">03 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Zoey Scott', '022 825 8144', 'Christchurch, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Zoey Scott', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Zoey Scott', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Zoey Scott', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Lily Green</td>
                                <td class="fs-13 text-muted">022 438 6143</td>
                                <td class="fs-13 text-muted">22/02/1979</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">11 Jun 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Lily Green', '022 438 6143', 'Tauranga, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Lily Green', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Lily Green', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Lily Green', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Website" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Lillian Adams</td>
                                <td class="fs-13 text-muted">022 813 5844</td>
                                <td class="fs-13 text-muted">18/03/1976</td>
                                <td class="fs-13 text-muted">Nelson, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Website</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">22 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Lillian Adams', '022 813 5844', 'Nelson, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Lillian Adams', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Lillian Adams', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Lillian Adams', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Facebook Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Hannah Baker</td>
                                <td class="fs-13 text-muted">022 278 5930</td>
                                <td class="fs-13 text-muted">13/09/1970</td>
                                <td class="fs-13 text-muted">Tauranga, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Facebook Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">14 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Hannah Baker', '022 278 5930', 'Tauranga, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Hannah Baker', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Hannah Baker', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Hannah Baker', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Meta Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Avery Nelson</td>
                                <td class="fs-13 text-muted">022 721 6279</td>
                                <td class="fs-13 text-muted">15/08/1984</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Meta Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">2</td>
                                <td class="fs-13 text-muted">26 Jul 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Avery Nelson', '022 721 6279', 'Christchurch, NZ', 'Inactive', '2')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Avery Nelson', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Avery Nelson', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Avery Nelson', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Referral" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Layla Carter</td>
                                <td class="fs-13 text-muted">022 273 2389</td>
                                <td class="fs-13 text-muted">10/09/1991</td>
                                <td class="fs-13 text-muted">Dunedin, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Referral</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">22 Jun 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Layla Carter', '022 273 2389', 'Dunedin, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Layla Carter', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Layla Carter', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Layla Carter', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr data-source="Google Ads" data-status="Inactive">
                                <td class="fw-bold text-dark fs-13">Brooklyn Mitchell</td>
                                <td class="fs-13 text-muted">022 330 4262</td>
                                <td class="fs-13 text-muted">05/01/1971</td>
                                <td class="fs-13 text-muted">Christchurch, NZ</td>
                                <td><span class="status-pill-inactive">Inactive</span></td>
                                <td class="fs-13 text-muted">Google Ads</td>
                                <td class="fs-13 fw-semibold text-dark text-center">1</td>
                                <td class="fs-13 text-muted">15 Jun 2026</td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('Brooklyn Mitchell', '022 330 4262', 'Christchurch, NZ', 'Inactive', '1')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('Brooklyn Mitchell', 'AIA Life')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('Brooklyn Mitchell', 'AIA Life')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('Brooklyn Mitchell', 'AIA Life')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
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
                                    <option value="Inactive">Inactive</option>
                                    <option value="Inforce">Inforce</option>
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
                                <label class="form-label fw-semibold fs-13 text-dark">Previous Policies</label>
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
    <script src="{{ asset('assets/js/pages/clients-inactive.js') }}"></script>
@endpush

@endsection