@extends('layouts.app')
@section('title', 'Create New Lead')
@section('content')
<div class="card-widget p-4">
                <form onsubmit="event.preventDefault(); window.location.href='crm-leads-pipeline.html';">
                    <h5 class="fw-bold text-dark mb-3">Prospect Lead Details</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-13 text-dark">First Name *</label>
                            <input type="text" class="form-control" required placeholder="e.g. Jason">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-13 text-dark">Last Name *</label>
                            <input type="text" class="form-control" required placeholder="e.g. Taylor">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-13 text-dark">Email Address *</label>
                            <input type="email" class="form-control" required placeholder="jason@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-13 text-dark">Phone Number *</label>
                            <input type="text" class="form-control" required placeholder="021 555 9988">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-13 text-dark">Acquisition Source</label>
                            <select class="form-select">
                                <option>Meta Leads</option>
                                <option>Door to Door</option>
                                <option>Google Ads</option>
                                <option>Referral</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-13 text-dark">Estimated Cover ($)</label>
                            <input type="number" class="form-control" placeholder="500000">
                        </div>
                        <div class="col-12 text-end mt-4">
                            <a href="crm-leads-pipeline.html" class="btn btn-light me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4">Create Lead</button>
                        </div>
                    </div>
                </form>
            



@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crm-leads-create.js') }}"></script>
@endpush

@endsection