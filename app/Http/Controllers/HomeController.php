<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pembayaran;
use App\Models\Jadwal;
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

        // 🍀 Total booking user
        $totalBookings = Booking::where('user_id', $user->id)->count();

        // 🍀 Upcoming booking (diurutkan berdasarkan tanggal jadwal — PostgreSQL SAFE)
        $upcomingBookings = Booking::with(['lapangan', 'jadwal'])
            ->where('user_id', $user->id)
            ->whereHas('jadwal', function ($q) {
                $q->where('tanggal', '>=', now()->toDateString());
            })
            ->orderBy(
                Jadwal::select('tanggal')
                    ->whereColumn('jadwal.id', 'booking.jadwal_id')
                    ->limit(1)
            )
            ->take(3)
            ->get();

        // 🍀 Pembayaran pending user
        $pendingPayment = Pembayaran::whereHas('booking', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'belum_bayar')
            ->count();

        // 🍀 Total pengeluaran user
        $totalSpent = Pembayaran::whereHas('booking', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('status', 'lunas')
            ->sum('jumlah');

        // 🔥 Kirim ke dashboard user
        return view('user.dashboard', [
            'totalBookings'   => $totalBookings,
            'upcomingBookings'=> $upcomingBookings,
            'pendingPayment'  => $pendingPayment,
            'totalSpent'      => $totalSpent,
        ]);
    }
}
