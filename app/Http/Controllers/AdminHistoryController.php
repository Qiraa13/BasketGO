<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminHistoryController extends Controller
{
    // BOOKING HISTORY
    public function booking()
    {
        $booking = Booking::with(['lapangan', 'user', 'jadwal'])
            ->orderBy('id')
            ->get();

        return view('admin.transaksi.booking-history', compact('booking'));
    }

    // HALAMAN LAPANGAN + JADWAL (1 HALAMAN)
    public function jadwal()
    {
        return view('admin.transaksi.lapangan', [
            'lapangans' => Lapangan::orderBy('id')->get(),
            'jadwal' => Jadwal::with('lapangan')
                            ->orderBy('tanggal', 'desc')
                            ->get()
        ]);
    }

    // STORE JADWAL
    public function storeJadwal(Request $request)
    {
        $validated = $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        Jadwal::create($validated);

        return redirect()->route('admin.lapangan')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function editJadwal(Jadwal $jadwal)
    {
        return view('admin.transaksi.jadwal-edit', [
            'jadwal' => $jadwal,
            'lapangans' => Lapangan::all()
        ]);
    }

    public function updateJadwal(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $jadwal->update($validated);

        return redirect()->route('admin.lapangan')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroyJadwal(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.lapangan')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
