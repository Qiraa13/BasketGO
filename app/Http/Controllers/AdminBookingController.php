<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    /**
     * Tampilkan halaman verifikasi (book-court)
     */
    public function index()
    {
        // ambil semua booking (terbaru dulu). include pembayaran, user, lapangan
        $bookings = Booking::with(['user', 'lapangan', 'pembayaran'])
            ->orderBy('created_at', 'desc')
            ->get();

        // statistik sederhana
        $pending   = $bookings->where('status', 'pending')->count();
        $confirmed = $bookings->where('status', 'diterima')->count();
        $rejected  = $bookings->where('status', 'ditolak')->count();

        return view('admin.book-court', compact('bookings', 'pending', 'confirmed', 'rejected'));
    }

    /**
     * Konfirmasi / terima booking
     */
    public function confirm(Booking $booking)
    {
        // ubah status booking
        $booking->status = 'diterima';
        $booking->save();

        // jika ada pembayaran, tandai lunas
        if ($booking->pembayaran) {
            $booking->pembayaran->status = 'lunas';
            $booking->pembayaran->save();
        }

        return redirect()->back()->with('success', 'Booking diterima dan pembayaran diverifikasi.');
    }

    /**
     * Tolak booking
     */
    public function reject(Booking $booking)
    {
        $booking->status = 'ditolak';
        $booking->save();

        // jika ada pembayaran, tandai gagal (atau tetap belum_bayar sesuai logika Anda)
        if ($booking->pembayaran) {
            $booking->pembayaran->status = 'gagal';
            $booking->pembayaran->save();
        }

        return redirect()->back()->with('success', 'Booking ditolak.');
    }
}
