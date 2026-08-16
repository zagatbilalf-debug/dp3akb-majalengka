document.addEventListener('DOMContentLoaded', function () {
    const inputFoto = document.querySelector('#foto');
    const previewFoto = document.querySelector('#previewFoto');

    if (inputFoto && previewFoto) {
        inputFoto.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    previewFoto.src = event.target.result;
                    previewFoto.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});