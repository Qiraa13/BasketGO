<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-500 via-amber-500 to-yellow-400 p-6">
        
        <div class="w-full max-w-md backdrop-blur-lg bg-white/20 border border-white/30 shadow-2xl rounded-2xl p-8 text-white">

            <!-- Title -->
            <h2 class="text-3xl font-extrabold text-center mb-2 drop-shadow-md">
                Reset Password
            </h2>

            <p class="text-sm text-center text-white/90 mb-8">
                Set your new password to access your account again.
            </p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-5">
                    <x-input-label for="email" :value="__('Email')" class="font-semibold text-white" />

                    <div class="relative mt-1">
                        <span class="absolute left-3 top-3 text-white/90">
                            📧
                        </span>
                        <x-text-input 
                            id="email"
                            type="email"
                            name="email"
                            :value="old('email', $request->email)"
                            required
                            autofocus
                            autocomplete="username"
                            class="block w-full pl-11 rounded-xl bg-white/20 border-white/40 text-white placeholder-white/70 focus:border-white focus:ring-white"
                        />
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-200" />
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <x-input-label for="password" :value="__('New Password')" class="font-semibold text-white" />

                    <div class="relative mt-1">
                        <span class="absolute left-3 top-3 text-white/90">
                            🔒
                        </span>
                        <x-text-input 
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            class="block w-full pl-11 rounded-xl bg-white/20 border-white/40 text-white placeholder-white/70 focus:border-white focus:ring-white"
                        />
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-200" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="font-semibold text-white" />

                    <div class="relative mt-1">
                        <span class="absolute left-3 top-3 text-white/90">
                            🔁
                        </span>
                        <x-text-input 
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            class="block w-full pl-11 rounded-xl bg-white/20 border-white/40 text-white placeholder-white/70 focus:border-white focus:ring-white"
                        />
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-200" />
                </div>

                <!-- Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 bg-white/95 text-orange-600 font-bold text-lg rounded-xl hover:bg-white transition-all shadow-xl hover:shadow-2xl"
                >
                    Reset Password
                </button>

            </form>

        </div>
    </div>

</x-guest-layout>
