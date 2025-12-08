<?php

// database/migrations/2025_09_15_000003_create_booking_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('booking', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('lapangan_id')->constrained('lapangan')->onDelete('cascade');

    // WAJIB UNTUK CEK SLOT TERBOOKING
    $table->date('tanggal');
    $table->string('jam');  // contoh: "08:00 - 09:00"

    $table->enum('status', ['pending', 'diterima', 'ditolak'])
        ->default('pending');

    $table->timestamps();
});

    }

    public function down(): void {
        Schema::dropIfExists('booking');
    }
};

