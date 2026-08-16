/* ==========================================================
   HOME PAGE (BERANDA) — DPPKB Kabupaten Majalengka
   Simpan sebagai: public/js/page/home.js
========================================================== */

document.addEventListener('DOMContentLoaded', function () {

    /* ---------- 1. Hero slider: crossfade halus + zoom lambat ---------- */
    const heroSlider = document.getElementById('heroSlider');
    if (heroSlider) {
        const slides = Array.from(heroSlider.querySelectorAll('.hero-slide'));
        let activeIndex = slides.findIndex(function (s) { return s.classList.contains('is-active'); });
        if (activeIndex === -1) activeIndex = 0;

        let zCounter = 1;
        slides[activeIndex].style.zIndex = zCounter;

        if (slides.length > 1) {
            setInterval(function () {
                const nextIndex = (activeIndex + 1) % slides.length;
                const next = slides[nextIndex];

                zCounter += 1;
                next.style.zIndex = zCounter;
                next.classList.add('is-active');

                activeIndex = nextIndex;
            }, 6000);
        }
    }

    /* ---------- 2. Tab Berita: Terbaru / Terpopuler ---------- */
    const tabButtons = document.querySelectorAll('.tab-btn');
    const panels = {
        terbaru: document.getElementById('berita-terbaru'),
        terpopuler: document.getElementById('berita-terpopuler'),
    };

    tabButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const target = btn.dataset.tab;

            tabButtons.forEach(function (b) {
                b.classList.remove('is-active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('is-active');
            btn.setAttribute('aria-selected', 'true');

            Object.keys(panels).forEach(function (key) {
                if (!panels[key]) return;
                panels[key].hidden = key !== target;
            });
        });
    });

    /* ---------- 3. Animasi judul + subjudul tiap section saat discroll ---------- */
    const subjudulTargets = document.querySelectorAll('.section-heading');
    if ('IntersectionObserver' in window && subjudulTargets.length) {
        const subjudulObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    subjudulObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        subjudulTargets.forEach(function (el) { subjudulObserver.observe(el); });
    } else {
        subjudulTargets.forEach(function (el) { el.classList.add('is-visible'); });
    }

    /* ---------- 4. Berita: carousel horizontal + progress bar ---------- */
    const beritaCarousel = document.getElementById('beritaCarousel');
    const beritaPrev = document.getElementById('beritaPrev');
    const beritaNext = document.getElementById('beritaNext');
    const beritaProgressBar = document.getElementById('beritaProgressBar');

    if (beritaCarousel) {
        function scrollJarak() {
            const slide = beritaCarousel.querySelector('.berita-slide');
            return slide ? slide.getBoundingClientRect().width + 16 : 260;
        }

        function updateBeritaProgress() {
            const maksimal = beritaCarousel.scrollWidth - beritaCarousel.clientWidth;
            const persen = maksimal > 0 ? (beritaCarousel.scrollLeft / maksimal) * 100 : 0;
            if (beritaProgressBar) beritaProgressBar.style.width = Math.max(8, persen) + '%';

            if (beritaPrev) beritaPrev.disabled = beritaCarousel.scrollLeft <= 4;
            if (beritaNext) beritaNext.disabled = beritaCarousel.scrollLeft >= maksimal - 4;
        }

        if (beritaPrev) beritaPrev.addEventListener('click', function () {
            beritaCarousel.scrollBy({ left: -scrollJarak(), behavior: 'smooth' });
        });
        if (beritaNext) beritaNext.addEventListener('click', function () {
            beritaCarousel.scrollBy({ left: scrollJarak(), behavior: 'smooth' });
        });

        beritaCarousel.addEventListener('scroll', updateBeritaProgress);
        window.addEventListener('resize', updateBeritaProgress);
        updateBeritaProgress();
    }

    /* ---------- 5. Reveal saat scroll ---------- */
    // FIX: class "berita-card" diganti "berita-slide" — nama class di CSS
    // memang .berita-slide, jadi sebelumnya animasi reveal ini tidak pernah
    // menyala untuk card berita.
    const revealTargets = document.querySelectorAll(
        '.berita-slide, .program-card, .penghargaan-item'
    );

    if ('IntersectionObserver' in window && revealTargets.length) {
        revealTargets.forEach(function (el, idx) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(14px)';
            el.style.transition = 'opacity .5s ease, transform .5s ease';
            // Delay bertahap per elemen supaya card di baris/grid yang sama
            // tidak muncul serentak, tapi bergelombang satu-satu.
            el.style.transitionDelay = (idx % 6) * 70 + 'ms';
        });

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        revealTargets.forEach(function (el) { observer.observe(el); });
    }

    /* ==========================================================
       6. AGENDA: kalender bulan berjalan — TERHUBUNG KE DATABASE
       Endpoint: GET /agenda/kalender?bulan=M&tahun=Y  (JSON)
    ========================================================== */
    const namaBulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    const namaBulanSingkat = [
        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    ];

    const agendaBulanEl = document.getElementById('agendaBulan');
    const agendaMingguEl = document.getElementById('agendaMinggu');
    const agendaDaysEl = document.getElementById('agendaDays');
    const btnPrev = document.getElementById('agendaPrev');
    const btnNext = document.getElementById('agendaNext');
    const agendaListEl = document.getElementById('agendaList');

    if (agendaDaysEl && agendaListEl) {
        const KALENDER_URL = '/agenda/kalender';
        const today = new Date();

        // Simpan HTML daftar "Agenda Mendatang" bawaan dari server (Blade),
        // supaya bisa dikembalikan lagi setelah user selesai lihat tanggal tertentu.
        const agendaListDefaultHTML = agendaListEl.innerHTML;

        let agendaState = {
            bulan: today.getMonth() + 1, // JS: 0-11, tapi backend & format tanggal pakai 1-12
            tahun: today.getFullYear(),
        };

        // Cache per bulan supaya tidak fetch berulang saat bolak-balik bulan yang sama.
        // key: "tahun-bulan" -> { "YYYY-MM-DD": [ {id, tanggal, judul, waktu_tempat}, ... ] }
        const cacheEventsPerTanggal = {};

        function formatTanggalKey(tahun, bulan1based, hari) {
            const b = String(bulan1based).padStart(2, '0');
            const h = String(hari).padStart(2, '0');
            return tahun + '-' + b + '-' + h;
        }

        function fetchAgendaBulan(tahun, bulan1based) {
            const cacheKey = tahun + '-' + bulan1based;

            if (cacheEventsPerTanggal[cacheKey]) {
                return Promise.resolve(cacheEventsPerTanggal[cacheKey]);
            }

            const url = KALENDER_URL + '?bulan=' + bulan1based + '&tahun=' + tahun;

            return fetch(url, { headers: { 'Accept': 'application/json' } })
                .then(function (res) {
                    if (!res.ok) throw new Error('Gagal memuat agenda');
                    return res.json();
                })
                .then(function (data) {
                    const grouped = {};
                    (data.agendas || []).forEach(function (item) {
                        if (!grouped[item.tanggal]) grouped[item.tanggal] = [];
                        grouped[item.tanggal].push(item);
                    });
                    cacheEventsPerTanggal[cacheKey] = grouped;
                    return grouped;
                })
                .catch(function () {
                    // Kalau gagal, tetap kembalikan objek kosong supaya kalender tidak error,
                    // cuma tidak akan ada tanda titik event.
                    return {};
                });
        }

        function renderAgendaCalendar() {
            if (!agendaBulanEl || !agendaDaysEl) return;

            const bulan0 = agendaState.bulan - 1; // balik ke 0-based untuk Date API
            agendaBulanEl.textContent = namaBulan[bulan0] + ' ' + agendaState.tahun;

            fetchAgendaBulan(agendaState.tahun, agendaState.bulan).then(function (eventsByTanggal) {
                const firstDay = new Date(agendaState.tahun, bulan0, 1).getDay();
                const totalHari = new Date(agendaState.tahun, bulan0 + 1, 0).getDate();
                const isBulanIni = bulan0 === today.getMonth() && agendaState.tahun === today.getFullYear();

                agendaDaysEl.innerHTML = '';

                for (let i = 0; i < firstDay; i++) {
                    const kosong = document.createElement('span');
                    kosong.className = 'agenda-day is-empty';
                    agendaDaysEl.appendChild(kosong);
                }

                for (let d = 1; d <= totalHari; d++) {
                    const cell = document.createElement('span');
                    cell.className = 'agenda-day';
                    cell.textContent = d;

                    const tanggalKey = formatTanggalKey(agendaState.tahun, agendaState.bulan, d);
                    const eventsHariIni = eventsByTanggal[tanggalKey] || [];

                    if (isBulanIni && d === today.getDate()) {
                        cell.classList.add('is-today');
                    }
                    if (eventsHariIni.length > 0) {
                        cell.classList.add('has-event');
                    }

                    cell.addEventListener('click', function () {
                        document.querySelectorAll('.agenda-day').forEach(function (el) {
                            el.classList.remove('is-selected');
                        });
                        cell.classList.add('is-selected');
                        tampilkanAgendaTanggal(agendaState.tahun, agendaState.bulan, d, eventsHariIni);
                    });

                    agendaDaysEl.appendChild(cell);
                }

                if (agendaMingguEl) {
                    const mingguKe = Math.ceil((isBulanIni ? today.getDate() : 1) / 7);
                    agendaMingguEl.textContent = isBulanIni
                        ? ('Minggu ke ' + mingguKe)
                        : namaBulanSingkat[bulan0] + ' ' + agendaState.tahun;
                }
            });
        }

        function tampilkanAgendaTanggal(tahun, bulan1based, hari, events) {
            const labelTanggal = hari + ' ' + namaBulan[bulan1based - 1] + ' ' + tahun;

            let html = '<h4>Agenda pada ' + labelTanggal + '</h4>';
            html += '<button type="button" class="agenda-list-reset" id="agendaListReset">&larr; Kembali ke Agenda Mendatang</button>';

            if (events.length === 0) {
                html += '<p class="agenda-list-empty">Tidak ada agenda pada tanggal ini.</p>';
            } else {
                events.forEach(function (agenda) {
                    html += '' +
                        '<div class="agenda-list-item">' +
                        '  <span class="agenda-date-badge">' + hari + '<small>' + namaBulanSingkat[bulan1based - 1] + '</small></span>' +
                        '  <div>' +
                        '    <p>' + escapeHtml(agenda.judul || '') + '</p>' +
                        '    <span>' + escapeHtml(agenda.waktu_tempat || '') + '</span>' +
                        '  </div>' +
                        '</div>';
                });
            }

            agendaListEl.innerHTML = html;

            const resetBtn = document.getElementById('agendaListReset');
            if (resetBtn) {
                resetBtn.addEventListener('click', function () {
                    agendaListEl.innerHTML = agendaListDefaultHTML;
                    document.querySelectorAll('.agenda-day').forEach(function (el) {
                        el.classList.remove('is-selected');
                    });
                });
            }
        }

        function escapeHtml(str) {
            const div = document.createElement('div');
            div.textContent = str;
            return div.innerHTML;
        }

        function ubahBulan(delta) {
            let bulanBaru = agendaState.bulan + delta;
            let tahunBaru = agendaState.tahun;

            if (bulanBaru > 12) {
                bulanBaru = 1;
                tahunBaru += 1;
            } else if (bulanBaru < 1) {
                bulanBaru = 12;
                tahunBaru -= 1;
            }

            agendaState.bulan = bulanBaru;
            agendaState.tahun = tahunBaru;
            renderAgendaCalendar();
        }

        if (btnPrev) btnPrev.addEventListener('click', function () { ubahBulan(-1); });
        if (btnNext) btnNext.addEventListener('click', function () { ubahBulan(1); });

        renderAgendaCalendar();
        
    }
    
});