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
                    <button class="btn btn-light btn-sm px-3 fw-bold text-success border-success" data-bs-toggle="modal" data-bs-target="#importLeadsModal"><i class="feather-upload me-1"></i> Import Leads</button>
                    <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#createLeadModal"><i class="feather-plus me-1"></i> Add Lead</button>
                </div>
            </div>

                                    <!-- 1. KANBAN VIEW CONTAINER WITH FULL INTERACTIVE DRAG AND DROP -->
            <div id="kanbanViewContainer" class="row g-3">
                <!-- Column 1: New Leads -->
                <div class="col-md-3 kanban-column-box" data-status-class="border-primary">
                    <div class="card-widget p-3 bg-light border min-vh-50" ondragover="handleKanbanDragOver(event)" ondrop="handleKanbanDrop(event, this)">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-dark mb-0"><i class="feather-circle text-primary me-2"></i> New Leads <span class="kanban-count text-primary">(8)</span></h6>
                        </div>
                        <div class="kanban-card-dropzone d-flex flex-column gap-2" style="min-height: 250px;">
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Evelyn Te Kuru', '021 620 6928', 'evelyn@example.com', 'Referral', '$6100/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Evelyn Te Kuru</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($6100/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Emily Hall', '021 964 2657', 'emily@example.com', 'Meta Ads', '$8400/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Emily Hall</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Meta Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($8400/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Sofia Wright', '021 838 8170', 'sofia@example.com', 'Referral', '$6700/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Sofia Wright</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($6700/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Mason Adams', '021 955 4178', 'mason@example.com', 'Facebook Ads', '$7100/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Facebook Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Mason Adams</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Facebook Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($7100/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Carter Mitchell', '021 993 5096', 'carter@example.com', 'Referral', '$7600/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Carter Mitchell</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($7600/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Aria Patel', '021 379 8361', 'aria@example.com', 'Meta Ads', '$3300/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Aria Patel</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Meta Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3300/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Lily Singh', '021 482 4862', 'lily@example.com', 'Google Ads', '$2500/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Lily Singh</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Google Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($2500/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-primary" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Layla Patel', '021 812 3273', 'layla@example.com', 'Door to Door', '$7500/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Layla Patel</div>
                                    <span class="badge bg-soft-primary text-primary fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($7500/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Contacted -->
                <div class="col-md-3 kanban-column-box" data-status-class="border-info">
                    <div class="card-widget p-3 bg-light border min-vh-50" ondragover="handleKanbanDragOver(event)" ondrop="handleKanbanDrop(event, this)">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-dark mb-0"><i class="feather-circle text-info me-2"></i> Contacted <span class="kanban-count text-info">(8)</span></h6>
                        </div>
                        <div class="kanban-card-dropzone d-flex flex-column gap-2" style="min-height: 250px;">
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Joshua Taylor', '021 416 3953', 'joshua@example.com', 'Existing Client', '$5800/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Joshua Taylor</div>
                                    <span class="badge bg-soft-info text-info fs-10">Existing Client</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($5800/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Jacob Allen', '021 955 9626', 'jacob@example.com', 'Referral', '$5800/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Jacob Allen</div>
                                    <span class="badge bg-soft-info text-info fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($5800/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Benjamin Hill', '021 473 4891', 'benjamin@example.com', 'Google Ads', '$5100/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Benjamin Hill</div>
                                    <span class="badge bg-soft-info text-info fs-10">Google Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($5100/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Logan Baker', '021 572 5616', 'logan@example.com', 'Door to Door', '$6300/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Logan Baker</div>
                                    <span class="badge bg-soft-info text-info fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($6300/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Alexander Kumar', '021 995 7081', 'alexander@example.com', 'Meta Ads', '$2800/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Alexander Kumar</div>
                                    <span class="badge bg-soft-info text-info fs-10">Meta Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($2800/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Chloe Connor', '021 950 8167', 'chloe@example.com', 'Referral', '$4300/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Chloe Connor</div>
                                    <span class="badge bg-soft-info text-info fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($4300/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Lillian Cooper', '021 483 4678', 'lillian@example.com', 'Referral', '$5500/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Lillian Cooper</div>
                                    <span class="badge bg-soft-info text-info fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($5500/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-info" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Brooklyn Smith', '021 559 1086', 'brooklyn@example.com', 'Referral', '$1700/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Brooklyn Smith</div>
                                    <span class="badge bg-soft-info text-info fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($1700/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Underwriting -->
                <div class="col-md-3 kanban-column-box" data-status-class="border-warning">
                    <div class="card-widget p-3 bg-light border min-vh-50" ondragover="handleKanbanDragOver(event)" ondrop="handleKanbanDrop(event, this)">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-dark mb-0"><i class="feather-circle text-warning me-2"></i> Underwriting <span class="kanban-count text-warning">(8)</span></h6>
                        </div>
                        <div class="kanban-card-dropzone d-flex flex-column gap-2" style="min-height: 250px;">
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Abigail Grey', '021 884 8967', 'abigail@example.com', 'Existing Client', '$4300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Abigail Grey</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Existing Client</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($4300/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Elizabeth Young', '021 997 3147', 'elizabeth@example.com', 'Meta Ads', '$6300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Elizabeth Young</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Meta Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($6300/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Liam Scott', '021 870 8355', 'liam@example.com', 'Existing Client', '$8300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Liam Scott</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Existing Client</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($8300/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Elijah Nelson', '021 614 9641', 'elijah@example.com', 'Google Ads', '$3500/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Elijah Nelson</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Google Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3500/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('James Pappula', '021 828 9452', 'james@example.com', 'Door to Door', '$3000/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">James Pappula</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3000/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Grace Miller', '021 936 8391', 'grace@example.com', 'Facebook Ads', '$1800/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Facebook Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Grace Miller</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Facebook Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($1800/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Hannah Taylor', '021 201 6493', 'hannah@example.com', 'Door to Door', '$3300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Hannah Taylor</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3300/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-warning" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Kishore Johnson', '021 362 4533', 'kishore@example.com', 'Door to Door', '$3400/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Kishore Johnson</div>
                                    <span class="badge bg-soft-warning text-warning fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3400/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 4: Policy Issued -->
                <div class="col-md-3 kanban-column-box" data-status-class="border-success">
                    <div class="card-widget p-3 bg-light border min-vh-50" ondragover="handleKanbanDragOver(event)" ondrop="handleKanbanDrop(event, this)">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-dark mb-0"><i class="feather-circle text-success me-2"></i> Policy Issued <span class="kanban-count text-success">(8)</span></h6>
                        </div>
                        <div class="kanban-card-dropzone d-flex flex-column gap-2" style="min-height: 250px;">
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Ryan Green', '021 240 3538', 'ryan@example.com', 'Referral', '$5200/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Ryan Green</div>
                                    <span class="badge bg-soft-success text-success fs-10">Referral</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($5200/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Justin King', '021 257 3658', 'justin@example.com', 'Existing Client', '$3600/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Justin King</div>
                                    <span class="badge bg-soft-success text-success fs-10">Existing Client</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3600/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Lucas Green', '021 344 6070', 'lucas@example.com', 'Door to Door', '$7500/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Lucas Green</div>
                                    <span class="badge bg-soft-success text-success fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($7500/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Oliver Carter', '021 936 4271', 'oliver@example.com', 'Door to Door', '$3200/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Oliver Carter</div>
                                    <span class="badge bg-soft-success text-success fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3200/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Benjamin Sharma', '021 391 2374', 'benjamin@example.com', 'Door to Door', '$3500/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Benjamin Sharma</div>
                                    <span class="badge bg-soft-success text-success fs-10">Door to Door</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($3500/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Zoey Chang', '021 524 1872', 'zoey@example.com', 'Google Ads', '$7900/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Zoey Chang</div>
                                    <span class="badge bg-soft-success text-success fs-10">Google Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($7900/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Avery Walker', '021 240 1627', 'avery@example.com', 'Facebook Ads', '$7500/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Facebook Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Avery Walker</div>
                                    <span class="badge bg-soft-success text-success fs-10">Facebook Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($7500/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                            <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-success" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('Suman Williams', '021 661 9647', 'suman@example.com', 'Google Ads', '$2900/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="fw-bold text-dark fs-13">Suman Williams</div>
                                    <span class="badge bg-soft-success text-success fs-10">Google Ads</span>
                                </div>
                                <div class="text-muted fs-12 mt-1">Cover Premium ($2900/yr)</div>
                                <div class="fs-11 text-muted mt-2 d-flex justify-content-between align-items-center"><span><i class="feather-clock me-1"></i> Active</span><span class="text-primary fw-semibold fs-11">Click for Details &gt;</span></div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <tr>
                                <td class="fw-bold text-dark fs-13">Evelyn Te Kuru</td>
                                <td class="fs-13 text-muted">021 620 6928 | evelyn@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$6100/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Evelyn Te Kuru', '021 620 6928', 'evelyn@example.com', 'Referral', '$6100/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Joshua Taylor</td>
                                <td class="fs-13 text-muted">021 416 3953 | joshua@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Existing Client</span></td>
                                <td class="fs-13 fw-semibold text-dark">$5800/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Joshua Taylor', '021 416 3953', 'joshua@example.com', 'Existing Client', '$5800/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Abigail Grey</td>
                                <td class="fs-13 text-muted">021 884 8967 | abigail@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Existing Client</span></td>
                                <td class="fs-13 fw-semibold text-dark">$4300/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Abigail Grey', '021 884 8967', 'abigail@example.com', 'Existing Client', '$4300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Ryan Green</td>
                                <td class="fs-13 text-muted">021 240 3538 | ryan@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$5200/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Ryan Green', '021 240 3538', 'ryan@example.com', 'Referral', '$5200/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Emily Hall</td>
                                <td class="fs-13 text-muted">021 964 2657 | emily@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Meta Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$8400/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Emily Hall', '021 964 2657', 'emily@example.com', 'Meta Ads', '$8400/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Jacob Allen</td>
                                <td class="fs-13 text-muted">021 955 9626 | jacob@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$5800/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Jacob Allen', '021 955 9626', 'jacob@example.com', 'Referral', '$5800/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Elizabeth Young</td>
                                <td class="fs-13 text-muted">021 997 3147 | elizabeth@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Meta Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$6300/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Elizabeth Young', '021 997 3147', 'elizabeth@example.com', 'Meta Ads', '$6300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Justin King</td>
                                <td class="fs-13 text-muted">021 257 3658 | justin@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Existing Client</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3600/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Justin King', '021 257 3658', 'justin@example.com', 'Existing Client', '$3600/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Sofia Wright</td>
                                <td class="fs-13 text-muted">021 838 8170 | sofia@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$6700/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Sofia Wright', '021 838 8170', 'sofia@example.com', 'Referral', '$6700/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Benjamin Hill</td>
                                <td class="fs-13 text-muted">021 473 4891 | benjamin@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Google Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$5100/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Benjamin Hill', '021 473 4891', 'benjamin@example.com', 'Google Ads', '$5100/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Liam Scott</td>
                                <td class="fs-13 text-muted">021 870 8355 | liam@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Existing Client</span></td>
                                <td class="fs-13 fw-semibold text-dark">$8300/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Liam Scott', '021 870 8355', 'liam@example.com', 'Existing Client', '$8300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Existing Client.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Lucas Green</td>
                                <td class="fs-13 text-muted">021 344 6070 | lucas@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$7500/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Lucas Green', '021 344 6070', 'lucas@example.com', 'Door to Door', '$7500/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Mason Adams</td>
                                <td class="fs-13 text-muted">021 955 4178 | mason@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Facebook Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$7100/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Mason Adams', '021 955 4178', 'mason@example.com', 'Facebook Ads', '$7100/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Facebook Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Logan Baker</td>
                                <td class="fs-13 text-muted">021 572 5616 | logan@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$6300/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Logan Baker', '021 572 5616', 'logan@example.com', 'Door to Door', '$6300/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Elijah Nelson</td>
                                <td class="fs-13 text-muted">021 614 9641 | elijah@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Google Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3500/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Elijah Nelson', '021 614 9641', 'elijah@example.com', 'Google Ads', '$3500/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Oliver Carter</td>
                                <td class="fs-13 text-muted">021 936 4271 | oliver@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3200/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Oliver Carter', '021 936 4271', 'oliver@example.com', 'Door to Door', '$3200/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Carter Mitchell</td>
                                <td class="fs-13 text-muted">021 993 5096 | carter@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$7600/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Carter Mitchell', '021 993 5096', 'carter@example.com', 'Referral', '$7600/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Alexander Kumar</td>
                                <td class="fs-13 text-muted">021 995 7081 | alexander@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Meta Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$2800/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Alexander Kumar', '021 995 7081', 'alexander@example.com', 'Meta Ads', '$2800/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">James Pappula</td>
                                <td class="fs-13 text-muted">021 828 9452 | james@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3000/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('James Pappula', '021 828 9452', 'james@example.com', 'Door to Door', '$3000/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Benjamin Sharma</td>
                                <td class="fs-13 text-muted">021 391 2374 | benjamin@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3500/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Benjamin Sharma', '021 391 2374', 'benjamin@example.com', 'Door to Door', '$3500/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Aria Patel</td>
                                <td class="fs-13 text-muted">021 379 8361 | aria@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Meta Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3300/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Aria Patel', '021 379 8361', 'aria@example.com', 'Meta Ads', '$3300/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Meta Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Chloe Connor</td>
                                <td class="fs-13 text-muted">021 950 8167 | chloe@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$4300/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Chloe Connor', '021 950 8167', 'chloe@example.com', 'Referral', '$4300/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Grace Miller</td>
                                <td class="fs-13 text-muted">021 936 8391 | grace@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Facebook Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$1800/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Grace Miller', '021 936 8391', 'grace@example.com', 'Facebook Ads', '$1800/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Facebook Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Zoey Chang</td>
                                <td class="fs-13 text-muted">021 524 1872 | zoey@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Google Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$7900/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Zoey Chang', '021 524 1872', 'zoey@example.com', 'Google Ads', '$7900/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Lily Singh</td>
                                <td class="fs-13 text-muted">021 482 4862 | lily@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Google Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$2500/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Lily Singh', '021 482 4862', 'lily@example.com', 'Google Ads', '$2500/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Lillian Cooper</td>
                                <td class="fs-13 text-muted">021 483 4678 | lillian@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$5500/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Lillian Cooper', '021 483 4678', 'lillian@example.com', 'Referral', '$5500/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Hannah Taylor</td>
                                <td class="fs-13 text-muted">021 201 6493 | hannah@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3300/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Hannah Taylor', '021 201 6493', 'hannah@example.com', 'Door to Door', '$3300/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Avery Walker</td>
                                <td class="fs-13 text-muted">021 240 1627 | avery@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Facebook Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$7500/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Avery Walker', '021 240 1627', 'avery@example.com', 'Facebook Ads', '$7500/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Facebook Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Layla Patel</td>
                                <td class="fs-13 text-muted">021 812 3273 | layla@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$7500/yr</td>
                                <td><span class="badge bg-primary fs-11">New Lead</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Layla Patel', '021 812 3273', 'layla@example.com', 'Door to Door', '$7500/yr', 'New Lead', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Brooklyn Smith</td>
                                <td class="fs-13 text-muted">021 559 1086 | brooklyn@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Referral</span></td>
                                <td class="fs-13 fw-semibold text-dark">$1700/yr</td>
                                <td><span class="badge bg-info fs-11">Contacted</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Brooklyn Smith', '021 559 1086', 'brooklyn@example.com', 'Referral', '$1700/yr', 'Contacted', 'Sushant Yadav', 'Interested in advisory review. Source: Referral.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Kishore Johnson</td>
                                <td class="fs-13 text-muted">021 362 4533 | kishore@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Door to Door</span></td>
                                <td class="fs-13 fw-semibold text-dark">$3400/yr</td>
                                <td><span class="badge bg-warning fs-11">Underwriting</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Kishore Johnson', '021 362 4533', 'kishore@example.com', 'Door to Door', '$3400/yr', 'Underwriting', 'Sushant Yadav', 'Interested in advisory review. Source: Door to Door.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Suman Williams</td>
                                <td class="fs-13 text-muted">021 661 9647 | suman@example.com</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Google Ads</span></td>
                                <td class="fs-13 fw-semibold text-dark">$2900/yr</td>
                                <td><span class="badge bg-success fs-11">Policy Issued</span></td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="openLeadDetailModal('Suman Williams', '021 661 9647', 'suman@example.com', 'Google Ads', '$2900/yr', 'Policy Issued', 'Sushant Yadav', 'Interested in advisory review. Source: Google Ads.')"><i class="feather-eye text-primary me-1"></i> View Details</a>
                                            <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-arrow-right text-success me-1"></i> Convert to Client</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
</tbody>
                    </table>
                </div>
            

<!-- Modal: Prospect Lead Details & Underwriting Notes -->
    <div class="modal fade" id="leadDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0" id="leadDetailModalTitle"><i class="feather-user me-2"></i> Prospect Lead Overview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4" id="leadDetailModalBody">
                    <!-- Populated dynamically via openLeadDetailModal() -->
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add New Login Client Entry (Exact match from clients-login.html) -->
    <div class="modal fade" id="createLeadModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-user-plus me-2"></i> Add New Login Client Entry</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="createLeadForm" onsubmit="event.preventDefault(); handleAddNewLead();">
                    <div class="modal-body p-4" style="max-height: 75vh; overflow-y: auto;">
                        
                        <!-- SECTION 1: POLICY & PROVIDER INFO -->
                        <div class="modal-section-card">
                            <div class="modal-section-title">
                                <i class="feather-shield text-primary fs-15"></i> 1. Policy & Insurance Provider
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Policy No.</label>
                                    <input type="text" class="form-control" id="loginPolicyNoInput" placeholder="e.g. POL-2026-9912">
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Insurance Company *</label>
                                    <select class="form-select" id="loginCompanyInput">
                                        <option value="AIA Life">AIA Life</option>
                                        <option value="Fidelity Life">Fidelity Life</option>
                                        <option value="Chubb Life">Chubb Life</option>
                                        <option value="Partners Life">Partners Life</option>
                                        <option value="Asteron Life">Asteron Life</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Login Date</label>
                                    <input type="date" class="form-control" id="loginDateInput">
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">ANP ($)</label>
                                    <input type="number" class="form-control" id="loginAnpInput" placeholder="2500">
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
                                    <input type="text" class="form-control" id="loginFirstNameInput" placeholder="e.g. Rahul" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Last Name *</label>
                                    <input type="text" class="form-control" id="loginLastNameInput" placeholder="e.g. Sharma" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Date of Birth</label>
                                    <input type="date" class="form-control" id="loginDobInput">
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Mobile Number *</label>
                                    <input type="text" class="form-control" id="loginMobileInput" placeholder="021 XXX XXXX" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Email Address</label>
                                    <input type="email" class="form-control" id="loginEmailInput" placeholder="client@example.com">
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
                                    <input type="text" class="form-control" id="loginAddressInput" placeholder="e.g. 42 Queen Street">
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Suburb</label>
                                    <input type="text" class="form-control" id="loginSuburbInput" placeholder="e.g. Central">
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">City</label>
                                    <input type="text" class="form-control" id="loginCityInput" placeholder="e.g. Auckland">
                                </div>
                                <div class="col-md-2 col-sm-4">
                                    <label class="form-label fw-semibold fs-13 text-dark">Post Code</label>
                                    <input type="text" class="form-control" id="loginPostCodeInput" placeholder="1010">
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
                                    <select class="form-select" id="loginAdviserInput">
                                        <option value="Sushant Yadav">Sushant Yadav</option>
                                        <option value="Royson Pinto">Royson Pinto</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Not Counting</label>
                                    <select class="form-select" id="loginNotCountingSelect">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Compliance by</label>
                                    <input type="text" class="form-control" id="loginComplianceByInput" placeholder="Officer Name">
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">RoA Due on</label>
                                    <input type="date" class="form-control" id="loginRoaDueDateInput">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Status - Sent to Compliance</label>
                                    <select class="form-select" id="loginStatusComplianceSelect">
                                        <option value="Sent to Compliance">Sent to Compliance</option>
                                        <option value="In Review">In Review</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label fw-semibold fs-13 text-dark">Sent to Client</label>
                                    <select class="form-select" id="loginSentToClientSelect">
                                        <option value="Pending">Pending</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label class="form-label fw-semibold fs-13 text-dark">Outcome / Pending Requirements</label>
                                    <input type="text" class="form-control" id="loginOutcomeInput" placeholder="e.g. Pending Medical Test">
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

    <!-- Modal: Import Leads -->
    <div class="modal fade" id="importLeadsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-upload me-2"></i> Import Leads Batch</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="importLeadsForm" onsubmit="event.preventDefault(); handleBatchImportLeads();">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Select Lead CSV Format *</label>
                            <select class="form-select fw-semibold text-dark" id="importFormatSelect" required>
                                <option value="Meta Leads CSV">Meta / Facebook Leads CSV Format</option>
                                <option value="Door to Door Leads CSV">Door to Door Field Campaign CSV</option>
                                <option value="Google Ads CSV">Google Ads Inbound CSV Format</option>
                                <option value="Custom Partner CSV">Custom Partner Brokerage CSV</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Upload File *</label>
                            <input type="file" class="form-control" id="importFileInput" accept=".csv, .xlsx" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm fw-bold"><i class="feather-check me-1"></i> Start Lead Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js?v=9.0') }}"></script>
    <script src="{{ asset('assets/js/pages/crm-leads-pipeline.js?v=1.6') }}"></script>
@endpush

@endsection