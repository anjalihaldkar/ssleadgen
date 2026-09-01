@extends('layouts.app')
@section('title', 'Lead & Sales Reports')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Lead Conversion & Performance Reports</h4>
                    <p class="text-muted fs-13 mb-0">Export performance metrics by advisor, channel, and quote
                        conversion rates.</p>
                </div>
                <button class="btn btn-outline-primary btn-sm px-3 fw-bold"
                    onclick="alert('Exporting Report PDF...')"><i class="feather-download me-1"></i> Export PDF
                    Report</button>
            </div>

            <!-- Report Filters Card -->
            <div class="dash-filter-card">
                <div class="row g-3 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label fs-12 fw-semibold text-muted mb-1">Date Range</label>
                        <div class="dash-filter-input-group">
                            <i class="feather-calendar"></i>
                            <input type="text" class="form-control dash-filter-input fs-13" id="reportDateRange"
                                placeholder="01 Jan 2026 – 18 Aug 2026" value="01 Jan 2026 - 18 Aug 2026" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fs-12 fw-semibold text-muted mb-1">Lead Source</label>
                        <select class="form-select fs-13" id="reportSourceSelect">
                            <option value="">All Sources</option>
                            <option value="Web Form">Web Form</option>
                            <option value="Referral">Referral</option>
                            <option value="LinkedIn Ads">LinkedIn Ads</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fs-12 fw-semibold text-muted mb-1">Assigned Advisor</label>
                        <select class="form-select fs-13" id="reportAdvisorSelect">
                            <option value="">All Advisors</option>
                            <option value="Sushant Yadav">Sushant Yadav</option>
                            <option value="Priya Patel">Priya Patel</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end" style="height: 62px;">
                        <button class="btn btn-primary w-100 fw-bold" id="btnApplyReportFilter"><i
                                class="feather-filter me-1"></i> Apply Filters</button>
                    </div>
                </div>
            </div>

            <!-- Report Charts Row -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card-widget p-4">
                        <h6 class="widget-title mb-3">Leads Captured by Source</h6>
                        <div id="reportSourceBarChart" style="min-height: 260px;"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-widget p-4">
                        <h6 class="widget-title mb-3">Advisor Conversion Funnel</h6>
                        <div id="reportFunnelAreaChart" style="min-height: 260px;"></div>
                    </div>
                </div>
            </div>

            <!-- Report DataTables -->
            <div class="card-widget">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="widget-title mb-0">Advisor Performance Breakdown</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100" id="repPerformanceTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Advisor Name</th>
                                <th>Inforce Clients</th>
                                <th>Claim Update</th>
                                <th>Conversion Rate</th>
                                <th>Annual Premium Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Sushant Yadav</td>
                                <td class="fs-13">142</td>
                                <td class="fs-13">110</td>
                                <td class="fs-13 fw-bold text-success">55.1%</td>
                                <td class="fs-13 fw-bold text-success">$1,420,000</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark fs-13">Priya Patel</td>
                                <td class="fs-13">98</td>
                                <td class="fs-13">75</td>
                                <td class="fs-13 fw-bold text-success">55.1%</td>
                                <td class="fs-13 fw-bold text-success">$890,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            

</div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    <script src="{{ asset('assets/js/pages/reports-leads.js') }}"></script>
@endpush

@endsection