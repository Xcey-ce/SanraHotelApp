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
    <button command="show-modal" commandfor="reservationDialog"  class="flex items-center gap-2 bg-white text-orange-500 px-4 py-2 rounded-lg shadow hover:bg-orange-100">
      <i data-lucide="plus" class="w-5 h-5"></i>
      <span>Add Reservation</span>
    </button>
  </div>
</div>
<br>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
@endpush

@section('add-modal')
<dialog id="reservationDialog" aria-labelledby="reservation-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
  <el-dialog-backdrop class="fixed inset-0 bg-gray-900/50 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

  <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
    <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
      
      <!-- Header -->
      <div class="bg-orange-600 px-6 pt-5 pb-4 border-b border-gray-700">
        <h3 id="reservation-title" class="text-lg font-semibold text-white">Add Reservation</h3>
        <p class="text-sm text-white">Fill out the form below to add a new reservation.</p>
      </div>

      <!-- Form -->
      <form method="POST" action="" class="bg-gray-800 px-6 pt-4 pb-6">
        @csrf
        <div class="space-y-4">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Full Name</label>
            <input type="text" name="name" id="name" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Date -->
          <div>
            <label for="date" class="block text-sm font-medium text-gray-300">Reservation Date</label>
            <input type="date" name="date" id="date" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Time -->
          <div>
            <label for="time" class="block text-sm font-medium text-gray-300">Time</label>
            <input type="time" name="time" id="time" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Guests -->
          <div>
            <label for="guests" class="block text-sm font-medium text-gray-300">Number of Guests</label>
            <input type="number" name="guests" id="guests" min="1" required
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          </div>

          <!-- Notes -->
          <div>
            <label for="notes" class="block text-sm font-medium text-gray-300">Special Requests</label>
            <textarea name="notes" id="notes" rows="2"
              class="mt-1 block w-full rounded-md bg-gray-700 border border-gray-600 text-white px-3 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
          </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 flex justify-end gap-3 border-t border-gray-700 pt-4">
          <button type="button" command="close" commandfor="reservationDialog"
            class="inline-flex justify-center rounded-md bg-white/10 px-4 py-1 text-sm font-semibold text-white hover:bg-white/20">
            Cancel
          </button>
          <button type="submit"
            class="inline-flex justify-center rounded-md bg-orange-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
            Save Reservation
          </button>
        </div>
      </form>
    </el-dialog-panel>
  </div>
</dialog>
@endsection


