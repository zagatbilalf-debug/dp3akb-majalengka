@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')
    {{-- ===== Statistik Ringkas ===== --}}
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-icon stat-icon-blue">
                <i class="fa-solid fa-newspaper"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $totalBerita ?? 0 }}</span>
                <span class="stat-label">Berita</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-orange">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $totalAgenda ?? 0 }}</span>
                <span class="stat-label">Agenda</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-green">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $totalProgram ?? 0 }}</span>
                <span class="stat-label">Program Unggulan</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-purple">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $totalGallery ?? 0 }}</span>
                <span class="stat-label">Gallery Penghargaan</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-teal">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $totalLaporan ?? 0 }}</span>
                <span class="stat-label">Laporan</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-yellow">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $totalDokumen ?? 0 }}</span>
                <span class="stat-label">Dokumen</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon stat-icon-red">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="stat-info">
                <span class="stat-value">{{ $totalPesan ?? 0 }}</span>
                <span class="stat-label">Pesan Masuk</span>
                
            </div>
             </div>
             <div class="stat-card">
    <div class="stat-icon stat-icon-indigo">
        <i class="fa-solid fa-user-tie"></i>
    </div>
    <div class="stat-info">
        <span class="stat-value">{{ $totalAnggota ?? 0 }}</span>
        <span class="stat-label">Jumlah Anggota</span>
    </div>
</div>
    </div>

    {{-- ===== Panel Tabel: Berita, Laporan, Pesan ===== --}}
    <div class="dashboard-columns">
        {{-- Berita Terbaru --}}
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2><i class="fa-solid fa-newspaper"></i> Berita Terbaru</h2>
                <a href="{{ route('admin.berita.index') }}" class="dashboard-card-link">
                    Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            @if(($beritaTerbaru ?? collect())->isNotEmpty())
                <div class="dashboard-mini-table">
                    <div class="dashboard-mini-row dashboard-mini-row-head">
                        <span>Judul</span>
                        <span>Tanggal</span>
                        <span></span>
                    </div>
                    @foreach($beritaTerbaru as $berita)
                        <div class="dashboard-mini-row">
                            <span class="dashboard-mini-title">{{ Str::limit($berita->judul, 32) }}</span>
                            <span class="dashboard-mini-date">{{ $berita->created_at->translatedFormat('d M Y') }}</span>
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="dashboard-mini-action">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="dashboard-empty">Belum ada berita.</p>
            @endif
        </div>

        {{-- Laporan Terbaru --}}
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2><i class="fa-solid fa-file-lines"></i> Laporan Terbaru</h2>
                <a href="{{ route('admin.laporan.index') }}" class="dashboard-card-link">
                    Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            @if(($laporanTerbaru ?? collect())->isNotEmpty())
                <div class="dashboard-mini-table">
                    <div class="dashboard-mini-row dashboard-mini-row-head">
                        <span>Judul</span>
                        <span>Tanggal</span>
                        <span></span>
                    </div>
                    @foreach($laporanTerbaru as $laporan)
                        <div class="dashboard-mini-row">
                            <span class="dashboard-mini-title">{{ Str::limit($laporan->judul, 32) }}</span>
                            <span class="dashboard-mini-date">{{ $laporan->tanggal_lapor?->translatedFormat('d M Y') ?? $laporan->created_at->translatedFormat('d M Y') }}</span>
                            <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="dashboard-mini-action">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="dashboard-empty">Belum ada laporan.</p>
            @endif
        </div>

        {{-- Pesan Terbaru --}}
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2><i class="fa-solid fa-envelope"></i> Pesan Terbaru</h2>
                <a href="{{ route('admin.pesan.index') }}" class="dashboard-card-link">
                    Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            @if(($pesanTerbaru ?? collect())->isNotEmpty())
                <div class="dashboard-mini-table">
                    <div class="dashboard-mini-row dashboard-mini-row-head">
                        <span>Subjek</span>
                        <span>Tanggal</span>
                        <span></span>
                    </div>
                    @foreach($pesanTerbaru as $pesan)
                        <div class="dashboard-mini-row">
                            <span class="dashboard-mini-title">{{ Str::limit($pesan->subjek, 32) }}</span>
                            <span class="dashboard-mini-date">{{ $pesan->created_at->translatedFormat('d M Y') }}</span>
                            <a href="{{ route('admin.pesan.show', $pesan->id) }}" class="dashboard-mini-action">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="dashboard-empty">Belum ada pesan.</p>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/dashboard.js') }}" defer></script>
@endpush