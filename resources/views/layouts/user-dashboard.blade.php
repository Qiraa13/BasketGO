<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BGO User Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white h-screen shadow-lg px-6 py-8 fixed">

        <!-- Logo -->
        <div class="flex items-center gap-3 mb-10">
            <img src="/images/logo.png" class="w-10" alt="">
            <div>
                <h1 class="font-bold text-xl">BasketGO</h1>
                <p class="text-xs text-gray-500">Sistem Pemesanan BGO</p>
            </div>
        </div>

        <!-- Menu -->
        <nav class="space-y-2 text-gray-700 font-medium">

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg 
               {{ request()->is('dashboard') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('booking.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg 
               {{ request()->is('booking*') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
                📅 Book Court
            </a>

            <a href="{{ route('history.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg 
               {{ request()->is('history*') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
                📊 Status & History
            </a>

            <form action="{{ route('account.delete') }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus akun secara permanen?')">
                @csrf @method('DELETE')

                
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                    🚪 Logout
                </button>
            </form>

        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="flex-1 ml-64 p-10">

        {{-- Header (Optional) --}}
        @hasSection('header')
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                @yield('header')
            </h1>
        @endif

        {{-- Content --}}
        <main>
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
