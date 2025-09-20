@extends('layouts.app')

@section('title', 'Reservation')

@section('page-title', 'Hotel property management system')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
  <div class="flex items-center justify-between text-white bg-orange-400 rounded-lg shadow p-6">
    <div>
      <p class="text-2xl font-bold">RESERVATION</p>
      <h2 class="text-lg">Available Rooms</h2>
    </div>
    <button class="flex items-center gap-2 bg-white text-orange-500 px-4 py-2 rounded-lg shadow hover:bg-orange-100">
      <i data-lucide="plus" class="w-5 h-5"></i>
      <span>Add Reservation</span>
    </button>

  </div>
</div>


  <!-- Recent Reservations Table -->
  <div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b flex justify-between items-center">
      <h2 class="text-lg font-semibold text-gray-800">Recent Reservations</h2>
      <a href="{{ route('reservation') }}" class="text-orange-600 text-sm font-medium hover:underline">
        View All
      </a>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse text-sm">
        <thead class="bg-orange-100 text-orange-700">
          <tr>
            <th class="px-6 py-3 text-left font-medium">Guest Name</th>
            <th class="px-6 py-3 text-left font-medium">Room No.</th>
            <th class="px-6 py-3 text-left font-medium">Check-in</th>
            <th class="px-6 py-3 text-left font-medium">Check-out</th>
            <th class="px-6 py-3 text-left font-medium">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y text-gray-700">
          <tr class="transition duration-300 hover:bg-orange-50">
            <td class="px-6 py-4">Mark Ompad</td>
            <td class="px-6 py-4">0163</td>
            <td class="px-6 py-4">September 16, 2025</td>
            <td class="px-6 py-4">September 17, 2025</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                Paid
              </span>
            </td>
          </tr>
          <tr class="transition duration-300 hover:bg-orange-50">
            <td class="px-6 py-4">Anna Cruz</td>
            <td class="px-6 py-4">0241</td>
            <td class="px-6 py-4">September 20, 2025</td>
            <td class="px-6 py-4">September 22, 2025</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                Pending
              </span>
            </td>
          </tr>
          <tr class="transition duration-300 hover:bg-orange-50">
            <td class="px-6 py-4">John Reyes</td>
            <td class="px-6 py-4">0310</td>
            <td class="px-6 py-4">September 25, 2025</td>
            <td class="px-6 py-4">September 28, 2025</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                Cancelled
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
