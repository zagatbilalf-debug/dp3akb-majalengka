<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::latest('tanggal_lapor')->paginate(10);

        return view('admin.laporan.index', [
            'title' => 'Laporan Masyarakat',
            'laporans' => $laporans,
        ]);
    }

    public function show(string $id)
    {
        $laporan = Laporan::findOrFail($id);

        return view('admin.laporan.show', [
            'title' => 'Detail Laporan',
            'laporan' => $laporan,
            'breadcrumbs' => [
                'Laporan' => route('admin.laporan.index'),
                'Detail' => '#',
            ],
        ]);
    }

    public function update(Request $request, string $id)
    {
        $laporan = Laporan::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:baru,diproses,selesai',
            'tanggapan' => 'nullable|string',
        ]);

        $laporan->update($validated);

        return redirect()->route('admin.laporan.show', $laporan->id)
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $laporan = Laporan::findOrFail($id);

        if ($laporan->lampiran) {
            Storage::disk('public')->delete($laporan->lampiran);
        }

        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}