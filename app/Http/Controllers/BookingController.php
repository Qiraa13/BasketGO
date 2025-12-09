<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        return view('user.book-court');
    }

    public function filterByJenis(Request $request)
    {
        return Lapangan::where('jenis', $request->jenis)->get();
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'lapangan' => 'required',
                'tanggal'  => 'required|date',
                'jam'      => 'required',
                'total'    => 'required|numeric',
                'bukti'    => 'required|image|mimes:jpg,jpeg,png|max:4096'
            ]);

            $lapangan = Lapangan::where('nama', $request->lapangan)->first();

            if (!$lapangan) {
                return response()->json(['error' => 'Lapangan tidak ditemukan'], 400);
            }

            // Cek slot bentrok
            $cek = Booking::where('lapangan_id', $lapangan->id)
                ->where('tanggal', $request->tanggal)
                ->where('jam', $request->jam)
                ->exists();

            if ($cek) {
                return response()->json(['error' => 'Slot sudah dibooking orang lain'], 400);
            }

            // Upload bukti
            $file = $request->file('bukti');
            $filename = time() . "_" . $file->getClientOriginalName();
            $path = $file->storeAs('bukti-transfer', $filename, 'public');

            // Simpan booking
            $booking = Booking::create([
                'user_id'     => Auth::id(),
                'lapangan_id' => $lapangan->id,
                'tanggal'     => $request->tanggal,
                'jam'         => $request->jam,
                'status'      => 'pending'
            ]);

            // Simpan pembayaran
            Pembayaran::create([
                'booking_id'      => $booking->id,
                'metode'          => "Transfer Bank",
                'jumlah'          => $request->total,
                'status'          => "belum_bayar",
                'bukti_transfer'  => $path
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}
