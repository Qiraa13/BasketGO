@extends('layouts.admin-dashboard')

@section('content')



    <!-- AKTIVITAS TERBARU -->
    <div class="bg-white p-6 rounded-lg shadow">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <h1 class="text-2xl font-bold text-gray-800">Admin Status</h1>

        <div class="flex items-center gap-4">

            {{-- Search --}}
            <input type="text"
                   placeholder="Cari pemesanan..."
                   class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56
                          focus:ring-orange-400 focus:border-orange-400">

            {{-- Dropdown --}}
            <div class="relative">
                <select
                    class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm appearance-none
                           focus:ring-orange-400 focus:border-orange-400">
                    <option>Semua Status</option>
                    <option>Verifikasi</option>
                    <option>Disetujui</option>
                    <option>Pending</option>
                </select>

                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none">
                    ▼
                </span>
            </div>

            {{-- Notifikasi --}}
            <button class="text-xl hover:text-orange-500">🔔</button>

            {{-- Avatar --}}
            <img src="https://ui-avatars.com/api/?name=Admin"
                 class="w-10 h-10 rounded-full border border-gray-300 shadow-sm">
        </div>

    </div>

    

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Total Booking</p>
            <p class="text-3xl font-bold">0</p>
        </div>

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Menunggu Verifikasi</p>
            <p class="text-3xl font-bold">0</p>
        </div>

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Booking Dikonfirmasi</p>
            <p class="text-3xl font-bold">0</p>
        </div>

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Total Pendapatan</p>
            <p class="text-3xl font-bold">Rp 0</p>
        </div>

    </div>



        <h2 class="font-semibold text-lg mb-4">Aktivitas Terbaru</h2>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Tanggal</th>
                    <th>Lapangan</th>
                    <th>Pemesan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Tidak ada data
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

@endsection
