<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanPublicController extends Controller
{
    public function create()
    {
        return view('page.layanan.form-pengaduan'); // sesuaikan nama view Anda
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'kontak_pelapor' => 'required|string|max:20',
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'isi_laporan' => 'required|string|min:20',
            'lokasi' => 'nullable|string|max:255',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($request->hasFile('lampiran')) {
            $validated['lampiran'] = $request->file('lampiran')->store('laporan', 'public');
        }

        $validated['status'] = 'baru';
        $validated['tanggal_lapor'] = now();

        Laporan::create($validated);

        return response()->json([
            'message' => 'Laporan Anda telah kami terima dan akan segera ditindaklanjuti.',
        ]);
    }
}