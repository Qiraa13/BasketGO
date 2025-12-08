<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAccountController;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HistoryController;

use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminHistoryController;
use App\Http\Controllers\AdminLapanganController;

// =========================
// ROOT / LANDING
// =========================
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('landing');
})->name('landing');


// =========================
// USER (AUTH)
// =========================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    // BOOK COURT
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    // USER HISTORY
    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');

});


// =========================
// USER ACCOUNT (DELETE)
// =========================
Route::delete('/delete-account', [UserAccountController::class, 'destroy'])
    ->name('account.delete');


// =========================
// USER PROFILE
// =========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// =========================
// ADMIN
// =========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Book Court Admin
    Route::get('/book-court', function () {
        return view('admin.book-court');
    })->name('admin.bookcourt');

    // Transaksi
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])
        ->name('admin.transaksi');

    // Booking History
    Route::get('/booking-history', [AdminHistoryController::class, 'booking'])
        ->name('admin.history.booking');

    // Lapangan & Jadwal
    Route::get('/lapangan-jadwal', [AdminHistoryController::class, 'jadwal'])
        ->name('admin.lapangan.jadwal');

    Route::get('/lapangan-jadwal/create', [AdminHistoryController::class, 'createJadwal'])
        ->name('admin.lapangan.jadwal.create');

    Route::post('/lapangan-jadwal', [AdminHistoryController::class, 'storeJadwal'])
        ->name('admin.lapangan.jadwal.store');

    Route::get('/lapangan-jadwal/{jadwal}/edit', [AdminHistoryController::class, 'editJadwal'])
        ->name('admin.lapangan.jadwal.edit');

    Route::put('/lapangan-jadwal/{jadwal}', [AdminHistoryController::class, 'updateJadwal'])
        ->name('admin.lapangan.jadwal.update');

    Route::delete('/lapangan-jadwal/{jadwal}', [AdminHistoryController::class, 'destroyJadwal'])
        ->name('admin.lapangan.jadwal.destroy');

    // Lapangan CRUD
    Route::get('/lapangan', [AdminLapanganController::class, 'index'])
        ->name('admin.lapangan.index');

    Route::get('/lapangan/create', [AdminLapanganController::class, 'create'])
        ->name('admin.lapangan.create');

    Route::post('/lapangan', [AdminLapanganController::class, 'store'])
        ->name('admin.lapangan.store');

    Route::get('/lapangan/{lapangan}/edit', [AdminLapanganController::class, 'edit'])
        ->name('admin.lapangan.edit');

    Route::put('/lapangan/{lapangan}', [AdminLapanganController::class, 'update'])
        ->name('admin.lapangan.update');

    Route::delete('/lapangan/{lapangan}', [AdminLapanganController::class, 'destroy'])
        ->name('admin.lapangan.destroy');
});


// AUTH ROUTES
require __DIR__.'/auth.php';
