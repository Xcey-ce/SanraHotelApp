$(document).ready(function() {
    $('#guestTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/guests/data',
        columns: [
            
            { data: 'id', name: 'id', searchable: true },
            { data: 'name', name: 'name', className: 'whitespace-nowrap px-4 py-2'},
            { data: 'email', name: 'email', searchable: false, className: 'whitespace-nowrap px-4 py-2' },
            { data: 'phone', name: 'phone', searchable: false, className: 'whitespace-nowrap px-4 py-2' },
            { data: 'id_type', name: 'id_type', searchable: false, className: 'whitespace-nowrap px-4 py-2' },
            { data: 'id_number', name: 'id_number', searchable: false, className: 'whitespace-nowrap px-4 py-2' },
            { data: 'address', name: 'address',},
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        
        language: {
            emptyTable: "<span class='text-gray-500'>No data available</span>",
        },
         drawCallback: function() {
            lucide.createIcons();
        }
    });

});

window.addGuestDialog = function () {
    const dlg = document.getElementById('addGuestDialog');
    if (dlg && typeof dlg.showModal === 'function') {
        dlg.showModal();
        return dlg;
    }
};

window.editGuestDialog = function (button) {
    const editdlg = document.getElementById('editGuestDialog');
    const form = document.getElementById('editGuestForm');

    if (!editdlg || typeof editdlg.showModal !== 'function') {
        console.error('Dialog element not found or showModal not supported.');
        return;
    }

    // Get data attributes from button
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const email = button.getAttribute('data-email');
    const phone = button.getAttribute('data-phone');
    const idType = button.getAttribute('data-idtype');
    const idNumber = button.getAttribute('data-idnumber');
    const address = button.getAttribute('data-address');

    // Fill form fields
    document.getElementById('editGuestId').value = id || '';
    document.getElementById('editGuestName').value = name || '';
    document.getElementById('editGuestEmail').value = email || '';
    document.getElementById('editGuestPhone').value = phone || '';
    document.getElementById('editGuestIdType').value = idType || '';
    document.getElementById('editGuestIdNumber').value = idNumber || '';
    document.getElementById('editGuestAddress').value = address || '';

    // Update form action dynamically
    form.action = `/update/guest/${id}`;

    editdlg.showModal();
};


window.openDeleteGuestDialog = function (button) {
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');

    // Update modal content
    document.getElementById('deleteGuestName').textContent = name || '';
    document.getElementById('deleteGuestDialog').classList.remove('hidden');
    document.getElementById('deleteGuestDialog').classList.add('flex');

    // Set form action (assuming your delete route is guests.destroy)
    const form = document.getElementById('deleteGuestForm');
    form.action = `/delete/guest/${id}`;
};

window.closeDangerModal = function () {
    const modal = document.getElementById('deleteGuestDialog');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
};
