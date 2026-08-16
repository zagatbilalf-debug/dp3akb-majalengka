<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Public\LaporanPublicController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\PengaduanController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Public\PesanPublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PimpinanController;

// Beranda & Kontak Utama
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');

// Route submit form kontak (publik)
Route::post('/kontak', [PesanPublicController::class, 'store'])->name('contact.store');

// Modul Berita Publik
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [PageController::class, 'beritaIndex'])->name('index');
    Route::get('/{slug}', [PageController::class, 'beritaShow'])->name('show');
});

// Modul Agenda Publik
Route::prefix('agenda')->name('agenda.')->group(function () {
    Route::get('/', [PageController::class, 'agendaIndex'])->name('index');
    // PENTING: route 'kalender' harus di atas '/{id}', kalau tidak Laravel akan
    // menganggap kata 'kalender' sebagai nilai {id} dan memicu agendaShow().
    Route::get('/kalender', [PageController::class, 'agendaKalender'])->name('kalender');
    Route::get('/{id}', [PageController::class, 'agendaShow'])->name('show');
});

// Modul Gallery Penghargaan Publik
Route::prefix('penghargaan')->name('penghargaan.')->group(function () {
    Route::get('/', [PageController::class, 'penghargaanIndex'])->name('index');
    Route::get('/{id}', [PageController::class, 'penghargaanShow'])->name('show');
});

// Modul Dokumen
Route::prefix('dokumen')->group(function () {
    Route::get('/', [PageController::class, 'documentIndex'])->name('document.index');
});

// Modul Layanan
Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::get('/', [PageController::class, 'layananIndex'])->name('index');
    Route::get('/form-pengaduan', [PageController::class, 'layananFormPengaduan'])->name('form-pengaduan');
    Route::get('/sp4n-lapor', [PageController::class, 'layananSp4nLapor'])->name('sp4n-lapor');
    Route::get('/uptd-ppa', [PageController::class, 'layananUptdPpa'])->name('uptd-ppa');
    Route::get('/form-laporan', [LaporanPublicController::class, 'create'])->name('form-laporan');
    Route::post('/form-laporan', [LaporanPublicController::class, 'store'])->name('form-laporan.store');
});

// Modul PPID
Route::prefix('ppid')->group(function () {
    Route::get('/', [PageController::class, 'ppidIndex'])->name('ppid.index');
    Route::get('/profil', [PageController::class, 'ppidProfil'])->name('ppid.profil');
    Route::get('/alur-permohonan', [PageController::class, 'ppidAlurPermohonan'])->name('ppid.alur-permohonan');
    Route::get('/alur-keberatan', [PageController::class, 'ppidAlurKeberatan'])->name('ppid.alur-keberatan');
    Route::get('/alur-sengketa', [PageController::class, 'ppidAlurSengketa'])->name('ppid.alur-sengketa');
    Route::get('/info-berkala', [PageController::class, 'ppidInfoBerkala'])->name('ppid.info-berkala');
    Route::get('/info-serta-merta', [PageController::class, 'ppidInfoSertaMerta'])->name('ppid.info-serta-merta');
    Route::get('/info-setiap-saat', [PageController::class, 'ppidInfoSetiapSaat'])->name('ppid.info-setiap-saat');
    Route::get('/sop', [PageController::class, 'ppidSop'])->name('ppid.sop');
});

// Modul Profile
Route::prefix('profile')->group(function () {
    Route::get('/', [PageController::class, 'profileIndex'])->name('profile.index');
    Route::get('/tentang-kami', [PageController::class, 'profileTentangKami'])->name('profile.tentang-kami');
    Route::get('/struktur-organisasi', [PageController::class, 'profileOrg'])->name('profile.org');
    Route::get('/pimpinan', [PageController::class, 'profilePimpinan'])->name('profile.pimpinan');
    Route::get('/uptd', [PageController::class, 'profileUptd'])->name('profile.uptd');
});

// Modul Program (menu statis Provinsi Jabar)
// Modul Program (dinamis, dari database)
Route::prefix('program')->group(function () {
    Route::get('/', [PageController::class, 'programIndex'])->name('program.index');
    Route::get('/{program}', [PageController::class, 'programShow'])->name('program.show');
});

// ==========================================
// MODUL ADMIN PANEL
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Login admin — TIDAK pakai middleware, karena ini endpoint proses login itu sendiri
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    // Semua route di bawah ini WAJIB login dulu (dicek via session admin_logged_in)
    Route::middleware('admin.auth')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        // Upload gambar dari dalam TinyMCE (konten berita)
        Route::post('/berita/upload-image', [BeritaController::class, 'uploadImage'])->name('berita.upload-image');

        // Route CRUD lainnya
        Route::resource('berita', BeritaController::class);
        Route::resource('agenda', AgendaController::class);
        Route::resource('program', ProgramController::class);
        Route::resource('gallery', GalleryController::class);
        Route::resource('laporan', LaporanController::class)
            ->only(['index', 'show', 'update', 'destroy']);
        Route::resource('dokumen', DokumenController::class);
        Route::resource('pesan', PesanController::class)
            ->only(['index', 'show', 'destroy']);
        Route::resource('pimpinan', PimpinanController::class);

        // Ganti Password (hanya bisa diakses admin yang sudah login)
        Route::get('/ganti-password', [AuthController::class, 'showChangePasswordForm'])->name('ganti-password');
        Route::put('/ganti-password', [AuthController::class, 'updatePassword'])->name('ganti-password.update');
    });
});

// Logout admin — sengaja di luar prefix 'admin' supaya URL-nya tetap /logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');