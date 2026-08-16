@extends('layouts.app')

@section('title', 'Profil Pimpinan - DP3AKB Jawa Barat')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/page/profile/pimpinan.css') }}">
@endpush

@section('content')
<div class="pimpinan-page-wrapper">

    @include('layouts.partials.page-header', [
        'title' => 'Direktori Pimpinan',
        'subtitle' => 'Informasi lengkap jajaran struktural DP3AKB Kabupaten Majalengka.',    ])

    <div class="container-custom">

        <!-- Search & Filter Controls -->
        <div class="controls-container-wrapper" style="margin-bottom: 40px;">
            <div class="controls-container" style="max-width: 700px; margin: 0 auto;">
                <div class="search-box" style="position: relative; margin-bottom: 20px;">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: #94a3b8;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="searchPimpinan" class="search-input" placeholder="Cari nama, NIP, atau jabatan...">
                </div>

                <div class="filter-pills" id="filterContainer" style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
                    <button class="filter-btn active" data-filter="all">Semua Pimpinan</button>
                    <button class="filter-btn" data-filter="utama">Utama</button>
                    <button class="filter-btn" data-filter="sekretariat">Sekretariat</button>
                    <button class="filter-btn" data-filter="bidang">Kepala Bidang</button>
                    <button class="filter-btn" data-filter="uptd">UPTD</button>
                </div>
            </div>
        </div>

        <div class="profile-grid" id="pimpinanGrid">
            @forelse ($pimpinans as $pimpinan)
                <div class="profile-card @if($pimpinan->kategori === 'Utama') featured @endif"
                     data-category="{{ $pimpinan->kategori_slug }}"
                     data-search="{{ strtolower($pimpinan->nama.' '.$pimpinan->nip.' '.$pimpinan->jabatan) }}">

                    <div class="card-image-wrapper">
                        <img src="{{ asset('storage/'.$pimpinan->foto) }}" alt="{{ $pimpinan->nama }}" class="profile-img">
                        <span class="badge-status {{ $pimpinan->status === 'aktif' ? 'active' : '' }}">
                            {{ ucfirst($pimpinan->status) }}
                        </span>
                    </div>

                    <div class="card-info">
                        <span class="badge-kategori {{ $pimpinan->kategori_slug }}">{{ $pimpinan->jabatan }}</span>
                        <h3 class="profile-name">{{ $pimpinan->nama }}</h3>

                        <div class="profile-meta">
                            @if($pimpinan->nip)
                                <div class="meta-item"><span class="meta-label">NIP</span> {{ $pimpinan->nip }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center" style="grid-column: 1 / -1;">Belum ada data pimpinan.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/page/profile/pimpinan.js') }}"></script>
@endpush