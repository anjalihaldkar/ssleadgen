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
                    <div class="card-widget p-3 bg-light border min-vh-50" ondragover="handleKanbanDragOver(event)" ondrop="handleKanbanDrop(event, this)">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-bold text-dark mb-0"><i class="feather-circle text-{{ $stage['color'] }} me-2"></i> {{ $stage['label'] }} <span class="kanban-count text-{{ $stage['color'] }}">({{ isset($leadsByStatus[$status]) ? count($leadsByStatus[$status]) : 0 }})</span></h6>
                        </div>
                        <div class="kanban-card-dropzone d-flex flex-column gap-2" style="min-height: 250px;">
                            @if(isset($leadsByStatus[$status]))
                                @foreach($leadsByStatus[$status] as $lead)
                                <div class="lead-kanban-card p-3 bg-white rounded shadow-sm border-start border-4 border-{{ $stage['color'] }}" draggable="true" ondragstart="handleKanbanDragStart(event, this)" ondragend="handleKanbanDragEnd(this)" style="cursor: grab;" onclick="openLeadDetailModal('{{ addslashes($lead->first_name) }} {{ addslashes($lead->last_name) }}', '{{ addslashes($lead->phone) }}', '{{ addslashes($lead->email) }}', '{{ addslashes($lead->leadSource->name ?? 'Unknown') }}', '${{ $lead->estimated_cover }}/yr', '{{ $stage['label'] }}', 'Sushant Yadav', '{{ addslashes($lead->notes) }}')">
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
                                            @if($lead->status !== 'won')
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
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white rounded-top">
                            <h5 class="modal-title fw-bold" id="leadDetailModalTitle">
                                <i class="feather-user me-2"></i> Prospect Lead Overview
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4" id="leadDetailModalBody" style="max-height: 75vh; overflow-y: auto;">
                            {{-- Content is injected by openLeadDetailModal() JS function --}}
                        </div>
                    </div>
                </div>
            </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js?v=9.0') }}"></script>
    <script src="{{ asset('assets/js/pages/crm-leads-pipeline.js?v=1.6') }}"></script>
@endpush

@endsection