@extends('layouts.app')

@section('title', 'Tentang Kami - DP3AKB Kabupaten Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/profile/tentang.css') }}">
@endpush

@section('content')
<div class="tentang-page-wrapper">

    @include('layouts.partials.page-header', [
        'title' => 'Tentang DP3AKB Kabupaten Majalengka',
        'subtitle' => 'Mengenal lebih dekat profil, tugas, dan fungsi instansi kami.',    ])

    <div class="container-custom">
        <div class="tentang-layout">
            
            <aside class="sidebar-nav">
                <ul class="nav-list">
                    <li><a href="#sejarah" class="nav-link active" onclick="setActive(event)">Sejarah Singkat</a></li>
                    <li><a href="#visi-misi" class="nav-link" onclick="setActive(event)">Visi & Misi</a></li>
                    <li><a href="#tugas-fungsi" class="nav-link" onclick="setActive(event)">Tugas & Fungsi</a></li>
                </ul>
            </aside>

            <main class="content-area">
                
                <section id="sejarah" class="content-section">
                    <h2 class="section-heading">Sejarah Singkat</h2>
                    <div class="content-body">
                        <img src="{{ asset('assets/images/kota.jpg') }}" alt="Pendampingan UPTD" class="alur-img">
                        <p>
                            Dinas Pemberdayaan Perempuan, Perlindungan Anak, dan Keluarga Berencana (DP3AKB) Kabupaten Majalengka dibentuk sebagai wujud nyata komitmen Pemerintah Kabupaten Majalengka dalam mewujudkan keadilan dan kesetaraan gender, perlindungan anak, serta pengendalian penduduk di wilayah Kabupaten Majalengka.
                        </p>
                        <p>
                            Seiring dengan perkembangan zaman dan dinamika sosial, DP3AKB Kabupaten Majalengka terus bertransformasi menjadi ujung tombak pelayanan responsif yang menjangkau seluruh lapisan masyarakat hingga ke tingkat desa, demi mencapai cita-cita Kabupaten Majalengka yang maju, sejahtera, dan berkeadilan.
                        </p>
                    </div>
                </section>

                <hr class="section-divider">

                <section id="visi-misi" class="content-section">
                    <h2 class="section-heading">Visi & Misi</h2>
                    <div class="content-body">
                        <div class="visi-box">
                            <h3>VISI</h3>
                            <p>"Terwujudnya Perempuan Berdaya, Anak Terlindungi, dan Keluarga Sejahtera di Kabupaten Majalengka melalui Inovasi dan Kolaborasi."</p>
                        </div>
                        
                        <h3 class="misi-title">MISI</h3>
                        <ul class="misi-list">
                            <li>Meningkatkan kualitas hidup perempuan dan perannya dalam pembangunan ekonomi, sosial, dan politik di Kabupaten Majalengka.</li>
                            <li>Meningkatkan perlindungan hak perempuan dan hak anak dari segala bentuk kekerasan, diskriminasi, dan eksploitasi.</li>
                            <li>Meningkatkan kualitas ketahanan dan kesejahteraan keluarga melalui program Keluarga Berencana.</li>
                            <li>Memperkuat tata kelola kelembagaan dan sistem data informasi gender serta anak yang terintegrasi di wilayah Kabupaten Majalengka.</li>
                        </ul>
                    </div>
                </section>

                <hr class="section-divider">

                <section id="tugas-fungsi" class="content-section">
                    <h2 class="section-heading">Tugas Pokok & Fungsi</h2>
                    <div class="content-body">
                        <p>
                            Berdasarkan Peraturan Bupati Majalengka, DP3AKB Kabupaten Majalengka menyelenggarakan tugas pokok perumusan kebijakan, koordinasi, pembinaan, dan pengendalian tugas bidang pemberdayaan perempuan, perlindungan anak, dan keluarga berencana di wilayah Kabupaten Majalengka.
                        </p>
                        <div class="fungsi-grid">
                            <div class="fungsi-card">
                                <h4>01. Perumusan Kebijakan</h4>
                                <p>Menyusun kebijakan teknis di bidang pemberdayaan perempuan, perlindungan khusus anak, dan pengendalian penduduk di Kabupaten Majalengka.</p>
                            </div>
                            <div class="fungsi-card">
                                <h4>02. Pelaksanaan Tugas</h4>
                                <p>Menyelenggarakan program advokasi, sosialisasi, dan pendampingan terpadu bagi masyarakat Kabupaten Majalengka.</p>
                            </div>
                            <div class="fungsi-card">
                                <h4>03. Evaluasi & Pelaporan</h4>
                                <p>Melaksanakan pengawasan, evaluasi, serta pelaporan capaian kinerja urusan pemerintahan bidang PPPA dan KB di tingkat kabupaten.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="section-divider">
            </main>
        </div>
    </div>
</div>
<script src="{{ asset('js/page/profile/tentang-kami.js') }}"></script>
@endsection