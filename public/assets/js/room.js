// public/assets/js/room.js
(function () {
  function init() {
    console.log('room.js loaded ✅');

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
       FORM SUBMIT HANDLER
       ========================== */
    const form = document.getElementById('addRoomForm');
    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        alert('Room added successfully!');
        const dlg = document.getElementById('roomDialog');
        if (dlg && typeof dlg.close === 'function') dlg.close();
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
       FILTER ROOMS FUNCTION
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

    /* ==========================
       SEARCH ROOMS FUNCTION
       ========================== */
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
