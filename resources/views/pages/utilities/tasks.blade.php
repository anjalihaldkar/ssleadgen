@extends('layouts.app')
@section('title', 'Tasks & Follow ups')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Tasks & Advisory Follow-ups</h4>
                    <p class="text-muted fs-13 mb-0">Organize client call-backs, renewal check-ins, and claim
                        verifications.</p>
                </div>
                <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal"
                    data-bs-target="#addTaskModal"><i class="feather-plus me-1"></i> Add Task</button>
            </div>

            <!-- Task Category Tabs -->
            <ul class="nav nav-tabs task-filter-tabs mb-2" id="taskFilterTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active fw-semibold" onclick="filterTaskTable('all')">All Tasks</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-semibold" onclick="filterTaskTable('Pending')">Pending</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link fw-semibold text-danger" onclick="filterTaskTable('High')">High
                        Priority</button>
                </li>

            </ul>

            <!-- Task Table Card -->
            <div class="card-widget">
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100" id="tasksTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Task Description</th>
                                <th>Client Name</th>
                                <th>Due Date</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark fs-13"><i class="feather-phone-call text-primary me-2"></i>
                                    Annual Review Call</td>
                                <td class="fs-13 text-muted">Kishore Kumar</td>
                                <td class="fs-13 text-muted">18 Aug 2026</td>
                                <td><span class="badge bg-soft-danger text-danger fs-11">High</span></td>
                                <td><span class="badge bg-soft-warning text-warning fs-11"
                                        id="task-status-1">Pending</span></td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center"> <button
                                            class="btn btn-sm btn-light text-primary py-1 px-2"
                                            onclick="openTaskNotesModal('Annual Review Call', 'Kishore Kumar')"
                                            title="Task Notes"><i class="feather-file-text"></i></button></div>
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13"><i class="feather-mail text-info me-2"></i> Send
                                    Policy Renewal Document</td>
                                <td class="fs-13 text-muted">Vandana Singh</td>
                                <td class="fs-13 text-muted">19 Aug 2026</td>
                                <td><span class="badge bg-soft-primary text-primary fs-11">Medium</span></td>
                                <td><span class="badge bg-soft-warning text-warning fs-11"
                                        id="task-status-2">Pending</span></td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center"> <button
                                            class="btn btn-sm btn-light text-primary py-1 px-2"
                                            onclick="openTaskNotesModal('Send Policy Renewal Document', 'Vandana Singh')"
                                            title="Task Notes"><i class="feather-file-text"></i></button></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            

</div>
    </div>

    <!-- Modal: Add New Task -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-check-square me-2"></i> Add New Task</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="newTaskForm" onsubmit="event.preventDefault(); handleAddNewTask();">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Task Title *</label>
                            <input type="text" class="form-control" id="taskTitleInput"
                                placeholder="e.g. Schedule Income Protection Review" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Associated Client</label>
                            <input type="text" class="form-control" id="taskClientInput" placeholder="Client Name">
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Due Date</label>
                                <input type="date" class="form-control" id="taskDateInput" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Priority</label>
                                <select class="form-select" id="taskPriorityInput">
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Task Notes -->
    <div class="modal fade" id="taskNotesModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-file-text me-2"></i> Notes for Task: <span
                            id="taskNotesTitleHeader"></span></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3 bg-light p-3 rounded fs-13">
                        <strong>Associated Client:</strong> <span id="taskNotesClientSpan" class="text-muted"></span>
                    </div>
                    <div class="card-widget p-3 mb-3">
                        <h6 class="fw-bold text-dark mb-2"><i class="feather-message-square me-1 text-primary"></i>
                            Notes History</h6>
                        <div id="taskNotesListContainer" class="d-flex flex-column gap-1"
                            style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                            <!-- Notes will be loaded here dynamically -->
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2 mt-2 pt-2 border-top">
                        <textarea id="newTaskNoteInput" class="form-control fs-12" placeholder="Write a task note..."
                            rows="2"></textarea>
                        <button class="btn btn-primary btn-sm align-self-end fw-bold px-3 py-1.5" id="addTaskNoteBtn"
                            type="button"><i class="feather-plus me-1"></i> Add Note</button>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-light btn-sm px-4" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    <script src="{{ asset('assets/js/pages/tasks.js?v=1.1') }}"></script>
@endpush

@endsection