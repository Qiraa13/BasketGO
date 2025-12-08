<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Include AlpineJS if not loaded -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- PROFILE DROPDOWN (MODERN STYLE) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6" x-data="{ menuOpen: false }">
                <div class="relative">
                    <!-- Profile Button -->
                    <button @click="menuOpen = !menuOpen" class="flex items-center">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('default-profile.png') }}"
                             class="w-10 h-10 rounded-full border">
                    </button>

                    <!-- Dropdown -->
                    <div x-show="menuOpen"
                         @click.outside="menuOpen = false"
                         x-transition
                         class="absolute right-0 mt-3 w-64 bg-white shadow-lg rounded-xl p-4 z-50">

                        <!-- User Info -->
                        <div class="flex items-center space-x-3 border-b pb-3">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('default-profile.png') }}"
                                 class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <!-- Menu -->
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('profile.edit') }}"
                               class="block px-3 py-2 rounded-lg hover:bg-gray-100 font-medium">
                                Edit Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="w-full text-left px-3 py-2 text-red-600 rounded-lg hover:bg-red-100 font-medium">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500
                               hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition
                               duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
