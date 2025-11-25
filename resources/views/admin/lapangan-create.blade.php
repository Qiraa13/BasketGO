<x-admin-dashboard>
<div class="bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Tambah Lapangan</h1>
        <a href="{{ route('admin.lapangan.index') }}" class="text-blue-500 hover:underline">Kembali</a>
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

    <form action="{{ route('admin.lapangan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_lapangan" class="block mb-1 font-semibold">Nama Lapangan</label>
            <input type="text" name="nama_lapangan" id="nama_lapangan" value="{{ old('nama_lapangan') }}" class="border rounded-lg px-3 py-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="tipe" class="block mb-1 font-semibold">Tipe</label>
            <input type="text" name="tipe" id="tipe" value="{{ old('tipe') }}" class="border rounded-lg px-3 py-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="harga_per_jam" class="block mb-1 font-semibold">Harga per Jam</label>
            <input type="number" name="harga_per_jam" id="harga_per_jam" value="{{ old('harga_per_jam') }}" class="border rounded-lg px-3 py-2 w-full" required min="0" step="1000">
        </div>

        <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">Simpan</button>
    </form>
</div>
</x-admin-dashboard>
