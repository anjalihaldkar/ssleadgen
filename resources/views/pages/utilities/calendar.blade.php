@extends('layouts.app')
@section('title', 'Calendar & Consultations')
@section('content')
<!-- CALENDAR HEADER & TOGGLES -->
            <div class="card-widget p-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="fw-bold text-dark mb-0 fs-16" id="calendarMonthTitle">August 2026</h5>
                        <div class="btn-group btn-group-sm ms-2">
                            <button class="btn btn-light" onclick="navigateMonth(-1)"><i class="feather-chevron-left"></i></button>
                            <button class="btn btn-light" onclick="navigateMonth(0)">Today</button>
                            <button class="btn btn-light" onclick="navigateMonth(1)"><i class="feather-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="btn-group btn-group-sm" id="calendarViewToggle">
                            <button class="btn btn-primary" onclick="switchCalendarView('month', this)">Month</button>
                            <button class="btn btn-outline-primary" onclick="switchCalendarView('week', this)">Week (7 Days)</button>
                            <button class="btn btn-outline-primary" onclick="switchCalendarView('day', this)">Day</button>
                        </div>
                        <button class="btn btn-primary btn-sm px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#scheduleEventModal"><i class="feather-plus me-1"></i> Schedule Appointment</button>
                    </div>
                </div>
            </div>

            <!-- EXPANDED FULL-WIDTH CALENDAR GRID & AGENDA SIDEBAR -->
            <div class="row g-4">
                <div class="col-xl-9 col-lg-8 col-md-12">
                    <div class="card-widget p-3">

                        <!-- 1. MONTH VIEW GRID -->
                        <div id="monthViewContainer" class="table-responsive">
                            <table class="table table-bordered align-middle mb-0 calendar-table w-100">
                                <thead>
                                    <tr>
                                        <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="calendar-cell other-month fw-bold">26</td>
                                        <td class="calendar-cell other-month fw-bold">27</td>
                                        <td class="calendar-cell other-month fw-bold">28</td>
                                        <td class="calendar-cell other-month fw-bold">29</td>
                                        <td class="calendar-cell other-month fw-bold">30</td>
                                        <td class="calendar-cell other-month fw-bold">31</td>
                                        <td class="calendar-cell fw-bold">1</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-cell fw-bold">2</td>
                                        <td class="calendar-cell fw-bold">3</td>
                                        <td class="calendar-cell fw-bold">4</td>
                                        <td class="calendar-cell fw-bold">5</td>
                                        <td class="calendar-cell fw-bold">6</td>
                                        <td class="calendar-cell fw-bold">7</td>
                                        <td class="calendar-cell fw-bold">8</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-cell fw-bold">9</td>
                                        <td class="calendar-cell fw-bold">10</td>
                                        <td class="calendar-cell fw-bold">11</td>
                                        <td class="calendar-cell fw-bold">12</td>
                                        <td class="calendar-cell fw-bold">13</td>
                                        <td class="calendar-cell fw-bold">14</td>
                                        <td class="calendar-cell fw-bold">15</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-cell fw-bold">16</td>
                                        <td class="calendar-cell fw-bold">17</td>
                                        <td class="calendar-cell today fw-bold">
                                            18
                                            <div class="event-badge event-blue" onclick="openCalendarEventDetail('Team Strategy Sync', '09:00 AM - 10:00 AM', 'Internal Team', 'Boardroom', 'Confirmed', 'Weekly sales pipeline sync.')">09:00 Team Strategy</div>
                                            <div class="event-badge event-green" onclick="openCalendarEventDetail('Annual Life Review', '10:30 AM - 11:30 AM', 'Kishore Kumar', 'Zoom Video Call', 'Confirmed', 'Reviewing life cover sum assured.')">10:30 Life Review (Kishore)</div>
                                            <div class="event-badge event-yellow" onclick="openCalendarEventDetail('Trauma Signing', '02:00 PM - 03:00 PM', 'Rahul Sharma', 'Office Auckland', 'Confirmed', 'Final document signing.')">14:00 Trauma Signing (Rahul)</div>
                                        </td>
                                        <td class="calendar-cell fw-bold">
                                            19
                                            <div class="event-badge event-purple" onclick="openCalendarEventDetail('Policy Renewal Review', '11:00 AM - 12:00 PM', 'Vandana Singh', 'Phone Call', 'Scheduled', 'Send renewal documents.')">11:00 Policy Renewal</div>
                                        </td>
                                        <td class="calendar-cell fw-bold">
                                            20
                                            <div class="event-badge event-blue" onclick="openCalendarEventDetail('Health Cover Consult', '03:00 PM - 04:00 PM', 'Ravi Mehta', 'Zoom Call', 'Confirmed', 'Family health plan quote.')">15:00 Health Consult</div>
                                        </td>
                                        <td class="calendar-cell fw-bold">
                                            21
                                            <div class="event-badge event-green" onclick="openCalendarEventDetail('Claims Assessment Sync', '10:00 AM - 11:00 AM', 'Neha Gupta', 'Teams Call', 'Confirmed', 'Review underwriter notes.')">10:00 Claims Sync</div>
                                        </td>
                                        <td class="calendar-cell fw-bold">22</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-cell fw-bold">23</td>
                                        <td class="calendar-cell fw-bold">24</td>
                                        <td class="calendar-cell fw-bold">25</td>
                                        <td class="calendar-cell fw-bold">26</td>
                                        <td class="calendar-cell fw-bold">27</td>
                                        <td class="calendar-cell fw-bold">28</td>
                                        <td class="calendar-cell fw-bold">29</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- 2. WEEK VIEW MATRIX (7 FULL DAYS) -->
                        <div id="weekViewContainer" class="table-responsive d-none">
                            <table class="table table-bordered align-middle fs-13 mb-0 w-100">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th style="width: 85px;">Time</th>
                                        <th>Mon 17 Aug</th>
                                        <th>Tue 18 Aug</th>
                                        <th>Wed 19 Aug</th>
                                        <th>Thu 20 Aug</th>
                                        <th>Fri 21 Aug</th>
                                        <th>Sat 22 Aug</th>
                                        <th>Sun 23 Aug</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 65px;">
                                        <td class="fw-bold text-muted text-center">09:00 AM</td>
                                        <td></td>
                                        <td class="bg-soft-primary cursor-pointer" onclick="openCalendarEventDetail('Team Briefing', '09:00 AM - 10:00 AM', 'Internal Team', 'SS Advisory Boardroom', 'Confirmed', 'Weekly sales strategy and lead assignment review.')">
                                            <span class="badge bg-primary p-2 w-100 text-start shadow-sm"><i class="feather-users me-1"></i> Team Briefing</span>
                                        </td>
                                        <td></td>
                                        <td class="bg-soft-info cursor-pointer" onclick="openCalendarEventDetail('Policy Underwriting Sync', '09:00 AM - 09:45 AM', 'AIA Underwriter', 'Microsoft Teams', 'Confirmed', 'Review pending medical assessments.')">
                                            <span class="badge bg-info p-2 w-100 text-start shadow-sm"><i class="feather-file-text me-1"></i> Underwriting Sync</span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="height: 65px;">
                                        <td class="fw-bold text-muted text-center">10:30 AM</td>
                                        <td></td>
                                        <td class="bg-soft-success cursor-pointer" onclick="openCalendarEventDetail('Annual Life Policy Review', '10:30 AM - 11:30 AM', 'Kishore Kumar', 'Zoom Video Call', 'Confirmed', 'Reviewing life cover sum assured and adding trauma rider.')">
                                            <span class="badge bg-success p-2 w-100 text-start shadow-sm"><i class="feather-video me-1"></i> Life Review (Kishore)</span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td class="bg-soft-primary cursor-pointer" onclick="openCalendarEventDetail('Client Onboarding Call', '10:30 AM - 11:15 AM', 'Rahul Sharma', 'Zoom Video Call', 'Confirmed', 'Initial financial consultation.')">
                                            <span class="badge bg-primary p-2 w-100 text-start shadow-sm"><i class="feather-user-check me-1"></i> Onboarding (Rahul)</span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="height: 65px;">
                                        <td class="fw-bold text-muted text-center">02:00 PM</td>
                                        <td></td>
                                        <td class="bg-soft-warning cursor-pointer" onclick="openCalendarEventDetail('Trauma Policy Signing', '02:00 PM - 03:00 PM', 'Rahul Sharma', 'In-Office Auckland', 'Confirmed', 'Final document signing for trauma insurance policy.')">
                                            <span class="badge bg-warning text-dark p-2 w-100 text-start shadow-sm"><i class="feather-map-pin me-1"></i> Trauma Signing (Rahul)</span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="bg-soft-purple cursor-pointer" onclick="openCalendarEventDetail('Weekend Lead Follow Up', '02:00 PM - 02:30 PM', 'Vandana Singh', 'Phone Call', 'Scheduled', 'Follow up regarding health insurance quote.')">
                                            <span class="badge bg-purple p-2 w-100 text-start shadow-sm"><i class="feather-phone me-1"></i> Follow Up (Vandana)</span>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- 3. DAY VIEW TIMELINE -->
                        <div id="dayViewContainer" class="d-none">
                            <div class="timeline-day-wrapper d-flex flex-column gap-3">
                                <div class="p-3 border rounded border-primary bg-soft-primary cursor-pointer" onclick="openCalendarEventDetail('Annual Life Policy Review', '10:30 AM - 11:30 AM', 'Kishore Kumar', 'Zoom Video Call', 'Confirmed', 'Reviewing life cover sum assured.')">
                                    <div class="fs-12 fw-bold text-primary">10:30 AM - 11:30 AM</div>
                                    <h6 class="fw-bold text-dark mb-1">Annual Life Policy Review</h6>
                                    <div class="text-muted fs-12">Client: Kishore Kumar | Location: Zoom Video Call</div>
                                </div>
                                <div class="p-3 border rounded border-success bg-soft-success cursor-pointer" onclick="openCalendarEventDetail('Trauma Policy Signing', '02:00 PM - 03:00 PM', 'Rahul Sharma', 'In-Office Auckland', 'Confirmed', 'Signing trauma cover papers.')">
                                    <div class="fs-12 fw-bold text-success">02:00 PM - 03:00 PM</div>
                                    <h6 class="fw-bold text-dark mb-1">Trauma Policy Signing</h6>
                                    <div class="text-muted fs-12">Client: Rahul Sharma | Location: In-Office Auckland</div>
                                </div>
                                <div class="p-3 border rounded border-warning bg-soft-warning cursor-pointer" onclick="openCalendarEventDetail('Follow-up Callback', '04:15 PM - 04:45 PM', 'Priya Patel', 'Phone Call', 'Pending', 'Call regarding AIA quote illustration.')">
                                    <div class="fs-12 fw-bold text-warning">04:15 PM - 04:45 PM</div>
                                    <h6 class="fw-bold text-dark mb-1">Follow-up Callback</h6>
                                    <div class="text-muted fs-12">Client: Priya Patel | Phone Consultation</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="card-widget p-4">
                        <h6 class="widget-title mb-3">Today's Agenda & Appointments</h6>
                        <div class="d-flex flex-column gap-3" id="agendaListContainer">
                            <div class="p-3 bg-soft-primary rounded border border-primary-subtle cursor-pointer" onclick="openCalendarEventDetail('Annual Life Policy Review', '10:30 AM - 11:30 AM', 'Kishore Kumar', 'Zoom Video Call', 'Confirmed', 'Reviewing life cover sum assured.')">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="badge bg-primary fs-11">10:30 AM</span>
                                    <span class="text-muted fs-11"><i class="feather-video me-1"></i> Zoom Call</span>
                                </div>
                                <div class="fw-bold text-dark fs-13">Annual Life Policy Review</div>
                                <div class="text-muted fs-12 mt-1">Client: Kishore Kumar</div>
                            </div>

                            <div class="p-3 bg-soft-success rounded border border-success-subtle cursor-pointer" onclick="openCalendarEventDetail('Trauma Policy Signing', '02:00 PM - 03:00 PM', 'Rahul Sharma', 'In-Office Auckland', 'Confirmed', 'Final document signing.')">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="badge bg-success fs-11">02:00 PM</span>
                                    <span class="text-muted fs-11"><i class="feather-map-pin me-1"></i> In-Office</span>
                                </div>
                                <div class="fw-bold text-dark fs-13">Trauma Policy Signing</div>
                                <div class="text-muted fs-12 mt-1">Client: Rahul Sharma</div>
                            </div>

                            <div class="p-3 bg-soft-warning rounded border border-warning-subtle cursor-pointer" onclick="openCalendarEventDetail('Follow-up Callback', '04:15 PM - 04:45 PM', 'Priya Patel', 'Phone Call', 'Pending', 'Call regarding AIA quote.')">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="badge bg-warning text-dark fs-11">04:15 PM</span>
                                    <span class="text-muted fs-11"><i class="feather-phone me-1"></i> Phone Call</span>
                                </div>
                                <div class="fw-bold text-dark fs-13">Follow-up Callback</div>
                                <div class="text-muted fs-12 mt-1">Client: Priya Patel</div>
                            </div>
                        </div>
                    </div>
                </div>
            

