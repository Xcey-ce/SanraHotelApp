// ✅ Make it global
window.reservationTable = null;

$(document).ready(function() {
  window.reservationTable = $('#reservationTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/get-reservation/data',
    columns: [
      { data: 'id', name: 'id', searchable: true },
      { data: 'guest_name', name: 'guest_name', searchable: true, className: 'whitespace-nowrap px-4 py-2' },
      { data: 'room_number', name: 'room_number', searchable: true, className: 'whitespace-nowrap px-4 py-2' },
      { data: 'check_in_date', name: 'check_in_date', searchable: false, className: 'whitespace-nowrap px-4 py-2' },
      { data: 'check_out_date', name: 'check_out_date', searchable: false, className: 'whitespace-nowrap px-4 py-2' },
      { data: 'stay_duration', name: 'stay_duration', orderable: false, searchable: false },
      { data: 'total_amount', name: 'total_amount', searchable: false, className: 'whitespace-nowrap px-4 py-2' },
      { data: 'deposit_amount', name: 'deposit_amount' },
      { data: 'status', name: 'status', searchable: true },
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

document.addEventListener('DOMContentLoaded', function() {
  ['guest_id', 'editGid'].forEach(id => {
    const input = document.getElementById(id);
    if (!input) return; 

    input.addEventListener('input', function() {
      const guestId = this.value;

      const nameFieldId = (this.id === 'guest_id') ? 'guest_name' : 'editGname';
      const nameField = document.getElementById(nameFieldId);

      if (!nameField) return;

      if (guestId) {
        fetch(`/get-guest/${guestId}`)
          .then(response => response.json())
          .then(data => {
            nameField.value = data ? data.name || 'Unknown Guest' : '';
          })
          .catch(() => {
            nameField.value = '';
          });
      } else {
        nameField.value = '';
      }
    });
  });

});

document.addEventListener('DOMContentLoaded', function() {

  function setupReservationLogic({
    roomInputId,
    checkInId,
    checkOutId,
    roomNumberId,
    totalId,
    depositId,
    balanceId
  }) {
    const roomInput = document.getElementById(roomInputId);
    const checkInInput = document.getElementById(checkInId);
    const checkOutInput = document.getElementById(checkOutId);
    const roomNumberInput = document.getElementById(roomNumberId);
    const totalInput = document.getElementById(totalId);
    const depositInput = document.getElementById(depositId);
    const balanceInput = document.getElementById(balanceId);

    // Skip if required elements not found
    if (!roomInput || !checkInInput || !checkOutInput) return;

    let roomPrice = 0;

    // --- Room auto-fill logic ---
    roomInput.addEventListener('input', function() {
      const roomId = this.value;

      if (roomId) {
        fetch(`/get-room/${roomId}`)
          .then(response => response.json())
          .then(data => {
            if (data) {
              if (data.status && data.status.toLowerCase() !== 'available') {
                roomNumberInput.value = 'Not Available';
                roomNumberInput.style.color = 'red';
                totalInput.value = '';
                roomPrice = 0;
              } else {
                roomNumberInput.value = data.roomnumber || 'Unknown Room';
                roomNumberInput.style.color = 'white';
                roomPrice = data.price ? parseFloat(data.price) : 0;
                updateTotalAmount();
              }
            } else {
              roomNumberInput.value = 'Unknown Room';
              totalInput.value = '';
              roomPrice = 0;
            }
          })
          .catch(() => {
            roomNumberInput.value = '';
            totalInput.value = '';
            roomPrice = 0;
          });
      } else {
        roomNumberInput.value = '';
        totalInput.value = '';
        roomPrice = 0;
      }
    });

    // --- Date change triggers recalculation ---
    checkInInput.addEventListener('change', updateTotalAmount);
    checkOutInput.addEventListener('change', updateTotalAmount);

    // --- Deposit / total updates balance ---
    depositInput.addEventListener('input', updateBalance);
    totalInput.addEventListener('input', updateBalance);

    // --- Calculate total (based on nights × price) ---
    function updateTotalAmount() {
      const checkIn = new Date(checkInInput.value);
      const checkOut = new Date(checkOutInput.value);

      if (roomPrice > 0 && checkIn && checkOut && checkOut > checkIn) {
        const timeDiff = checkOut - checkIn;
        const nights = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        const total = nights * roomPrice;
        totalInput.value = total.toFixed(2);
      } else {
        totalInput.value = '';
      }

      updateBalance();
    }

    // --- Calculate balance ---
    function updateBalance() {
      const total = parseFloat(totalInput.value) || 0;
      const deposit = parseFloat(depositInput.value) || 0;
      balanceInput.value = (total - deposit).toFixed(2);
    }
  }

  // --- Apply to ADD Reservation Form (IDs from your main form) ---
  setupReservationLogic({
    roomInputId: 'room_id',
    checkInId: 'check_in_date',
    checkOutId: 'check_out_date',
    roomNumberId: 'roomnumber',
    totalId: 'total_amount',
    depositId: 'deposit_amount',
    balanceId: 'balance_amount'
  });

  // --- Apply to EDIT Reservation Dialog (IDs from your dialog above) ---
  setupReservationLogic({
    roomInputId: 'editRoomId',
    checkInId: 'editCheck_in_date',
    checkOutId: 'editCheck_out_date',
    roomNumberId: 'editRoomNumber',
    totalId: 'editTotal_amount',
    depositId: 'editDeposit_amount',
    balanceId: 'editBalance_amount'
  });

});

window.editReservationDialog = function (button) {
  const editdlg = document.getElementById('editReservationDialog');
  const form = document.getElementById('editReservationForm');

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
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });

      const data = await response.json();

      if (data.status === 'success') {
        editdlg.close();

        Swal.fire({
          icon: 'success',
          title: 'Updated!',
          text: data.message,
          timer: 1500,
          showConfirmButton: false
        });

        if (window.reservationTable) {
          window.reservationTable.ajax.reload(null, false);
        }

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

  // Populate modal fields...
  const id = button.getAttribute('data-id');
  form.action = `/update/reservation/${id}`;
  document.getElementById('reservationId').textContent = id || '';
  document.getElementById('editReservationId').value = id || '';
  document.getElementById('editGid').value = button.getAttribute('data-guest') || '';
  document.getElementById('editGname').value = button.getAttribute('data-guestname') || '';
  document.getElementById('editRoomId').value = button.getAttribute('data-room') || '';
  document.getElementById('editRoomNumber').value = button.getAttribute('data-rnumber') || '';
  document.getElementById('editCheck_in_date').value = button.getAttribute('data-checkin') || '';
  document.getElementById('editCheck_out_date').value = button.getAttribute('data-checkout') || '';
  document.getElementById('editTotal_amount').value = button.getAttribute('data-amount') || '';
  document.getElementById('editDeposit_amount').value = button.getAttribute('data-depamount') || '';
  document.getElementById('editBalance_amount').value = button.getAttribute('data-balance') || '';
  document.getElementById('editStatus').value = button.getAttribute('data-status') || '';

  editdlg.showModal();
};
