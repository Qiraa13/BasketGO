<x-admin-dashboard>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Admin Status</h1>

    <div class="flex items-center gap-4">
        <input type="text" placeholder="Cari pemesanan..." class="px-4 py-2 rounded-lg border w-64">
        <select class="px-4 py-2 rounded-lg border">
            <option>Semua Status</option>
            <option>Lunas</option>
            <option>Belum Lunas</option>
        </select>
        <span class="text-xl">🔔</span>
        <img src="https://ui-avatars.com/api/?name=Admin" class="w-10 h-10 rounded-full">
    </div>
</div>

<div class="bg-white p-6 rounded-xl shadow">

    <!-- TAB -->
    <div class="flex gap-6 border-b pb-2 mb-4">
        <a href="{{ route('admin.transaksi') }}" class="font-semibold border-b-2 border-yellow-500 pb-2 text-yellow-500">
            Riwayat Transaksi
        </a>
        <a href="{{ route('admin.history.booking') }}" class="text-gray-600">Booking History</a>
        <a href="{{ route('admin.lapangan.jadwal') }}" class="text-gray-600">Jadwal History</a>
    </div>

    <!-- TOP CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-yellow-400 text-white p-6 rounded-xl">Total Transaksi<br><span class="text-2xl font-bold">{{ $transaksi->count() }}</span></div>
        <div class="bg-yellow-400 text-white p-6 rounded-xl">Total Pendapatan<br><span class="text-2xl font-bold">Rp {{ number_format($transaksi->sum('jumlah'),0,',','.') }}</span></div>
        <div class="bg-yellow-400 text-white p-6 rounded-xl">Transaksi Lunas<br><span class="text-2xl font-bold">{{ $transaksi->where('status','lunas')->count() }}</span></div>
        <div class="bg-yellow-400 text-white p-6 rounded-xl">Belum Lunas<br><span class="text-2xl font-bold">{{ $transaksi->where('status','belum_bayar')->count() }}</span></div>
    </div>

    <!-- TABLE -->
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-yellow-500 text-white">
                <th class="py-2 px-3">ID Transaksi</th>
                <th class="py-2 px-3">Pemesan</th>
                <th class="py-2 px-3">Lapangan</th>
                <th class="py-2 px-3">Tanggal</th>
                <th class="py-2 px-3">Jumlah</th>
                <th class="py-2 px-3">Metode</th>
                <th class="py-2 px-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $t)
                <tr class="border-b">
                    <td class="py-2 px-3">TR{{ str_pad($t->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td class="py-2 px-3">{{ $t->booking->user->name }}</td>
                    <td class="py-2 px-3">{{ $t->booking->lapangan->nama }}</td>
                    <td class="py-2 px-3">{{ $t->booking->jadwal->tanggal }}</td>
                    <td class="py-2 px-3">Rp {{ number_format($t->jumlah,0,',','.') }}</td>
                    <td class="py-2 px-3">{{ $t->metode }}</td>
                    <td class="py-2 px-3">
                        @if($t->status === 'lunas')
                            <span class="px-3 py-1 bg-green-600 text-white rounded-lg">Lunas</span>
                        @else
                            <span class="px-3 py-1 bg-yellow-500 text-white rounded-lg">Belum Lunas</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

</div>

</x-admin-dashboard>
