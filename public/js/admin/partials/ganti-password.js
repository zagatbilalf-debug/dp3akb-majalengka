document.addEventListener('DOMContentLoaded', function () {
    // ===== Toggle show/hide password =====
    document.querySelectorAll('.toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const targetId = btn.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (!input) return;

            const icon = btn.querySelector('i');
            const isHidden = input.type === 'password';

            input.type = isHidden ? 'text' : 'password';
            if (icon) {
                icon.classList.toggle('fa-eye', !isHidden);
                icon.classList.toggle('fa-eye-slash', isHidden);
            }
        });
    });

    // ===== Validasi real-time konfirmasi password =====
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const matchHint = document.getElementById('matchHint');
    const submitBtn = document.querySelector('#gantiPasswordForm .btn-save');

    function checkMatch() {
        if (!confirmInput.value) {
            matchHint.textContent = '';
            matchHint.className = 'field-hint';
            if (submitBtn) submitBtn.disabled = false;
            return;
        }

        const isMatch = passwordInput.value === confirmInput.value;

        matchHint.textContent = isMatch
            ? 'Password cocok.'
            : 'Password tidak cocok.';
        matchHint.className = 'field-hint ' + (isMatch ? 'match' : 'no-match');

        if (submitBtn) submitBtn.disabled = !isMatch;
    }

    if (passwordInput && confirmInput && matchHint) {
        passwordInput.addEventListener('input', checkMatch);
        confirmInput.addEventListener('input', checkMatch);
    }
});