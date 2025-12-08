@extends('layouts.user-dashboard')

@section('content')
<div class="p-6 space-y-8">

{{-- ================= HEADER ================= --}}
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-2xl font-bold">Booking Lapangan</h1>
            <p class="text-gray-500">Kelola pemesanan BGO anda</p>
        </div>

        <div class="flex items-center gap-4">
            <input type="text"
                placeholder="Cari pemesanan..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-56">

            <button class="text-xl hover:text-orange-500">🔔</button>

            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                class="w-10 h-10 rounded-full border border-gray-300 shadow-sm">
        </div>

    </div>
</div>



{{-- ================= PILIH JENIS ================= --}}
<div class="bg-white p-6 rounded-lg shadow space-y-4">

    <h2 class="font-semibold text-lg flex items-center gap-2">
        <span class="text-red-500 text-xl">📍</span> Pilih Jenis BGO
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <button onclick="selectType('Indoor', this)"
            class="bgo-btn border border-gray-300 p-4 rounded-xl hover:border-orange-400">
            <p class="font-bold text-lg">Indoor</p>
            <p class="text-gray-500 text-sm">ber-AC</p>
        </button>

        <button onclick="selectType('Outdoor', this)"
            class="bgo-btn border border-gray-300 p-4 rounded-xl hover:border-orange-400">
            <p class="font-bold text-lg">Outdoor</p>
            <p class="text-gray-500 text-sm">Pencahayaan alami</p>
        </button>

        <button onclick="selectType('Premium', this)"
            class="bgo-btn border border-gray-300 p-4 rounded-xl hover:border-orange-400">
            <p class="font-bold text-lg">Premium</p>
            <p class="text-gray-500 text-sm">VIP</p>
        </button>

    </div>

</div>



{{-- ================= LAPANGAN ================= --}}
<div class="bg-white p-6 rounded-lg shadow space-y-4">

    <h2 class="font-semibold text-lg flex items-center gap-2">
        <span class="text-blue-500 text-xl">🏟️</span> Pilih Lapangan
    </h2>

    <div id="lapanganList" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>

</div>



{{-- ================= TANGGAL & JAM ================= --}}
<div class="bg-white p-6 rounded-lg shadow space-y-4">

    <h2 class="font-semibold text-lg flex items-center gap-2">
        <span class="text-red-500 text-xl">📅</span> Pilih Tanggal & Waktu
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="text-sm font-medium">Tanggal</label>
            <input type="date" id="selectedDate"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-1"
                onchange="updateSummary()">
        </div>

        <div>
            <label class="text-sm font-medium">Slot Waktu</label>

            <div class="grid grid-cols-3 gap-3 mt-2">
                @foreach (['08:00 - 09:00','09:00 - 10:00','10:00 - 11:00','11:00 - 12:00','14:00 - 15:00','15:00 - 16:00'] as $time)
                    <button onclick="selectTime('{{ $time }}', this)"
                        class="time-btn border border-gray-300 rounded-lg py-2 text-sm hover:border-orange-400">
                        {{ $time }}
                    </button>
                @endforeach
            </div>

        </div>
    </div>

</div>



