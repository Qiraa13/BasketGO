@extends('layouts.admin-dashboard')

@section('content')



<div class="bg-white rounded-xl shadow p-6">
    <div class="flex items-center justify-between mb-6">

    {{-- LEFT --}}
    <h1 class="text-2xl font-bold text-gray-800">Admin Verifikasi Booking</h1>

    {{-- RIGHT --}}
    <div class="flex items-center gap-4">

        {{-- Search --}}
        <input type="text"
               placeholder="Cari pemesanan..."
               class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56
                      focus:ring-orange-400 focus:border-orange-400">

        {{-- Status Dropdown --}}
        <div class="relative">
            <select
                class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm appearance-none
                       focus:ring-orange-400 focus:border-orange-400">
                <option>Semua Status</option>
                <option>Dikonfirmasi</option>
                <option>Pending</option>
                <option>Ditolak</option>
            </select>

            <!-- Custom arrow biar rapi -->
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none">
                ▼
            </span>
        </div>

        {{-- Notifikasi --}}
        <button class="text-2xl hover:text-orange-500">🔔</button>

        {{-- Avatar --}}
        <img src="https://ui-avatars.com/api/?name=Admin"
             class="w-10 h-10 rounded-full border border-gray-300 shadow-sm">
    </div>

</div>


    <!-- STATUS CARD -->
    <div class="grid grid-cols-3 gap-6 mb-6">

        <div class="bg-yellow-100 p-4 rounded-lg">
            <p class="text-gray-600">Total Booking Pending</p>
            <h3 class="text-3xl font-bold text-yellow-600">0</h3>
        </div>

        <div class="bg-green-100 p-4 rounded-lg">
            <p class="text-gray-600">Booking Dikonfirmasi</p>
            <h3 class="text-3xl font-bold text-green-600">0</h3>
        </div>

        <div class="bg-red-100 p-4 rounded-lg">
            <p class="text-gray-600">Booking Ditolak</p>
            <h3 class="text-3xl font-bold text-red-600">0</h3>
        </div>

    </div>

    <!-- FILTER -->
    <div class="flex gap-3 mb-4">
        <button class="px-4 py-2 bg-gray-200 rounded">Semua Status</button>
        <input type="text" placeholder="Cari nama penyewa atau ID..."
               class="border px-4 py-2 rounded w-64">
        <button class="px-4 py-2 bg-yellow-400 text-white rounded">Cari</button>
    </div>

    <!-- TABEL -->
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-yellow-400 text-white text-left">
                <th class="p-3">ID Booking</th>
                <th class="p-3">Nama Penyewa</th>
                <th class="p-3">Lapangan</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Jam</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr class="border-b">
                <td class="p-3">BK001</td>
                <td class="p-3">Budi Santoso</td>
                <td class="p-3">Lapangan A</td>
                <td class="p-3">2024-11-15</td>
                <td class="p-3">08:00 - 09:00</td>
                <td class="p-3"><span class="px-3 py-1 bg-yellow-300 text-white rounded">Pending</span></td>
                <td class="p-3"><button class="px-3 py-1 bg-blue-500 text-white rounded">Detail</button></td>
            </tr>
        </tbody>
    </table>

</div>

@endsection
