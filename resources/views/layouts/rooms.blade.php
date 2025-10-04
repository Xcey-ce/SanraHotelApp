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
      <button onclick="roomDialog()" 
          class="flex items-center gap-2 bg-white text-orange-500 px-4 py-2 rounded-lg shadow hover:bg-orange-100">
      <i data-lucide="plus" class="w-5 h-5"></i>
      <span>Add Room</span>
    </button>
  </div>
</div>

<!-- Category Buttons -->
<div class="mt-8">
  <div class="flex flex-wrap gap-3 mb-6 items-center">
    <button onclick="filterRooms('all')" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-500">All</button>
    <button onclick="filterRooms('standard')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Standard</button>
    <button onclick="filterRooms('deluxe')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Deluxe</button>
    <button onclick="filterRooms('premier-deluxe')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-o  range-500 hover:text-white">Premier Deluxe</button>
    <button onclick="filterRooms('family')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Family</button>
    <button onclick="filterRooms('premier-family')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-o  range-500 hover:text-white">Premier Family</button>
    <button onclick="filterRooms('executive')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Executive</button>
    <button onclick="filterRooms('presidential')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-o  range-500 hover:text-white">Presidential Suite</button>

  <!-- Search -->
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
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <div class="room-card presidential bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300 relative" x-data="{ open: false }">
      <img src="https://assets.hyatt.com/content/dam/hyatt/hyattdam/images/2018/01/22/1544/Park-Hyatt-New-York-P499-Presidential-Suite-Living-Room.jpg" 
          alt="Presidential Suite" class="w-full h-48 object-cover">

      <!-- 3 dots button -->
      <div class="absolute top-3 right-3">
        <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-200 focus:outline-none">
          ⋮
        </button>

        <!-- Popover (hidden until clicked) -->
          <div x-show="open" 
              @click.away="open = false" 
              x-transition 
              class="absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-lg py-2 z-50">
              <a href="#edit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
              <a href="#delete" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a>
            </div>
        </div>

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
    @endsection

@section('add-modal')
<dialog id="roomDialog" aria-labelledby="room-title" 
  class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">

  <el-dialog-backdrop 
    class="fixed inset-0 bg-gray-900/50 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in">
  </el-dialog-backdrop>

  <div tabindex="0" 
    class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
    
    <el-dialog-panel 
      class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all sm:my-8 sm:w-full sm:max-w-5xl data-closed:sm:translate-y-0 data-closed:sm:scale-95">
      
      <!-- Header -->
      <div class="bg-orange-600 px-6 pt-5 pb-4 border-b border-gray-700">
        <h3 id="room-title" class="text-xl font-semibold text-white">Add New Room</h3>
        <p class="text-sm text-white">Fill out the details to add a new room to the hotel.</p>
      </div>

      <!-- Form -->
      <form method="POST" action="" class="bg-gray-800 px-6 pt-4 pb-6">
        @csrf

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-4">
          <!-- Room Number -->
          <div>
            <label for="room_number" class="block text-sm font-medium text-gray-300">Room Number</label>
            <input type="text" name="roomnumber" id="room_number" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Room Name -->
          <div>
            <label for="room_name" class="block text-sm font-medium text-gray-300">Room Name</label>
            <input type="text" name="roomname" id="room_name" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Room Type -->
          <div>
            <label for="type" class="block text-sm font-medium text-gray-300">Room Type</label>
            <select name="type" id="type" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="" disabled selected>-- Select Room Type --</option>
                <option value="standard">Standard</option>
                <option value="deluxe">Deluxe</option>
                <option value="premiere deluxe">Premiere Deluxe</option>
                <option value="family">Family</option>
                <option value="premiere family">Premiere Family</option>
                <option value="executive">Executive</option>
                <option value="presidential suite">Presidential Suite</option>
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

          <!-- Description -->
          <div>
            <label for="description" class="block text-sm font-medium text-gray-300">Room Description</label>
            <textarea name="description" id="description" rows="2" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
              placeholder="Enter room description here..."></textarea>
          </div>

          <!-- Amenities -->
          <div>
            <label for="amenities" class="block text-sm font-medium text-gray-300">Room Amenities</label>
            <textarea name="amenities" id="amenities" rows="2" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"
              placeholder="Enter room amenities here..."></textarea>
          </div>
        </div>

        <!-- Image Upload -->
        <div class="w-full">
          <label for="imagePath" class="block text-sm font-medium text-gray-300">Image</label>

          <input 
            type="file" 
            name="image_path" 
            id="imagePath" 
            accept="image/*"
            class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >

          <!-- Preview container -->
          <div id="previewContainer" class="relative mt-3 hidden">
            <img id="imagePreview" src="" alt="Preview" 
                class="w-full max-h-64 object-contain rounded-md border border-gray-600">

            <!-- X Button -->
            <button type="button" id="removeImageBtn"
                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 focus:outline-none">
              ✕
            </button>
          </div>
        </div>
        <!-- Footer -->
        <div class="mt-6 flex justify-end gap-3 border-t border-gray-700 pt-4">
          <button type="button" command="close" commandfor="roomDialog"
            class="inline-flex justify-center rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20">
            Cancel
          </button>
          <button type="submit"
            class="inline-flex justify-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-500">
            Save Room
          </button>
        </div>
      </form>
    </el-dialog-panel>
  </div>
</dialog>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
<script src="{{ asset('assets/js/room.js')}}?v={{ time() }}"></script>
@endpush

