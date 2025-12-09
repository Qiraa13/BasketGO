@extends('layouts.admin-dashboard')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <h1 class="text-2xl font-bold text-gray-800">Admin Status</h1>

        <div class="flex items-center gap-4">

            {{-- Search --}}
            <input type="text"
                placeholder="Cari lapangan..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56
                       focus:ring-yellow-400 focus:border-yellow-400">

            {{-- Dropdown --}}
            <div class="relative">
                <select
                    class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm appearance-none
                           focus:ring-yellow-400 focus:border-yellow-400">
                    <option>Semua Status</option>
                </select>

                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none">
                    ▼
                </span>
            </div>

            {{-- Notifikasi --}}
            <button class="text-2xl hover:text-yellow-500">🔔</button>

            {{-- Avatar --}}
            <img src="https://ui-avatars.com/api/?name=Admin"
                class="w-10 h-10 rounded-full border border-gray-300 shadow-sm">
        </div>

    </div>

    {{-- TAB --}}
    <div class="flex gap-6 border-b pb-2 mb-6">
        <a href="{{ route('admin.transaksi') }}" class="text-gray-600">
            Riwayat Transaksi
        </a>

        <a href="{{ route('admin.lapangan') }}"
           class="text-yellow-500 font-semibold border-b-2 border-yellow-500 pb-2">
            Lapangan
        </a>
    </div>

    {{-- TITLE + BUTTON --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Daftar Lapangan</h2>

        <button onclick="openLapanganModal()"
            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            + Tambah Lapangan
        </button>
    </div>

    {{-- TABLE --}}
    <table class="w-full text-sm border border-gray-200 rounded-xl overflow-hidden">

        <thead class="bg-yellow-500 text-white">
            <tr>
                <th class="py-3 px-3 text-center">Nama</th>
                <th class="py-3 px-3 text-center">Jenis</th>
                <th class="py-3 px-3 text-center">Harga / Jam</th>
                <th class="py-3 px-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($lapangans as $lapangan)
                <tr class="border-b text-center">

                    <td class="py-3 px-3">{{ $lapangan->nama }}</td>
                    <td>{{ $lapangan->jenis }}</td>
                    <td>Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</td>

                    <td class="py-2 flex justify-center gap-2">

                        {{-- Edit --}}
                        <button onclick="openEditModal({{ $lapangan }})"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            Edit
                        </button>

                        {{-- Delete --}}
                        <form action="{{ route('admin.lapangan.destroy', $lapangan->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus lapangan ini?');">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

</div>

{{-- ====================================================== --}}
{{-- MODAL TAMBAH LAPANGAN --}}
{{-- ====================================================== --}}
<div id="modalTambahLapangan"
    class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">

    <div class="bg-white w-96 p-6 rounded-xl space-y-4">

        <h2 class="text-xl font-bold text-center">Tambah Lapangan</h2>

        <form action="{{ route('admin.lapangan.store') }}" method="POST">
            @csrf

            <div>
                <label class="font-semibold">Nama Lapangan</label>
                <input type="text" name="nama"
                       class="border rounded-lg w-full px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Jenis</label>
                <select name="jenis" class="border rounded-lg w-full px-3 py-2" required>
                    <option value="Premium">Premium</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Outdoor">Outdoor</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Harga per Jam</label>
                <input type="number" name="harga_per_jam"
                       class="border rounded-lg w-full px-3 py-2" required>
            </div>

            <button class="bg-yellow-500 text-white w-full py-2 rounded-lg mt-3">
                Simpan
            </button>

            <button type="button"
                    onclick="closeLapanganModal()"
                    class="bg-gray-300 w-full py-2 rounded-lg mt-2">
                Batal
            </button>

        </form>

    </div>
</div>

{{-- ====================================================== --}}
{{-- MODAL EDIT LAPANGAN (NEW) --}}
{{-- ====================================================== --}}
<div id="modalEditLapangan"
    class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">

    <div class="bg-white w-96 p-6 rounded-xl space-y-4">

        <h2 class="text-xl font-bold text-center">Edit Lapangan</h2>

        <form id="editLapanganForm" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label class="font-semibold">Nama Lapangan</label>
                <input type="text" id="edit_nama" name="nama"
                       class="border rounded-lg w-full px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Jenis</label>
                <select id="edit_jenis" name="jenis"
                        class="border rounded-lg w-full px-3 py-2" required>
                    <option value="Premium">Premium</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Outdoor">Outdoor</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Harga per Jam</label>
                <input type="number" id="edit_harga" name="harga_per_jam"
                       class="border rounded-lg w-full px-3 py-2" required>
            </div>

            <button class="bg-blue-600 text-white w-full py-2 rounded-lg mt-3">
                Update
            </button>

            <button type="button"
                    onclick="closeEditModal()"
                    class="bg-gray-300 w-full py-2 rounded-lg mt-2">
                Batal
            </button>

        </form>

    </div>
</div>

{{-- ====================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ====================================================== --}}
<script>
function openLapanganModal() {
    document.getElementById("modalTambahLapangan").classList.remove("hidden");
    document.getElementById("modalTambahLapangan").classList.add("flex");
}

function closeLapanganModal() {
    document.getElementById("modalTambahLapangan").classList.add("hidden");
}

function openEditModal(data) {
    document.getElementById("modalEditLapangan").classList.remove("hidden");
    document.getElementById("modalEditLapangan").classList.add("flex");

    // Isi input otomatis
    document.getElementById("edit_nama").value = data.nama;
    document.getElementById("edit_jenis").value = data.jenis;
    document.getElementById("edit_harga").value = data.harga_per_jam;

    // Set action form edit
    document.getElementById("editLapanganForm").action =
        "/admin/lapangan/" + data.id;
}

function closeEditModal() {
    document.getElementById("modalEditLapangan").classList.add("hidden");
}
</script>

@endsection
