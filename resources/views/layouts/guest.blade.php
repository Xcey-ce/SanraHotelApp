@extends('layouts.app')

@section('title', 'Guest')

@section('page-title', 'Hospitality Management Hostel PMS')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
  <div class="flex items-center justify-between text-white bg-orange-400 rounded-lg shadow p-6">
    <div>
      <p class="text-2xl font-bold">GUESTS</p>
      <h2 class="text-lg">Guests Management</h2>
    </div>
  </div>
</div>

<!-- Guest List Section -->
<div class="mt-8">
  <!-- Filters + Search -->
  <div class="flex flex-wrap gap-3 mb-6 items-center">
    <button onclick="filterGuests('all')" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-500">All</button>
    <button onclick="filterGuests('checkedin')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Checked-in</button>
    <button onclick="filterGuests('checkedout')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-orange-500 hover:text-white">Checked-out</button>

    <div class="flex ml-auto">
      <input type="text" id="guestSearch" placeholder="Search guests..." 
             class="px-3 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
      <button onclick="searchGuests()" 
          class="px-4 py-2 bg-orange-600 text-white rounded-r-lg hover:bg-orange-500">Search</button>
    </div>
  </div>

  <!-- Guests Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Guest Card -->
    <div class="guest-card checkedin bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800">Che Matillano</h3>
        <p class="text-gray-600 mt-2">Room 0163 • 2 Nights</p>
        <p class="text-sm text-gray-500">Check-in: Sept 16, 2025</p>
        <p class="text-sm text-gray-500">Check-out: Sept 18, 2025</p>
        <div class="flex justify-between items-center mt-4">
          <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Checked-in</span>
          <div class="flex gap-2">
            <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-500 text-sm">View</a>
            <a href="#" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-500 text-sm">Checkout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Another Guest -->
    <div class="guest-card checkedout bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
      <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-800">Anna Cruz</h3>
        <p class="text-gray-600 mt-2">Room 0241 • 1 Night</p>
        <p class="text-sm text-gray-500">Check-in: Sept 18, 2025</p>
        <p class="text-sm text-gray-500">Check-out: Sept 19, 2025</p>
        <div class="flex justify-between items-center mt-4">
          <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">Checked-out</span>
          <div class="flex gap-2">
            <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-500 text-sm">View</a>
            <a href="#" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-500 text-sm">Delete</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
