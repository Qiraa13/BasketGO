<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class AdminLapanganController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::orderBy('id')->get();
        return view('admin.transaksi.lapangan-index', compact('lapangans'));
    }

    public function create()
    {
        return view('admin.transaksi.lapangan-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'tipe' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric|min:0',
        ]);

        Lapangan::create($validated);

        return redirect()->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function edit(Lapangan $lapangan)
    {
        return view('admin.transaksi.lapangan-edit', compact('lapangan'));
    }

    public function update(Request $request, Lapangan $lapangan)
    {
        $validated = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'tipe' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric|min:0',
        ]);

        $lapangan->update($validated);

        return redirect()->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(Lapangan $lapangan)
    {
        $lapangan->delete();

        return redirect()->route('admin.lapangan.index')
            ->with('success', 'Lapangan berhasil dihapus.');
    }
}
