@extends('layouts.user-dashboard')

@section('content')
<div class="p-6 space-y-8">

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold">Status & History</h1>
                <p class="text-gray-500">Kelola pemesanan BGO anda</p>
            </div>

            <div class="flex items-center gap-4">
                <input type="text" placeholder="Cari pemesanan..."
                    class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56">

                <div class="relative">
                    <select class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm">
                        <option>Semua Status</option>
                        <option>Pending</option>
                        <option>Diterima</option>
                        <option>Ditolak</option>
                    </select>
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600">▼</span>
                </div>

                <button class="text-xl hover:text-orange-500">🔔</button>

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                    class="w-10 h-10 rounded-full border shadow-sm">
            </div>
        </div>
    </div>

    {{-- TAB --}}
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center gap-6 mb-6 border-b pb-2">

            <a href="?tab=status"
                class="{{ $tab == 'status'
                    ? 'text-orange-500 font-semibold border-b-2 border-orange-500 pb-2'
                    : 'text-gray-500 hover:text-gray-700 pb-2' }}">
                Status Pemesanan
            </a>

            <a href="?tab=history"
                class="{{ $tab == 'history'
                    ? 'text-orange-500 font-semibold border-b-2 border-orange-500 pb-2'
                    : 'text-gray-500 hover:text-gray-700 pb-2' }}">
                Booking History
            </a>

        </div>
    </div>


    {{-- ============= TAB STATUS ============= --}}
    @if($tab == 'status')

        @if($bookings->isEmpty())
            <p class="text-center text-gray-500 mt-10">Belum ada booking</p>
        @else

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach($bookings as $b)
                <div class="bg-white rounded-xl shadow-sm border p-5
                    @if($b->status=='pending') border-l-4 border-yellow-400
                    @elseif($b->status=='diterima') border-l-4 border-green-500
                    @elseif($b->status=='ditolak') border-l-4 border-red-500
                    @endif">

                    <div class="flex justify-between mb-3">
                        {{-- STATUS BADGE --}}
                        <span class="text-xs font-semibold px-3 py-1 rounded-full
                            @if($b->status=='pending') bg-yellow-100 text-yellow-600
                            @elseif($b->status=='diterima') bg-green-100 text-green-600
                            @elseif($b->status=='ditolak') bg-red-100 text-red-600
                            @endif">
                            {{ strtoupper($b->status) }}
                        </span>

                        <span class="text-xs text-gray-400">#BK{{ $b->id }}</span>
                    </div>

                    {{-- LAPANGAN --}}
                    <h3 class="font-semibold text-gray-800 mb-1">
                        {{ $b->lapangan->nama ?? '-' }}
                    </h3>

                    {{-- JADWAL (DATABASE BERDASARKAN BOOKING LANGSUNG, BUKAN TABEL JADWAL) --}}
                    <p class="text-sm text-gray-500">📅 {{ $b->tanggal }}</p>
                    <p class="text-sm text-gray-500 mb-3">⏰ {{ $b->jam }}</p>

                    {{-- HARGA --}}
                    <p class="text-sm font-semibold text-orange-600">
                        IDR {{ number_format($b->lapangan->harga_per_jam ?? 0, 0, ',', '.') }}
                    </p>

                </div>
                @endforeach

            </div>

        @endif

    @endif



    {{-- ============= TAB HISTORY ============= --}}
    @if($tab == 'history')

        @php
            $history = $bookings->filter(fn($x) => in_array($x->status, ['diterima','ditolak']));
        @endphp

        @if($history->isEmpty())
            <p class="text-center text-gray-500 mt-10">Belum ada riwayat booking</p>

        @else

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach($history as $b)
                <div class="bg-white rounded-xl shadow-sm border p-5">

                    <div class="flex justify-between mb-3">
                        <span class="text-xs font-semibold px-3 py-1 rounded-full
                            @if($b->status=='diterima') bg-green-100 text-green-600
                            @else bg-red-100 text-red-600 @endif">
                            {{ strtoupper($b->status) }}
                        </span>

                        <span class="text-xs text-gray-400">#BK{{ $b->id }}</span>
                    </div>

                    <h3 class="font-semibold text-gray-800 mb-1">
                        {{ $b->lapangan->nama ?? '-' }}
                    </h3>

                    <p class="text-sm text-gray-500">📅 {{ $b->tanggal }}</p>
                    <p class="text-sm text-gray-500 mb-3">⏰ {{ $b->jam }}</p>

                    <p class="text-sm font-semibold text-orange-600">
                        IDR {{ number_format($b->lapangan->harga_per_jam ?? 0, 0, ',', '.') }}
                    </p>

                </div>
                @endforeach

            </div>

        @endif

    @endif

</div>
@endsection
