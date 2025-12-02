@extends('layouts.user-dashboard')


@section('content')
<div class="p-6 space-y-8">
<div class="bg-white p-6 rounded-lg shadow">
    {{-- Greeting --}}
    <div>
        <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-gray-500">Siap untuk permainan Anda berikutnya?</p>
    </div>
</div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Total Bookings</p>
            <h2 class="text-3xl font-bold">{{ $totalBookings ?? 0 }}</h2>
            <p class="text-green-500 text-xs mt-1">↑ 12% dari bulan lalu</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Pemesanan Mendatang</p>
            <h2 class="text-3xl font-bold">{{ $upcoming ?? 0 }}</h2>
            <p class="text-blue-500 text-xs mt-1">Berikutnya: Besok 2PM</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Pembayaran Tertunda</p>
            <h2 class="text-3xl font-bold">{{ $pending ?? 0 }}</h2>
            <p class="text-yellow-500 text-xs mt-1">Rp 200.000</p>
        </div>

        <div class="bg-white p-5 rounded-xl shadow">
            <p class="text-gray-500 text-sm">Total Spent</p>
            <h2 class="text-3xl font-bold">Rp {{ number_format($totalSpent ?? 0, 0, ',', '.') }}</h2>
            <p class="text-green-500 text-xs mt-1">Tahun ini</p>
        </div>

    </div>

    {{-- Bookings List --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Pemesanan Mendatang --}}
        <div class="bg-white p-6 rounded-xl shadow col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-lg">Pemesanan Mendatang</h2>
                <a href="#" class="text-red-500 text-sm">Lihat Semua</a>
            </div>

            @forelse ($upcomingBookings ?? [] as $book)
                <div class="flex items-center justify-between p-4 border rounded-lg mb-3">
                    <div>
                        <h3 class="font-semibold">{{ $book->court_name }}</h3>
                        <p class="text-xs text-gray-500">{{ $book->date }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">{{ $book->time }}</p>
                        <p class="text-green-500 text-xs">Dikonfirmasi</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-sm">Belum ada pemesanan.</p>
            @endforelse
        </div>

        {{-- Aktivitas Terbaru --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="font-semibold text-lg mb-4">Aktivitas Terkini</h2>

            <ul class="space-y-3">
                <li class="flex gap-2 items-center">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    <p class="text-sm">Pemesanan dikonfirmasi untuk Court A</p>
                </li>

                <li class="flex gap-2 items-center">
                    <span class="w-3 h-3 bg-orange-500 rounded-full"></span>
                    <p class="text-sm">Pembayaran diterima Rp 200.000</p>
                </li>

                <li class="flex gap-2 items-center">
                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                    <p class="text-sm">Permintaan pemesanan baru</p>
                </li>
            </ul>
        </div>


    </div>

</div>

@endsection
