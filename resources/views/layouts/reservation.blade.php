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
    <button onclick="document.getElementById('reservationDialog').showModal()" 
            class="flex items-center gap-2 bg-white text-orange-500 px-4 py-2 rounded-lg shadow hover:bg-orange-100">
      <i data-lucide="plus" class="w-5 h-5"></i>
      <span>New Reservation</span>
    </button>
  </div>
</div>

<!-- Reservation Modal -->
<div id="addReservationModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden">
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
<div class="bg-white rounded-lg shadow overflow-hidden mt-6 p-2">
   <div class="flex justify-between items-center border-b pb-2 mb-4">
    <h2 class="text-lg font-semibold text-gray-800">Recent Reservations</h2>
  </div>
  <div class="overflow-x-auto">
   <table id="reservationTable" class="border-collapse text-sm mx-auto w-auto min-w-[600px] border border-gray-300 divide-y divide-gray-200">
      <thead class="bg-orange-100 text-orange-700">
        <tr>
          <th class="px-6 py-3 text-left font-medium">ID</th>
          <th class="px-6 py-3 text-left font-medium">Guest</th>
          <th class="px-6 py-3 text-left font-medium">Room</th>
          <th class="px-6 py-3 text-left font-medium">Check-in</th>
          <th class="px-6 py-3 text-left font-medium">Check-out</th>
          <th class="px-6 py-3 text-left font-medium">Nights</th>
          <th class="px-6 py-3 text-left font-medium">Total Amount</th>
          <th class="px-6 py-3 text-left font-medium">Dep. Amount</th>
          <th class="px-6 py-3 text-left font-medium">Status</th>
          <th class="px-6 py-3 text-left font-medium">Actions</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection

@section('add-modal')
@include('components.modal-components')
@endsection

@push('scripts')
<script src="{{ asset('assets/js/jquery-3.6.0.min.js')}}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js')}}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/reservation.js')}}?v={{ time() }}"></script>

<script src="{{ asset('asset/js/tailwindplus.js')}}?v={{ time() }}" type="module"></script>
<script src="{{asset('assets/js/alpine.js')}}?v={{ time() }}" defer></script>
<script src="{{asset('assets/js/sweetAlert.js')}}?v={{ time() }}"></script>
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

        <!-- Footer -->++
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


