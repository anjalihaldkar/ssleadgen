/* Page script for claims */
let claimsDataTable = null;

function viewClaimDetails(clientName, company, claimType, processedDate, updateStatus, approvedDate, outcome, admin) {
    $('#viewClaimClientHeader').text(clientName);
    $('#viewClaimClientName').val(clientName);
    $('#viewClaimCompany').val(company);
    $('#viewClaimType').val(claimType);
    $('#viewClaimProcessedDate').val(processedDate);
    $('#viewClaimUpdate').val(updateStatus);
    $('#viewClaimApprovedDate').val(approvedDate);
    $('#viewClaimOutcome').val(outcome);
    $('#viewClaimAdmin').val(admin);

    const modalEl = document.getElementById('viewClaimModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function editClaimDetails(clientName, company, claimType, processedDate, updateStatus, approvedDate, outcome, admin) {
    $('#claimModalTitle').text('Edit Claim Record');
    $('#claimClientSelect').val(clientName);
    $('#claimCompanySelect').val(company);
    $('#claimTypeInput').val(claimType);
    
    // Format date string for date inputs if needed
    $('#claimProcessedDateInput').val(processedDate.includes('/') ? processedDate.split('/').reverse().join('-') : '');
    $('#claimUpdateSelect').val(updateStatus);
    $('#claimApprovedDateInput').val(approvedDate.includes('/') ? approvedDate.split('/').reverse().join('-') : '');
    $('#claimOutcomeInput').val(outcome);
    $('#claimAdminSelect').val(admin);

    const modalEl = document.getElementById('lodgeClaimModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function handleAddNewClaim() {
    const client = $('#claimClientSelect').val() || 'Kishore Kumar';
    const company = $('#claimCompanySelect').val() || 'AIA New Zealand';
    const claimType = $('#claimTypeInput').val().trim() || 'Medical Claim';
    const rawProcessedDate = $('#claimProcessedDateInput').val();
    const processedDate = rawProcessedDate ? rawProcessedDate.split('-').reverse().join('/') : '20/08/2026';
    const updateStatus = $('#claimUpdateSelect').val() || 'Under Assessment';
    const rawApprovedDate = $('#claimApprovedDateInput').val();
    const approvedDate = rawApprovedDate ? rawApprovedDate.split('-').reverse().join('/') : 'Pending';
    const outcome = $('#claimOutcomeInput').val().trim() || 'Claim Under Assessment';
    const admin = $('#claimAdminSelect').val() || 'Sushant Yadav';

    if (!client) {
        alert('Please select a Client Name.');
        return;
    }

    let badgeClass = 'bg-soft-warning text-warning';
    if (updateStatus === 'Approved') badgeClass = 'bg-soft-success text-success';
    if (updateStatus === 'Medical Review') badgeClass = 'bg-soft-info text-info';
    if (updateStatus === 'Document Verification') badgeClass = 'bg-soft-primary text-primary';
    const updateBadge = `<span class="badge ${badgeClass} fs-11">${updateStatus}</span>`;

    const actionParams = `'${client}', '${company}', '${claimType}', '${processedDate}', '${updateStatus}', '${approvedDate}', '${outcome}', '${admin}'`;

    if (claimsDataTable) {
        claimsDataTable.row.add([
            `<span class="fw-bold text-dark fs-13">${client}</span>`,
            `<span class="fs-13 fw-semibold text-dark">${company}</span>`,
            `<span class="fs-13 text-muted">${claimType}</span>`,
            `<span class="fs-13 text-muted">${processedDate}</span>`,
            updateBadge,
            `<span class="fs-13 text-muted">${approvedDate}</span>`,
            `<span class="fs-13 text-muted">${outcome}</span>`,
            `<span class="fs-13 text-muted">${admin}</span>`,
            `<div class="text-center">
                <div class="action-kebab-wrapper">
                    <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                    <div class="action-kebab-dropdown">
                        <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClaimDetails(${actionParams})"><i class="feather-eye text-primary me-1"></i> View Details</a>
                        <a href="javascript:void(0);" class="action-kebab-item" onclick="editClaimDetails(${actionParams})"><i class="feather-edit text-info me-1"></i> Edit Claim</a>
                    </div>
                </div>
            </div>`
        ]).draw(false);
    }

    $('#lodgeClaimForm')[0].reset();
    const modalEl = document.getElementById('lodgeClaimModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#claimsTable')) {
        claimsDataTable = $('#claimsTable').DataTable({
            retrieve: true,
            responsive: true,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search claims..."
            }
        });
    }
});
