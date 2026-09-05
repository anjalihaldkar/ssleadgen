/* SS Advisory - Master Interactive & Desktop Navigation Collapsible Logic */

// Suppress DataTables reinitialization warning popups globally
if (typeof $.fn.dataTable !== 'undefined') {
    $.fn.dataTable.ext.errMode = 'none';
}

function dismissPreloader() {
    var loader = document.getElementById('preloader');
    if (loader) {
        loader.classList.add('loaded');
        setTimeout(function () { loader.style.display = 'none'; }, 300);
    }
}

window.addEventListener('load', dismissPreloader);
document.addEventListener('DOMContentLoaded', function () {
    setTimeout(dismissPreloader, 400);
});

$(document).ready(function () {
    if (typeof $.fn.dataTable !== 'undefined') {
        $.fn.dataTable.ext.errMode = 'none';
    }

    // Force Clients menu to be persistently active and open in DOM structure
    const $clientsMenu = $('.nxl-item.nxl-hasmenu').filter(function() {
        return $(this).find('a .feather-users').length > 0;
    });
    if ($clientsMenu.length) {
        $clientsMenu.addClass('active open');
    }

    // Function to sync submenu display with sidebar collapse state
    function syncSidebarSubmenu() {
        if ($('body').hasClass('nxl-mini-navigation')) {
            $('.nxl-submenu').attr('style', 'display: none !important;');
        } else {
            $('.nxl-submenu').removeAttr('style');
        }
    }

    // Initial check on load
    syncSidebarSubmenu();

    // Single Universal Navigation Toggle Handler across Desktop & Mobile
    $(document).on('click', '#menu-mini-button, #mobile-collapse', function (e) {
        e.preventDefault();
        if ($(window).width() >= 992) {
            $('body').toggleClass('nxl-mini-navigation');
            syncSidebarSubmenu();
        } else {
            $('body').toggleClass('nxl-navigation-active');
            $('#mainSidebar, .nxl-navigation').toggleClass('mob-navigation-active');
        }
    });

    // Dismiss mobile drawer on overlay / outer click
    $(document).on('click', function (e) {
        if ($(window).width() < 992) {
            if (!$(e.target).closest('.nxl-navigation, #menu-mini-button, #mobile-collapse').length) {
                $('body').removeClass('nxl-navigation-active');
                $('#mainSidebar, .nxl-navigation').removeClass('mob-navigation-active');
            }
        }
    });

    // Safe Global Datatables Auto-Initialization
    $('.table').each(function () {
        if (this.id && this.id !== 'recentClientsTable' && typeof $.fn.DataTable !== 'undefined') {
            if (!$.fn.DataTable.isDataTable('#' + this.id)) {
                let tableObj = $(this);
                tableObj.DataTable({
                    retrieve: true,
                    responsive: false,
                    pageLength: 10,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records..."
                    }
                });
            }
        }
    });

    // Auto-attach green + expand buttons to table rows for mobile view
    setupTableExpandButtons();
    formatDataTablesHeader();
    setTimeout(formatDataTablesHeader, 300);

    // Universal Top Filter Search & Clear Handler
    $(document).on('click', '#btnExecuteSearch', function (e) {
        e.preventDefault();
        const clientVal = $('#filterClientSearch').length && $('#filterClientSearch').val() ? $('#filterClientSearch').val().trim() : '';
        const phoneVal = $('#filterNumberSearch').length && $('#filterNumberSearch').val() ? $('#filterNumberSearch').val().trim() : '';
        const addressVal = $('#filterAddressSearch').length && $('#filterAddressSearch').val() ? $('#filterAddressSearch').val().trim() : '';
        const dobVal = $('#filterDobSearch').length && $('#filterDobSearch').val() ? $('#filterDobSearch').val().trim() : '';

        const searchTerm = [clientVal, phoneVal, addressVal, dobVal].filter(Boolean).join(' ');

        // Search active DataTable on page
        $('.table').each(function () {
            if (this.id && typeof $.fn.DataTable !== 'undefined' && $.fn.DataTable.isDataTable('#' + this.id)) {
                $('#' + this.id).DataTable().search(searchTerm).draw();
            }
        });

        const $btn = $(this);
        $btn.addClass('btn-success');
        $btn.html('<i class="feather-check me-1"></i> Filtered');
        setTimeout(function () {
            $btn.removeClass('btn-success');
            $btn.html('<i class="feather-search me-1"></i> Search');
        }, 1200);
    });

    $(document).on('click', '#btnClearSearch', function (e) {
        e.preventDefault();
        $('.dash-filter-input').val('');
        $('.table').each(function () {
            if (this.id && typeof $.fn.DataTable !== 'undefined' && $.fn.DataTable.isDataTable('#' + this.id)) {
                $('#' + this.id).DataTable().search('').columns().search('').draw();
            }
        });
    });

    // Also support pressing Enter inside any .dash-filter-input
    $(document).on('keypress', '.dash-filter-input', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#btnExecuteSearch').click();
        }
    });
});

