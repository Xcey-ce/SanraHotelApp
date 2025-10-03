@extends('layouts.app')

@section('title', 'Reservation')
@section('page-title', 'Hostel Front Desk - Reservation')

@section('content')
<div class="grid grid-cols-1 gap-6">
  <!-- Header -->
  <div class="flex items-center justify-between text-white bg-orange-400 rounded-lg shadow p-6">
    <div>
      <p class="text-2xl font-bold">Reservations</p>
      <h2 class="text-lg">Manage Guest Bookings</h2>
    </div>
    <!-- Add Reservation Button -->
    <button onclick="document.getElementById('addReservationModal').classList.remove('hidden')" 
            class="flex items-center gap-2 bg-white text-orange-500 px-4 py-2 rounded-lg shadow hover:bg-orange-100">
      <i data-lucide="plus" class="w-5 h-5"></i>
      <span>New Reservation</span>
    </button>
  </div>
</div>

<!-- Reservation Modal -->
<div id="addReservationModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
  <div class="bg-white w-full max-w-xl rounded-lg shadow-lg p-6 relative">
    <!-- Close Button -->
    <button onclick="document.getElementById('addReservationModal').classList.add('hidden')" 
            class="absolute top-2 right-2 text-gray-500 hover:text-red-500">✕</button>

    <h2 class="text-xl font-bold mb-4 text-orange-600">Add Reservation</h2>

    <form action="{{ route('reservation') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700">Guest Name</label>
        <input type="text" name="name" required class="w-full border rounded p-2 focus:ring-orange-400" />
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Check-in</label>
          <input type="date" name="check_in" required class="w-full border rounded p-2 focus:ring-orange-400" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Check-out</label>
          <input type="date" name="check_out" required class="w-full border rounded p-2 focus:ring-orange-400" />
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm font-medium text-gray-700">Pax</label>
    <input type="number" name="pax" min="1" required 
           class="w-full border rounded p-2 focus:ring-orange-400" />
  </div>
  <div>
    <label class="block text-sm font-medium text-gray-700">Room Number</label>
    <select name="room_number" required class="w-full border rounded p-2">
      <option value="">Select Room</option>
      <option value="0163">Room 0163</option>
      <option value="0241">Room 0241</option>
      <option value="0310">Room 0310</option>
      <!-- Replace with dynamic room list -->
    </select>
  </div>
</div>

      <div>
  <label class="block text-sm font-medium text-gray-700">Additional Request</label>
  <textarea name="additional_request" 
            placeholder="e.g. Extra bed, late checkout, no breakfast"
            class="w-full border rounded p-2 focus:ring-orange-400"></textarea>
</div>

      
      

      <div class="flex justify-end">
        <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">
          Save Reservation
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Recent Reservations -->
<div class="bg-white rounded-lg shadow overflow-hidden mt-6">
  <div class="p-4 border-b flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">Recent Reservations</h2>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full border-collapse text-sm">
      <thead class="bg-orange-100 text-orange-700">
        <tr>
          <th class="px-6 py-3 text-left font-medium">Guest</th>
          <th class="px-6 py-3 text-left font-medium">Room</th>
          <th class="px-6 py-3 text-left font-medium">Check-in</th>
          <th class="px-6 py-3 text-left font-medium">Check-out</th>
          <th class="px-6 py-3 text-left font-medium">Status</th>
          <th class="px-6 py-3 text-left font-medium">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y text-gray-700">
        <!-- Example row -->
        <tr class="hover:bg-orange-50">
          <td class="px-6 py-4">Mark Ompad</td>
          <td class="px-6 py-4">0163</td>
          <td class="px-6 py-4">Sept 16, 2025</td>
          <td class="px-6 py-4">Sept 17, 2025</td>
          <td class="px-6 py-4">
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">Paid</span>
          </td>
          <td class="px-6 py-4 flex gap-2">
            <!-- Replace # with your route, e.g. route('reservation.update', $id) -->
            <form action="#" method="POST">
              @csrf
              <button class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">Check-in</button>
            </form>
            <form action="#" method="POST">
              @csrf
              <button class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">Check-out</button>
            </form>
            <form action="#" method="POST">
              @csrf
              <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Cancel</button>
            </form>
          </td>
        </tr>

        <!-- Repeat for other reservations -->
        <tr class="hover:bg-orange-50">
          <td class="px-6 py-4">Anna Cruz</td>
          <td class="px-6 py-4">0241</td>
          <td class="px-6 py-4">Sept 20, 2025</td>
          <td class="px-6 py-4">Sept 22, 2025</td>
          <td class="px-6 py-4">
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">Pending</span>
          </td>
          <td class="px-6 py-4 flex gap-2">
            <form action="#" method="POST">
              @csrf
              <button class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">Check-in</button>
            </form>
            <form action="#" method="POST">
              @csrf
              <button class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Cancel</button>
            </form>
          </td>
        </tr>

        <tr class="hover:bg-orange-50">
          <td class="px-6 py-4">John Reyes</td>
          <td class="px-6 py-4">0310</td>
          <td class="px-6 py-4">Sept 25, 2025</td>
          <td class="px-6 py-4">Sept 28, 2025</td>
          <td class="px-6 py-4">
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">Cancelled</span>
          </td>
          <td class="px-6 py-4 text-gray-400 text-xs italic">
            No actions available
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


