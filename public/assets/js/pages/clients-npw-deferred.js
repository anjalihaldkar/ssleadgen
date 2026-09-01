/* Page script for clients-npw-deferred */
let npwDeferredDataTable = null;

function viewNpwDetails(firstName, lastName, policyNo, company, dob, mobile, email, address, suburb, city, postCode, issueDate, premium, premiumMode, admin, notesComments, pending, comments) {
    $('#viewNpwClientHeader').text(firstName + ' ' + lastName);
    $('#viewNpwFirstName').val(firstName);
    $('#viewNpwLastName').val(lastName);
    $('#viewNpwPolicyNo').val(policyNo);
    $('#viewNpwCompany').val(company);
    $('#viewNpwDob').val(dob);
    $('#viewNpwMobile').val(mobile);
    $('#viewNpwEmail').val(email);
    $('#viewNpwAddress').val(address);
    $('#viewNpwSuburb').val(suburb);
    $('#viewNpwCity').val(city);
    $('#viewNpwPostCode').val(postCode);
    $('#viewNpwIssueDate').val(issueDate);
    $('#viewNpwPremium').val(premium);
    $('#viewNpwPremiumMode').val(premiumMode);
    $('#viewNpwAdmin').val(admin);
    $('#viewNpwNotesComments').val(notesComments);
    $('#viewNpwPending').val(pending);
    $('#viewNpwComments').val(comments);

    const modalEl = document.getElementById('viewNpwModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function editNpwDetails(firstName, lastName, policyNo, company, dob, mobile, email, address, suburb, city, postCode, issueDate, premium, premiumMode, admin, notesComments, pending, comments) {
    $('#npwModalTitle').text('Edit NPW Deferred Record');
    $('#npwFirstNameInput').val(firstName);
    $('#npwLastNameInput').val(lastName);
    $('#npwPolicyNoInput').val(policyNo);
    $('#npwCompanyInput').val(company);
    $('#npwDobInput').val(dob.includes('/') ? dob.split('/').reverse().join('-') : '');
    $('#npwMobileInput').val(mobile);
    $('#npwEmailInput').val(email);
    $('#npwAddressInput').val(address);
    $('#npwSuburbInput').val(suburb);
    $('#npwCityInput').val(city);
    $('#npwPostCodeInput').val(postCode);
    $('#npwIssueDateInput').val(issueDate.includes('/') ? issueDate.split('/').reverse().join('-') : '');
    $('#npwPremiumInput').val(premium.replace(/[^0-9.]/g, ''));
    $('#npwPremiumModeSelect').val(premiumMode);
    $('#npwAdminSelect').val(admin);
    $('#npwNotesCommentsInput').val(notesComments);
    $('#npwPendingSelect').val(pending);
    $('#npwCommentsInput').val(comments);

    const modalEl = document.getElementById('addNpwModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function handleAddNewNpw() {
    const firstName = $('#npwFirstNameInput').val().trim() || 'Amit';
    const lastName = $('#npwLastNameInput').val().trim() || 'Sharma';
    const policyNo = $('#npwPolicyNoInput').val().trim() || 'POL-9921';
    const company = $('#npwCompanyInput').val().trim() || 'AIA Life';
    const rawDob = $('#npwDobInput').val();
    const dob = rawDob ? rawDob.split('-').reverse().join('/') : '12/04/1987';
    const mobile = $('#npwMobileInput').val().trim() || '021 111 2222';
    const email = $('#npwEmailInput').val().trim() || 'amit.sharma@example.com';
    const address = $('#npwAddressInput').val().trim() || '12 Queen Street';
    const suburb = $('#npwSuburbInput').val().trim() || 'Auckland Central';
    const city = $('#npwCityInput').val().trim() || 'Auckland';
    const postCode = $('#npwPostCodeInput').val().trim() || '1010';
    const rawIssueDate = $('#npwIssueDateInput').val();
    const issueDate = rawIssueDate ? rawIssueDate.split('-').reverse().join('/') : '15/07/2026';
    const premiumVal = $('#npwPremiumInput').val().trim() || '150.00';
    const premium = premiumVal.startsWith('$') ? premiumVal : '$' + parseFloat(premiumVal).toFixed(2);
    const premiumMode = $('#npwPremiumModeSelect').val() || 'Monthly';
    const admin = $('#npwAdminSelect').val() || 'Sushant Yadav';
    const notesComments = $('#npwNotesCommentsInput').val().trim() || 'Deferred pending medical check.';
    const pending = $('#npwPendingSelect').val() || 'Yes';
    const comments = $('#npwCommentsInput').val().trim() || 'Follow up with insurer on Monday.';

    let pendingBadgeClass = 'bg-soft-warning text-warning';
    if (pending === 'No') pendingBadgeClass = 'bg-soft-success text-success';
    const pendingBadge = `<span class="badge ${pendingBadgeClass} fs-11">${pending}</span>`;

    const actionParams = `
        '${firstName.replace(/'/g, "\\'")}',
        '${lastName.replace(/'/g, "\\'")}',
        '${policyNo.replace(/'/g, "\\'")}',
        '${company.replace(/'/g, "\\'")}',
        '${dob}',
        '${mobile.replace(/'/g, "\\'")}',
        '${email.replace(/'/g, "\\'")}',
        '${address.replace(/'/g, "\\'")}',
        '${suburb.replace(/'/g, "\\'")}',
        '${city.replace(/'/g, "\\'")}',
        '${postCode.replace(/'/g, "\\'")}',
        '${issueDate}',
        '${premium}',
        '${premiumMode}',
        '${admin.replace(/'/g, "\\'")}',
        '${notesComments.replace(/'/g, "\\'")}',
        '${pending}',
        '${comments.replace(/'/g, "\\'")}'
    `.replace(/\s+/g, ' ').trim();

    if (npwDeferredDataTable) {
        npwDeferredDataTable.row.add([
            `<span class="fw-bold text-dark fs-13">${firstName} ${lastName}</span>`,
            `<span class="fs-13 text-muted">${policyNo}</span>`,
            `<span class="fs-13 fw-semibold text-dark">${company}</span>`,
            `<span class="fs-13 text-muted">${mobile}</span>`,
            `<span class="fs-13 text-muted">${issueDate}</span>`,
            `<span class="fs-13 fw-bold text-dark">${premium} <small class="text-muted">(${premiumMode})</small></span>`,
            `<span class="fs-13 text-muted">${admin}</span>`,
            pendingBadge,
            `<span class="fs-13 text-muted">${comments}</span>`,
            `<div class="text-center">
                <div class="action-kebab-wrapper">
                    <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                    <div class="action-kebab-dropdown">
                        <a href="javascript:void(0);" class="action-kebab-item" onclick="viewNpwDetails(${actionParams})"><i class="feather-eye text-primary me-1"></i> View Details</a>
                        <a href="javascript:void(0);" class="action-kebab-item" onclick="editNpwDetails(${actionParams})"><i class="feather-edit text-info me-1"></i> Edit Record</a>
                    </div>
                </div>
            </div>`
        ]).draw(false);
    }

    $('#addNpwDeferredForm')[0].reset();
    const modalEl = document.getElementById('addNpwModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#npwDeferredTable')) {
        npwDeferredDataTable = $('#npwDeferredTable').DataTable({
            retrieve: true,
            responsive: true,
            pageLength: 10,
            columnDefs: [
                { responsivePriority: 1, targets: -1 }, // Keep Actions column always visible
                { responsivePriority: 2, targets: 0 },  // Keep First Name always visible
                { responsivePriority: 3, targets: 1 }   // Keep Last Name always visible
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records..."
            },
            initComplete: function(settings, json) {
                const wrapper = $('#npwDeferredTable_wrapper');
                const topRow = wrapper.find('.row').first();
                topRow.addClass('d-flex flex-row justify-content-between align-items-center flex-nowrap w-100 mb-3');
                
                const lengthCol = topRow.find('> div').first();
                lengthCol.addClass('d-flex align-items-center justify-content-start');
                
                const filterCol = topRow.find('> div').last();
                filterCol.addClass('d-flex align-items-center justify-content-end ms-auto text-end');
                
                const filterDiv = filterCol.find('.dataTables_filter');
                filterDiv.addClass('d-flex align-items-center justify-content-end ms-auto text-end');
                filterDiv.css({
                    'margin-left': 'auto',
                    'display': 'flex',
                    'justify-content': 'flex-end',
                    'align-items': 'center'
                });
            }
        });
    }
});
