<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Pembayaran::with([
                'booking.user', 
                'booking.lapangan', 
                'booking.jadwal'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.transaksi.index', [
            'transaksi' => $transaksi
        ]);
    }
}
