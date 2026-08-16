document.addEventListener("DOMContentLoaded", function () {
    const laporanForm = document.getElementById("laporanForm");
    const alertBox = document.getElementById("alertBox");

    if (laporanForm) {
        laporanForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const submitBtn = laporanForm.querySelector(".btn-submit-pengaduan");
            const originalText = submitBtn.textContent;

            submitBtn.textContent = "Mengirim...";
            submitBtn.disabled = true;

            const formData = new FormData(laporanForm);
            const token = laporanForm.querySelector('input[name="_token"]').value;

            fetch(laporanForm.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                    "Accept": "application/json",
                },
                body: formData, // jangan set Content-Type manual, browser yg atur boundary multipart
            })
                .then(async (response) => {
                    const data = await response.json().catch(() => null);

                    if (response.ok) {
                        alertBox.style.display = "block";
                        alertBox.className = "alert-box alert-box-success";
                        alertBox.textContent =
                            (data && data.message) ||
                            "Laporan Anda telah kami terima dan akan segera ditindaklanjuti.";
                        laporanForm.reset();
                    } else if (response.status === 422 && data && data.errors) {
                        const firstError = Object.values(data.errors)[0][0];
                        alertBox.style.display = "block";
                        alertBox.className = "alert-box alert-box-error";
                        alertBox.textContent = firstError;
                    } else {
                        throw new Error("Request gagal");
                    }
                })
                .catch(() => {
                    alertBox.style.display = "block";
                    alertBox.className = "alert-box alert-box-error";
                    alertBox.textContent =
                        "Terjadi kesalahan saat mengirim laporan. Silakan coba lagi.";
                })
                .finally(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;

                    setTimeout(() => {
                        alertBox.style.display = "none";
                    }, 5000);
                });
        });
    }
});