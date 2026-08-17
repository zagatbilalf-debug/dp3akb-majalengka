@extends('layouts.app')

@section('title', 'Beranda - DP3AKB Kabupaten Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/home.css') }}">
@endpush

@section('content')
<div class="home-page">

    {{-- =========================================================
        1. HERO SECTION
    ========================================================== --}}
    <section class="hero-section">
       <div class="hero-slide is-active" style="background-image:url('{{ asset('assets/images/index/women.jpg') }}')"></div>
<div class="hero-slide" style="background-image:url('{{ asset('assets/images/index/children.jpg') }}')"></div>
<div class="hero-slide" style="background-image:url('{{ asset('assets/images/index/childrens.jpg') }}')"></div>
        <div class="hero-overlay"></div>

        <div class="container-custom hero-inner">
            <h1 class="hero-title">
               Dinas Pemberdayaan Perempuan, Perlindungan Anak,<br> dan Keluarga Berencana
            </h1>
            <p class="hero-slogan">
                 Kabupaten Majalengka, Jawa Barat <br>
                Keluarga Berkualitas, Majalengka Religius Istimewa Menuju Indonesia Emas 2045
            </p>
        </div>

        <button class="hero-scroll-cue" type="button" aria-label="Gulir ke bawah" onclick="document.getElementById('berita').scrollIntoView({behavior:'smooth'})">
            <span></span>
        </button>
    </section>

    {{-- =========================================================
        2. BERITA DAN INFORMASI
    ========================================================== --}}
    <section class="berita-section" id="berita">
        <div class="container-custom berita-layout">

            <div class="berita-side">
                <h2>Berita dan Informasi</h2>
                <p>Dapatkan informasi terkini seputar program, kegiatan, dan layanan pengendalian penduduk serta keluarga berencana di Kabupaten Majalengka.</p>
                <a href="{{ url('/berita') }}" class="berita-lainnya">Lainnya <i class="fa-solid fa-arrow-up-right"></i></a>
            </div>

            <div class="berita-carousel-wrap">
                <div class="berita-carousel" id="beritaCarousel">
                    @forelse (($beritaTerbaru ?? []) as $berita)
                    <a href="{{ $berita['url'] ?? '#' }}" class="berita-slide" style="background-image:url('{{ $berita['gambar'] ?? asset('assets/images/berita/default.jpg') }}')">
                        <div class="berita-slide-overlay">
                            <span class="berita-kategori">{{ $berita['kategori'] ?? 'berita' }}</span>
                            <h3>{{ $berita['judul'] }}</h3>
                            <span class="berita-tanggal">Update Terakhir {{ $berita['tanggal'] }}</span>
                        </div>
                    </a>
                    @empty
                    @endforelse
                </div>

                <div class="berita-carousel-controls">
                    <div class="berita-progress">
                        <span class="berita-progress-bar" id="beritaProgressBar"></span>
                    </div>
                    <div class="berita-carousel-arrows">
                        <button type="button" id="beritaPrev" aria-label="Sebelumnya"><i class="fa-solid fa-arrow-left"></i></button>
                        <button type="button" id="beritaNext" aria-label="Berikutnya"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- =========================================================
        3. AGENDA (Layout: Kiri Kalender Kecil, Kanan Daftar Agenda)
    ========================================================== --}}
    <section class="agenda-section">
        <div class="container-custom">
            <div class="section-heading">
                <h2>Agenda Dinas</h2>
                <p>Informasi kegiatan dan aktivitas DPPKB Kabupaten Majalengka.</p>
            </div>

            <div class="agenda-wrapper-grid">
                <!-- SISI KIRI: KALENDER KECIL -->
                <div class="agenda-card calendar-card">
                    <div class="agenda-nav">
                        <button type="button" id="agendaPrev" aria-label="Bulan sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="agenda-period">
                            <span id="agendaBulan">Juli 2026</span>
                            <small id="agendaMinggu">Minggu ke 5</small>
                        </div>
                        <button type="button" id="agendaNext" aria-label="Bulan berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>

                    <div class="agenda-weekdays">
                        <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
                    </div>
                    <div class="agenda-days" id="agendaDays">
                        {{-- Diisi otomatis oleh JS --}}
                    </div>
                </div>

                <!-- SISI KANAN: DAFTAR AGENDA MENDATANG -->
                <div class="agenda-card list-card">
                    <div class="agenda-list" id="agendaList">
                        <h4>Agenda Mendatang</h4>

                        @forelse ($agendaList ?? [] as $agenda)
                        <div class="agenda-list-item">
                            <span class="agenda-date-badge">{{ $agenda['tanggal'] }}<small>{{ $agenda['bulan_singkat'] }}</small></span>
                            <div>
                                <p>{{ $agenda['judul'] }}</p>
                                <span>{{ $agenda['waktu_tempat'] }}</span>
                            </div>
                        </div>
                        @empty
                        <p class="agenda-list-empty">Belum ada agenda mendatang yang dijadwalkan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

   {{-- =========================================================
    4. PROGRAM UNGGULAN (dari database — admin > Program Unggulan)
========================================================== --}}
<section class="program-section">
    <div class="container-custom">
        <div class="section-heading">
            <h2>Program Unggulan</h2>
            <p>Berikut informasi dan layanan yang tersedia di DPPKB Kabupaten Majalengka.</p>
        </div>

        <div class="program-grid">
            @forelse (($programUnggulan ?? []) as $program)
                @php
                    $programId = data_get($program, 'id');
                    $programGambar = data_get($program, 'gambar');
                    $programNama = data_get($program, 'nama_program', 'Program Unggulan');
                @endphp
                <a href="{{ ($programId && Route::has('program.show')) ? route('program.show', $programId) : '#' }}" class="program-card">
                    <div class="program-thumb-reveal" style="background-image:url('{{ $programGambar ? cloudinary()->getUrl($programGambar) : asset('assets/images/program/default.jpg') }}')"></div>
                    <h3>{{ $programNama }}</h3>
                    <span class="program-link">Selengkapnya <i class="fa-solid fa-arrow-right"></i></span>
                </a>
            @empty
                <p class="program-empty">Belum ada program unggulan yang ditambahkan.</p>
            @endforelse
        </div>
    </div>
