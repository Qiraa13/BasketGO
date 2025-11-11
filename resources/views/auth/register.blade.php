<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar BasketGO</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="h-screen flex overflow-hidden">

    <!-- ✅ KIRI (Gambar Besar) -->
    <div class="w-1/2 hidden md:flex relative h-screen">
        <img src="/images/register.jpg" class="w-full h-full object-cover" alt="Basket Court">

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center px-6">
            <h2 class="text-2xl font-bold mb-2 drop-shadow-lg">Selamat Datang di BasketGO</h2>
            <p class="text-sm drop-shadow-lg">
                Pesan lapangan terbaikmu dan bermainlah seperti seorang profesional.
            </p>
        </div>
    </div>

    <!-- ✅ KANAN (Card Form) -->
    <div class="w-full md:w-1/2 bg-orange-500 flex justify-center items-center h-screen">

        <div class="bg-white w-[420px] min-w-[420px] rounded-2xl shadow-xl p-8">

            <div class="flex justify-center mb-4">
                <img src="/images/logo.png" class="w-12" alt="Logo BasketGO">
            </div>

            <h2 class="text-xl font-bold text-center">Daftar BasketGO</h2>
            <p class="text-center text-gray-500 text-sm mb-6">Buat akun Anda sekarang juga</p>

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

            <!-- ✅ FORM REGISTER -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input type="text" name="name" placeholder="Nama Lengkap"
                       value="{{ old('name') }}"
                       class="w-full border rounded p-2 mb-3">

                <input type="email" name="email" placeholder="Email"
                       value="{{ old('email') }}"
                       class="w-full border rounded p-2 mb-3">

                <input type="text" name="nomor_telepon" placeholder="Nomor Telepon"
                       value="{{ old('nomor_telepon') }}"
                       class="w-full border rounded p-2 mb-3">

                <input type="password" name="password" placeholder="Kata Sandi"
                       class="w-full border rounded p-2 mb-3">

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                       class="w-full border rounded p-2 mb-3">

                <input type="text" name="kota" placeholder="Kota"
                       value="{{ old('kota') }}"
                       class="w-full border rounded p-2 mb-3">

                <label class="flex items-center text-sm text-gray-600 mb-3 cursor-pointer">
                    <input type="checkbox" required class="mr-2">
                    Saya setuju dengan
                    <span class="text-orange-600 font-medium ml-1">Syarat & Ketentuan</span>
                </label>

                <button
                    class="bg-orange-500 text-white w-full p-2 rounded-lg font-semibold hover:bg-orange-600 transition">
                    Daftar
                </button>
            </form>

            <p class="text-center text-sm mt-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-orange-600 font-semibold">Masuk di sini</a>
            </p>

        </div>
    </div>

</div>

</body>
</html>
