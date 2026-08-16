<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Program;
use App\Models\Gallery;
use App\Models\Laporan;
use App\Models\Dokumen;
use App\Models\Pesan;
use App\Models\Pimpinan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'title' => 'Dashboard',

            'totalBerita'   => Berita::count(),
            'totalAgenda'   => Agenda::count(),
            'totalProgram'  => Program::count(),
            'totalGallery'  => Gallery::count(),
            'totalLaporan'  => Laporan::count(),
            'totalDokumen'  => Dokumen::count(),
            'totalPesan'    => Pesan::count(),
            'totalAnggota'  => Pimpinan::count(),

            'beritaTerbaru'  => Berita::latest()->take(5)->get(),
            'laporanTerbaru' => Laporan::latest('tanggal_lapor')->take(5)->get(),
            'pesanTerbaru'   => Pesan::latest()->take(5)->get(),
        ]);
    }
}