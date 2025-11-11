<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk BasketGO</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="min-h-screen w-full flex">

    <!-- ✅ BAGIAN KIRI (Gambar + Text) -->
    <div class="hidden md:flex w-1/2 h-screen relative">
        <img src="/images/login.png" class="w-full h-full object-cover" alt="Background Basket">

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center px-6">
            <h1 class="text-3xl font-bold drop-shadow-lg">BasketGO</h1>
            <p class="text-md mt-2 drop-shadow-lg">
                Platform Pemesanan Lapangan Basket No.1 untuk Anda
            </p>
        </div>
    </div>

    <!-- ✅ BAGIAN KANAN (Card Login) -->
    <div class="w-full md:w-1/2 bg-orange-500 flex justify-center items-center">

        <div class="bg-white w-[420px] rounded-2xl shadow-xl p-8">

            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="/images/logo.png" class="w-10" alt="Logo BasketGO">
            </div>

            <h2 class="text-2xl font-bold text-center">Masuk BasketGO</h2>
            <p class="text-center text-gray-500 text-sm mb-6">
                Silakan login ke akun Anda
            </p>

            

            <!-- ✅ ERROR MESSAGE -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ✅ FORM LOGIN -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" placeholder="Masukkan email Anda"
                       class="w-full border rounded-lg p-2 mb-4">

                <label class="text-sm font-medium">Kata Sandi</label>
                <input type="password" name="password" placeholder="Masukkan kata sandi"
                       class="w-full border rounded-lg p-2 mb-2">

                <div class="flex justify-between items-center text-sm mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Ingat saya
                    </label>

                    <a href="{{ route('password.request') }}" class="text-orange-600 font-medium">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <button
                    class="bg-orange-500 text-white w-full p-2 rounded-lg font-semibold hover:bg-orange-600 transition">
                    Masuk
                </button>
            </form>

            <!-- ✅ LINK REGISTER -->
            <p class="text-center text-sm mt-4">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-orange-600 font-semibold">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </div>

</div>

<!-- ✅ JS kecil untuk tombol Pengguna/Admin -->
<script>
    const userBtn = document.getElementById('btnUser');
    const adminBtn = document.getElementById('btnAdmin');

    userBtn.onclick = () => {
        userBtn.classList.add('bg-orange-100', 'text-orange-600', 'border-orange-500');
        adminBtn.classList.remove('bg-orange-100', 'text-orange-600');
    };

    adminBtn.onclick = () => {
        adminBtn.classList.add('bg-orange-100', 'text-orange-600', 'border-orange-500');
        userBtn.classList.remove('bg-orange-100', 'text-orange-600');
    };
</script>

</body>
</html>
