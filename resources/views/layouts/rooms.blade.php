@extends('layouts.app')

@section('title', 'Rooms')

@section('page-title', 'Hospitality Management Hostel PMS')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
  <div class="flex items-center justify-between text-white bg-orange-400 rounded-lg shadow p-6">
    <div>
      <p class="text-2xl font-bold">ROOMS</p>
      <h2 class="text-lg">Available Rooms</h2>
    </div>
    <button onclick="openRoomModal()" 
      class="flex items-center gap-2 bg-white text-orange-500 px-4 py-2 rounded-lg shadow hover:bg-orange-100">
      <i data-lucide="plus" class="w-5 h-5"></i>
      <span>Add Room</span>
    </button>
  </div>
</div>

<!-- Category Buttons + Search -->
<div class="mt-8">
  <div class="flex flex-wrap gap-3 mb-6 items-center">
    <button onclick="filterRooms('all')" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-500">All</button>
    <button onclick="filterRooms('deluxe')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Deluxe</button>
    <button onclick="filterRooms('executive')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Executive</button>
    <button onclick="filterRooms('presidential')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Presidential</button>

    <div class="flex ml-auto">
      <input type="text" id="roomSearch" placeholder="Search rooms..." 
             class="px-3 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
      <button onclick="searchRooms()" 
          class="px-4 py-2 bg-orange-600 text-white rounded-r-lg hover:bg-orange-500">Search</button>
    </div>
  </div>

  <!-- Rooms Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Deluxe Room -->
    <div class="room-card deluxe bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
      <img src="https://www.thebiltmorehotels.com/mhb-media/biltmore/assets/images/king-grand-deluxe-room-bedroom.jpg" alt="Deluxe Room" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800">Deluxe Room</h3>
        <p class="text-gray-600 mt-2">A cozy deluxe room with a queen-sized bed, free Wi-Fi, and a private balcony.</p>
        <div class="flex justify-between items-center mt-4">
          <span class="text-lg font-bold text-orange-600">₱1200 / night</span>
          <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition">Book Now</a>
        </div>
      </div>
    </div>

    <!-- Executive Suite -->
    <div class="room-card executive bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
      <img src="https://a-hotel-izvor.com/image13869.png" alt="Executive Suite" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800">Executive Suite</h3>
        <p class="text-gray-600 mt-2">Spacious suite with king bed, living area, minibar, and panoramic city views.</p>
        <div class="flex justify-between items-center mt-4">
          <span class="text-lg font-bold text-orange-600">₱2500 / night</span>
          <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition">Book Now</a>
        </div>
      </div>
    </div>

    <!-- Presidential Suite -->
    <div class="room-card presidential bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
      <img src="https://assets.hyatt.com/content/dam/hyatt/hyattdam/images/2018/01/22/1544/Park-Hyatt-New-York-P499-Presidential-Suite-Living-Room.jpg" alt="Presidential Suite" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800">Presidential Suite</h3>
        <p class="text-gray-600 mt-2">Ultimate luxury suite with private jacuzzi, office space, and 24/7 butler service.</p>
        <div class="flex justify-between items-center mt-4">
          <span class="text-lg font-bold text-orange-600">₱5000 / night</span>
          <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition">Book Now</a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- ADD ROOM MODAL -->
<div id="addRoomModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
    <h2 class="text-2xl font-semibold mb-4 text-orange-600">Add Room</h2>

    <form id="addRoomForm" class="space-y-3">
      <!-- Room Name -->
      <div>
        <label class="block font-medium">Room Name</label>
        <input type="text" name="room_name" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-orange-500">
      </div>

      <!-- Room Type -->
      <div>
        <label class="block font-medium">Room Type</label>
        <select name="room_type" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-orange-500">
          <option value="">-- Select Type --</option>
          <option value="deluxe">Deluxe</option>
          <option value="executive">Executive</option>
          <option value="presidential">Presidential</option>
        </select>
      </div>

      <!-- Price -->
      <div>
        <label class="block font-medium">Price per Night (₱)</label>
        <input type="number" name="price" min="0" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-orange-500">
      </div>

      <!-- Description -->
      <div>
        <label class="block font-medium">Description</label>
        <textarea name="description" rows="2" required class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-orange-500"></textarea>
      </div>

      <!-- Upload Image -->
      <div>
        <label class="block font-medium">Upload Image</label>
        <input type="file" accept="image/*" onchange="previewRoomImage(event)" class="w-full">
        <img id="roomImagePreview" class="mt-2 rounded-lg shadow hidden w-full h-40 object-cover" />
      </div>

      <!-- Amenities -->
      <div>
        <label class="block font-medium mb-1">Amenities</label>
        <div class="grid grid-cols-2 gap-2 text-sm">
          <label><input type="checkbox" name="amenities[]" value="Wi-Fi" class="mr-1"> Wi-Fi</label>
          <label><input type="checkbox" name="amenities[]" value="TV" class="mr-1"> TV</label>
          <label><input type="checkbox" name="amenities[]" value="Aircon" class="mr-1"> Aircon</label>
          <label><input type="checkbox" name="amenities[]" value="Balcony" class="mr-1"> Balcony</label>
          <label><input type="checkbox" name="amenities[]" value="Mini Bar" class="mr-1"> Mini Bar</label>
          <label><input type="checkbox" name="amenities[]" value="Hot Shower" class="mr-1"> Hot Shower</label>
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end gap-2 mt-4">
        <button type="button" onclick="closeRoomModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
        <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-500">Save</button>
      </div>
    </form>

    <button onclick="closeRoomModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black">&times;</button>
  </div>
