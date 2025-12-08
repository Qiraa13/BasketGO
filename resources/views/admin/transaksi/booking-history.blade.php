@extends('layouts.admin-dashboard')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Admin Status
        </h1>

        <div class="flex items-center gap-4">

            {{-- Search --}}
            <input type="text"
                   placeholder="Cari pemesanan..."
                   class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56
                          focus:ring-yellow-400 focus:border-yellow-400">

            {{-- Dropdown --}}
            <div class="relative">
                <select
                    class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm appearance-none
                           focus:ring-yellow-400 focus:border-yellow-400">
                    <option>Semua Status</option>
                    <option>Lunas</option>
                    <option>Belum Lunas</option>
                </select>

                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none">
                    ▼
                </span>
            </div>

            {{-- Notifikasi --}}
            <button class="text-2xl hover:text-yellow-500">🔔</button>

            {{-- Avatar --}}
            <img src="https://ui-avatars.com/api/?name=Admin"
                 class="w-10 h-10 rounded-full border border-gray-300 shadow-sm">
        </div>

    </div>
{{-- TAB --}}
<div class="flex gap-6 border-b pb-2 mb-4">
    <a href="{{ route('admin.transaksi') }}" 
       class="text-gray-600">
       Riwayat Transaksi
    </a>

    <a href="{{ route('admin.history.booking') }}" 
       class="text-yellow-500 border-b-2 border-yellow-500 pb-2 font-semibold">
       Booking History
    </a>

    <a href="{{ route('admin.lapangan') }}" 
       class="text-gray-600">
       Jadwal History
    </a>
</div>

    {{-- CARD ATAS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-yellow-400 text-white p-6 rounded-xl flex flex-col justify-center">
            <span class="text-lg">Total Lapangan</span>
            <span class="text-2xl font-bold mt-2">4</span>
        </div>

        <div class="bg-yellow-400 text-white p-6 rounded-xl flex flex-col justify-center">
            <span class="text-lg">Total Harga/Jam</span>
            <span class="text-2xl font-bold mt-2">Rp 900.000</span>
        </div>
    </div>

   <div class="mb-4">
    <input type="text"
           placeholder="Cari lapangan..."
           class="border px-4 py-2 rounded-lg w-full max-w-8xl 
                  focus:ring-yellow-400 focus:border-yellow-400">
</div>


    {{-- TABLE --}}
    <table class="w-full text-sm border border-gray-200 rounded-xl overflow-hidden">
        
        <thead class="bg-yellow-500 text-white">
            <tr>
                <th class="py-3 px-3 text-center">ID</th>
                <th class="py-3 px-3 text-center">Nama Lapangan</th>
                <th class="py-3 px-3 text-center">Tipe</th>
                <th class="py-3 px-3 text-center">Harga/Jam</th>
                <th class="py-3 px-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-center">
            <tr class="border-b hover:bg-gray-50">
                <td class="px-3 py-3">1</td>
                <td class="px-3 py-3">Lapangan A</td>
                <td class="px-3 py-3">Indoor</td>
                <td class="px-3 py-3">Rp 200.000</td>
                <td class="px-3 py-3">
                    <div class="flex justify-center gap-2">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            Edit
                        </button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            Hapus
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>

    </table>

</div>

@endsection
