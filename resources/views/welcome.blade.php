<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Admin Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-orange-600 text-white flex flex-col">
      <div class="p-6 text-2xl font-bold">PSU - San Rafael Hospitality Management Hostel PMS</div>
      <nav class="flex-1 px-4">
        <ul class="space-y-2">
          <li><a href="#" class="block py-2 px-3 rounded hover:bg-orange-500 transition-colors">Dashboard</a></li>
          <li><a href="#" class="block py-2 px-3 rounded hover:bg-orange-500 transition-colors">Reservations</a></li>
          <li><a href="#" class="block py-2 px-3 rounded hover:bg-orange-500 transition-colors">Rooms</a></li>
          <li><a href="#" class="block py-2 px-3 rounded hover:bg-orange-500 transition-colors">Guests</a></li>
          <li><a href="#" class="block py-2 px-3 rounded hover:bg-orange-500 transition-colors">Reports</a></li>
        </ul>
      </nav>
      <div class="p-4 border-t border-orange-500">
        <a href="#" class="block py-2 px-3 rounded hover:bg-orange-500 transition-colors">Logout</a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Navbar -->
      <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-semibold">Dashboard</h1>
        <div class="flex items-center space-x-4">
          <span class="text-gray-700">Admin</span>
          <img src="https://i.pravatar.cc/40" alt="Profile" class="w-10 h-10 rounded-full border-2 border-orange-500">
        </div>
      </header>

      <!-- Dashboard Cards -->
      <main class="p-6 flex-1 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          @php
            $cards = [
              ['title' => 'Bookings', 'value' => $bookings ?? 0, 'color' => 'bg-orange-500'],
              ['title' => 'Rooms', 'value' => $rooms ?? 0, 'color' => 'bg-orange-400'],
              ['title' => 'Revenue', 'value' => '$'.number_format($revenue ?? 0, 2), 'color' => 'bg-orange-600'],
              ['title' => 'Guests', 'value' => $guests ?? 0, 'color' => 'bg-orange-700'],
            ];
          @endphp

          @foreach($cards as $card)
          <div class="{{ $card['color'] }} text-white rounded-lg shadow p-6 transform transition duration-500 hover:scale-105">
            <h2 class="text-lg">{{ $card['title'] }}</h2>
            <p class="text-2xl font-bold">{{ $card['value'] }}</p>
          </div>
          @endforeach
        </div>

        <!-- Reservation Table -->
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
                @foreach($reservations ?? [] as $res)
                <tr class="transition duration-300 hover:bg-orange-50">
                  <td class="px-6 py-4">{{ $res->guest_name }}</td>
                  <td class="px-6 py-4">{{ $res->room_name }}</td>
                  <td class="px-6 py-4">{{ $res->check_in->format('Y-m-d') }}</td>
                  <td class="px-6 py-4">{{ $res->check_out->format('Y-m-d') }}</td>
                  <td class="px-6 py-4">
                    @php
                      $statusColor = match($res->status) {
                        'Confirmed' => 'bg-green-100 text-green-700',
                        'Pending' => 'bg-yellow-100 text-yellow-700',
                        'Cancelled' => 'bg-red-100 text-red-700',
                        default => 'bg-gray-100 text-gray-700'
                      };
                    @endphp
                    <span class="px-2 py-1 text-sm rounded {{ $statusColor }}">{{ $res->status }}</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </main>
    </div>
  </div>

</body>
</html>
