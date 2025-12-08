@extends('layouts.user-dashboard')

@section('content')
<div class="p-6 space-y-8">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">

            {{-- Greeting --}}
            <div>
                <h1 class="text-2xl font-bold">Status & History</h1>
                <p class="text-gray-500">Kelola pemesanan BGO anda</p>
            </div>

            {{-- Search + Status + Notif + Avatar --}}
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

                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none">▼</span>
                </div>

                {{-- Notifikasi --}}
                <button class="text-xl hover:text-orange-500">🔔</button>

                {{-- Avatar --}}
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                    class="w-10 h-10 rounded-full border border-gray-300 shadow-sm">
            </div>

        </div>
    </div>

    {{-- TAB NAVIGATION --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center gap-6 mb-6 border-b pb-2">

            {{-- TAB STATUS --}}
            <a href="?tab=status"
                class="{{ $tab == 'status'
                    ? 'text-orange-500 font-semibold border-b-2 border-orange-500 pb-2'
                    : 'text-gray-500 hover:text-gray-700 pb-2' }}">
                Status Pemesanan
            </a>

            {{-- TAB HISTORY --}}
            <a href="?tab=history"
                class="{{ $tab == 'history'
                    ? 'text-orange-500 font-semibold border-b-2 border-orange-500 pb-2'
                    : 'text-gray-500 hover:text-gray-700 pb-2' }}">
                Booking History
            </a>

        </div>
    </div>

    {{-- KONTEN TAB --}}
    @if($tab == 'status')
        {{-- TAB: STATUS PEMESANAN --}}

        @if($bookings->isEmpty())
            <p class="text-center text-gray-500 mt-10">Belum ada booking</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($bookings as $booking)
                    <div
                        class="bg-white rounded-xl shadow-sm border p-5
                        @if($booking->status === 'pending') border-l-4 border-yellow-400
                        @elseif($booking->status === 'diterima') border-l-4 border-green-500
                        @elseif($booking->status === 'ditolak') border-l-4 border-red-500
                        @else border-l-4 border-orange-500 @endif">

                        <div class="flex items-center justify-between mb-3">
                            {{-- STATUS BADGE --}}
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if($booking->status === 'pending') bg-yellow-100 text-yellow-600
                                @elseif($booking->status === 'diterima') bg-green-100 text-green-600
                                @elseif($booking->status === 'ditolak') bg-red-100 text-red-600
                                @else bg-orange-100 text-orange-600 @endif">
                                {{ strtoupper($booking->status) }}
                            </span>

                            {{-- CODE --}}
                            <span class="text-xs text-gray-400">
                                #BK{{ $booking->id }}
                            </span>
                        </div>

                        {{-- NAMA LAPANGAN --}}
                        <h3 class="font-semibold text-gray-800 mb-1">
                            {{ $booking->lapangan->nama ?? '-' }}
                        </h3>

                        {{-- JADWAL --}}
                        <div class="text-sm text-gray-500 space-y-1 mb-2">
                            <p>📅 {{ $booking->jadwal->tanggal ?? '-' }}</p>
                            <p>⏰ {{ $booking->jadwal->jam_mulai ?? '-' }} -
                                {{ $booking->jadwal->jam_selesai ?? '-' }}</p>
                        </div>

                        {{-- HARGA --}}
                        <p class="text-sm font-semibold text-orange-600">
                            IDR {{ number_format($booking->lapangan->harga ?? 0, 0, ',', '.') }}
                        </p>

                    </div>
                @endforeach
            </div>
        @endif
    @endif


    @if($tab == 'history')
        {{-- TAB: BOOKING HISTORY --}}

        @php
            $history = $bookings->filter(function($b) {
                return in_array($b->status, ['diterima', 'ditolak']);
            });
        @endphp

        @if($history->isEmpty())
            <p class="text-center text-gray-500 mt-10">Belum ada riwayat booking</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($history as $booking)
                    <div class="bg-white rounded-xl shadow-sm border p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full
                                @if($booking->status === 'diterima') bg-green-100 text-green-600
                                @else bg-red-100 text-red-600 @endif">
                                {{ strtoupper($booking->status) }}
                            </span>

                            <span class="text-xs text-gray-400">
                                #BK{{ $booking->id }}
                            </span>
                        </div>

                        <h3 class="font-semibold text-gray-800 mb-1">
                            {{ $booking->lapangan->nama ?? '-' }}
                        </h3>

                        <div class="text-sm text-gray-500 space-y-1 mb-2">
                            <p>📅 {{ $booking->jadwal->tanggal ?? '-' }}</p>
                            <p>⏰ {{ $booking->jadwal->jam_mulai ?? '-' }} -
                                {{ $booking->jadwal->jam_selesai ?? '-' }}</p>
                        </div>

                        <p class="text-sm font-semibold text-orange-600">
                            IDR {{ number_format($booking->lapangan->harga ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    @endif

</div>
@endsection