function formatDataTablesHeader() {
    $('.dataTables_wrapper').each(function () {
        let wrapper = $(this);
        let lengthEl = wrapper.find('.dataTables_length');
        let filterEl = wrapper.find('.dataTables_filter');

        if (lengthEl.length && filterEl.length && !wrapper.find('.dt-mobile-header-row').length) {
            let headerRow = $('<div class="dt-mobile-header-row"></div>');
            lengthEl.before(headerRow);
            headerRow.append(lengthEl).append(filterEl);
        }
    });
}

// Universal Mobile Expandable Table Row Toggle Engine (Actions column stays visible on screen!)
$(document).on('click', '.table-expand-btn', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let btn = $(this);
    let tr = btn.closest('tr');
    let table = tr.closest('table');
    let colHeaders = table.find('thead th');

    if (tr.next('.table-child-row').length) {
        tr.next('.table-child-row').remove();
        btn.removeClass('expanded').text('+');
    } else {
        let cells = tr.children('td');
        let detailsHtml = '<div class="table-child-content">';

        cells.each(function (idx) {
            // Skip first cell (Name) and last cell (Actions) so Actions stays ON SCREEN!
            if (idx === 0 || idx === cells.length - 1) return;

            let label = $(colHeaders[idx]).text().trim();
            let val = $(this).html();
            if (label && val) {
                detailsHtml += `
                    <div class="table-child-item">
                        <span class="table-child-label">${label}:</span>
                        <span class="table-child-val">${val}</span>
                    </div>`;
            }
        });
        detailsHtml += '</div>';

        let colCount = cells.length;
        let childRow = `<tr class="table-child-row"><td colspan="${colCount}">${detailsHtml}</td></tr>`;
        tr.after(childRow);
        btn.addClass('expanded').text('×');
    }
});

function setupTableExpandButtons() {
    $('.table tbody tr').each(function () {
        let tr = $(this);
        if (!tr.hasClass('table-child-row') && !tr.find('.table-expand-btn').length) {
            let firstTd = tr.find('td').first();
            if (firstTd.length) {
                let currentContent = firstTd.html();
                firstTd.html(`<div class="table-cell-title-wrap"><button type="button" class="table-expand-btn" title="Toggle Extra Details">+</button><div>${currentContent}</div></div>`);
            }
        }
    });
}

function openNotesDrawer(idOrName) {
    let targetName = typeof idOrName === 'string' ? idOrName : 'Client Details';
    if (typeof idOrName === 'number' && typeof insuranceLeads !== 'undefined') {
        let found = insuranceLeads.find(l => l.id === idOrName);
        if (found) targetName = found.name;
    } else if (typeof idOrName === 'string' && typeof insuranceLeads !== 'undefined') {
        let found = insuranceLeads.find(l => l.name.toLowerCase() === idOrName.toLowerCase());
        if (found) targetName = found.name;
    }

    if ($('#drawerLeadName').length) {
        $('#drawerLeadName').text(targetName);
    }

    let drawer = $('#notesDrawerBackdrop');
    if (drawer.length) {
        drawer.addClass('show').css({ 'display': 'flex', 'opacity': '1' });
    }

    let modalEl = document.getElementById('addNotesModal') || document.getElementById('notesModal');
    if (modalEl) {
        var bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        bsModal.show();
    }
}

function closeNotesDrawer() {
    let drawer = $('#notesDrawerBackdrop');
    if (drawer.length) {
        drawer.removeClass('show').css({ 'display': 'none', 'opacity': '0' });
    }
}

// Action Kebab Menu Click Toggle Handler (Desktop & Mobile)
$(document).on('click', '.action-kebab-btn', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let wrapper = $(this).closest('.action-kebab-wrapper');
    let dropdown = wrapper.find('.action-kebab-dropdown');
    let isOpen = dropdown.hasClass('show');

    // Close any currently open kebab dropdowns
    $('.action-kebab-dropdown').removeClass('show').css({ 'position': '', 'top': '', 'left': '', 'right': '', 'bottom': '' });
    $('.action-kebab-wrapper').removeClass('show');

    // Toggle current dropdown if it wasn't open
    if (!isOpen) {
        dropdown.addClass('show');
        wrapper.addClass('show');
        
        // Prevent clipping by containers with overflow: hidden/auto (like table-responsive)
        let rect = this.getBoundingClientRect();
        dropdown.css({
            'position': 'fixed',
            'top': (rect.bottom + 4) + 'px',
            'left': (rect.right - dropdown.outerWidth()) + 'px',
            'bottom': 'auto',
            'right': 'auto',
            'z-index': '999999'
        });
    }
});

