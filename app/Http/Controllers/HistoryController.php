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

        // ambil booking milik user
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['lapangan', 'jadwal'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', compact('tab', 'bookings'));
    }
}
