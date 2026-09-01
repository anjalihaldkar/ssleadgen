/* Page script for clients-cancellation */
let cancellationDataTable = null;

function viewCancellationDetails(clientName, company, dateSent, completedDate, outcome, admin, comments) {
    $('#viewCancClientHeader').text(clientName);
    $('#viewCancClientName').val(clientName);
    $('#viewCancCompany').val(company);
    $('#viewCancDateSent').val(dateSent);
    $('#viewCancCompletedDate').val(completedDate);
    $('#viewCancOutcome').val(outcome);
    $('#viewCancAdmin').val(admin);
    $('#viewCancComments').val(comments);

    const modalEl = document.getElementById('viewCancellationModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function editCancellationDetails(clientName, company, dateSent, completedDate, outcome, admin, comments) {
    $('#cancModalTitle').text('Edit Cancellation Record');
    $('#cancClientSelect').val(clientName);
    $('#cancCompanySelect').val(company);
    $('#cancDateSentInput').val(dateSent.includes('/') ? dateSent.split('/').reverse().join('-') : '');
    $('#cancCompletedInput').val(completedDate);
    $('#cancOutcomeInput').val(outcome);
    $('#cancAdminSelect').val(admin);
    $('#cancCommentsInput').val(comments);

    const modalEl = document.getElementById('addCancellationModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function handleAddNewCancellation() {
    const client = $('#cancClientSelect').val() || 'Vandana Singh';
    const company = $('#cancCompanySelect').val() || 'AIA Life';
    const rawDateSent = $('#cancDateSentInput').val();
    const dateSent = rawDateSent ? rawDateSent.split('-').reverse().join('/') : '15/08/2026';
    const completedDate = $('#cancCompletedInput').val().trim() || 'Pending';
    const outcome = $('#cancOutcomeInput').val().trim() || 'Cancellation In Progress';
    const admin = $('#cancAdminSelect').val() || 'Sushant Yadav';
    const comments = $('#cancCommentsInput').val().trim() || 'Client submitted cancellation request.';

    if (!client) {
        alert('Please select a Client Name.');
        return;
    }

    let completedBadgeClass = 'bg-soft-warning text-warning';
    if (completedDate.includes('/') || completedDate === 'Completed') completedBadgeClass = 'bg-soft-success text-success';
    const completedBadge = `<span class="badge ${completedBadgeClass} fs-11">${completedDate}</span>`;

    const actionParams = `'${client}', '${company}', '${dateSent}', '${completedDate}', '${outcome}', '${admin}', '${comments}'`;

    if (cancellationDataTable) {
        cancellationDataTable.row.add([
            `<span class="fw-bold text-dark fs-13">${client}</span>`,
            `<span class="fs-13 fw-semibold text-dark">${company}</span>`,
            `<span class="fs-13 text-muted">${dateSent}</span>`,
            completedBadge,
            `<span class="fs-13 text-muted">${outcome}</span>`,
            `<span class="fs-13 text-muted">${admin}</span>`,
            `<span class="fs-13 text-muted">${comments}</span>`,
            `<div class="text-center">
                <div class="action-kebab-wrapper">
                    <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                    <div class="action-kebab-dropdown">
                        <a href="javascript:void(0);" class="action-kebab-item" onclick="viewCancellationDetails(${actionParams})"><i class="feather-eye text-primary me-1"></i> View Details</a>
                        <a href="javascript:void(0);" class="action-kebab-item" onclick="editCancellationDetails(${actionParams})"><i class="feather-edit text-info me-1"></i> Edit Record</a>
                    </div>
                </div>
            </div>`
        ]).draw(false);
    }

    $('#addCancellationForm')[0].reset();
    const modalEl = document.getElementById('addCancellationModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#cancellationTable')) {
        cancellationDataTable = $('#cancellationTable').DataTable({
            retrieve: true,
            responsive: true,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search cancellations..."
            }
        });
    }
});
