<x-admin-dashboard>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>

        <div class="flex items-center gap-4">

            <!-- Search -->
            <input 
                type="text"
                placeholder="Cari pemesanan..."
                class="px-4 py-2 rounded-lg border w-64"
            >

            <!-- Filter -->
            <select class="px-4 py-2 rounded-lg border">
                <option>Semua Status</option>
                <option>Pending</option>
                <option>Verifikasi</option>
                <option>Disetujui</option>
            </select>

            <!-- Notif -->
            <span class="text-xl">🔔</span>

            <!-- Avatar -->
            <img src="https://ui-avatars.com/api/?name=Admin" class="w-10 h-10 rounded-full">
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Total Booking</p>
            <p class="text-3xl font-bold">0</p>
        </div>

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Menunggu Verifikasi</p>
            <p class="text-3xl font-bold">0</p>
        </div>

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Booking Dikonfirmasi</p>
            <p class="text-3xl font-bold">0</p>
        </div>

        <div class="bg-yellow-400 text-white p-6 rounded-lg text-center shadow">
            <p>Total Pendapatan</p>
            <p class="text-3xl font-bold">Rp 0</p>
        </div>

    </div>

    <!-- AKTIVITAS TERBARU -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="font-semibold text-lg mb-4">Aktivitas Terbaru</h2>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Tanggal</th>
                    <th>Lapangan</th>
                    <th>Pemesan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">
                        Tidak ada data
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</x-admin-dashboard>
