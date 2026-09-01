/* Page script for clients */
let clientsDataTable = null;

        function viewClientDetails(name, phone, address, status, policies) {
            $('#viewClientModalTitle').text(name + ' - Profile Overview');
            $('#viewClientModalBody').html(`
                <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                    <div class="avatar-text avatar-lg bg-soft-primary text-primary rounded-circle fs-3" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center;"><i class="feather-user"></i></div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0">${name}</h5>
                        <span class="badge ${status === 'Inforce' ? 'bg-soft-success text-success' : 'bg-soft-warning text-warning'} fw-bold fs-11 mt-1">${status} Client</span>
                    </div>
                </div>
                <div class="row g-3 fs-13">
                    <div class="col-6"><strong>Phone:</strong> ${phone}</div>
                    <div class="col-6"><strong>Address:</strong> ${address}</div>
                    <div class="col-6"><strong>Active Policies:</strong> ${policies}</div>
                    <div class="col-6"><strong>Advisor Assigned:</strong> Sushant Yadav</div>
                </div>
            `);
            $('#viewClientModal').modal('show');
        }

        function handleAddNewClient() {
            const name = $('#clientNameInput').val().trim();
            const phone = $('#clientPhoneInput').val().trim();
            const rawDob = $('#clientDobInput').val();
            const dob = rawDob ? rawDob.split('-').reverse().join('/') : '12/05/1988';
            const address = $('#clientAddressInput').val().trim() || 'Auckland, NZ';
            const status = $('#clientStatusSelect').val();
            const source = $('#clientSourceSelect').val();
            const policies = $('#clientPoliciesInput').val() || '1';

            if (!name || !phone) return;

            const statusPill = status === 'Inforce' 
                ? `<span class="status-pill-inforce">Inforce</span>`
                : `<span class="status-pill-inactive">Inactive</span>`;

            if (clientsDataTable) {
                clientsDataTable.row.add([
                    `<span class="fw-bold text-dark fs-13">${name}</span>`,
                    `<span class="fs-13 text-muted">${phone}</span>`,
                    `<span class="fs-13 text-muted">${dob}</span>`,
                    `<span class="fs-13 text-muted">${address}</span>`,
                    statusPill,
                    `<span class="fs-13 text-muted">${source}</span>`,
                    `<span class="fs-13 fw-semibold text-dark text-center">${policies}</span>`,
                    `<span class="fs-13 text-muted">Today</span>`,
                    `<div class="text-center">
                        <div class="action-kebab-wrapper">
                            <button class="action-kebab-btn"><i class="feather-more-vertical"></i></button>
                            <div class="action-kebab-dropdown">
                                <a href="javascript:void(0);" class="action-kebab-item" onclick="viewClientDetails('${name}', '${phone}', '${address}', '${status}', '${policies}')"><i class="feather-eye text-primary me-1"></i> View Profile</a>
                            </div>
                        </div>
                    </div>`
                ]).draw(false);
            }

            $('#addClientForm')[0].reset();
            const modalEl = document.getElementById('addClientModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        }

        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#clientsDirectoryTable')) {
                clientsDataTable = $('#clientsDirectoryTable').DataTable({
                    retrieve: true,
                    responsive: true,
                    pageLength: 10,
                    language: { search: "_INPUT_", searchPlaceholder: "Search client records..." }
                });
            }
        });
