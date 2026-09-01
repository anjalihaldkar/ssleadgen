/* Page script for clients-inactive */
let inactiveClientsTable = null;

        function handleAddNewClient() {
            const name = $('#clientNameInput').val().trim();
            const phone = $('#clientPhoneInput').val().trim();
            const rawDob = $('#clientDobInput').val();
            const dob = rawDob ? rawDob.split('-').reverse().join('/') : '12/05/1988';
            const address = $('#clientAddressInput').val().trim() || 'Wellington, NZ';
            const status = $('#clientStatusSelect').val();
            const source = $('#clientSourceSelect').val();
            const policies = $('#clientPoliciesInput').val() || '1';

            if (!name || !phone) return;

            const statusPill = status === 'Inforce' 
                ? `<span class="status-pill-inforce">Inforce</span>`
                : `<span class="status-pill-inactive">Inactive</span>`;

            if (inactiveClientsTable) {
                inactiveClientsTable.row.add([
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
                                <a href="javascript:void(0);" class="action-kebab-item"><i class="feather-eye text-primary me-1"></i> View Profile</a>
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
            if (!$.fn.DataTable.isDataTable('#inactiveClientsTable')) {
                inactiveClientsTable = $('#inactiveClientsTable').DataTable({
                    retrieve: true,
                    responsive: true,
                    pageLength: 10,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search inactive clients..."
                    }
                });
            }
        });
