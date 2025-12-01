<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BasketGO</title>
    @vite('resources/css/app.css')

    <style>
        /* Posisi gambar ring di kiri */
        .ring-left {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 420px;
            opacity: 0.35;
            pointer-events: none;
        }
    </style>

</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
<nav class="w-full bg-gradient-to-r from-orange-500 to-orange-400 fixed top-0 left-0 z-50 shadow">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Logo BasketGO putih -->
        <h1 class="text-2xl font-bold text-white flex items-center gap-2">
            <img src="/images/logo.png" class="w-7 brightness-110" />
            BasketGO
        </h1>

        <!-- Right Menu -->
        <div class="flex items-center gap-6">

            <!-- Menu -->
            <a href="#lapangan" 
               class="text-white hover:text-gray-200 text-sm font-medium">
                Lapangan
            </a>

            <!-- Tombol Masuk -->
            <a href="{{ route('login') }}"
               class="px-4 py-2 bg-white text-black rounded-lg font-semibold shadow hover:bg-gray-100">
                Masuk
            </a>

        </div>
    </div>
</nav>




    <!-- HERO SECTION -->
    <section class="pt-32 pb-28 bg-gradient-to-b from-orange-400 to-orange-500 text-white relative overflow-hidden">

        <!-- Gambar ring kiri -->
        
    <img src="/images/ring.png" 
         class="absolute left-0 top-12 w-[260px] opacity-90">

        <div class="text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                Pesan Lapangan Basket Dengan Mudah
            </h2>

            <p class="text-lg opacity-90 mb-8">
                Platform terpercaya untuk booking lapangan basket di seluruh kota
            </p>

            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-white text-orange-600 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition">
                Daftar Sekarang
            </a>
        </div>
    </section>



    <!-- FITUR -->
    <section class="max-w-7xl mx-auto py-16 px-6 grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
            <p class="text-3xl mb-3">⚡</p>
            <h3 class="font-bold mb-2">Cepat & Mudah</h3>
            <p class="text-gray-600 text-sm">
                Booking lapangan hanya dalam beberapa klik tanpa ribet
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
            <p class="text-3xl mb-3">💳</p>
            <h3 class="font-bold mb-2">Pembayaran Aman</h3>
            <p class="text-gray-600 text-sm">
                Metode pembayaran aman & terpercaya
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
            <p class="text-3xl mb-3">📅</p>
            <h3 class="font-bold mb-2">Jadwal Fleksibel</h3>
            <p class="text-gray-600 text-sm">
                Pilih jadwal kapan pun sesuai kebutuhan
            </p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
            <p class="text-3xl mb-3">⭐</p>
            <h3 class="font-bold mb-2">Lapangan Berkualitas</h3>
            <p class="text-gray-600 text-sm">
                Semua lapangan terstandar & terverifikasi
            </p>
        </div>

    </section>



    <!-- LAPANGAN POPULER -->
    <section id="lapangan" class="max-w-7xl mx-auto py-10 px-6">
        <h2 class="text-3xl font-bold text-center mb-10">Lapangan Populer</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="/images/lap1.png" class="w-full h-44 object-cover">
                <div class="p-4">
                    <h3 class="font-bold">Respect Basketball Arena</h3>
                    <p class="text-gray-600 text-sm">Tangerang Selatan • 2 Lapangan</p>
                    <p class="text-orange-600 font-semibold text-sm mt-2">Mulai Rp 550.000/jam</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="/images/lap2.png" class="w-full h-44 object-cover">
                <div class="p-4">
                    <h3 class="font-bold">Happy Hoops Jakarta</h3>
                    <p class="text-gray-600 text-sm">Jakarta Barat • 3 Lapangan</p>
                    <p class="text-orange-600 font-semibold text-sm mt-2">Mulai Rp 50.000/jam</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                <img src="/images/lap3.png" class="w-full h-44 object-cover">
                <div class="p-4">
                    <h3 class="font-bold">Skyline Court</h3>
                    <p class="text-gray-600 text-sm">Tangerang Selatan • 3 Lapangan</p>
                    <p class="text-orange-600 font-semibold text-sm mt-2">Mulai Rp 200.000/jam</p>
                </div>
            </div>

        </div>
    </section>



    <!-- FOOTER -->
    <footer class="bg-gray-900 text-center text-white py-6 mt-16">
        <p class="text-sm">© 2025 BasketGO - Penyewaan Lapangan Basket</p>
        <p class="text-sm opacity-80">Booking lapangan basket dengan mudah dan terpercaya</p>
    </footer>

</body>
</html>