<!-- Modal: Interactive Event Detail View -->
    <div class="modal fade" id="calendarEventDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0" id="eventDetailModalTitle"><i class="feather-calendar me-2"></i> Appointment Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                        <div>
                            <span class="badge bg-soft-primary text-primary fw-bold fs-11" id="eventDetailStatus">Confirmed Appointment</span>
                            <h5 class="fw-bold text-dark mt-1 mb-0" id="eventDetailHeaderTitle">Life Insurance Consult</h5>
                        </div>
                        <div class="avatar-text avatar-lg bg-soft-primary text-primary rounded-circle" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;"><i class="feather-clock fs-4"></i></div>
                    </div>
                    <div class="row g-3 fs-13">
                        <div class="col-6">
                            <span class="text-muted d-block fs-11 fw-semibold text-uppercase">Time & Duration</span>
                            <strong class="text-dark" id="eventDetailTime">10:30 AM - 11:30 AM</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block fs-11 fw-semibold text-uppercase">Client Name</span>
                            <strong class="text-dark" id="eventDetailClient">Kishore Kumar</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block fs-11 fw-semibold text-uppercase">Location / Meeting Link</span>
                            <strong class="text-primary" id="eventDetailLocation">Zoom Video Call</strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block fs-11 fw-semibold text-uppercase">Assigned Advisor</span>
                            <strong class="text-dark">Sushant Yadav</strong>
                        </div>
                        <div class="col-12 mt-2">
                            <span class="text-muted d-block fs-11 fw-semibold text-uppercase mb-1">Appointment Notes</span>
                            <div class="p-3 bg-light rounded border text-dark fs-13 mb-2" id="eventDetailNotes" style="max-height: 140px; overflow-y: auto; white-space: pre-line;">
                                Annual policy review for life & disability cover. Discussing trauma rider options.
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <textarea id="eventDetailNewNoteInput" class="form-control fs-12" rows="2" placeholder="Type appointment note..."></textarea>
                                <button type="button" class="btn btn-primary btn-sm px-3 fw-bold align-self-start" onclick="handleSaveDetailNote()"><i class="feather-plus me-1"></i> Add Note</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm fw-bold" onclick="alert('Meeting reminder sent to client via SMS & Email!'); $('#calendarEventDetailModal').modal('hide');"><i class="feather-send me-1"></i> Send Reminder</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Schedule Appointment -->
    <div class="modal fade" id="scheduleEventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background-color: var(--color-navy-dark);">
                    <h5 class="modal-title text-white mb-0"><i class="feather-calendar me-2"></i> Schedule Appointment</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="scheduleEventForm" onsubmit="event.preventDefault(); handleAddNewAppointment();">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Meeting Title *</label>
                            <input type="text" class="form-control" id="eventTitleInput" placeholder="e.g. Life Cover Consult" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Client Name *</label>
                            <select class="form-select" id="eventClientInput" required>
                                <option value="" disabled selected>Select Client</option>
                                <option value="Kishore Kumar">Kishore Kumar (Inforce)</option>
                                <option value="Rahul Sharma">Rahul Sharma (Inforce)</option>
                                <option value="Vandana Singh">Vandana Singh (Inforce)</option>
                                <option value="Ravi Mehta">Ravi Mehta (Login Client)</option>
                                <option value="Neha Gupta">Neha Gupta (Claim Update)</option>
                                <option value="Priya Patel">Priya Patel (Login Client)</option>
                                <option value="Michael Chang">Michael Chang (New Lead)</option>
                                <option value="Evelyn Te Kuru">Evelyn Te Kuru (New Lead)</option>
                                <option value="Joshua Taylor">Joshua Taylor (Contacted)</option>
                                <option value="Abigail Grey">Abigail Grey (Underwriting)</option>
                                <option value="Ryan Green">Ryan Green (Policy Issued)</option>
                                <option value="Internal Team">Internal Team (Meeting)</option>
                            </select>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Date</label>
                                <input type="date" class="form-control" id="eventDateInput" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold fs-13 text-dark">Time</label>
                                <input type="time" class="form-control" id="eventTimeInput" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Location / Link</label>
                            <input type="text" class="form-control" id="eventLocationInput" placeholder="Zoom Link or Office Location">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold fs-13 text-dark">Appointment Notes / Agenda</label>
                            <textarea class="form-control" id="eventNotesInput" rows="3" placeholder="Add meeting agenda, discussion points, or policy notes..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold">Schedule Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

    
        </div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/pages/calendar.js') }}"></script>
@endpush

@endsection