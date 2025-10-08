(function () {
  function init() {
    console.log('room.js loaded');

    /* ==========================
       GLOBAL VARIABLES
       ========================== */
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const storeRoomUrl = document.querySelector('meta[name="store-room-url"]')
      ? document.querySelector('meta[name="store-room-url"]').getAttribute('content')
      : null;

    /* ==========================
       DIALOG OPEN / CLOSE
       ========================== */
    window.roomDialog = function () {
      const dlg = document.getElementById('roomDialog');
      if (dlg && typeof dlg.showModal === 'function') {
        dlg.showModal();
      }
    };

    const closeBtn = document.querySelector('[command="close"][commandfor="roomDialog"]');
    if (closeBtn) {
      closeBtn.addEventListener('click', function () {
        const dlg = document.getElementById('roomDialog');
        if (dlg && typeof dlg.close === 'function') {
          dlg.close();
        }
      });
    }

    /* ==========================
       IMAGE PREVIEW HANDLER
       ========================== */
    const fileInput = document.getElementById('imagePath');
    const previewContainer = document.getElementById('previewContainer');
    const preview = document.getElementById('imagePreview');
    const removeBtn = document.getElementById('removeImageBtn');

    if (fileInput && previewContainer && preview && removeBtn) {
      fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
          };
          reader.readAsDataURL(file);
        } else {
          preview.src = '';
          previewContainer.classList.add('hidden');
        }
      });

      removeBtn.addEventListener('click', () => {
        fileInput.value = '';
        preview.src = '';
        previewContainer.classList.add('hidden');
      });
    }

    /* ==========================
       FILTER & SEARCH
       ========================== */
    window.filterRooms = function (category) {
      const rooms = document.querySelectorAll('.room-card');
      rooms.forEach((room) => {
        if (category === 'all') {
          room.style.display = 'block';
        } else {
          room.style.display = room.classList.contains(category)
            ? 'block'
            : 'none';
        }
      });
    };

    window.searchRooms = function () {
      const input = document.getElementById('roomSearch');
      if (!input) return;

      const searchValue = input.value.toLowerCase();
      const rooms = document.querySelectorAll('.room-card');

      rooms.forEach((room) => {
        const title = room.querySelector('h3')?.textContent.toLowerCase() || '';
        const desc = room.querySelector('p')?.textContent.toLowerCase() || '';
        const price = room.querySelector('span')?.textContent.toLowerCase() || '';

        room.style.display =
          title.includes(searchValue) ||
          desc.includes(searchValue) ||
          price.includes(searchValue)
            ? 'block'
            : 'none';
      });
    };
  }

  // Run after DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

function openEditRoomDialog(id, number, name, type, capacity, price, status, description, amenities, imagePath) {
  const dialog = document.getElementById('editRoomDialog');
  const form = document.getElementById('editRoomForm');

  form.action = `/rooms/update/${id}`;

  // Fill fields
  document.getElementById('id').value = id;
  document.getElementById('editRoomNumber').value = number;
  document.getElementById('editRoomName').value = name;
  document.getElementById('editType').value = type;
  document.getElementById('editCapacity').value = capacity;
  document.getElementById('editPrice').value = price;
  document.getElementById('editStatus').value = status;
  document.getElementById('editDescription').value = description;
  document.getElementById('editAmenities').value = amenities;
  document.getElementById('roomNumber').textContent = number;

  // ✅ Show old image preview
  const editPreviewImg = document.getElementById('editImagePreview');
  const editPreviewContainer = document.getElementById('editPreviewContainer');

  if (imagePath) {
    editPreviewImg.src = imagePath; 
    editPreviewImg.classList.remove("hidden");
    editPreviewContainer.classList.remove("hidden");
  } else {
    editPreviewImg.src = "";
    editPreviewImg.classList.add("hidden");
    editPreviewContainer.classList.add("hidden");
  }
    // Clear file input (so user must pick new one if they want to change)
  document.getElementById('editImagePath').value = "";

  // Show modal
  dialog.showModal();
}

function initEditImagePreview() {
  const fileInput = document.getElementById("editImagePath");
  const previewContainer = document.getElementById("editPreviewContainer");
  const previewImg = document.getElementById("editImagePreview");
  const removeBtn = document.getElementById("removeImageBtn");

  if (!fileInput || !previewImg || !removeBtn) return;

  // When selecting a new file → show preview
  fileInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImg.src = e.target.result; // show new image
        previewImg.classList.remove("hidden");
        previewContainer.classList.remove("hidden");
      };
      reader.readAsDataURL(file);
    }
  });

  // Remove/reset image
  removeBtn.addEventListener("click", function () {
    fileInput.value = "";
    previewImg.src = "";
    previewImg.classList.add("hidden");
    previewContainer.classList.add("hidden");
  });
}

function openDeleteRoomDialog(id, name) {
  const deleteDialog = document.getElementById('deleteRoomDialog');
  const deleteForm = document.getElementById('deleteRoomForm');

  // set action + name
  deleteForm.action = `/rooms/delete/${id}`;
  document.getElementById('deleteRoomName').textContent = name;

  // show modal
  deleteDialog.classList.remove('hidden');
  deleteDialog.classList.add('flex');
}

function closeDangerModal() {
  const deleteDialog = document.getElementById('deleteRoomDialog');
  deleteDialog.classList.add('hidden');
  deleteDialog.classList.remove('flex');
}

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

  setupReservationLogic({
    roomInputId: 'room_id',
    checkInId: 'check_in_date',
    checkOutId: 'check_out_date',
    roomNumberId: 'roomnumber',
    totalId: 'total_amount',
    depositId: 'deposit_amount',
    balanceId: 'balance_amount'
  });
});