</div>

<script>
  function openRoomModal() {
    document.getElementById('addRoomModal').classList.remove('hidden');
  }

  function closeRoomModal() {
    document.getElementById('addRoomModal').classList.add('hidden');
    document.getElementById('addRoomForm').reset();
    document.getElementById('roomImagePreview').classList.add('hidden');
  }

  function previewRoomImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
      const output = document.getElementById('roomImagePreview');
      output.src = reader.result;
      output.classList.remove('hidden');
    }
    reader.readAsDataURL(event.target.files[0]);
  }

  // Dummy submit handler
  document.getElementById('addRoomForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert('Room added successfully!');
    closeRoomModal();
  });

  function filterRooms(category) {
    let rooms = document.querySelectorAll('.room-card');
    rooms.forEach(room => {
      if (category === 'all') {
        room.style.display = 'block';
      } else {
        room.style.display = room.classList.contains(category) ? 'block' : 'none';
      }
    });
  }

  function searchRooms() {
    let input = document.getElementById('roomSearch').value.toLowerCase();
    let rooms = document.querySelectorAll('.room-card');
    rooms.forEach(room => {
      let title = room.querySelector('h3').textContent.toLowerCase();
      let desc = room.querySelector('p').textContent.toLowerCase();
      let price = room.querySelector('span').textContent.toLowerCase();
      room.style.display = (title.includes(input) || desc.includes(input) || price.includes(input)) ? 'block' : 'none';
    });
  }
</script>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
@endpush

@section('add-modal')
<dialog id="roomDialog" aria-labelledby="room-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
  <el-dialog-backdrop class="fixed inset-0 bg-gray-900/50 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

  <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
    <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
      
      <!-- Header -->
      <div class="bg-orange-600 px-6 pt-5 pb-4 border-b border-gray-700">
        <h3 id="room-title" class="text-lg font-semibold text-white">Add New Room</h3>
        <p class="text-sm text-white">Fill out the details to add a new room to the hotel.</p>
      </div>

      <!-- Form -->
      <form method="POST" action="" class="bg-gray-800 px-6 pt-4 pb-6">
        @csrf
        <div class="space-y-4">
          <!-- Room Number -->
          <div>
            <label for="room_number" class="block text-sm font-medium text-gray-300">Room Number</label>
            <input type="text" name="room_number" id="room_number" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Room Type -->
          <div>
            <label for="room_type" class="block text-sm font-medium text-gray-300">Room Type</label>
            <select name="room_type" id="room_type" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              <option value="">Select type</option>
              <option value="single">Single</option>
              <option value="double">Double</option>
              <option value="suite">Suite</option>
              <option value="deluxe">Deluxe</option>
            </select>
          </div>

          <!-- Capacity -->
          <div>
            <label for="capacity" class="block text-sm font-medium text-gray-300">Capacity</label>
            <input type="number" name="capacity" id="capacity" min="1" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Price Per Night -->
          <div>
            <label for="price" class="block text-sm font-medium text-gray-300">Price Per Night</label>
            <input type="number" step="0.01" name="price" id="price" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Status -->
          <div>
            <label for="status" class="block text-sm font-medium text-gray-300">Status</label>
            <select name="status" id="status" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              <option value="available">Available</option>
              <option value="occupied">Occupied</option>
              <option value="maintenance">Maintenance</option>
            </select>
          </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 flex justify-end gap-3 border-t border-gray-700 pt-4">
          <button type="button" command="close" commandfor="roomDialog"
            class="inline-flex justify-center rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20">
            Cancel
          </button>
          <button type="submit"
            class="inline-flex justify-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
            Save Room
          </button>
        </div>
      </form>
    </el-dialog-panel>
  </div>
</dialog>
@endsection

