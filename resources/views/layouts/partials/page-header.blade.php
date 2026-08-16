<!-- File: resources/views/layouts/partials/page-header.blade.php -->
<header class="page-header-hero" style="background-image: url('{{ $bgImage ?? asset('assets/images/gedung-sate.jpg') }}');">
    
    <!-- Lapisan Gelap Merah Marun (Overlay) -->
    <div class="hero-overlay"></div>
    
    <div class="hero-content-wrapper">
        
        <!-- Breadcrumb Navigasi Teks (Beranda > Tentang Kami) -->
        <nav class="hero-breadcrumb" aria-label="breadcrumb">
            <a href="{{ url('/') }}">Beranda</a>
            <span class="separator">›</span>
            <span class="current">{{ $title ?? 'Informasi' }}</span>
        </nav>

        <!-- Layout 2 Kolom (Kiri: Judul Besar, Kanan: Deskripsi) -->
        <div class="hero-grid">
            <div class="hero-left">
                <h1 class="hero-title">{{ $title }}</h1>
            </div>
            
            <div class="hero-right">
                @isset($subtitle)
                    <p class="hero-description">{!! $subtitle !!}</p>
                @endisset
            </div>
        </div>
        
        <!-- Slot Tambahan Opsional (Misal untuk pencarian) -->
        @isset($slot)
            <div class="hero-slot">
                {{ $slot }}
            </div>
        @endisset

    </div>
</header>