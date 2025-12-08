<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Jadwal;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class AdminHistoryController extends Controller
{
    public function booking()
{
    $bookings = Booking::with(['lapangan', 'user', 'jadwal'])
        ->orderBy('id', 'desc')
        ->get();

    return view('admin.transaksi.booking-history', compact('bookings'));
}


    public function jadwal()
    {
        $jadwal = Jadwal::with('lapangan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.transaksi.lapangan-jadwal', [
            'jadwal' => $jadwal
        ]);
    }

    public function createJadwal()
    {
        $lapangans = Lapangan::all();
        return view('admin.transaksi.lapangan-jadwal-create', [
            'lapangans' => $lapangans
        ]);
    }

    public function storeJadwal(Request $request)
    {
        $validated = $request->validate([
            'lapangan_id' => 'required|exists:lapangan,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        Jadwal::create($validated);

        return redirect()->route('admin.lapangan.jadwal')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function editJadwal(Jadwal $jadwal)
    {
        $lapangans = Lapangan::all();
        
        return view('admin.transaksi.lapangan-jadwal-edit', [
            'jadwal' => $jadwal,
            'lapangans' => $lapangans
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

        return redirect()->route('admin.lapangan.jadwal')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroyJadwal(Jadwal $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.lapangan.jadwal')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
