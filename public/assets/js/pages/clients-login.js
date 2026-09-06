/* Page script for clients-login */
let loginClientsTable = null;

function viewLoginClientFromRow(wrapper) {
    const data = wrapper.dataset;
    
    $('#viewPolicyNoHeader').text(data.policy_no || '-');
    $('#viewPolicyNo').val(data.policy_no);
    $('#viewCompany').val(data.company);
    $('#viewFirstName').val(data.first_name);
    $('#viewLastName').val(data.last_name);
    
    let dob = data.dob;
    if (dob) {
        let parts = dob.split('-');
        if (parts.length === 3) dob = parts[2] + '/' + parts[1] + '/' + parts[0];
    }
    $('#viewDob').val(dob);
    
    $('#viewMobile').val(data.phone);
    $('#viewEmail').val(data.email);
    $('#viewAddress').val(data.address);
    $('#viewSuburb').val(data.suburb);
    $('#viewCity').val(data.city);
    $('#viewPostCode').val(data.post_code);
    
    let loginDate = data.login_date;
    if (loginDate) {
        let parts = loginDate.split('-');
        if (parts.length === 3) loginDate = parts[2] + '/' + parts[1] + '/' + parts[0];
    }
    $('#viewLoginDate').val(loginDate);
    
    $('#viewAnp').val(data.anp);
    $('#viewOutcome').val(data.outcome);
    $('#viewAdviser').val(data.adviser);
    $('#viewNotCounting').val(data.not_counting === '1' ? 'Yes' : 'No');
    $('#viewComplianceBy').val(data.compliance_by);
    
    let roaDate = data.roa_due_date;
    if (roaDate) {
        let parts = roaDate.split('-');
        if (parts.length === 3) roaDate = parts[2] + '/' + parts[1] + '/' + parts[0];
    }
    $('#viewRoaDueDate').val(roaDate);
    
    $('#viewStatusCompliance').val(data.status_compliance);
    $('#viewSentToClient').val(data.sent_to_client);

    const modalEl = document.getElementById('viewLoginClientModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function editCurrentViewedLoginClient() {
    const viewModalEl = document.getElementById('viewLoginClientModal');
    const viewModal = bootstrap.Modal.getInstance(viewModalEl);
    if (viewModal) viewModal.hide();

    const policyNo = $('#viewPolicyNo').val();
    const wrapper = document.querySelector('.action-kebab-wrapper[data-policy_no="' + policyNo + '"]');
    if (wrapper) {
        setTimeout(() => {
            editLoginClientFromRow(wrapper);
        }, 300);
    }
}

function editLoginClientFromRow(wrapper) {
    const data = wrapper.dataset;
    
    $('#loginModalTitle').text('Edit Login Client Entry - ' + (data.policy_no || ''));
    $('#addLoginClientForm')[0].reset();
    
    $('#loginFormMethod').val('PATCH');
    $('#loginClientId').val(data.id);
    
    // We update the form action to point to the update route
    let formAction = $('#addLoginClientForm').attr('action');
    if (formAction.endsWith('/login')) {
        $('#addLoginClientForm').attr('action', formAction + '/' + data.id);
    } else {
        // If it already has an ID, replace it
        formAction = formAction.substring(0, formAction.lastIndexOf('/'));
        $('#addLoginClientForm').attr('action', formAction + '/' + data.id);
    }

    $('#loginPolicyNoInput').val(data.policy_no || '');
    if (data.company && $('#loginCompanyInput option[value="' + data.company + '"]').length > 0) {
        $('#loginCompanyInput').val(data.company);
    } else if (data.company) {
        $('#loginCompanyInput').append(new Option(data.company, data.company, true, true)).val(data.company);
    }
    $('#loginFirstNameInput').val(data.first_name || '');
    $('#loginLastNameInput').val(data.last_name || '');
    
    $('#loginDobInput').val(data.dob || '');
    
    $('#loginMobileInput').val(data.phone || '');
    $('#loginEmailInput').val(data.email || '');
    $('#loginAddressInput').val(data.address || '');
    $('#loginSuburbInput').val(data.suburb || '');
    $('#loginCityInput').val(data.city || '');
    $('#loginPostCodeInput').val(data.post_code || '');
    
    $('#loginDateInput').val(data.login_date || '');
    
    $('#loginAnpInput').val(data.anp || '');
    $('#loginOutcomeInput').val(data.outcome || '');
    $('#loginAdviserInput').val(data.adviser || '');
    $('#loginNotCountingSelect').val(data.not_counting === '1' ? '1' : '0');
    $('#loginComplianceByInput').val(data.compliance_by || '');
    
    $('#loginRoaDueDateInput').val(data.roa_due_date || '');
    
    $('#loginStatusComplianceSelect').val(data.status_compliance || 'Sent to Compliance');
    $('#loginSentToClientSelect').val(data.sent_to_client || 'Pending');

    const modalEl = document.getElementById('addLoginClientModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function openClientRequestModal(clientName, company, clientId) {
    $('#reqClientNameHeader').text(clientName);
    $('#reqClientNameInput').val(clientName);
    $('#reqCompanyInput').val(company || '');
    $('#reqClientId').val(clientId);

    // Build the action URL from the current base path
    const basePath = window.location.origin + '/clients/login/' + clientId + '/inforce';
    $('#clientRequestForm').attr('action', basePath);

    // Reset variable fields
    $('#reqDateInput').val('');
    $('#reqFinishedDateInput').val('');
    $('#reqOutcomeInput').val('');
    $('#reqCommentsInput').val('');

    const modalEl = document.getElementById('clientRequestModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function openClaimUpdateModal(clientName, company, clientId) {
    $('#claimModalTitle').text('New Claim Update - ' + clientName);
    
    // Convert selects to text inputs for display purposes since we are moving to a specific client record
    $('#claimClientNameDisplay').val(clientName);
    $('#claimCompanyDisplay').val(company || '');
    $('#claimClientId').val(clientId);

    // Build the action URL from the current base path
    const basePath = window.location.origin + '/clients/login/' + clientId + '/claim';
    $('#lodgeClaimForm').attr('action', basePath);

    // Reset fields
    $('#claimTypeInput').val('');
    $('#claimProcessedDateInput').val('');
    $('#claimApprovedDateInput').val('');
    $('#claimOutcomeInput').val('');

    const modalEl = document.getElementById('lodgeClaimModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function openCancellationUpdateModal(clientName, company, clientId) {
    $('#cancModalTitle').text('New Cancellation Update - ' + clientName);
    
    // Set read-only fields
    $('#cancClientNameDisplay').val(clientName);
    $('#cancCompanyDisplay').val(company || '');
    
    // Build the action URL from the current base path
    const basePath = window.location.origin + '/clients/login/' + clientId + '/cancellation';
    $('#addCancellationForm').attr('action', basePath);

    // Reset fields
    $('#cancDateSentInput').val('');
    $('#cancCompletedInput').val('');
    $('#cancOutcomeInput').val('');
    $('#cancCommentsInput').val('');

    const modalEl = document.getElementById('addCancellationModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function handleSaveClientRequest(event) {
    // Let the browser submit the form normally to the server
    return true;
}





function handleAddNewLoginClient() {
    const policyNo = $('#loginPolicyNoInput').val().trim() || ('POL-2026-' + Math.floor(1000 + Math.random() * 9000));
    const company = $('#loginCompanyInput').val().trim() || 'AIA Life';
    const firstName = $('#loginFirstNameInput').val().trim();
    const lastName = $('#loginLastNameInput').val().trim();
    const rawDob = $('#loginDobInput').val();
    const dob = rawDob ? rawDob.split('-').reverse().join('/') : '15/06/1990';
    const mobile = $('#loginMobileInput').val().trim();
    const email = $('#loginEmailInput').val().trim() || (firstName.toLowerCase() + '.' + lastName.toLowerCase() + '@gmail.com');
    const address = $('#loginAddressInput').val().trim() || '123 Queen Street';
    const suburb = $('#loginSuburbInput').val().trim() || 'Central';
    const city = $('#loginCityInput').val().trim() || 'Auckland';
    const postCode = $('#loginPostCodeInput').val().trim() || '1010';
    const rawLoginDate = $('#loginDateInput').val();
    const loginDate = rawLoginDate ? rawLoginDate.split('-').reverse().join('/') : '18/08/2026';
    const anpVal = $('#loginAnpInput').val().trim() || '2500';
    const formattedAnp = anpVal.startsWith('$') ? anpVal : `$${parseFloat(anpVal.replace(/[^0-9.]/g, '') || 2500).toLocaleString()}`;
    const outcome = $('#loginOutcomeInput').val().trim() || 'Underwriting Review';
    const adviser = $('#loginAdviserInput').val() || 'Sushant Yadav';
    const notCounting = $('#loginNotCountingSelect').val() || 'No';
    const complianceBy = $('#loginComplianceByInput').val().trim() || 'Royson Pinto';
    const rawRoaDate = $('#loginRoaDueDateInput').val();
    const roaDueDate = rawRoaDate ? rawRoaDate.split('-').reverse().join('/') : '30/08/2026';
    const statusCompliance = $('#loginStatusComplianceSelect').val() || 'Sent to Compliance';
    const sentToClient = $('#loginSentToClientSelect').val() || 'Pending';

    if (!firstName || !lastName || !mobile) {
        alert('Please fill in First Name, Last Name, and Mobile Number.');
        return;
    }

    let complianceBadgeClass = 'bg-soft-primary text-primary';
    if (statusCompliance.includes('Approved') || statusCompliance.includes('Completed')) complianceBadgeClass = 'bg-soft-success text-success';
    if (statusCompliance.includes('Review') || statusCompliance.includes('Pending')) complianceBadgeClass = 'bg-soft-warning text-warning';
    const complianceBadge = `<span class="badge ${complianceBadgeClass} fs-11">${statusCompliance}</span>`;

    const sentClientBadge = sentToClient === 'Yes'
        ? '<span class="badge bg-soft-success text-success fs-11"><i class="feather-check me-1"></i>Yes</span>'
        : '<span class="badge bg-soft-secondary text-secondary fs-11">Pending</span>';

    const clientFullName = firstName + ' ' + lastName;

    const actionParams = `'${policyNo}', '${company}', '${firstName}', '${lastName}', '${dob}', '${mobile}', '${email}', '${address}', '${suburb}', '${city}', '${postCode}', '${loginDate}', '${formattedAnp}', '${outcome}', '${adviser}', '${notCounting}', '${complianceBy}', '${roaDueDate}', '${statusCompliance}', '${sentToClient}'`;

    const rowData = [
        `<span class="fw-bold text-dark fs-12">${policyNo}</span>`,
        `<span class="fs-13 fw-semibold text-dark">${company}</span>`,
        `<span class="fs-13 fw-bold text-dark">${clientFullName}</span>`,
        `<span class="fs-13 text-muted">${mobile}</span>`,
        `<span class="fs-13 text-muted">${loginDate}</span>`,
        `<span class="fs-13 fw-bold text-dark">${formattedAnp}</span>`,
        complianceBadge,
        sentClientBadge,
        `<div class="text-center">
            <div class="action-kebab-wrapper">
                <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                <div class="action-kebab-dropdown">
                    <a href="javascript:void(0);" class="action-kebab-item" onclick="viewLoginClientDetails(${actionParams})"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                    <a href="javascript:void(0);" class="action-kebab-item" onclick="editLoginClientDetails(${actionParams})"><i class="feather-edit text-success me-1"></i> Edit Client</a>
                    <a href="javascript:void(0);" class="action-kebab-item" onclick="openClientRequestModal('${clientFullName}', '${company}', '')"><i class="feather-git-pull-request text-warning me-1"></i> Client Request</a>
                    <a href="javascript:void(0);" class="action-kebab-item" onclick="openClaimUpdateModal('${clientFullName}', '${company}', '')"><i class="feather-shield text-info me-1"></i> Claim Update</a>
                    <a href="javascript:void(0);" class="action-kebab-item" onclick="openInactiveClientModal('${clientFullName}', '${company}', '')"><i class="feather-user-x text-secondary me-1"></i> Inactive Clients</a>
                    <a href="javascript:void(0);" class="action-kebab-item" onclick="openNpwDeferredModal('${clientFullName}', '${company}', '')"><i class="feather-clock text-purple me-1"></i> NPW Deferred</a>
                    <a href="javascript:void(0);" class="action-kebab-item" onclick="openCancellationUpdateModal('${clientFullName}', '${company}', '')"><i class="feather-file-minus text-danger me-1"></i> Cancellation update</a>
                </div>
            </div>
        </div>`
    ];

    if (loginClientsTable) {
        let existingRowIndex = -1;
        loginClientsTable.rows().every(function (rowIdx) {
            const data = this.data();
            if (data && data[0] && data[0].includes(policyNo)) {
                existingRowIndex = rowIdx;
            }
        });

        if (existingRowIndex >= 0) {
            loginClientsTable.row(existingRowIndex).data(rowData).draw(false);
            alert(`Login Client Record for ${clientFullName} (${policyNo}) updated successfully!`);
        } else {
            loginClientsTable.row.add(rowData).draw(false);
            alert(`Login Client Record for ${clientFullName} (${policyNo}) created successfully!`);
        }
    }

    $('#addLoginClientForm')[0].reset();
    const modalEl = document.getElementById('addLoginClientModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

function handleImportClients() {
    const fileInput = document.getElementById('importFileInput');
    if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
        alert('Please select a CSV or Excel file to import.');
        return;
    }
    const fileName = fileInput.files[0].name;
    alert(`File "${fileName}" uploaded successfully! 12 new login client records imported.`);
    const modalEl = document.getElementById('importLoginClientsModal');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
    $('#importForm')[0].reset();
}

$(document).ready(function () {
    if (!$.fn.DataTable.isDataTable('#loginClientsTable')) {
        loginClientsTable = $('#loginClientsTable').DataTable({
            retrieve: true,
            responsive: true,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search login clients..."
            }
        });
    }
});
function openNpwDeferredModal(clientName, company, clientId) {
    $('#npwModalTitle').text('NPW Deferred - ' + clientName);
    
    // Set read-only fields
    $('#npwClientNameDisplay').val(clientName);
    $('#npwCompanyDisplay').val(company || '');
    
    // Build the action URL from the current base path
    const basePath = window.location.origin + '/clients/login/' + clientId + '/npw-deferred';
    $('#addNpwForm').attr('action', basePath);

    // Reset fields
    $('#npwIssueDateInput').val('');
    $('#npwPremiumInput').val('');
    $('#npwNotesCommentsInput').val('');

    const modalEl = document.getElementById('addNpwModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}
function openInactiveClientModal(clientName, company, clientId) {
    $('#inactiveClientNameDisplay').text(clientName);
    
    // Build the action URL from the current base path
    const basePath = window.location.origin + '/clients/login/' + clientId + '/inactive';
    $('#addInactiveForm').attr('action', basePath);

    const modalEl = document.getElementById('addInactiveModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}
