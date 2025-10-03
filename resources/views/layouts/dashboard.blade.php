@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Hospitality Management Hostel PMS')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6">
    <div class=" text-white bg-orange-400 rounded-lg shadow p-6">
      <p class="text-2xl font-bold">Dashboard Overview</p>
      <h2 class="text-lg">Data and Statistics</h2>
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
            Paid
            <span class="px-2 py-1 text-sm rounded"></span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
