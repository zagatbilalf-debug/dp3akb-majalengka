document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const mobileToggle = document.getElementById('sidebarMobileToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const mainContent = document.querySelector('.main-content');
    const STORAGE_KEY = 'sidebarCollapsed';

    if (!sidebar) return;

    // ===== Collapse / expand (desktop) =====
    function setCollapsed(isCollapsed) {
        sidebar.classList.toggle('collapsed', isCollapsed);
        if (mainContent) {
            mainContent.classList.toggle('sidebar-collapsed', isCollapsed);
        }
        localStorage.setItem(STORAGE_KEY, isCollapsed ? '1' : '0');
    }

    // Muat kondisi tersimpan saat halaman dibuka
    const savedState = localStorage.getItem(STORAGE_KEY);
    if (savedState === '1') {
        setCollapsed(true);
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            setCollapsed(!sidebar.classList.contains('collapsed'));
        });
    }

    // ===== Toggle mobile (buka/tutup dengan overlay) =====
    // PENTING: nama class di sini ('show') harus sama persis dengan yang
    // dipakai sidebar.css (.sidebar.show { transform: translateX(0); }),
    // kalau beda, sidebar tidak akan pernah kelihatan meluncur masuk.
    function openMobileSidebar() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    }

    function closeMobileSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function () {
            if (sidebar.classList.contains('show')) {
                closeMobileSidebar();
            } else {
                openMobileSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeMobileSidebar);
    }

    // Tutup sidebar mobile otomatis saat layar diperbesar kembali
    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            closeMobileSidebar();
        }
    });

    // Tutup sidebar mobile saat salah satu menu diklik (khusus layar kecil)
    document.querySelectorAll('.sidebar-item a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 992) {
                closeMobileSidebar();
            }
        });
    });

    // ===== Konfirmasi Logout =====
    const logoutBtn = document.getElementById('sidebarLogoutBtn');
    const logoutForm = document.getElementById('sidebarLogoutForm');

    if (logoutBtn && logoutForm) {
        logoutBtn.addEventListener('click', function () {
            Swal.fire({
                title: 'Keluar dari Admin?',
                text: 'Kamu akan diarahkan kembali ke halaman login.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#db2777',
                cancelButtonColor: '#6b7280',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    logoutForm.submit();
                }
            });
        });
    }
});