// Close open dropdowns when scrolling to prevent floating detached menus
document.addEventListener('scroll', function(e) {
    if ($('.action-kebab-dropdown.show').length > 0) {
        // Only close if scrolling something other than the dropdown itself
        if (!$(e.target).closest('.action-kebab-dropdown').length) {
            $('.action-kebab-dropdown').removeClass('show').css({ 'position': '', 'top': '', 'left': '', 'right': '', 'bottom': '' });
            $('.action-kebab-wrapper').removeClass('show');
        }
    }
}, true);

// Close dropdown when clicking outside
$(document).on('click', function (e) {
    if (!$(e.target).closest('.action-kebab-wrapper').length) {
        $('.action-kebab-dropdown').removeClass('show').css({ 'position': '', 'top': '', 'left': '', 'right': '', 'bottom': '' });
        $('.action-kebab-wrapper').removeClass('show');
    }
});

// Close dropdown when an item inside is clicked
$(document).on('click', '.action-kebab-item', function () {
    $('.action-kebab-dropdown').removeClass('show').css({ 'position': '', 'top': '', 'left': '', 'right': '', 'bottom': '' });
    $('.action-kebab-wrapper').removeClass('show');
});

/* Global Helper Functions for Common Kebab Modals */
function openClientRequestModal(clientName, company) {
    $('#reqClientNameHeader').text(clientName || 'Client');
    $('#reqClientNameInput').val(clientName || '');
    $('#reqCompanyInput').val(company || 'AIA Life');
    const today = new Date().toISOString().split('T')[0];
    $('#reqDateInput').val(today);
    $('#reqFinishedDateInput').val('');
    $('#reqOutcomeInput').val('');
    $('#reqCommentsInput').val('');
    
    const modalEl = document.getElementById('clientRequestModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.show();
    }
}

function openClaimUpdateModal(clientName, company) {
    $('#claimModalTitle').text('New Claim Update - ' + (clientName || 'Client'));
    if ($('#claimClientSelect').length) {
        if ($('#claimClientSelect option[value="' + clientName + '"]').length > 0) {
            $('#claimClientSelect').val(clientName);
        } else if (clientName) {
            $('#claimClientSelect').append(new Option(clientName, clientName, true, true)).val(clientName);
        }
    }
    if ($('#claimCompanySelect').length) {
        if (company && $('#claimCompanySelect option[value="' + company + '"]').length > 0) {
            $('#claimCompanySelect').val(company);
        } else if (company) {
            $('#claimCompanySelect').append(new Option(company, company, true, true)).val(company);
        }
    }
    const modalEl = document.getElementById('lodgeClaimModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.show();
    }
}

function openCancellationUpdateModal(clientName, company) {
    $('#cancModalTitle').text('New Cancellation Update - ' + (clientName || 'Client'));
    if ($('#cancClientSelect').length) {
        if ($('#cancClientSelect option[value="' + clientName + '"]').length > 0) {
            $('#cancClientSelect').val(clientName);
        } else if (clientName) {
            $('#cancClientSelect').append(new Option(clientName, clientName, true, true)).val(clientName);
        }
    }
    if ($('#cancCompanySelect').length) {
        if (company && $('#cancCompanySelect option[value="' + company + '"]').length > 0) {
            $('#cancCompanySelect').val(company);
        } else if (company) {
            $('#cancCompanySelect').append(new Option(company, company, true, true)).val(company);
        }
    }
    const modalEl = document.getElementById('addCancellationModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.show();
    }
}

function handleSaveClientRequest() {
    const name = $('#reqClientNameInput').val() || 'Client';
    const requestType = $('#reqTypeSelect').val() || 'Service Request';
    alert(`Client Request "${requestType}" for ${name} saved successfully!`);
    
    const modalEl = document.getElementById('clientRequestModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }
    if ($('#clientRequestForm').length) $('#clientRequestForm')[0].reset();
}

function handleAddNewClaim() {
    const client = $('#claimClientSelect').val() || 'Client';
    alert(`Claim Update for ${client} logged successfully!`);

    if ($('#lodgeClaimForm').length) $('#lodgeClaimForm')[0].reset();
    const modalEl = document.getElementById('lodgeClaimModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }
}

function handleAddNewCancellation() {
    const client = $('#cancClientSelect').val() || 'Client';
    alert(`Cancellation Update for ${client} logged successfully!`);

    if ($('#addCancellationForm').length) $('#addCancellationForm')[0].reset();
    const modalEl = document.getElementById('addCancellationModal');
    if (modalEl) {
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
    }
}


