<?php

use Illuminate\Support\Facades\Route;

// USER CONTROLLERS
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;

// ADMIN CONTROLLERS
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminHistoryController;
use App\Http\Controllers\AdminLapanganController;


// =====================================================================
// ROOT / LANDING
// =====================================================================
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('landing');
})->name('landing');


// =====================================================================
// USER (LOGIN REQUIRED)
// =====================================================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard User
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    // Booking Page
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    // AJAX Filter Lapangan
    Route::get('/booking/filter', [BookingController::class, 'filterByJenis'])
        ->name('booking.filter');

    // Create Booking + Upload Bukti Transfer
    Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('booking.store');

    // User History
    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');
});


// =====================================================================
// USER ACCOUNT
// =====================================================================
Route::delete('/delete-account', [UserAccountController::class, 'destroy'])
    ->name('account.delete');


// =====================================================================
// ADMIN PANEL
// =====================================================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', fn () => view('admin.dashboard'))
        ->name('admin.dashboard');

    // Transaksi Admin
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])
        ->name('admin.transaksi');

    // Booking History Admin
    Route::get('/booking-history', [AdminHistoryController::class, 'booking'])
        ->name('admin.history.booking');

    // LAPANGAN PAGE (LAPANGAN + JADWAL)
    Route::get('/lapangan', [AdminHistoryController::class, 'jadwal'])
        ->name('admin.lapangan');

    // CRUD LAPANGAN
    Route::post('/lapangan/store', [AdminLapanganController::class, 'store'])
        ->name('admin.lapangan.store');

    Route::put('/lapangan/{lapangan}', [AdminLapanganController::class, 'update'])
        ->name('admin.lapangan.update');

    Route::delete('/lapangan/{lapangan}', [AdminLapanganController::class, 'destroy'])
        ->name('admin.lapangan.destroy');

    // CRUD JADWAL
    Route::post('/lapangan/jadwal', [AdminHistoryController::class, 'storeJadwal'])
        ->name('admin.lapangan.jadwal.store');

    Route::get('/lapangan/jadwal/{jadwal}/edit', [AdminHistoryController::class, 'editJadwal'])
        ->name('admin.lapangan.jadwal.edit');

    Route::put('/lapangan/jadwal/{jadwal}', [AdminHistoryController::class, 'updateJadwal'])
        ->name('admin.lapangan.jadwal.update');

    Route::delete('/lapangan/jadwal/{jadwal}', [AdminHistoryController::class, 'destroyJadwal'])
        ->name('admin.lapangan.jadwal.destroy');
});


// AUTH ROUTES (Laravel Breeze/Fortify)
require __DIR__.'/auth.php';
