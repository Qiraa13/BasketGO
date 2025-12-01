<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminHistoryController;

// Arahkan root berdasarkan role / login
Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return view('landing');
})->name('landing');


// Dashboard User
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

// Hapus akun user
Route::delete('/delete-account', [UserAccountController::class, 'destroy'])
     ->name('account.delete');


// User profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================
// ROUTE ADMIN
// =========================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

 Route::get('/book-court', function () {
    return view('admin.book-court');
})->name('admin.bookcourt');

    // Riwayat Transaksi (pakai controller)
    Route::get('/transaksi', [\App\Http\Controllers\AdminTransaksiController::class, 'index'])
        ->name('admin.transaksi');

    // Booking History
    Route::get('/booking-history', [\App\Http\Controllers\AdminHistoryController::class, 'booking'])
        ->name('admin.history.booking');

    // Lapangan & Jadwal (fix method name and add CRUD routes)
    Route::get('/lapangan-jadwal', [\App\Http\Controllers\AdminHistoryController::class, 'jadwal'])
        ->name('admin.lapangan.jadwal');

    Route::get('/lapangan-jadwal/create', [\App\Http\Controllers\AdminHistoryController::class, 'createJadwal'])
        ->name('admin.lapangan.jadwal.create');
    Route::post('/lapangan-jadwal', [\App\Http\Controllers\AdminHistoryController::class, 'storeJadwal'])
        ->name('admin.lapangan.jadwal.store');
    Route::get('/lapangan-jadwal/{jadwal}/edit', [\App\Http\Controllers\AdminHistoryController::class, 'editJadwal'])
        ->name('admin.lapangan.jadwal.edit');
    Route::put('/lapangan-jadwal/{jadwal}', [\App\Http\Controllers\AdminHistoryController::class, 'updateJadwal'])
        ->name('admin.lapangan.jadwal.update');
    Route::delete('/lapangan-jadwal/{jadwal}', [\App\Http\Controllers\AdminHistoryController::class, 'destroyJadwal'])
        ->name('admin.lapangan.jadwal.destroy');
    
    // Lapangan CRUD
    Route::get('/lapangan', [\App\Http\Controllers\AdminLapanganController::class, 'index'])
        ->name('admin.lapangan.index');
    Route::get('/lapangan/create', [\App\Http\Controllers\AdminLapanganController::class, 'create'])
        ->name('admin.lapangan.create');
    Route::post('/lapangan', [\App\Http\Controllers\AdminLapanganController::class, 'store'])
        ->name('admin.lapangan.store');
    Route::get('/lapangan/{lapangan}/edit', [\App\Http\Controllers\AdminLapanganController::class, 'edit'])
        ->name('admin.lapangan.edit');
    Route::put('/lapangan/{lapangan}', [\App\Http\Controllers\AdminLapanganController::class, 'update'])
        ->name('admin.lapangan.update');
    Route::delete('/lapangan/{lapangan}', [\App\Http\Controllers\AdminLapanganController::class, 'destroy'])
        ->name('admin.lapangan.destroy');
});


require __DIR__.'/auth.php';
