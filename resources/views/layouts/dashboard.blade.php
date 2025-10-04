@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Hospitality Management Hostel PMS')

@section('content')
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Reservations -->
    <div class="bg-white shadow rounded-lg p-6 text-center">
      <h3 class="text-sm font-medium text-gray-500">Reservations Today</h3>
      <p class="text-2xl font-bold text-orange-600 mt-2">12</p>
    </div>

    <!-- Check-In Today -->
    <div class="bg-white shadow rounded-lg p-6 text-center">
      <h3 class="text-sm font-medium text-gray-500">Check-Ins Today</h3>
      <p class="text-2xl font-bold text-green-600 mt-2">8</p>
    </div>

    <!-- Check-Out Today -->
    <div class="bg-white shadow rounded-lg p-6 text-center">
      <h3 class="text-sm font-medium text-gray-500">Check-Outs Today</h3>
      <p class="text-2xl font-bold text-red-600 mt-2">5</p>
    </div>

    <!-- Available Rooms -->
    <div class="bg-white shadow rounded-lg p-6 text-center">
      <h3 class="text-sm font-medium text-gray-500">Available Rooms</h3>
      <p class="text-2xl font-bold text-blue-600 mt-2">24</p>
    </div>
  </div>

  <!-- Recent Reservations Table -->
  <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b">
      <h2 class="text-lg font-semibold">Recent Reservations</h2>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse">
        <thead class="bg-orange-100 text-orange-700">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-medium">Guest</th>
            <th class="px-6 py-3 text-left text-sm font-medium">Room</th>
            <th class="px-6 py-3 text-left text-sm font-medium">Check-in</th>
            <th class="px-6 py-3 text-left text-sm font-medium">Check-out</th>
            <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          <tr class="transition duration-300 hover:bg-orange-50">
            <td class="px-6 py-4">Mark Ompad</td>
            <td class="px-6 py-4">0163</td>
            <td class="px-6 py-4">September 16, 2025</td>
            <td class="px-6 py-4">September 17, 2025</td>
            <td class="px-6 py-4">
              <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Paid</span>
            </td>
          </tr>
          <tr class="transition duration-300 hover:bg-orange-50">
            <td class="px-6 py-4">Jane Dela Cruz</td>
            <td class="px-6 py-4">0210</td>
            <td class="px-6 py-4">September 18, 2025</td>
            <td class="px-6 py-4">September 20, 2025</td>
            <td class="px-6 py-4">
              <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">Pending</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Billing Overview -->
  <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white shadow rounded-lg p-6 text-center">
      <h3 class="text-sm font-medium text-gray-500">Today's Revenue</h3>
      <p class="text-2xl font-bold text-orange-600 mt-2">₱12,500</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
      <h3 class="text-sm font-medium text-gray-500">Outstanding Balance</h3>
      <p class="text-2xl font-bold text-red-600 mt-2">₱3,200</p>
    </div>
    <div class="bg-white shadow rounded-lg p-6 text-center">
      <h3 class="text-sm font-medium text-gray-500">Recent Payments</h3>
      <p class="text-2xl font-bold text-green-600 mt-2">₱8,000</p>
    </div>
  </div>

  <!-- Mini Calendar -->
  <div class="mt-8 bg-white shadow rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Upcoming Reservations (Calendar)</h2>
    <div id="calendar"></div>
  </div>
@endsection

@push('scripts')
  <!-- FullCalendar JS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 500,
        events: [
          {
            title: 'Mark Ompad - Room 0163',
            start: '2025-09-16',
            end: '2025-09-17',
            color: '#f97316'
          },
          {
            title: 'Jane Dela Cruz - Room 0210',
            start: '2025-09-18',
            end: '2025-09-20',
            color: '#22c55e'
          }
        ]
      });
      calendar.render();
    });
  </script>
@endpush