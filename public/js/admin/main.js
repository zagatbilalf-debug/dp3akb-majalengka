document.addEventListener('DOMContentLoaded', function () {

    // ===== Tutup alert manual (tombol x) =====
    document.querySelectorAll('.alert-close').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const alertBox = btn.closest('.alert');
            if (alertBox) {
                alertBox.style.transition = 'opacity 0.3s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 300);
            }
        });
    });

    // ===== Auto-dismiss alert setelah 5 detik =====
    document.querySelectorAll('.alert').forEach(function (alertBox) {
        setTimeout(function () {
            alertBox.style.transition = 'opacity 0.3s ease';
            alertBox.style.opacity = '0';
            setTimeout(() => alertBox.remove(), 300);
        }, 5000);
    });

});