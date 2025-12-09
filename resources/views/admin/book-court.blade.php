@extends('layouts.admin-dashboard')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <h1 class="text-2xl font-bold text-gray-800">Admin Verifikasi Booking</h1>

        <div class="flex items-center gap-4">

            <input type="text"
                placeholder="Cari booking..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56">

            <button class="text-2xl hover:text-yellow-500">🔔</button>

            <img src="https://ui-avatars.com/api/?name=Admin"
                class="w-10 h-10 rounded-full border shadow-sm">
        </div>

    </div>

    {{-- STATISTICS --}}
    <div class="grid grid-cols-3 gap-6 mb-6">

        <div class="bg-yellow-100 p-4 rounded-lg">
            <p class="text-gray-600">Total Pending</p>
            <h3 class="text-3xl font-bold text-yellow-600">{{ $pending }}</h3>
        </div>

        <div class="bg-green-100 p-4 rounded-lg">
            <p class="text-gray-600">Dikonfirmasi</p>
            <h3 class="text-3xl font-bold text-green-600">{{ $confirmed }}</h3>
        </div>

        <div class="bg-red-100 p-4 rounded-lg">
            <p class="text-gray-600">Ditolak</p>
            <h3 class="text-3xl font-bold text-red-600">{{ $rejected }}</h3>
        </div>

    </div>

    {{-- TABEL BOOKING --}}
    <table class="w-full border-collapse">

        <thead>
            <tr class="bg-yellow-400 text-white text-left">
                <th class="p-3">ID Booking</th>
                <th class="p-3">Nama Penyewa</th>
                <th class="p-3">Lapangan</th>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Jam</th>
                <th class="p-3">Bukti Transfer</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($bookings as $b)
            <tr class="border-b">

                <td class="p-3">BK{{ str_pad($b->id, 3, '0', STR_PAD_LEFT) }}</td>

                <td class="p-3">{{ $b->user->name }}</td>

                <td class="p-3">{{ $b->lapangan->nama }}</td>

                <td class="p-3">{{ $b->tanggal }}</td>

                <td class="p-3">{{ $b->jam }}</td>

                <td class="p-3">
                    @if($b->pembayaran && $b->pembayaran->bukti_transfer)
                        <a href="{{ asset('storage/'.$b->pembayaran->bukti_transfer) }}"
                           target="_blank"
                           class="text-blue-600 underline">
                            Lihat Bukti
                        </a>
                    @else
                        <span class="text-gray-400">Tidak ada</span>
                    @endif
                </td>

                <td class="p-3">
                    @if($b->status == 'pending')
                        <span class="px-3 py-1 bg-yellow-300 text-white rounded">Pending</span>
                    @elseif($b->status == 'diterima')
                        <span class="px-3 py-1 bg-green-600 text-white rounded">Diterima</span>
                    @else
                        <span class="px-3 py-1 bg-red-600 text-white rounded">Ditolak</span>
                    @endif
                </td>

                <td class="p-3 flex gap-2">

                    {{-- Terima --}}
                    <form method="POST" action="{{ route('admin.booking.confirm', $b->id) }}">
                        @csrf @method('PUT')
                        <button class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                            Terima
                        </button>
                    </form>

                    {{-- Tolak --}}
                    <form method="POST" action="{{ route('admin.booking.reject', $b->id) }}">
                        @csrf @method('PUT')
                        <button class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                            Tolak
                        </button>
                    </form>

                </td>

            </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-gray-500">
                        Belum ada booking
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</div>

@endsection
