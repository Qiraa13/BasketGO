<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasketGO Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white h-screen shadow-md px-6 py-8">
        
        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-10">
            <img src="/images/logo.png" class="w-10 h-10">
            <div>
                <h1 class="font-bold text-xl">BasketGO</h1>
                <p class="text-xs text-gray-500">Sistem Pemesanan BGO</p>
            </div>
        </div>

        <nav class="space-y-2 text-gray-700">
            <a href="/dashboard" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium 
                      {{ request()->is('dashboard') ? 'bg-yellow-400 text-white' : 'hover:bg-gray-100' }}">
                <span>🏠</span>
                <span>Dashboard</span>
            </a>

            <a href="/booking" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium hover:bg-gray-100">
                <span>📅</span>
                <span>Book Court</span>
            </a>

            <a href="/status" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium hover:bg-gray-100">
                <span>📊</span>
                <span>Status & History</span>
            </a>

             <form method="POST" action="{{ route('account.delete') }}"
      onsubmit="return confirm('Yakin ingin menghapus akun secara permanen?')">
    @csrf
    @method('DELETE')

    <button type="submit"
            class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-lg font-semibold 
                   text-red-600 bg-gradient-to-r from-red-50 to-red-100 hover:from-red-100 hover:to-red-200 
                   transition-all">
        <span>🔥</span>
        <span>Hapus Akun</span>
    </button>
</form>

            <form method="POST" action="/logout">
                @csrf
                <button class="w-full text-left flex items-center space-x-3 px-4 py-3 rounded-lg font-medium hover:bg-gray-100">
                    <span>🚪</span>
                    <span>Logout</span>
                </button>
            </form>
        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1 p-10">
        {{ $slot }}
    </main>

</div>

</body>
</html>
