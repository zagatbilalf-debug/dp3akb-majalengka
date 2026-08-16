document.addEventListener('DOMContentLoaded', function () {
    const inputFile = document.querySelector('#file');
    const filePreview = document.querySelector('#fileNamePreview');

    if (inputFile && filePreview) {
        inputFile.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                filePreview.innerHTML = '<i class="fa-solid fa-file-circle-check"></i> ' + file.name;
                filePreview.style.display = 'flex';
            } else {
                filePreview.style.display = 'none';
            }
        });
    }
});