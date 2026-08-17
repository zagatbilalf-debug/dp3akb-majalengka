@extends('layouts.app')

@section('title', $berita->judul . ' - DP3AKB Kab. Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/berita/berita.css') }}">
@endpush

@section('content')
<div class="berita-show-wrapper">

    @include('layouts.partials.page-header', [
        'title' => $berita->judul,
        'subtitle' => $berita->kategori ?? null,
       'bgImage' => $berita->gambar ?: asset('assets/images/gedung-sate.jpg')
    ])

    <div class="container-custom">
        <div class="detail-info-bar">
            @if($berita->kategori)
                <span class="detail-kategori-badge">{{ $berita->kategori }}</span>
            @endif
            <span class="detail-date">
                {{ optional($berita->tanggal_terbit)->translatedFormat('d F Y') ?? $berita->created_at->translatedFormat('d F Y') }}
            </span>
        </div>

        <div class="berita-detail-layout">

            {{-- Konten Artikel --}}
<article class="berita-detail-content">
    @if($berita->gambar)
        <img src="{{ $berita->gambar }}" alt="{{ $berita->judul }}" class="detail-cover-img">
    @endif

    <div class="detail-body">
        {!! $berita->konten !!}
    </div>

    <a href="{{ Route::has('berita.index') ? route('berita.index') : url('/berita') }}" class="btn-back">
        Kembali ke Berita
    </a>
</article>

            {{-- Sidebar: Berita Lainnya --}}
            <aside class="berita-detail-sidebar">
                <h3 class="sidebar-title">Berita Lainnya</h3>

                @forelse($beritaLainnya as $item)
                    <a href="{{ route('berita.show', $item->slug) }}" class="sidebar-berita-item">
                        <div class="sidebar-berita-img">
                            <img src="{{ $item->gambar ?: asset('assets/images/berita/default.jpg') }}" alt="{{ $item->judul }}">
                        </div>
                        <div class="sidebar-berita-text">
                            <h4>{{ Str::limit($item->judul, 60) }}</h4>
                            <span>{{ optional($item->tanggal_terbit)->translatedFormat('d F Y') ?? $item->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </a>
                @empty
                    <p class="sidebar-empty">Belum ada berita lain.</p>
                @endforelse
            </aside>

        </div>
    </div>
</div>
@endsection