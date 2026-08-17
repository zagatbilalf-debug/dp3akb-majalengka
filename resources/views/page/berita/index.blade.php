@extends('layouts.app')
@section('title', 'Berita - DP3AKB Kab. Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/berita/berita.css') }}">
@endpush

@section('content')
<div class="berita-page-wrapper">

    @include('layouts.partials.page-header', [
        'title' => 'Berita & Kegiatan',
        'subtitle' => 'Kumpulan berita, kegiatan, dan informasi terbaru seputar Dinas Pengendalian Penduduk, Keluarga Berencana, dan Pemberdayaan Perempuan & Perlindungan Anak Kabupaten Majalengka.',
    ])

    <div class="container-custom">

        {{-- Filter & Search --}}
        <section class="berita-filter-section">
            <form action="{{ route('berita.index') }}" method="GET" class="berita-search-form">
                <input type="text" name="cari" class="search-input" placeholder="Cari judul berita..." value="{{ request('cari') }}">
                <button type="submit" class="btn-search">
                    <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path></svg>
                    Cari
                </button>
            </form>

            @if($kategoriList->isNotEmpty())
                <div class="kategori-filter">
                    <a href="{{ route('berita.index') }}" class="kategori-pill {{ request('kategori') ? '' : 'active' }}">Semua</a>
                    @foreach($kategoriList as $kategori)
                        <a href="{{ route('berita.index', ['kategori' => $kategori]) }}" class="kategori-pill {{ request('kategori') === $kategori ? 'active' : '' }}">
                            {{ $kategori }}
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        <hr class="section-divider">

        {{-- Grid Berita --}}
        <section class="berita-grid-section">
            @if($beritas->isEmpty())
                <div class="berita-empty">
                    <div class="icon-box">📰</div>
                    <h3>Belum ada berita ditemukan</h3>
                    <p>Coba ubah kata kunci pencarian atau pilih kategori lain.</p>
                </div>
            @else
                <div class="berita-grid">
                    @foreach($beritas as $berita)
                        <a href="{{ route('berita.show', $berita->slug) }}" class="berita-card">
                            <div class="berita-card-img">
                                <img src="{{ $berita->gambar ?: asset('assets/images/berita/default.jpg') }}" alt="{{ $berita->judul }}">
                                @if($berita->kategori)
                                    <span class="berita-card-badge">{{ $berita->kategori }}</span>
                                @endif
                            </div>
                            <div class="berita-card-body">
                                <span class="berita-card-date">
                                    {{ optional($berita->tanggal_terbit)->translatedFormat('d F Y') ?? $berita->created_at->translatedFormat('d F Y') }}
                                </span>
                                <h3 class="berita-card-title">{{ $berita->judul }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="berita-pagination">
                    {{ $beritas->links() }}
                </div>
            @endif
        </section>

    </div>
</div>
@endsection