<x-admin-dashboard>

<div class="bg-white p-6 rounded-xl shadow">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Admin History</h1>

        <div class="flex gap-3">
            <input type="text" placeholder="Cari jadwal..." class="border rounded-lg px-4 py-2">
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
        <a href="{{ route('admin.history.booking') }}" class="text-gray-600">Booking History</a>
        <a href="{{ route('admin.lapangan.jadwal') }}" class="text-yellow-500 border-b-2 border-yellow-500 pb-2">
            Lapangan & Jadwal
        </a>
    </div>

    {{-- CARD ATAS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-yellow-400 text-white p-6 rounded-xl">
            Total Jadwal<br>
            <span class="text-2xl font-bold">{{ $jadwal->count() }}</span>
        </div>
        <div class="bg-yellow-400 text-white p-6 rounded-xl">
            Jadwal Tersedia<br>
            <span class="text-2xl font-bold">0</span>
        </div>
    </div>

    {{-- BUTTONS --}}
    <div class="mb-4 flex justify-between">
        <a href="{{ route('admin.lapangan.jadwal.create') }}" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
            Tambah Jadwal
        </a>
        <a href="{{ route('admin.lapangan.index') }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Tambah Lapangan
        </a>
    </div>

    {{-- FILTER --}}
    <div class="flex gap-3 mb-3">
        <select class="border px-3 py-2 rounded-lg">
            <option>Semua Status</option>
        </select>

        <input type="date" class="border px-3 py-2 rounded-lg">

        <button class="bg-gray-700 text-white px-4 py-2 rounded-lg">Filter</button>
    </div>

    {{-- TABEL --}}
    <table class="w-full text-sm">
        <thead class="bg-yellow-500 text-white">
            <tr>
                <th class="py-2 px-3">ID</th>
                <th class="py-2 px-3">Lapangan</th>
                <th class="py-2 px-3">Tanggal</th>
                <th class="py-2 px-3">Jam Mulai</th>
                <th class="py-2 px-3">Jam Selesai</th>
                <th class="py-2 px-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($jadwal as $item)
                <tr class="border-b">
                    <td class="px-3 py-2">{{ $item->id }}</td>
                    <td class="px-3 py-2">{{ $item->lapangan->nama_lapangan ?? 'Lapangan '.$item->lapangan_id }}</td>
                    <td class="px-3 py-2">{{ $item->tanggal->format('Y-m-d') }}</td>
                    <td class="px-3 py-2">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                    <td class="px-3 py-2">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
                    <td class="px-3 py-2 flex gap-2">
                        <a href="{{ route('admin.lapangan.jadwal.edit', $item->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                        <form action="{{ route('admin.lapangan.jadwal.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</x-admin-dashboard>
