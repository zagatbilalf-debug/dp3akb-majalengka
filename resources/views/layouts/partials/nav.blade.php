<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
<nav class="navbar">
 <a href="{{ url('/') }}" class="logo">
    <img src="{{ asset('assets/images/logo1.png') }}" alt="DP3AKB Majalengka" class="logo-img-full">
</a>

    <div class="nav-links" id="navLinks">
        <div class="nav-item">
            <a href="javascript:void(0)" class="nav-trigger">Profile</a>
            <div class="dropdown">
                <div class="dropdown-column">
                    <span class="dropdown-category">Jelajahi Profil</span>
                    <a href="{{ url('/profile/tentang-kami') }}" class="dropdown-link-large">Tentang Kami</a>
                    <a href="{{ url('/profile/pimpinan') }}" class="dropdown-link-large">Profil Pimpinan</a>
                </div>
                <div class="dropdown-column">
                    <span class="dropdown-category">Lainnya dari Profil</span>
                    <a href="{{ url('/profile/uptd') }}">Unit Pelayanan Terpadu</a>
                </div>
            </div>
        </div>

        <div class="nav-item">
            <a href="javascript:void(0)" class="nav-trigger">Dokumen dan Publikasi</a>
            <div class="dropdown">
                <div class="dropdown-column">
                    <span class="dropdown-category">Publikasi</span>
                    <a href="{{ url('/dokumen') }}" class="dropdown-link-large">Semua Dokumen</a>
                </div>
            </div>
        </div>

        <div class="nav-item">
            <a href="javascript:void(0)" class="nav-trigger">PPID</a>
            <div class="dropdown">
                <div class="dropdown-column">
                    <span class="dropdown-category">Layanan Informasi</span>
                    <a href="{{ url('/ppid/profil') }}" class="dropdown-link-large">Profil PPID</a>
                </div>
                <div class="dropdown-column">
                    <span class="dropdown-category">Alur & Regulasi</span>
                    <a href="{{ url('/ppid/alur-permohonan') }}">Alur Permohonan Informasi</a>
                </div>
            </div>
        </div>

        <div class="nav-item">
            <a href="javascript:void(0)" class="nav-trigger">Layanan</a>
            <div class="dropdown">
                <div class="dropdown-column">
                    <span class="dropdown-category">Layanan Utama</span>
                    <a href="{{ url('/layanan/form-pengaduan') }}" class="dropdown-link-large">Form Pengaduan UPTD PPA</a>
                </div>
                <div class="dropdown-column">
                    <span class="dropdown-category">Pengaduan Publik</span>
                    <a href="{{ url('/layanan/sp4n-lapor') }}">SP4N Lapor</a>
                </div>
            </div>
        </div>

        <div class="nav-item">
            <a href="javascript:void(0)" class="nav-trigger">Program Dinas</a>
            <div class="dropdown">
                <div class="dropdown-column">
                    <span class="dropdown-category">Program Unggulan</span>
                    @forelse ($navPrograms as $program)
                        <a href="{{ route('program.show', $program->id) }}" class="dropdown-link-large">
                            {{ $program->nama_program }}
                        </a>
                    @empty
                        <span class="dropdown-link-large" style="color: #999;">Belum ada program</span>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="nav-item">
            <a href="{{ url('/kontak') }}">Kontak</a>
        </div>
          <div class="nav-item">
            <a href="{{ url('biodata') }}">Biodata</a>
        </div>

        <div class="nav-item mobile-login-container">
            <button class="mobile-admin-trigger-btn" id="openAdminMobile">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
                </svg>
                Admin Login
            </button>
        </div>
    </div>

    <div style="display: flex; align-items: center; gap: 8px;">
        <button class="admin-btn" id="openAdmin" title="Admin Login">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 20c0-4 4-6 8-6s8 2 8 6"></path>
            </svg>
        </button>

        <button class="hamburger-btn" id="hamburgerBtn" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<div class="menu-backdrop" id="menuBackdrop"></div>

<div class="overlay" id="overlay">
    <div class="admin-modal">
        <h2>Admin Login</h2>
        <form id="loginForm" action="{{ url('/admin/login') }}" method="POST">
            @csrf
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required>

            <label for="password">Password</label>
            <div class="password-field">
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                <button type="button" class="toggle-password" id="togglePassword" tabindex="-1" aria-label="Tampilkan password">
                    <svg class="icon-eye" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <svg class="icon-eye-off" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a19.77 19.77 0 0 1 4.22-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a19.5 19.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </button>
            </div>

            <div id="msg" class="msg"></div>

            <button type="submit" class="submit" id="loginSubmitBtn">Login</button>
            <button type="button" class="close-btn" id="closeModal">Batal</button>
        </form>
    </div>
</div>