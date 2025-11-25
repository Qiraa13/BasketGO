<x-admin-dashboard>
<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Edit Jadwal Lapangan</h1>
        <a href="{{ route('admin.lapangan.jadwal') }}" class="text-blue-500 hover:underline">Kembali</a>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.lapangan.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="lapangan_id" class="block mb-1 font-semibold">Pilihan Lapangan</label>
            <select name="lapangan_id" id="lapangan_id" class="border rounded-lg px-3 py-2 w-full">
                <option value="">Pilih Lapangan</option>
                @foreach($lapangans as $lapangan)
                    <option value="{{ $lapangan->id }}" {{ $jadwal->lapangan_id == $lapangan->id ? 'selected' : '' }}>{{ $lapangan->nama_lapangan ?? 'Lapangan '.$lapangan->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="tanggal" class="block mb-1 font-semibold">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ $jadwal->tanggal->format('Y-m-d') }}" class="border rounded-lg px-3 py-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="jam_mulai" class="block mb-1 font-semibold">Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" value="{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}" class="border rounded-lg px-3 py-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="jam_selesai" class="block mb-1 font-semibold">Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" value="{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}" class="border rounded-lg px-3 py-2 w-full" required>
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">Perbarui</button>
    </form>
</div>
</x-admin-dashboard>
