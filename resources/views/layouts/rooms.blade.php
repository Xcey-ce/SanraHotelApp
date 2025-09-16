@extends('layouts.app')

@section('title', 'Rooms')

@section('page-title', 'Rooms')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
    <div class=" text-white bg-orange-400 rounded-lg shadow p-6 transform transition duration-500 hover:scale-105">
      <p class="text-2xl font-bold">ROOMS</p>
      <h2 class="text-lg">Availables Rooms</h2>
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
