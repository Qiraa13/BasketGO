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
use App\Http\Controllers\AdminBookingController; // untuk verifikasi booking


/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('landing');
})->name('landing');


/*
|--------------------------------------------------------------------------
| USER (AUTH + VERIFIED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','verified'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    // Booking Lapangan (User)
    Route::get('/booking', [BookingController::class, 'index'])
        ->name('booking.index');

    Route::get('/booking/filter', [BookingController::class, 'filterByJenis'])
        ->name('booking.filter');

    Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('booking.store');

    // Riwayat Booking User
    Route::get('/history', [HistoryController::class, 'index'])
        ->name('history.index');
});


/*
|--------------------------------------------------------------------------
| USER ACCOUNT
|--------------------------------------------------------------------------
*/
Route::delete('/delete-account', [UserAccountController::class, 'destroy'])
    ->name('account.delete');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', fn() => view('admin.dashboard'))
        ->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | ADMIN VERIFIKASI BOOKING (Book Court)
    |--------------------------------------------------------------------------
    */
    Route::get('/book-court', [AdminBookingController::class, 'index'])
        ->name('admin.bookcourt');

    Route::put('/booking/{booking}/confirm', [AdminBookingController::class, 'confirm'])
        ->name('admin.booking.confirm');

    Route::put('/booking/{booking}/reject', [AdminBookingController::class, 'reject'])
        ->name('admin.booking.reject');


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT TRANSAKSI (Admin)
    |--------------------------------------------------------------------------
    */
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])
        ->name('admin.transaksi');

    /*
    |--------------------------------------------------------------------------
    | LAPANGAN & JADWAL
    |--------------------------------------------------------------------------
    */
    Route::get('/lapangan', [AdminHistoryController::class,'jadwal'])
        ->name('admin.lapangan');

    Route::post('/lapangan/store', [AdminLapanganController::class,'store'])
        ->name('admin.lapangan.store');

    Route::put('/lapangan/{lapangan}', [AdminLapanganController::class,'update'])
        ->name('admin.lapangan.update');

    Route::delete('/lapangan/{lapangan}', [AdminLapanganController::class,'destroy'])
        ->name('admin.lapangan.destroy');

    // CRUD Jadwal
    Route::post('/lapangan/jadwal', [AdminHistoryController::class,'storeJadwal'])
        ->name('admin.lapangan.jadwal.store');

    Route::get('/lapangan/jadwal/{jadwal}/edit', [AdminHistoryController::class,'editJadwal'])
        ->name('admin.lapangan.jadwal.edit');

    Route::put('/lapangan/jadwal/{jadwal}', [AdminHistoryController::class,'updateJadwal'])
        ->name('admin.lapangan.jadwal.update');

    Route::delete('/lapangan/jadwal/{jadwal}', [AdminHistoryController::class,'destroyJadwal'])
        ->name('admin.lapangan.jadwal.destroy');
});


// Default Auth Routes
require __DIR__.'/auth.php';
