<?php

// database/migrations/2025_09_15_000001_create_lapangan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lapangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis');
            $table->integer('harga_per_jam');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('lapangan');
    }
};

