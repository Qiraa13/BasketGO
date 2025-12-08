@extends('layouts.user-dashboard')

@section('content')
<div class="p-6 space-y-8">
<div class="bg-white p-6 rounded-lg shadow">

    <div class="flex justify-between items-center">
        
        {{-- Greeting --}}
        <div>
            <h1 class="text-2xl font-bold">Booking Lapangan</h1>
            <p class="text-gray-500">Kelola pemesanan BGO anda</p>
        </div>

        {{-- Search + Status + Notif + Avatar --}}
        <div class="flex items-center gap-4">

            {{-- Search --}}
            <input type="text"
                placeholder="Cari pemesanan..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56
                       focus:ring-orange-400 focus:border-orange-400">

            {{-- Dropdown --}}
            <div class="relative">
                <select
                    class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm appearance-none
                           focus:ring-orange-400 focus:border-orange-400">
                    <option>Semua Status</option>
                    <option>Verifikasi</option>
                    <option>Disetujui</option>
                    <option>Pending</option>
                </select>

                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 pointer-events-none">▼</span>
            </div>

            {{-- Notifikasi --}}
            <button class="text-xl hover:text-orange-500">🔔</button>

            {{-- Avatar --}}
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                class="w-10 h-10 rounded-full border border-gray-300 shadow-sm">
        </div>

    </div> {{-- END flex justify-between --}}

</div>

{{-- Card: Jenis Lapangan --}}
<div class="bg-white p-6 rounded-lg shadow space-y-4">

    <h2 class="font-semibold text-lg flex items-center gap-2">
        <span class="text-red-500 text-xl">📍</span> Pilih Jenis BGO
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Indoor --}}
        <button
            onclick="selectType('Indoor', 150000, this)"
            class="bgo-btn border border-gray-300 p-4 rounded-xl text-left space-y-1 hover:border-orange-400">
            <p class="font-bold text-lg">Indoor</p>
            <p class="text-gray-500 text-sm">ber-AC</p>
            <p class="text-orange-600 font-semibold">Rp 150k/Jam</p>
        </button>

        {{-- Outdoor --}}
        <button
            onclick="selectType('Outdoor', 100000, this)"
            class="bgo-btn border border-gray-300 p-4 rounded-xl text-left space-y-1 hover:border-orange-400">
            <p class="font-bold text-lg">Outdoor</p>
            <p class="text-gray-500 text-sm">Pencahayaan alami</p>
            <p class="text-orange-600 font-semibold">Rp 100k/Jam</p>
        </button>

        {{-- Premium --}}
        <button
            onclick="selectType('Premium', 250000, this)"
            class="bgo-btn border border-gray-300 p-4 rounded-xl text-left space-y-1 hover:border-orange-400">
            <p class="font-bold text-lg">Premium</p>
            <p class="text-gray-500 text-sm">VIP</p>
            <p class="text-orange-600 font-semibold">Rp 250k/Jam</p>
        </button>

    </div>

</div>

{{-- Card: Tanggal & Waktu --}}
<div class="bg-white p-6 rounded-lg shadow space-y-4">

    <h2 class="font-semibold text-lg flex items-center gap-2">
        <span class="text-red-500 text-xl">📅</span> Pilih Tanggal & Waktu
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Date Picker --}}
        <div>
            <label class="text-sm font-medium">Tanggal</label>
            <input type="date" id="selectedDate"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1 focus:ring-orange-400"
                onchange="updateSummary()">
        </div>

        {{-- Time Slots --}}
        <div>
            <label class="text-sm font-medium">Slot Waktu Tersedia</label>
            <div class="grid grid-cols-3 gap-3 mt-2">

                @php
                    $times = [
                        '08:00 - 09:00',
                        '09:00 - 10:00',
                        '10:00 - 11:00',
                        '11:00 - 12:00',
                        '14:00 - 15:00',
                        '15:00 - 16:00',
                    ];
                @endphp

                @foreach ($times as $time)
                    <button onclick="selectTime('{{ $time }}', this)"
                        class="time-btn border border-gray-300 rounded-lg py-2 text-sm">
                        {{ $time }}
                    </button>
                @endforeach

            </div>
        </div>

    </div>

</div>

{{-- Pratinjau Lapangan --}}
<div class="bg-white p-6 rounded-lg shadow space-y-4">
    <img src="{{ asset('images/bookcourt.png') }}"
         class="rounded-xl w-full h-64 object-cover">

    <p class="text-green-600 text-sm mt-1 flex items-center gap-2">
        <span>●</span> Professional court with standard dimensions
    </p>
</div>


