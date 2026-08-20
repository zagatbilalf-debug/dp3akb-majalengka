<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Program;
use App\Models\Gallery;
use App\Models\Dokumen;
use App\Models\Pimpinan;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        $beritaTerbaru = Berita::where('status', 'publish')
            ->latest('tanggal_terbit')
            ->take(4)
            ->get()
            ->map(function ($berita) {
                return [
                    'url' => route('berita.show', $berita->slug),
                    'gambar' => $berita->gambar ?: asset('assets/images/berita/default.jpg'),
                    'kategori' => $berita->kategori ?? 'Berita',
                    'judul' => $berita->judul,
                    'tanggal' => optional($berita->tanggal_terbit)->translatedFormat('d F Y') ?? $berita->created_at->translatedFormat('d F Y'),
                ];
            });

        $agendaList = Agenda::where('tanggal', '>=', now()->startOfDay())
            ->orderBy('tanggal')
            ->take(5)
            ->get()
            ->map(function ($agenda) {
                return [
                    'id' => $agenda->id,
                    'tanggal' => $agenda->tanggal->format('d'),
                    'bulan_singkat' => $agenda->tanggal->translatedFormat('M'),
                    'judul' => $agenda->nama_kegiatan,
                    'waktu_tempat' => $agenda->lokasi,
                ];
            });

        // Program Unggulan di beranda: tampilkan 6 data (sebelumnya 3)
        $programUnggulan = Program::latest()->take(6)->get();

        $galleryPenghargaan = Gallery::latest()->take(6)->get();

        return view('page.index', [
            'beritaTerbaru' => $beritaTerbaru,
            'agendaList' => $agendaList,
            'programUnggulan' => $programUnggulan,
            'galleryPenghargaan' => $galleryPenghargaan,
        ]);
    }

  
    public function contact()
    {
        return view('page.contact');
    }


    // Halaman Biodata Developer (statis, konten diisi di sini)
    public function developerBio()
    {
        return view('page.biodata', [
            'kategori' => 'DEVELOPER',
            'jabatan'  => 'Fullstack Web Developer',
            'nama'     => 'Zagat', // TODO: ganti sesuai nama lengkap yang mau ditampilkan

            'foto'     => asset('assets/images/developer/foto.jpg'), // TODO: ganti path foto asli

            'biodata'  => '
                <p>Developer di balik website dan admin CMS DP3AKB Kabupaten Majalengka ini — dibangun dari nol pakai Laravel, mulai dari sistem autentikasi admin, tujuh modul CRUD (Berita, Agenda, Program Unggulan, Gallery Penghargaan, Laporan, Dokumen, Pengaduan), sampai integrasi Cloudinary untuk penyimpanan file dan deploy ke Railway.</p>
                <p>TODO: ganti paragraf ini dengan cerita singkat versi kamu sendiri — pengalaman, fokus keahlian, atau apa pun yang mau ditonjolkan.</p>
            ',

            'dataDiri' => [
                ['label' => 'Peran', 'value' => 'Fullstack Web Developer'],
                ['label' => 'Tech Stack', 'value' => 'Laravel, PHP, MySQL, JavaScript'],
                ['label' => 'Infrastruktur', 'value' => 'Railway, Cloudinary'],
                ['label' => 'Proyek Ini', 'value' => 'Website & Admin CMS DP3AKB Kab. Majalengka'],
            ],

            'backUrl' => url('/'),
        ]);
    }

  
    public function beritaIndex(Request $request)
    {
        $query = Berita::where('status', 'publish')->latest('tanggal_terbit');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('cari')) {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }

        $beritas = $query->paginate(9);
        $beritas->appends($request->query());

        $kategoriList = Berita::where('status', 'publish')
            ->whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');

        return view('page.berita.index', [
            'beritas' => $beritas,
            'kategoriList' => $kategoriList,
        ]);
    }

    public function beritaShow(string $slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $beritaLainnya = Berita::where('status', 'publish')
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_terbit')
            ->take(3)
            ->get();

        return view('page.berita.show', [
            'berita' => $berita,
            'beritaLainnya' => $beritaLainnya,
        ]);
    }

 
    public function agendaIndex()
    {
        $agendaMendatang = Agenda::where('tanggal', '>=', now()->startOfDay())
            ->orderBy('tanggal')
            ->paginate(9, ['*'], 'mendatang');

        $agendaLalu = Agenda::where('tanggal', '<', now()->startOfDay())
            ->orderBy('tanggal', 'desc')
            ->paginate(9, ['*'], 'lalu');

        $viewName = view()->exists('page.agenda.index')
            ? 'page.agenda.index'
            : (view()->exists('page.agenda') ? 'page.agenda' : 'page.index');

        return view($viewName, [
            'agendaMendatang' => $agendaMendatang,
            'agendaLalu' => $agendaLalu,
        ]);
    }

    public function agendaShow(string $id)
    {
        $agenda = Agenda::findOrFail($id);

        $agendaLainnya = Agenda::where('id', '!=', $agenda->id)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        $viewName = view()->exists('page.agenda.index')
            ? 'page.agenda.index'
            : (view()->exists('page.agenda') ? 'page.agenda' : 'page.index');

        return view($viewName, [
            'agenda' => $agenda,
            'agendaLainnya' => $agendaLainnya,
            'agendaMendatang' => collect(),
            'agendaLalu' => collect(),
        ]);
    }

    
    public function agendaKalender(Request $request)
    {
        $bulan = (int) $request->query('bulan', now()->month);
        $tahun = (int) $request->query('tahun', now()->year);

        $agendas = Agenda::whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal')
            ->get()
            ->map(function ($agenda) {
                return [
                    'id' => $agenda->id,
                    'tanggal' => $agenda->tanggal->format('Y-m-d'),
                    'judul' => $agenda->nama_kegiatan,
                    'waktu_tempat' => $agenda->lokasi,
                ];
            });

        return response()->json([
            'bulan' => $bulan,
            'tahun' => $tahun,
            'agendas' => $agendas,
        ]);
    }

    
    public function penghargaanIndex()
    {
        $galleries = Gallery::latest()->paginate(12);

        $viewName = view()->exists('page.penghargaan.index')
            ? 'page.penghargaan.index'
            : (view()->exists('page.penghargaan') ? 'page.penghargaan' : 'page.index');

        return view($viewName, [
            'galleries' => $galleries,
        ]);
    }

    public function penghargaanShow(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        $galleryLainnya = Gallery::where('id', '!=', $gallery->id)
            ->latest()
            ->take(4)
            ->get();

        $viewName = view()->exists('page.penghargaan.show')
            ? 'page.penghargaan.show'
            : (view()->exists('page.penghargaan') ? 'page.penghargaan' : 'page.index');

        return view($viewName, [
            'gallery' => $gallery,
            'galleryLainnya' => $galleryLainnya,
        ]);
    }

    
    public function documentIndex(Request $request)
    {
        $query = Dokumen::latest();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('cari')) {
            $query->where('judul', 'like', '%' . $request->cari . '%');
        }

        $dokumens = $query->paginate(9)->appends($request->query());

        $kategoriList = Dokumen::whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');

        return view('page.document.index', [
            'dokumens' => $dokumens,
            'kategoriList' => $kategoriList,
        ]);
    }

    public function layananFormPengaduan()
    {
        return view('page.layanan.form-pengaduan');
    }

    public function layananSp4nLapor()
    {
        return view('page.layanan.sp4n-lapor');
    }

    public function ppidProfil()
    {
        return view('page.ppid.profil');
    }

    public function ppidAlurPermohonan()
    {
        return view('page.ppid.alur-permohonan');
    }

    public function profileTentangKami()
    {
        return view('page.profile.TentangKami');
    }

    public function profilePimpinan()
    {
        $pimpinans = Pimpinan::where('status', 'aktif')
            ->orderByRaw("FIELD(kategori, 'Utama', 'Sekretariat', 'Kepala Bidang', 'UPTD')")
            ->orderBy('nama')
            ->get();

        return view('page.profile.Pimpinan', [
            'pimpinans' => $pimpinans,
        ]);
    }

    public function profileUptd()
    {
        return view('page.profile.UPTD');
    }

    // Program (menu statis Provinsi Jabar, TIDAK terkait modul Program Unggulan admin)
    public function programIndex()
    {
        $programs = Program::latest()->get();

        $viewName = view()->exists('page.program.index')
            ? 'page.program.index'
            : (view()->exists('page.program.program') ? 'page.program.program' : 'page.index');

        return view($viewName, [
            'programs' => $programs,
        ]);
    }

    public function programShow(Program $program)
    {
        $viewName = view()->exists('page.program.show')
            ? 'page.program.show'
            : (view()->exists('page.program') ? 'page.program' : 'page.index');

        return view($viewName, [
            'program' => $program,
        ]);
    }

}