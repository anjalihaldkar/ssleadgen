@extends('layouts.app')
@section('title', 'Document Vault')
@section('content')
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Document Vault & Secure Sharing</h4>
                    <p class="text-muted fs-13 mb-0">Drag and drop client disclosure statements, policy schedules, or medical records to generate shareable links.</p>
                </div>
            </div>

            <!-- Drag & Drop Upload Zone -->
            <div class="card-widget p-4 text-center border-dashed border-2 border-primary" style="background: rgba(0, 168, 181, 0.03); border-style: dashed !important; border-radius: 12px;" id="dropZoneContainer">
                <div class="mb-3">
                    <div class="avatar-text avatar-lg bg-soft-primary text-primary rounded-circle mx-auto fs-3" style="width: 60px; height: 60px; display: inline-flex; align-items: center; justify-content: center;"><i class="feather-upload-cloud"></i></div>
                </div>
                <h5 class="fw-bold text-dark mb-1">Drag and Drop Files Here to Upload</h5>
                <p class="text-muted fs-13 mb-3">Or click below to browse policy PDFs, medical reports, or disclosure forms.</p>
                <input type="file" id="documentFileInput" class="d-none" multiple onchange="handleFileUpload(this.files)">
                <button class="btn btn-primary px-4 fw-bold" onclick="document.getElementById('documentFileInput').click()"><i class="feather-file-plus me-1"></i> Browse Files</button>
            </div>

            <!-- Document Directory Table -->
            <div class="card-widget">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="widget-title mb-0">Stored Advisory Documents</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle w-100" id="documentsTable">
                        <thead>
                            <tr class="fs-12 text-muted text-uppercase fw-semibold" style="background: #F8FAFC;">
                                <th>Document Name</th>
                                <th>Associated Client</th>
                                <th>File Size</th>
                                <th>Upload Date</th>
                                <th>Shared Link</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark fs-13"><i class="feather-file-text text-danger me-2"></i> Disclosure_Statement_Kumar.pdf</td>
                                <td class="fs-13 text-muted">Kishore Kumar</td>
                                <td class="fs-13 text-muted">1.4 MB</td>
                                <td class="fs-13 text-muted">15 Aug 2026</td>
                                <td>
                                    <button class="btn btn-sm btn-light text-primary fw-semibold py-1 px-2" onclick="copyShareLink('https://ssadvisory.co.nz/share/doc-8812')"><i class="feather-link me-1"></i> Copy Link</button>
                                </td>
                                <td class="text-center">
                                    <div class="action-kebab-wrapper">
                                        <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                                        <div class="action-kebab-dropdown">
                                            <a href="javascript:void(0);" class="action-kebab-item" onclick="alert('Downloading Document...')"><i class="feather-download text-primary me-2"></i> Download</a>
                                            <a href="javascript:void(0);" class="action-kebab-item text-danger" onclick="$(this).closest('tr').remove()"><i class="feather-trash-2 text-danger me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            

</div>
    </div>

@push('scripts')
    <script src="{{ asset('assets/js/dashboard-redesign.js?v=7.0') }}"></script>
    <script src="{{ asset('assets/js/pages/documents.js') }}"></script>
@endpush

@endsection