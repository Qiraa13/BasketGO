<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Greeting + Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

                <!-- Total Bookings -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-500 text-sm">Total Bookings</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalBookings }}</p>
                </div>

                <!-- Upcoming -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-500 text-sm">Upcoming Bookings</h3>
                    <p class="text-3xl font-bold mt-2">{{ $upcomingBookings->count() }}</p>
                </div>

                <!-- Pending Payment -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-500 text-sm">Pending Payment</h3>
                    <p class="text-3xl font-bold mt-2">{{ $pendingPayment }}</p>
                </div>

                <!-- Total Spent -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-500 text-sm">Total Spent</h3>
                    <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalSpent, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Upcoming Booking Section -->
            <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                <h3 class="text-lg font-semibold mb-4">Upcoming Bookings</h3>

                @if($upcomingBookings->count() == 0)
                    <p class="text-gray-500">Tidak ada booking mendatang.</p>
                @else
                    <div class="space-y-4">
                        @foreach ($upcomingBookings as $book)
                            <div class="border p-4 rounded-lg flex justify-between items-center">
                                <div>
                                    <p class="font-semibold">{{ $book->lapangan->nama }}</p>
                                    <p class="text-gray-600 text-sm">
                                        {{ \Carbon\Carbon::parse($book->jadwal->tanggal)->format('d M Y') }}
                                        • {{ substr($book->jadwal->jam_mulai,0,5) }} - {{ substr($book->jadwal->jam_selesai,0,5) }}
                                    </p>
                                </div>

                                <span class="px-4 py-1 rounded-full text-white 
                                    @if($book->status === 'pending') bg-yellow-500 
                                    @elseif($book->status === 'diterima') bg-green-600 
                                    @else bg-red-600 @endif">
                                    {{ ucfirst($book->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Activity / History -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>

                <p class="text-gray-500">Fitur ini bisa diisi dengan riwayat booking / pembayaran terbaru.</p>
            </div>

        </div>
    </div>
</x-dashboard-layout>
