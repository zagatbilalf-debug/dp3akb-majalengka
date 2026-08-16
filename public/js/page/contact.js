document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contactForm");
    const formAlert = document.getElementById("formAlert");

    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const submitBtn = contactForm.querySelector(".btn-submit");
            const originalText = submitBtn.textContent;

            submitBtn.textContent = "Mengirim...";
            submitBtn.disabled = true;

            const formData = new FormData(contactForm);
            const token = contactForm.querySelector('input[name="_token"]').value;

            fetch(contactForm.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                    "Accept": "application/json",
                },
                body: formData,
            })
                .then(async (response) => {
                    const data = await response.json().catch(() => null);

                    if (response.ok) {
                        formAlert.style.display = "block";
                        formAlert.className = "form-alert success";
                        formAlert.textContent =
                            (data && data.message) ||
                            "Terima kasih! Pesan atau pengaduan Anda berhasil dikirim dan akan segera kami proses.";
                        contactForm.reset();
                    } else if (response.status === 422 && data && data.errors) {
                        // Tampilkan error validasi pertama
                        const firstError = Object.values(data.errors)[0][0];
                        formAlert.style.display = "block";
                        formAlert.className = "form-alert error";
                        formAlert.textContent = firstError;
                    } else {
                        throw new Error("Request gagal");
                    }
                })
                .catch(() => {
                    formAlert.style.display = "block";
                    formAlert.className = "form-alert error";
                    formAlert.textContent =
                        "Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.";
                })
                .finally(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;

                    setTimeout(() => {
                        formAlert.style.display = "none";
                    }, 5000);
                });
        });
    }
});