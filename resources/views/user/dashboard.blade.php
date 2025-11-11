<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-5">
                <h1 class="text-2xl font-bold">Dashboard User</h1>
                <p class="mt-2 text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>
            </div>

            {{-- Hapus Akun --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('user.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <h2 class="text-lg font-bold mb-3 text-red-600">Hapus Akun</h2>
                    <p class="text-gray-600 mb-4">
                        Menghapus akun bersifat permanen dan tidak dapat dikembalikan.
                    </p>

                    <button type="submit"
                        onclick="return confirm('Yakin ingin menghapus akun secara permanen?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Hapus Akun
                    </button>
                </form>

            </div>

        </div>
    </div>

</x-app-layout>
