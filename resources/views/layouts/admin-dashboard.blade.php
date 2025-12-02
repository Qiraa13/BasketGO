<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasketGO - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white h-screen shadow-lg px-6 py-8">
        <div class="flex items-center gap-3 mb-10">
            <img src="/images/logo.png" alt="logo" class="w-10 h-10">
            <div>
                <h1 class="font-bold text-xl">BasketGO</h1>
                <p class="text-xs text-gray-500">Admin</p>
            </div>
        </div>

        <nav class="space-y-2 text-gray-700">

    {{-- DASHBOARD --}}
    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium whitespace-nowrap w-full truncate
       {{ request()->is('admin/dashboard') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
       <span class="w-5 text-lg">🏠</span>
       <span>Dashboard</span>
    </a>

    {{-- BOOK COURT --}}
    <a href="{{ route('admin.bookcourt') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium whitespace-nowrap w-full truncate
       {{ request()->is('admin/book-court') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
       <span class="w-5 text-lg">📅</span>
       <span>Book Court</span>
    </a>

    {{-- TRANSAKSI --}}
    <a href="{{ route('admin.transaksi') }}"
       class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium whitespace-nowrap w-full truncate
       {{
           request()->is('admin/transaksi*') ||
           request()->is('admin/booking*') ||
           request()->is('admin/lapangan*')
           ? 'bg-yellow-400 text-white'
           : 'hover:bg-gray-100'
       }}">
       <span class="w-5 text-lg">📊</span>
       <span>Transaksi & History</span>
    </a>

    {{-- LOGOUT --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg font-medium hover:bg-gray-100 whitespace-nowrap truncate">
            <span class="w-5 text-lg">🚪</span>
            <span>Logout</span>
        </button>
    </form>

</nav>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10">
        @yield('content')
    </main>

</div>

</body>
</html>
