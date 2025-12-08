<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika ADMIN → arahkan ke dashboard admin
        if ($user && $user->role === 'admin') {
            return view('admin.dashboard');
        }

        // =============================
        // 1. TOTAL BOOKING USER
        // =============================
        $totalBookings = Booking::where('user_id', $user->id)->count();

        // =============================
        // 2. UPCOMING BOOKING (TANPA jadwal_id)
        // =============================
        $upcomingBookings = Booking::with('lapangan')
            ->where('user_id', $user->id)
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();

        // =============================
        // 3. PEMBAYARAN PENDING
        // =============================
        $pendingPayment = Pembayaran::whereHas('booking', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'belum_bayar')
            ->count();

        // =============================
        // 4. TOTAL PENGELUARAN USER
        // =============================
        $totalSpent = Pembayaran::whereHas('booking', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'lunas')
            ->sum('jumlah');

        // =============================
        // RETURN TO USER DASHBOARD
        // =============================
        return view('user.dashboard', [
            'totalBookings'   => $totalBookings,
            'upcomingBookings'=> $upcomingBookings,
            'pendingPayment'  => $pendingPayment,
            'totalSpent'      => $totalSpent,
        ]);
    }
}
