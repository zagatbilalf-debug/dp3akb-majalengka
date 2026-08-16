(function () {
    /**
     * Scrollspy untuk sidebar navigasi halaman "Tentang Kami"
     * (Sejarah Singkat, Visi & Misi, Tugas & Fungsi)
     *
     * Dibungkus IIFE supaya variabel di dalam sini tidak bocor ke
     * global scope dan tidak bentrok dengan script lain di halaman
     * (misalnya nav.js yang juga punya variabel serupa).
     */

    var sidebarLinks = document.querySelectorAll('.sidebar-nav .nav-link');
    var sections = document.querySelectorAll('.content-section[id]');

    if (!sidebarLinks.length || !sections.length) {
        return;
    }

    function setActiveLink(id) {
        sidebarLinks.forEach(function (link) {
            var isActive = link.getAttribute('href') === '#' + id;
            link.classList.toggle('active', isActive);
        });
    }

    // 1. Update active saat link di-klik langsung (biar terasa instan)
    sidebarLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            var targetId = link.getAttribute('href').replace('#', '');
            setActiveLink(targetId);
        });
    });

    // 2. Scrollspy: update active sesuai section yang sedang terlihat
    var sectionObserver = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    setActiveLink(entry.target.id);
                }
            });
        },
        {
            root: null,
            // area "pemicu aktif" difokuskan di bagian atas viewport,
            // selaras dengan scroll-margin-top: 100px di CSS
            rootMargin: '-110px 0px -70% 0px',
            threshold: 0,
        }
    );

    sections.forEach(function (section) {
        sectionObserver.observe(section);
    });

    // 3. Saat halaman pertama kali dibuka dengan hash di URL
    //    (contoh: /profile/tentang-kami#visi-misi), langsung set active
    var initialHash = window.location.hash.replace('#', '');
    if (initialHash) {
        setActiveLink(initialHash);
    }
})();