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
                    <h4>🔒 Terjamin Aman</h4>
                    <p>Kerahasiaan data pelapor dilindungi undang-undang pelayanan publik.</p>
                </div>
                <div class="sp4n-feature-box">
                    <h4>⏱️ Respon Cepat</h4>
                    <p>Tindak lanjut penanganan terpantau secara real-time oleh instansi terkait.</p>
                </div>
            </div>

            <div class="external-link-box">
                <p>Ingin membuat laporan pengaduan umum atau memantau status aduan nasional Anda?</p>
                <a href="https://www.lapor.go.id" target="_blank" class="btn-external">Kunjungi Portal Resmi SP4N-LAPOR! &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/layanan/sp4n.js') }}"></script>
@endpush