{{-- ================= RINGKASAN ================= --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-green-50 p-6 rounded-lg">
        <h3 class="font-bold text-lg">Booking Tips</h3>
        <ul class="mt-3 text-sm space-y-2">
            <li>✔ Book early untuk weekend</li>
            <li>✔ Cancel max 2 jam sebelum</li>
            <li>✔ Bawa perlengkapan sendiri</li>
        </ul>
    </div>

    <div class="bg-white p-6 rounded-lg shadow space-y-4">

        <h3 class="font-bold text-lg">Ringkasan Booking</h3>

        <div class="border-t pt-3 text-sm space-y-2">
            <p class="flex justify-between"><span>Jenis</span> <strong id="sumType">-</strong></p>
            <p class="flex justify-between"><span>Lapangan</span> <strong id="sumCourt">-</strong></p>
            <p class="flex justify-between"><span>Tanggal</span> <strong id="sumDate">-</strong></p>
            <p class="flex justify-between"><span>Waktu</span> <strong id="sumTime">-</strong></p>
            <p class="flex justify-between"><span>Harga</span> <strong id="sumPrice">Rp 0</strong></p>
        </div>

        <div class="flex justify-between text-lg font-bold text-orange-600 border-t pt-3">
            <span>Total</span> <span id="sumTotal">Rp 0</span>
        </div>

        <button onclick="openPaymentModal()"
            class="bg-orange-500 text-white py-3 rounded-xl font-semibold">
            Pay and Book Now
        </button>

    </div>

</div>

</div> {{-- END CONTENT --}}



{{-- ================= PAYMENT MODAL ================= --}}
<div id="paymentModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white w-96 p-6 rounded-xl shadow-lg space-y-4">

        <h2 class="text-xl font-bold text-center">Pembayaran Transfer Bank</h2>

        <p class="text-sm">Silakan transfer ke:</p>

        <div class="text-center mt-2">
            <p class="text-lg font-bold">BCA - 123 456 7890</p>
            <p>a/n BasketGO Indonesia</p>
        </div>

        <div>
            <p class="font-semibold">Total:</p>
            <p id="modalTotal" class="text-orange-600 font-bold text-xl">Rp -</p>
        </div>

        {{-- INPUT FILE --}}
        <div class="mt-3">
            <label class="font-semibold text-sm">Upload Bukti Transfer</label>
            <input type="file" id="bukti" accept="image/*"
                class="border p-2 w-full rounded-lg bg-white z-50">
        </div>

        <button onclick="submitPayment()"
            class="bg-orange-500 text-white w-full py-2 rounded-lg mt-4 cursor-pointer">
            Upload & Konfirmasi
        </button>

        <button onclick="closePaymentModal()"
            class="w-full mt-2 py-2 rounded-lg bg-gray-200 cursor-pointer">
            Batal
        </button>

    </div>
</div>



{{-- ================= SCRIPT ================= --}}
<script>

let selectedType = null;
let selectedCourt = null;
let selectedPrice = 0;
let selectedTime = null;


/* === PILIH JENIS === */
function selectType(type, element) {

    selectedType = type;

    document.querySelectorAll('.bgo-btn')
        .forEach(btn => btn.classList.remove('border-orange-500', 'bg-orange-50'));

    element.classList.add('border-orange-500', 'bg-orange-50');

    fetch(`/booking/filter?jenis=${type}`)
        .then(res => res.json())
        .then(data => {

            let html = "";

            data.forEach(l => {
                html += `
                    <div class="lapangan-card border p-4 rounded-xl shadow hover:border-orange-400 cursor-pointer"
                         onclick="selectCourt('${l.nama}', ${l.harga_per_jam}, this)">
                        <h3 class="font-bold text-lg">${l.nama}</h3>
                        <p class="text-sm text-gray-500">${l.jenis}</p>
                        <p class="text-orange-600 font-semibold">Rp ${l.harga_per_jam.toLocaleString()}</p>
                    </div>
                `;
            });

            document.getElementById("lapanganList").innerHTML = html;
        });

    updateSummary();
}



/* === PILIH LAPANGAN === */
function selectCourt(nama, harga, element) {
    selectedCourt = nama;
    selectedPrice = harga;

    document.querySelectorAll('.lapangan-card')
        .forEach(c => c.classList.remove('border-orange-500', 'bg-orange-50'));

    element.classList.add('border-orange-500', 'bg-orange-50');

    updateSummary();
}



/* === PILIH JAM === */
function selectTime(time, element) {

    selectedTime = time;

    document.querySelectorAll('.time-btn')
        .forEach(btn => btn.classList.remove('bg-orange-500', 'text-white'));

    element.classList.add('bg-orange-500', 'text-white');

    updateSummary();
}



/* === UPDATE SUMMARY === */
function updateSummary() {

    document.getElementById('sumType').textContent = selectedType ?? "-";
    document.getElementById('sumCourt').textContent = selectedCourt ?? "-";
    document.getElementById('sumDate').textContent =
        document.getElementById('selectedDate').value || "-";
    document.getElementById('sumTime').textContent = selectedTime ?? "-";

    let total = (selectedPrice || 0) + 15000;
    document.getElementById('sumTotal').textContent =
        "Rp " + total.toLocaleString();
}



/* === OPEN MODAL === */
function openPaymentModal() {

    if (!selectedCourt || !selectedTime || !document.getElementById("selectedDate").value) {
        alert("Lengkapi semua pilihan!");
        return;
    }

    document.getElementById("modalTotal").textContent =
        document.getElementById("sumTotal").textContent;

    document.getElementById("paymentModal").classList.remove("hidden");
    document.getElementById("paymentModal").classList.add("flex");
}



/* === CLOSE MODAL === */
function closePaymentModal() {
    document.getElementById("paymentModal").classList.add("hidden");
}



/* === KIRIM DATA BOOKING + BUKTI TRANSFER === */
function submitPayment() {

    let file = document.getElementById("bukti").files[0];

    if (!file) {
        alert("Upload bukti transfer dulu!");
        return;
    }

    let formData = new FormData();
    formData.append("_token", "{{ csrf_token() }}");
    formData.append("lapangan", selectedCourt);
    formData.append("tanggal", document.getElementById("selectedDate").value);
    formData.append("jam", selectedTime);
    formData.append("metode", "Transfer Bank");
    formData.append("total", selectedPrice + 15000);
    formData.append("bukti", file);

    fetch("{{ route('booking.store') }}", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            alert("Booking berhasil! Menunggu verifikasi admin.");
            window.location.href = "/history";
        } else {
            alert(res.error || "Gagal booking.");
        }
    });
}

</script>
@endsection
