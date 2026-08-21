@section('content')
@extends('layouts.app')

@section('title', ($nama ?? 'Biodata Developer') . ' - DP3AKB Kab. Majalengka')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/biodata.css') }}">
@endpush

@section('content')
<section class="biodata-section">
    <div class="biodata-container">

        {{-- Breadcrumb kembali ke beranda --}}
        <div class="biodata-breadcrumb">
            <a href="{{ $backUrl ?? url('/') }}" class="biodata-back-link">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        @php
            // Ganti nilai-nilai di bawah ini sesuai data asli kamu.
            $skillList = $dataDiri ?? [
                ['label' => 'Peran', 'value' => 'Fullstack Web Developer'],
                ['label' => 'Tech Stack', 'value' => 'Laravel, PHP, MySQL, JavaScript'],
                ['label' => 'Infrastruktur', 'value' => 'Railway, Cloudinary'],
                ['label' => 'Proyek Ini', 'value' => 'Website & Admin CMS DP3AKB Kab. Majalengka'],
                ['label' => 'Alamat', 'value' => 'Blok. Buyut, Desa. Cikawung Kec. Terisi Kab. Indramayu, Jawa Barat 45253'],
                ['label' => 'No. Telepon', 'value' => '+62 888 6047 570'],
            ];

            // Ganti link-link di bawah ini ke akun sosmed kamu sendiri.
            $socialLinks = $sosmed ?? [
                'instagram' => 'https://www.instagram.com/zygot.04?igsh=MWFmZ2JxY21lemE0Ng==',
                'tiktok'    => 'https://tiktok.com/@zygt_04',
                'whatsapp'  => 'https://wa.me/628886047570',
            ];
        @endphp

        <article class="biodata-card" id="biodataCard">

            {{-- Kolom kiri: label, nama, jabatan, deskripsi --}}
            <div class="biodata-info">
                <div class="biodata-tag" aria-hidden="true">
                    <span class="biodata-tag-text">{{ $kategori ?? 'DEVELOPER' }}</span>
                </div>

                <div class="biodata-body">
                    <span class="biodata-eyebrow">{{ $jabatan ?? 'Fullstack Web Developer' }}</span>
                    <h1 class="biodata-nama">{{ $nama ?? 'Zagat Bilal Fahkrudiansyah' }}</h1>
                    <span class="biodata-rule" aria-hidden="true"></span>

                    <div class="biodata-deskripsi">
                        {!! $biodata ?? '<p>Developer di balik website dan admin CMS DP3AKB Kabupaten Majalengka ini — dibangun dari nol pakai Laravel, mulai dari sistem autentikasi admin, modul CRUD (berita, agenda, program unggulan, galeri, dokumen, pengaduan), sampai integrasi Cloudinary untuk penyimpanan file dan deploy ke Railway.</p><p>Ganti paragraf ini dengan cerita singkat versi kamu sendiri — pengalaman, fokus keahlian, atau apa pun yang mau ditonjolkan.</p>' !!}
                    </div>

                    <ul class="biodata-meta-list">
                        @foreach($skillList as $item)
                            <li>
                                <span class="meta-label">{{ $item['label'] }}</span>
                                <span class="meta-value">{{ $item['value'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    {{-- Sosial media --}}
                    <div class="biodata-social">
                        @if(!empty($socialLinks['instagram']))
                            <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram" class="biodata-social-link">
                                <svg viewBox="0 0 448 512" fill="currentColor"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                            </a>
                        @endif
                        @if(!empty($socialLinks['tiktok']))
                            <a href="{{ $socialLinks['tiktok'] }}" target="_blank" rel="noopener" aria-label="TikTok" class="biodata-social-link">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 3c.3 1.7 1.4 3 3.2 3.5v2.6c-1.2 0-2.3-.4-3.2-1v6.4c0 3-2.5 5.5-5.5 5.5S3 17.5 3 14.5 5.5 9 8.5 9c.3 0 .6 0 .9.1v2.6a2.9 2.9 0 1 0 2 2.8V3H14z"/></svg>
                            </a>
                        @endif
                        @if(!empty($socialLinks['whatsapp']))
                            <a href="{{ $socialLinks['whatsapp'] }}" target="_blank" rel="noopener" aria-label="WhatsApp" class="biodata-social-link">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.05 2C6.6 2 2.16 6.44 2.16 11.9c0 1.77.46 3.44 1.28 4.9L2 22l5.34-1.4a9.9 9.9 0 0 0 4.71 1.2h.01c5.45 0 9.9-4.44 9.9-9.9C21.96 6.44 17.5 2 12.05 2zm0 18.05h-.01a8.2 8.2 0 0 1-4.18-1.15l-.3-.18-3.17.83.85-3.09-.2-.32a8.19 8.19 0 0 1-1.26-4.34c0-4.53 3.69-8.22 8.28-8.22 2.21 0 4.28.86 5.84 2.42a8.2 8.2 0 0 1 2.42 5.83c0 4.53-3.69 8.22-8.27 8.22zm4.53-6.16c-.25-.12-1.47-.72-1.69-.81-.23-.08-.4-.12-.56.13-.17.25-.65.81-.79.97-.15.17-.29.19-.54.06-.25-.12-1.04-.38-1.98-1.22-.73-.65-1.23-1.46-1.37-1.7-.14-.25-.02-.38.11-.51.11-.11.25-.29.37-.43.12-.15.16-.25.24-.42.08-.17.04-.31-.02-.43-.06-.12-.56-1.35-.77-1.85-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.31-.23.25-.87.85-.87 2.08 0 1.23.89 2.42 1.02 2.58.12.17 1.75 2.67 4.24 3.74.59.26 1.05.41 1.41.52.59.19 1.13.16 1.56.1.48-.07 1.47-.6 1.67-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.28z"/></svg>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="biodata-mark">
                    <img src="{{ asset('assets/images/logo1.png') }}" alt="DP3AKB Majalengka">
                    <span>Dikembangkan untuk DP3AKB Kab. Majalengka</span>
                </div>
            </div>

            {{-- Kolom kanan: foto --}}
            <div class="biodata-photo">
                <span class="corner corner-tl" aria-hidden="true"></span>
                <span class="corner corner-tr" aria-hidden="true"></span>
                <span class="corner corner-bl" aria-hidden="true"></span>
                <span class="corner corner-br" aria-hidden="true"></span>
                <img src="{{ $foto ?? asset('assets/images/Biodata.png') }}" alt="Foto {{ $nama ?? 'Developer' }}">
            </div>

        </article>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/biodata.js') }}"></script>
@endpush

</div>
@endsection