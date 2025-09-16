<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sanra Hotel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-orange-600 text-white flex flex-col">
            <!-- Logo / Title -->
            <div class="p-6 text-2xl font-bold">
                Sanra Hotel
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4">
                <ul class="space-y-2">
                   <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-2 py-2 px-3 rounded hover:bg-orange-500 transition-colors">
                           <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                           <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('rooms') }}"
                           class="flex items-center gap-2 py-2 px-3 rounded hover:bg-orange-500 transition-colors">
                           <i data-lucide="bed" class="w-5 h-5"></i>
                           <span>Rooms</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center gap-2 py-2 px-3 rounded hover:bg-orange-500 transition-colors">
                           <i data-lucide="calendar-check" class="w-5 h-5"></i>
                           <span>Reservations</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center gap-2 py-2 px-3 rounded hover:bg-orange-500 transition-colors">
                           <i data-lucide="users" class="w-5 h-5"></i>
                           <span>Guests</span>
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="flex items-center gap-2 py-2 px-3 rounded hover:bg-orange-500 transition-colors">
                           <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                           <span>Reports</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-orange-500">
                <a href="#"
                   class="block py-2 px-3 rounded hover:bg-orange-500 transition-colors">
                   Logout
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">

            <!-- Navbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-orange-600">
                    @yield('page-title', 'Hotel property management system')
                </h1>

                <h2 class="text-lg">@section('title', 'Rooms')</h2>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Admin</span>
                    <img src="https://i.pravatar.cc/40"
                         alt="Profile"
                         class="w-10 h-10 rounded-full border-2 border-orange-500">
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1 overflow-y-auto">
                @yield('content')
            </main>

        </div>
    </div>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
