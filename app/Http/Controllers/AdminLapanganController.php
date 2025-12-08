<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class AdminLapanganController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric|min:0',
        ]);

        Lapangan::create($validated);

        return redirect()
            ->route('admin.lapangan')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function update(Request $request, Lapangan $lapangan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'harga_per_jam' => 'required|numeric|min:0',
        ]);

        $lapangan->update($validated);

        return redirect()
            ->route('admin.lapangan')
            ->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(Lapangan $lapangan)
    {
        $lapangan->delete();

        return redirect()
            ->route('admin.lapangan')
            ->with('success', 'Lapangan berhasil dihapus.');
    }
}
