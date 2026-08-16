document.addEventListener('DOMContentLoaded', function () {
    // Animasi hitung naik untuk angka statistik
    const statValues = document.querySelectorAll('.dashboard-stats .stat-value');

    statValues.forEach(function (el) {
        const target = parseInt(el.textContent, 10) || 0;

        if (target === 0) return;

        let current = 0;
        const duration = 800;
        const stepTime = Math.max(Math.floor(duration / target), 20);

        const counter = setInterval(function () {
            current += 1;
            el.textContent = current;

            if (current >= target) {
                clearInterval(counter);
                el.textContent = target;
            }
        }, stepTime);
    });
});