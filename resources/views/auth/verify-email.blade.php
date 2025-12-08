<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-500 via-amber-500 to-yellow-400 p-6">

        <div class="w-full max-w-md bg-white/20 backdrop-blur-xl border border-white/30 p-8 rounded-2xl shadow-2xl text-white text-center">

            <!-- Logo -->
            <img src="{{ asset('images/logo.png') }}" 
                 alt="Logo" 
                 class="mx-auto mb-4 w-28 drop-shadow-lg">

            <!-- Title -->
            <h2 class="text-3xl font-extrabold mb-2 drop-shadow-md">
                Verify Your Email
            </h2>

            <p class="text-white/90 mb-6">
                Terima kasih telah mendaftar di <strong>BasketGO</strong>!
                <br>Silakan cek email kamu untuk verifikasi akun.
            </p>

            <!-- Status -->
            @if (session('status') == 'verification-link-sent')
                <p class="text-green-300 font-semibold mb-4">
                    Link verifikasi baru telah dikirim ke email kamu!
                </p>
            @endif

            <!-- Resend Button -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button 
                    class="w-full py-3 mt-3 bg-white/95 text-orange-600 font-bold rounded-xl 
                           hover:bg-white transition-all shadow-lg hover:shadow-2xl">
                    Resend Verification Email
                </button>
            </form>

            <!-- Small Note -->
            <p class="text-xs text-white/80 mt-6">
                Belum menerima email? Periksa folder spam/junk juga ya!
            </p>

        </div>
    </div>

</x-guest-layout>
