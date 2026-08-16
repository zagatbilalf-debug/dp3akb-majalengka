document.addEventListener('DOMContentLoaded', function () {

    // ===== Inisialisasi TinyMCE untuk Konten Berita =====
    if (document.querySelector('#konten')) {
        tinymce.init({
            selector: '#konten',
            license_key: 'gpl',
            height: 400,
            menubar: false,
            branding: false,
            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount help',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | ' +
                     'bullist numlist outdent indent | blockquote link image media table | removeformat | code fullscreen | help',
            block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Inter", sans-serif; font-size: 15px; }',

            // Alt text & alignment tab di dialog Insert/Edit Image (pengganti imageTextAlternative CKEditor)
            image_advtab: true,

            // ===== Upload gambar ke endpoint Laravel yang sama persis kayak sebelumnya =====
            images_upload_handler: function (blobInfo) {
                return new Promise((resolve, reject) => {
                    const formData = new FormData();
                    formData.append('upload', blobInfo.blob(), blobInfo.filename());

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch('/admin/berita/upload-image', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.url) {
                                resolve(data.url);
                            } else {
                                reject('Upload gagal: respons tidak berisi URL.');
                            }
                        })
                        .catch(() => reject('Upload gagal: terjadi kesalahan jaringan.'));
                });
            },
        });
    }

    // ===== Preview gambar cover sebelum upload (tidak berubah) =====
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