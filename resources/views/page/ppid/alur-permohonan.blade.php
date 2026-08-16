@extends('layouts.app')

@section('title', 'Alur Permohonan Informasi - PPID DP3AKB')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/ppid/alur.css') }}">
@endpush

@section('content')
<div class="alur-page-wrapper">

    {{-- Memanggil Header Partials --}}
    @include('layouts.partials.page-header', [
        'title' => 'Alur Permohonan Informasi',
        'subtitle' => 'Prosedur dan tata cara memperoleh informasi publik di lingkungan DP3AKB Majalengka.',    ])

    <div class="container-custom">
        <div class="alur-container-box">
            
            <h2 class="section-title">Tahapan Permohonan Informasi Publik</h2>
            <p class="section-desc">Berikut adalah prosedur baku bagi masyarakat yang ingin mengajukan permohonan informasi publik melalui PPID DP3AKB Majalengka.</p>

            <div class="steps-timeline">
                <div class="step-card">
                    <div class="step-badge">01</div>
                    <div class="step-content">
                        <h3>Mengisi Formulir Permohonan</h3>
                        <p>Pemohon mengisi formulir permohonan informasi publik secara online melalui website resmi atau datang langsung ke Sekretariat PPID DP3AKB.</p>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-badge">02</div>
                    <div class="step-content">
                        <h3>Pengecekan & Registrasi</h3>
                        <p>Petugas PPID memeriksa kelengkapan identitas pemohon dan rincian informasi yang diminta, kemudian memberikan nomor pendaftaran.</p>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-badge">03</div>
                    <div class="step-content">
                        <h3>Proses Pemenuhan Informasi</h3>
                        <p>Petugas memproses permohonan dan berkoordinasi dengan unit pengolah data terkait dalam jangka waktu maksimal sesuai UU KIP.</p>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-badge">04</div>
                    <div class="step-content">
                        <h3>Penyerahan Informasi</h3>
                        <p>Pemohon menerima informasi yang diminta dalam bentuk salinan softcopy (PDF/email) atau hardcopy sesuai dengan ketentuan.</p>
                    </div>
                </div>
            </div>

            <div class="cta-box">
                <h3>Butuh Bantuan Lebih Lanjut?</h3>
                <p>Anda dapat mengajukan permohonan informasi secara langsung atau menghubungi layanan bantuan PPID kami.</p>
                <a href="/kontak" class="btn-cta">Hubungi Layanan PPID</a>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/ppid/alur.js') }}"></script>
@endpush