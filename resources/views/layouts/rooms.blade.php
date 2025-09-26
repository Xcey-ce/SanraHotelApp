@extends('layouts.app')

@section('title', 'Rooms')

@section('page-title', 'Rooms')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
  <div class="flex items-center justify-between text-white bg-orange-400 rounded-lg shadow p-6">
    <div>
      <p class="text-2xl font-bold">ROOMS</p>
      <h2 class="text-lg">Available Rooms</h2>
    </div>
    <button command="show-modal" commandfor="roomDialog" class="flex items-center gap-2 bg-white text-orange-500 px-4 py-2 rounded-lg shadow hover:bg-orange-100">
      <i data-lucide="plus" class="w-5 h-5"></i>
      <span>Add Room</span>
    </button>

  </div>
</div>


<!-- Recent Reservations Table -->
<div class="mt-8">
  <!-- Category Buttons + Search -->
  <div class="flex flex-wrap gap-3 mb-6 items-center">
    <!-- Category Buttons -->
    <button onclick="filterRooms('all')" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-500">All</button>
    <button onclick="filterRooms('deluxe')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Deluxe</button>
    <button onclick="filterRooms('executive')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Executive</button>
    <button onclick="filterRooms('presidential')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Presidential</button>

    <!-- Search Box -->
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
      <img src="https://www.thebiltmorehotels.com/mhb-media/biltmore/assets/images/king-grand-deluxe-room-bedroom.jpg?rev=58134523104c4d68801ae5820cb5f576&hash=D76172EA1787DDD5DB6381AE8AA5845C" alt="Deluxe Room" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800">Deluxe Room</h3>
        <p class="text-gray-600 mt-2">A cozy deluxe room with a queen-sized bed, free Wi-Fi, and a private balcony.</p>
        <div class="flex justify-between items-center mt-4">
          <span class="text-lg font-bold text-orange-600">$120 / night</span>
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
          <span class="text-lg font-bold text-orange-600">$250 / night</span>
          <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition">Book Now</a>
        </div>
      </div>
    </div>

    <!-- Presidential Suite -->
    <div class="room-card presidential bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
      <img src="https://assets.hyatt.com/content/dam/hyatt/hyattdam/images/2018/01/22/1544/Park-Hyatt-New-York-P499-Presidential-Suite-Living-Room.jpg/Park-Hyatt-New-York-P499-Presidential-Suite-Living-Room.16x9.jpg?imwidth=1920" alt="Presidential Suite" class="w-full h-48 object-cover">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800">Presidential Suite</h3>
        <p class="text-gray-600 mt-2">Ultimate luxury suite with private jacuzzi, office space, and 24/7 butler service.</p>
        <div class="flex justify-between items-center mt-4">
          <span class="text-lg font-bold text-orange-600">$500 / night</span>
          <a href="#" class="bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-500 transition">Book Now</a>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  function filterRooms(category) {
    let rooms = document.querySelectorAll('.room-card');
    rooms.forEach(room => {
      if (category === 'all') {
        room.style.display = 'block';
      } else {
        if (room.classList.contains(category)) {
          room.style.display = 'block';
        } else {
          room.style.display = 'none';
        }
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
      if (title.includes(input) || desc.includes(input) || price.includes(input)) {
        room.style.display = 'block';
      } else {
        room.style.display = 'none';
      }
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

