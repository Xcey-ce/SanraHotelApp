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
    console.error('Dialog not found or not supported.');
    return;
  }

  form.onsubmit = async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    formData.append('_method', 'PUT');

    try {
      const response = await fetch(form.action, {
        method: 'POST', // Laravel sees it as PUT
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const data = await response.json();

      if (data.status === 'success') {
        editdlg.close(); 

        Swal.fire({
          icon: 'success',
          title: 'Updated!',
          text: data.message,
          timer: 2000,
          showConfirmButton: false
        });

        $('#guestTable').DataTable().ajax.reload(null, false);

      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: data.message
        });
      }

    } catch (error) {
      Swal.fire({
        icon: 'error',
        title: 'Something went wrong!',
        text: error.message
      });
    }
  };

  // Populate form fields from data attributes
  const id = button.getAttribute('data-id');
  form.action = `/update/guest/${id}`;

  document.getElementById('editGuestId').value = id || '';
  document.getElementById('editGuestName').value = button.getAttribute('data-name') || '';
  document.getElementById('editGuestEmail').value = button.getAttribute('data-email') || '';
  document.getElementById('editGuestPhone').value = button.getAttribute('data-phone') || '';
  document.getElementById('editGuestIdType').value = button.getAttribute('data-idtype') || '';
  document.getElementById('editGuestIdNumber').value = button.getAttribute('data-idnumber') || '';
  document.getElementById('editGuestAddress').value = button.getAttribute('data-address') || '';

  editdlg.showModal();
};


// Open Delete Modal
window.openDeleteGuestDialog = function (button) {
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');

    // Update modal content
    document.getElementById('deleteGuestName').textContent = name || '';
    document.getElementById('deleteGuestDialog').classList.remove('hidden');
    document.getElementById('deleteGuestDialog').classList.add('flex');

    // Update form action dynamically
    const form = document.getElementById('deleteGuestForm');
    form.setAttribute('action', `/delete/guest/${id}`);
};

// Close Modal
window.closeDangerModal = function () {
    const modal = document.getElementById('deleteGuestDialog');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
};


document.getElementById('deleteGuestForm').addEventListener('submit', function (e) {
    e.preventDefault(); 

    const form = this;
    const url = form.getAttribute('action');
    const formData = new FormData(form);

    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                closeDangerModal();

                // Reload DataTable dynamically (without refresh)
                $('#guestTable').DataTable().ajax.reload(null, false);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error('Delete failed:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong!'
            });
        });
});