{{-- Booking Summary --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Tips --}}
    <div class="bg-green-50 p-6 rounded-lg">
        <h3 class="font-bold text-lg flex items-center gap-2">
            <span class="text-green-600">📌</span> Booking Tips
        </h3>
        <ul class="mt-3 text-sm space-y-2 text-gray-700">
            <li>✔ Book early for weekend slots</li>
            <li>✔ Cancel up to 2 hours before</li>
            <li>✔ Bring your own equipment</li>
        </ul>
    </div>

    {{-- Summary --}}
    <div class="bg-white p-6 rounded-lg shadow space-y-4">
        <h3 class="font-bold text-lg">Ringkasan Booking</h3>

        <div class="border-t pt-3 space-y-2 text-sm">
            <p class="flex justify-between"><span>BGO Type</span> <strong id="sumType">-</strong></p>
            <p class="flex justify-between"><span>Tanggal</span> <strong id="sumDate">-</strong></p>
            <p class="flex justify-between"><span>Waktu</span> <strong id="sumTime">-</strong></p>
            <p class="flex justify-between"><span>Durasi</span> <strong id="sumDuration">1 jam</strong></p>
            <p class="flex justify-between"><span>Harga per Jam</span> <strong id="sumPrice">Rp 0</strong></p>
            <p class="flex justify-between"><span>Service Fee</span> <strong>Rp 15.000</strong></p>
        </div>

        <div class="flex justify-between text-lg font-bold text-orange-600 border-t pt-3">
            <span>Total</span> <span id="sumTotal">Rp 0</span>
        </div>

        <button 
            onclick="openPaymentModal()"
            class="bg-orange-500 hover:bg-orange-600 text-white w-full py-3 rounded-xl font-semibold">
            Pay and Book Now
        </button>

        <p class="text-green-700 text-sm flex items-center gap-2">
            <span>✔</span> Pembayaran aman terjamin
        </p>
    </div>

</div>

</div>

{{-- PAYMENT MODAL --}}
<div id="paymentModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white w-96 p-6 rounded-xl shadow-lg space-y-4">

        <h2 class="text-xl font-bold text-center mb-4">Pembayaran</h2>

        <p class="text-sm mb-2">Metode Pembayaran:</p>

        <select id="paymentMethod" class="w-full border border-gray-300 p-2 rounded-lg">
            <option value="QRIS">QRIS</option>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="E-Wallet">E-Wallet</option>
        </select>

        <div class="mt-4">
            <p class="font-semibold">Total Pembayaran:</p>
            <p id="modalTotal" class="text-orange-600 font-bold text-xl">Rp -</p>
        </div>

        <button 
            onclick="submitPayment()"
            class="bg-orange-500 hover:bg-orange-600 w-full text-white py-2 rounded-lg mt-4">
            Bayar Sekarang
        </button>

        <button 
            onclick="closePaymentModal()"
            class="w-full mt-2 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
            Batal
        </button>

    </div>
</div>


{{-- SCRIPT INTERAKTIF --}}
<script>
    let selectedType = null;
    let selectedPrice = 0;
    let selectedTime = null;

    function selectType(type, price, element) {
        selectedType = type;
        selectedPrice = price;

        document.querySelectorAll('.bgo-btn').forEach(btn => {
            btn.classList.remove('border-orange-500', 'bg-orange-50');
            btn.classList.add('border-gray-300');
        });

        element.classList.add('border-orange-500', 'bg-orange-50');

        updateSummary();
    }

    function selectTime(time, element) {
        selectedTime = time;

        document.querySelectorAll('.time-btn').forEach(btn => {
            btn.classList.remove('bg-orange-500', 'text-white');
            btn.classList.add('border-gray-300');
        });

        element.classList.add('bg-orange-500', 'text-white');

        document.getElementById('sumTime').textContent = time;

        updateSummary();
    }

    function updateSummary() {
        document.getElementById('sumType').textContent = selectedType ?? '-';
        document.getElementById('sumDate').textContent =
            document.getElementById('selectedDate').value || '-';
        document.getElementById('sumPrice').textContent =
            "Rp " + selectedPrice.toLocaleString();

        let total = selectedPrice + 15000;
        document.getElementById('sumTotal').textContent = "Rp " + total.toLocaleString();
    }

    function openPaymentModal() {
        const total = document.getElementById("sumTotal").textContent;
        document.getElementById("modalTotal").textContent = total;

        document.getElementById("paymentModal").classList.remove("hidden");
        document.getElementById("paymentModal").classList.add("flex");
    }

    function closePaymentModal() {
        document.getElementById("paymentModal").classList.add("hidden");
        document.getElementById("paymentModal").classList.remove("flex");
    }

    function submitPayment() {
        alert("Pembayaran berhasil! Booking Anda telah dibuat.");
        closePaymentModal();
    }
</script>

@endsection
