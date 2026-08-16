@extends('layouts.app')

@section('title', 'UPTD PPA - DP3AKB Jawa Barat')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Pastikan path CSS sesuai dengan struktur folder kamu -->
    <link rel="stylesheet" href="{{ asset('css/page/profile/uptd.css') }}">
@endpush

@section('content')
<div class="uptd-page-wrapper">

    <!-- Hero Section UPTD -->
    <section class="uptd-hero">
        <div class="container-custom">
            <div class="hero-content">
                <span class="hero-badge">Layanan Terpadu Kabupaten Majalengka</span>
                <h1 class="hero-title">UPTD PPA Majalengka</h1>
                <p class="hero-subtitle">Hadir untuk memberikan perlindungan, pelayanan medis, psikologis, dan bantuan hukum bagi perempuan dan anak korban kekerasan secara cepat dan rahasia.</p>
                <div class="hero-actions">
                    <a href="#alur-pengaduan" class="btn-primary">Lihat Alur Pengaduan</a>
                    <a href="tel:129" class="btn-emergency">
                        <i class="fa-solid fa-phone-volume"></i>
                        Hotline SAPA 129
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container-custom">
        
        <!-- Section: 6 Layanan Utama -->
        <section class="layanan-section">
            <div class="section-header text-center">
                <h2>Layanan UPTD PPA</h2>
                <p>Enam fungsi layanan utama untuk memastikan korban mendapatkan hak dan pemulihan yang komprehensif.</p>
            </div>

            <div class="layanan-grid">
                <div class="layanan-card">
                    <div class="icon-box"><i class="fa-solid fa-phone"></i></div>
                    <h3>Pengaduan & Pelaporan</h3>
                    <p>Fasilitas penerimaan laporan masyarakat terkait tindak kekerasan terhadap perempuan dan anak selama 24 jam.</p>
                </div>
                <div class="layanan-card">
                    <div class="icon-box"><i class="fa-solid fa-truck-medical"></i></div>
                    <h3>Penjangkauan Korban</h3>
                    <p>Tindakan cepat tanggap turun ke lapangan untuk mengevakuasi dan mengamankan korban dari lokasi kejadian.</p>
                </div>
                <div class="layanan-card">
                    <div class="icon-box"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3>Pendampingan Hukum</h3>
                    <p>Bantuan advokasi dan pendampingan proses hukum di kepolisian hingga pengadilan oleh paralegal dan pengacara.</p>
                </div>
                <div class="layanan-card">
                    <div class="icon-box"><i class="fa-solid fa-brain"></i></div>
                    <h3>Pemulihan Psikologis</h3>
                    <p>Sesi konseling trauma healing bersama psikolog profesional untuk memulihkan kondisi mental korban.</p>
                </div>
                <div class="layanan-card">
                    <div class="icon-box"><i class="fa-solid fa-handshake"></i></div>
                    <h3>Mediasi & Resolusi</h3>
                    <p>Fasilitasi penyelesaian konflik keluarga dengan mengedepankan keselamatan dan kepentingan terbaik anak.</p>
                </div>
                <div class="layanan-card">
                    <div class="icon-box"><i class="fa-solid fa-house-chimney-medical"></i></div>
                    <h3>Rumah Aman (Shelter)</h3>
                    <p>Fasilitas tempat tinggal sementara yang dirahasiakan lokasinya untuk menjamin keamanan korban dari ancaman.</p>
                </div>
            </div>
        </section>

        <hr class="section-divider">

        <!-- Section: Alur Pengaduan (Interaktif Accordion) -->
        <section id="alur-pengaduan" class="alur-section">
            <div class="alur-layout">
                <div class="alur-text">
                    <h2>Alur Penanganan Kasus</h2>
                    <p>Proses penanganan di UPTD PPA dilakukan secara sistematis, rahasia, dan gratis tanpa dipungut biaya apapun.</p>
                    <img src="{{ asset('assets/images/lapor.jpg') }}" alt="Pendampingan UPTD" class="alur-img">
                </div>
                
                <div class="alur-accordion" id="alurAccordion">
                    
                    <div class="accordion-item active">
                        <button class="accordion-header">
                            <span class="step-number">01</span>
                            Laporan Masuk & Identifikasi
                            <span class="icon-toggle"><i class="fa-solid fa-chevron-down"></i></span>
                        </button>
                        <div class="accordion-content">
                            <p>Masyarakat atau korban melaporkan kejadian melalui Hotline 129, WhatsApp, atau datang langsung. Petugas akan melakukan registrasi, identifikasi awal, dan penapisan tingkat kegawatdaruratan.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="step-number">02</span>
                            Penjangkauan & Assesmen
                            <span class="icon-toggle"><i class="fa-solid fa-chevron-down"></i></span>
                        </button>
                        <div class="accordion-content">
                            <p>Tim Reaksi Cepat (TRC) melakukan penjangkauan jika korban berada dalam kondisi darurat. Selanjutnya, pekerja sosial dan psikolog melakukan assesmen mendalam terkait kebutuhan korban.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="step-number">03</span>
                            Intervensi & Pendampingan
                            <span class="icon-toggle"><i class="fa-solid fa-chevron-down"></i></span>
                        </button>
                        <div class="accordion-content">
                            <p>Pelaksanaan layanan sesuai kebutuhan hasil assesmen. Ini meliputi layanan medis darurat (visum), konseling psikologis, penempatan di Rumah Aman, dan pendampingan BAP di kepolisian.</p>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <button class="accordion-header">
                            <span class="step-number">04</span>
                            Terminasi & Reintegrasi
                            <span class="icon-toggle"><i class="fa-solid fa-chevron-down"></i></span>
                        </button>
                        <div class="accordion-content">
                            <p>Jika kondisi korban telah pulih dan kasus hukum telah inkrah/selesai, dilakukan terminasi. Korban akan dikembalikan ke keluarga atau masyarakat dengan pembekalan pemberdayaan agar mandiri.</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection

@push('scripts')
    <!-- Pastikan path JS sesuai dengan struktur folder kamu -->
    <script src="{{ asset('js/page/profile/uptd.js') }}"></script>
@endpush