@extends('layouts.app')

@section('title', 'Dokumen & Publikasi - DP3AKB Kabupaten Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/dokumen/dokumen.css') }}">
@endpush

@section('content')
<div class="dokumen-page-wrapper">

    {{-- Memanggil Header Partials sesuai contoh template --}}
    @include('layouts.partials.page-header', [
        'title' => 'Dokumen & Publikasi',
        'subtitle' => 'Pusat unduhan arsip resmi, laporan kinerja, regulasi, dan publikasi DP3AKB Kabupaten Majalengka.',    ])

    <div class="container-custom">

        <!-- Search & Filter Controls -->
        <div class="controls-container">
            <div class="search-box">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="searchDokumen" class="search-input" placeholder="Cari judul dokumen atau tahun...">
            </div>

            <div class="filter-pills" id="filterContainer">
                <button class="filter-btn active" data-filter="all">Semua Dokumen</button>
                @foreach($kategoriList as $kategori)
                    <button class="filter-btn" data-filter="{{ Str::slug($kategori) }}">{{ $kategori }}</button>
                @endforeach
            </div>
        </div>

        <!-- Daftar Dokumen (List View) -->
        <div class="dokumen-list" id="dokumenList">

            @forelse($dokumens as $dokumen)
                <div class="dokumen-item" data-category="{{ $dokumen->kategori ? Str::slug($dokumen->kategori) : 'lainnya' }}" data-search="{{ Str::lower($dokumen->judul . ' ' . $dokumen->kategori . ' ' . ($dokumen->tanggal?->format('Y') ?? '')) }}">
                    <div class="doc-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    </div>
                    <div class="doc-info">
                        <span class="doc-category {{ $dokumen->kategori ? Str::slug($dokumen->kategori) : 'lainnya' }}">{{ $dokumen->kategori ?? 'Lainnya' }}</span>
                        <h3 class="doc-title">{{ $dokumen->judul }}</h3>
                        <div class="doc-meta">
                            <span>🗓️ Diunggah: {{ $dokumen->tanggal?->translatedFormat('d M Y') ?? $dokumen->created_at->translatedFormat('d M Y') }}</span>
                            <span>📄 {{ strtoupper(pathinfo($dokumen->file, PATHINFO_EXTENSION)) }}</span>
                            <span>💾 {{ $dokumen->ukuran ? number_format($dokumen->ukuran / 1024 / 1024, 1) . ' MB' : '-' }}</span>
                        </div>
                    </div>
                    <div class="doc-action">
                        <a href="{{ str_replace('/upload/', '/upload/fl_attachment/', $dokumen->file) }}" class="btn-download" target="_blank">Unduh Dokumen &darr;</a>
                    </div>
                </div>
            @empty
                {{-- Kosong: ditangani oleh #noDataMessage di bawah kalau JS aktif, tapi tetap tampilkan fallback statis --}}
            @endforelse

        </div>
<div id="noDataMessage" class="no-data-message" style="display: {{ $dokumens->isEmpty() ? 'block' : 'none' }};">
    <div class="no-data-icon"><i class="fa-solid fa-file-circle-question"></i></div>
    <h3>Dokumen Tidak Ditemukan</h3>
    <p>Maaf, belum ada dokumen yang tersedia untuk kategori atau pencarian ini.</p>
</div>

        @if($dokumens->hasPages())
            <div class="dokumen-pagination-wrap">
                {{ $dokumens->links() }}
            </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/dokumen/dokumen.js') }}"></script>
@endpush