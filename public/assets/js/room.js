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


