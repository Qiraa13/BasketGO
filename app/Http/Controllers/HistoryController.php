<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // TAB: status / history
        $tab = $request->get('tab', 'status'); // default: status

        // Ambil booking milik user
        $bookings = Booking::where('user_id', Auth::id())
            ->with('lapangan')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('user.history', compact('tab', 'bookings'));
    }
}
