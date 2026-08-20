@extends('layouts.app')

@section('title', 'SP4N LAPOR! - Layanan Aspirasi & Pengaduan Online')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/layanan/sp4n.css') }}">
@endpush

@section('content')
<div class="sp4n-page-wrapper">

    @include('layouts.partials.page-header', [
        'title' => 'SP4N LAPOR!',
        'subtitle' => 'Layanan Aspirasi dan Pengaduan Online Rakyat - Pengendalian Terintegrasi Pemerintah.',    ])

    <div class="container-custom">
        <div class="sp4n-content-card">
            <h2>Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional</h2>
            <p>Pemerintah Kabupaten Majalengka terintegrasi langsung dengan platform nasional SP4N-LAPOR! untuk memastikan setiap aspirasi, kritik, dan pengaduan masyarakat ditangani secara transparan dan akuntabel.</p>
            
            <div class="sp4n-features">
                <div class="sp4n-feature-box">
                    <h4>
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                        Terjamin Aman
                    </h4>
                    <p>Kerahasiaan data pelapor dilindungi undang-undang pelayanan publik.</p>
                </div>
                <div class="sp4n-feature-box">
                    <h4>
                        <span class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </span>
                        Respon Cepat
                    </h4>
                    <p>Tindak lanjut penanganan terpantau secara real-time oleh instansi terkait.</p>
                </div>
            </div>

            <div class="external-link-box">
                <p>Ingin membuat laporan pengaduan umum atau memantau status aduan nasional Anda?</p>
                <a href="https://www.lapor.go.id" target="_blank" class="btn-external">
                    Kunjungi Portal Resmi SP4N-LAPOR!
                    <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/layanan/sp4n.js') }}"></script>
@endpush