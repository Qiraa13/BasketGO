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

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium 
               {{ request()->is('admin/dashboard') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
               🏠 Dashboard
            </a>

            <a href="#"
               class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium hover:bg-gray-100">
               📅 Book Court
            </a>

            <a href="{{ route('admin.transaksi') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium 
                {{ request()->is('admin/transaksi') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
                📊 Transaksi & History
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg font-medium hover:bg-gray-100">
                    🚪 Logout
                </button>
            </form>

        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10">
        {{ $slot }}
    </main>

</div>

</body>
</html>
