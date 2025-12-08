<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - BasketGO</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- KIRI (Gambar + Text) -->
    <div class="hidden md:flex w-1/2 h-screen relative">
        <img src="/images/login.png" class="w-full h-full object-cover" alt="BasketGO Forgot Password">

        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

        <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center px-6">
            <h1 class="text-3xl font-bold drop-shadow-lg">Lupa Kata Sandi?</h1>
            <p class="text-md mt-2 drop-shadow-lg w-3/4">
                Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang kata sandi.
            </p>
        </div>
    </div>

    <!-- KANAN (Card Form) -->
    <div class="w-full md:w-1/2 bg-orange-500 flex justify-center items-center p-6">

        <div class="bg-white w-[420px] rounded-2xl shadow-xl p-8">

            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <img src="/images/logo.png" class="w-12" alt="Logo BasketGO">
            </div>

            <h2 class="text-xl font-bold text-center mb-2">Atur Ulang Kata Sandi</h2>
            <p class="text-center text-gray-500 text-sm mb-6">
                Masukkan email Anda untuk menerima link reset password
            </p>

            <!-- Status -->
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Error -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" required autofocus
                       value="{{ old('email') }}"
                       placeholder="Masukkan email Anda"
                       class="w-full border rounded-lg p-2 mb-4">

                <button
                    class="bg-orange-500 text-white w-full p-2 rounded-lg font-semibold hover:bg-orange-600 transition">
                    Kirim Link Reset Password
                </button>
            </form>

            <p class="text-center text-sm mt-4">
                Kembali ke  
                <a href="{{ route('login') }}" class="text-orange-600 font-semibold">Halaman Masuk</a>
            </p>
        </div>
    </div>

</div>

</body>
</html>