</section>

    {{-- =========================================================
        5. PENGHARGAAN (dari database — admin > Gallery Penghargaan)
    ========================================================== --}}
    <section class="penghargaan-section">
        <div class="container-custom">
            <div class="section-heading">
                <h2>Penghargaan yang Diraih</h2>
                <p>Apresiasi atas capaian kinerja DPPKB Kabupaten Majalengka.</p>
            </div>

            <div class="penghargaan-gallery">
                @forelse (($galleryPenghargaan ?? []) as $item)
                    @php
                        $judul = data_get($item, 'judul', '');
                        $tahun = data_get($item, 'tahun', null);
                        $foto = data_get($item, 'foto', null);
                    @endphp
                    <div class="penghargaan-item">
                        <img
                            src="{{ $foto ? cloudinary()->getUrl($foto) : asset('assets/images/penghargaan/default.jpg') }}"
                            alt="{{ $judul }}"
                            loading="lazy"
                            onerror="this.parentElement.classList.add('is-placeholder')"
                        >
                        <div class="penghargaan-caption">
                            <span>{{ $judul }}</span>
                            @if($tahun)
                                <small>{{ $tahun }}</small>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="penghargaan-empty">Belum ada penghargaan yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- =========================================================
        6. MEDIA TAYANGAN
    ========================================================== --}}
    <section class="media-section">
        <div class="container-custom">
            <div class="section-heading">
                <h2>Media Tayangan</h2>
                <p>Video profil dan dokumentasi kegiatan DPPKB Kabupaten Majalengka.</p>
            </div>
        </div>

     <div class="media-video-wrapper">
    <iframe
        src="https://www.youtube.com/embed/cVAoVO-CO5o?start"
        title="Video Profil DPPKB Kabupaten Majalengka"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
    </iframe>
</div>
    </section>

</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/home.js') }}"></script>
@endpush