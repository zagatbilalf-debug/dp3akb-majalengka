document.addEventListener('DOMContentLoaded', function () {
    const inputGambar = document.querySelector('#gambar');
    const previewGambar = document.querySelector('#previewGambar');

    if (inputGambar && previewGambar) {
        inputGambar.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    previewGambar.src = event.target.result;
                    previewGambar.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});