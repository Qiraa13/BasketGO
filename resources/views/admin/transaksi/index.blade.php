@extends('layouts.admin-dashboard')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

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
                    <option>Lunas</option>
                    <option>Belum Lunas</option>
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

    {{-- TAB --}}
    <div class="flex gap-6 border-b pb-2 mb-4">
        <a href="{{ route('admin.transaksi') }}" 
           class="text-yellow-500 border-b-2 border-yellow-500 pb-2 font-semibold">
            Riwayat Transaksi
        </a>
        <a href="{{ route('admin.lapangan.jadwal') }}" class="text-gray-600">Jadwal Lapangan</a>
    </div>

    {{-- CARD STATISTIC --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

        <div class="bg-white border p-5 rounded-xl shadow-sm">
            <p class="text-gray-600">Total Transaksi</p>
            <h2 class="text-2xl font-bold mt-1">{{ $transaksi->count() }}</h2>
        </div>

        <div class="bg-white border p-5 rounded-xl shadow-sm">
            <p class="text-gray-600">Total Pendapatan</p>
            <h2 class="text-2xl font-bold mt-1">
                Rp {{ number_format($transaksi->sum('jumlah'),0,',','.') }}
            </h2>
        </div>

        <div class="bg-white border p-5 rounded-xl shadow-sm">
            <p class="text-gray-600">Transaksi Lunas</p>
            <h2 class="text-2xl font-bold mt-1">
                {{ $transaksi->where('status','lunas')->count() }}
            </h2>
        </div>

        <div class="bg-white border p-5 rounded-xl shadow-sm">
            <p class="text-gray-600">Transaksi Belum Lunas</p>
            <h2 class="text-2xl font-bold mt-1">
                {{ $transaksi->where('status','belum_bayar')->count() }}
            </h2>
        </div>

    </div>

    {{-- FILTER AREA --}}
    <div class="flex items-center gap-3 mb-4">

        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
            <option>Semua Status</option>
            <option>Lunas</option>
            <option>Belum Lunas</option>
        </select>

        <input type="date"
               class="border border-gray-300 rounded-lg px-3 py-1 text-sm">

        <button class="bg-orange-500 text-white px-4 py-1 rounded-lg text-sm">Filter</button>

        <button class="border border-orange-500 text-orange-600 px-4 py-1 rounded-lg text-sm">
            Export PDF
        </button>

    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full text-sm">
            <thead class="bg-yellow-500 text-white">
                <tr>
                    <th class="py-2 px-3">ID Transaksi</th>
                    <th class="py-2 px-3">ID Booking</th>
                    <th class="py-2 px-3">Nama Penyewa</th>
                    <th class="py-2 px-3">Lapangan</th>
                    <th class="py-2 px-3">Tanggal</th>
                    <th class="py-2 px-3">Jumlah</th>
                    <th class="py-2 px-3">Metode</th>
                    <th class="py-2 px-3">Status</th>
                    <th class="py-2 px-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transaksi as $t)
                    <tr class="border-b">
                        <td class="py-2 px-3">TR{{ str_pad($t->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-2 px-3">BK{{ str_pad($t->booking->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-2 px-3">{{ $t->booking->user->name }}</td>
                        <td class="py-2 px-3">{{ $t->booking->lapangan->nama }}</td>
                        <td class="py-2 px-3">{{ $t->booking->jadwal->tanggal }}</td>
                        <td class="py-2 px-3">Rp {{ number_format($t->jumlah,0,',','.') }}</td>
                        <td class="py-2 px-3">{{ $t->metode }}</td>

                        <td class="py-2 px-3">
                            @if($t->status === 'lunas')
                                <span class="px-3 py-1 text-xs bg-green-600 text-white rounded-lg">
                                    Lunas
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs bg-yellow-400 text-white rounded-lg">
                                    Belum Lunas
                                </span>
                            @endif
                        </td>

                        <td class="py-2 px-3 text-center">
                            <a href="{{ route('admin.transaksi.detail', $t->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded-lg text-xs">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

@endsection
