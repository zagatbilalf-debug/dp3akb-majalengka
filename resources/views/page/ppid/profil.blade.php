@extends('layouts.app')

@section('title', 'Profil PPID - DP3AKB Kabupaten Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/ppid/profile.css') }}">
@endpush

@section('content')
<div class="ppid-page-wrapper">

    {{-- Memanggil Header Partials --}}
    @include('layouts.partials.page-header', [
        'title' => 'Profil PPID DP3AKB',
        'subtitle' => 'Pejabat Pengelola Informasi dan Dokumentasi Kabupaten Majalengka.',    ])

    <div class="container-custom">
        <div class="ppid-layout">
            
            <!-- Sidebar Navigasi -->
            <aside class="sidebar-nav">
                <ul class="nav-list">
                    <li><a href="#tentang-ppid" class="nav-link active" onclick="setActive(event)">Tentang PPID</a></li>
                    <li><a href="#tugas-fungsi" class="nav-link" onclick="setActive(event)">Tugas & Wewenang</a></li>
                    <li><a href="#dasar-hukum" class="nav-link" onclick="setActive(event)">Dasar Hukum</a></li>
                </ul>
            </aside>

            <!-- Area Konten Utama -->
            <main class="content-area">
                
                <section id="tentang-ppid" class="content-section">
                    <h2 class="section-heading">Tentang PPID DP3AKB</h2>
                    <div class="content-body">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1000&q=80" alt="PPID DP3AKB" class="content-image">
                        <p>
                            Pejabat Pengelola Informasi dan Dokumentasi (PPID) Dinas Pemberdayaan Perempuan, Perlindungan Anak, dan Keluarga Berencana (DP3AKB) Kabupaten Majalengka adalah pejabat yang bertanggung jawab di bidang penyimpanan, pendokumentasian, penyediaan, dan pelayanan informasi publik.
                        </p>
                        <p>
                            Kehadiran PPID merupakan wujud komitmen keterbukaan informasi publik sesuai dengan Undang-Undang Nomor 14 Tahun 2008 guna mewujudkan penyelenggaraan pemerintahan yang transparan, efektif, dan akuntabel.
                        </p>
                    </div>
                </section>

                <hr class="section-divider">

                <section id="tugas-fungsi" class="content-section">
                    <h2 class="section-heading">Tugas & Wewenang PPID</h2>
                    <div class="content-body">
                        <div class="grid-card-box">
                            <div class="card-box-item">
                                <h4>01. Pengelolaan Informasi</h4>
                                <p>Menyimpan, mendokumentasikan, menyediakan, dan memberikan pelayanan informasi publik kepada masyarakat.</p>
                            </div>
                            <div class="card-box-item">
                                <h4>02. Uji Konsekuensi</h4>
                                <p>Melakukan pengujian konsekuensi atas informasi publik yang dikecualikan sebelum dikategorikan tertutup.</p>
                            </div>
                            <div class="card-box-item">
                                <h4>03. Penetapan Dikecualikan</h4>
                                <p>Menetapkan informasi yang tidak dapat diakses oleh publik berdasarkan ketentuan perundang-undangan.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="section-divider">

                <section id="dasar-hukum" class="content-section">
                    <h2 class="section-heading">Dasar Hukum PPID</h2>
                    <div class="content-body">
                        <ul class="legal-list">
                            <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik (KIP).</li>
                            <li>Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Undang-Undang Keterbukaan Informasi Publik.</li>
                            <li>Peraturan Menteri Dalam Negeri Nomor 3 Tahun 2017 tentang Pedoman Pengelolaan Pelayanan Informasi dan Dokumentasi Kementerian Dalam Negeri dan Pemerintahan Daerah.</li>
                        </ul>
                    </div>
                </section>

            </main>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/ppid/profile.js') }}"></script>
@endpush