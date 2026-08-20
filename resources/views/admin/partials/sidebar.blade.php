<link rel="stylesheet" href="{{ asset('css/admin/partials/sidebar.css') }}">

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-logo-wrap">
            <img src="{{ asset('assets/images/LOGOS.png') }}" alt="DP3AKB Majalengka" class="sidebar-logo-full">
        </div>
        <button class="sidebar-toggle-btn" id="sidebarToggleBtn" type="button" aria-label="Tutup Sidebar">
            <i class="fa-solid fa-angles-left"></i>
        </button>
    </div>
    <!-- (lanjutan menu lainnya tetap sama) -->

    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" data-title="Dashboard">
                    <i class="fa-solid fa-gauge"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                <a href="{{ route('admin.berita.index') }}" data-title="Berita">
                    <i class="fa-solid fa-newspaper"></i>
                    <span class="sidebar-text">Berita</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}">
                <a href="{{ route('admin.agenda.index') }}" data-title="Agenda">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="sidebar-text">Agenda</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.program.*') ? 'active' : '' }}">
                <a href="{{ route('admin.program.index') }}" data-title="Program Unggulan">
                    <i class="fa-solid fa-star"></i>
                    <span class="sidebar-text">Program Unggulan</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                <a href="{{ route('admin.gallery.index') }}" data-title="Gallery Penghargaan">
                    <i class="fa-solid fa-trophy"></i>
                    <span class="sidebar-text">Gallery Penghargaan</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <a href="{{ route('admin.laporan.index') }}" data-title="Laporan">
                    <i class="fa-solid fa-file-lines"></i>
                    <span class="sidebar-text">Laporan</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.dokumen.*') ? 'active' : '' }}">
                <a href="{{ route('admin.dokumen.index') }}" data-title="Dokumen">
                    <i class="fa-solid fa-folder-open"></i>
                    <span class="sidebar-text">Dokumen</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}">
                <a href="{{ route('admin.pesan.index') }}" data-title="Pesan">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span class="sidebar-text">Pesan</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.pimpinan.*') ? 'active' : '' }}">
                <a href="{{ route('admin.pimpinan.index') }}" data-title="Pimpinan">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="sidebar-text">Pimpinan</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
                <a href="{{ route('admin.pengaturan.index') }}" data-title="Pengaturan">
                    <i class="fa-solid fa-gear"></i>
                    <span class="sidebar-text">Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}" id="sidebarLogoutForm">
            @csrf
            <button type="button" class="sidebar-logout-btn" id="sidebarLogoutBtn">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="sidebar-text">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<button class="sidebar-mobile-toggle" id="sidebarMobileToggle" type="button" aria-label="Buka Sidebar">
    <i class="fa-solid fa-bars"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/admin/partials/sidebar.js') }}" defer></script>