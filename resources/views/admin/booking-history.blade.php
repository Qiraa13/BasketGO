<x-admin-dashboard>

<div class="bg-white p-6 rounded-xl shadow">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Admin Status</h1>

        <div class="flex gap-3">
            <input type="text" placeholder="Cari pemesanan..." class="border rounded-lg px-4 py-2">
            <select class="border rounded-lg px-4 py-2">
                <option>Semua Status</option>
            </select>
            <span class="text-xl">🔔</span>
            <img src="https://ui-avatars.com/api/?name=Admin" class="w-10 h-10 rounded-full">
        </div>
    </div>

    {{-- TAB --}}
    <div class="flex gap-6 border-b pb-2 mb-4">
        <a href="{{ route('admin.transaksi') }}" class="text-gray-600">Riwayat Transaksi</a>
        <a href="{{ route('admin.history.booking') }}" class="text-yellow-500 border-b-2 border-yellow-500 pb-2">
            Booking History
        </a>
        <a href="{{ route('admin.lapangan.jadwal') }}" class="text-gray-600">Jadwal History</a>
    </div>

    {{-- CARD ATAS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-yellow-400 text-white p-6 rounded-xl">
            Total Lapangan<br>
            <span class="text-2xl font-bold">4</span>
        </div>
        <div class="bg-yellow-400 text-white p-6 rounded-xl">
            Total Harga/Jam<br>
            <span class="text-2xl font-bold">Rp 900.000</span>
        </div>
    </div>

    {{-- SEARCH --}}
    <div class="flex justify-end mb-4">
        <input type="text" placeholder="Cari lapangan..." class="border px-4 py-2 rounded-lg w-64">
    </div>

    {{-- TABEL --}}
    <table class="w-full text-sm">
        <thead class="bg-yellow-500 text-white">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Nama Lapangan</th>
                <th class="py-2 px-3">Tipe</th>
                <th class="py-2 px-3">Harga/Jam</th>
                <th class="py-2 px-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <tr class="border-b">
                <td class="px-3 py-2">1</td>
                <td class="px-3 py-2">Lapangan A</td>
                <td class="px-3 py-2">Indoor</td>
                <td class="px-3 py-2">Rp 200.000</td>
                <td class="px-3 py-2">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>

</div>

</x-admin-dashboard>
