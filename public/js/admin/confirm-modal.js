document.addEventListener("DOMContentLoaded", function () {
    const overlay = document.getElementById("confirmDeleteOverlay");
    const messageEl = document.getElementById("confirmDeleteMessage");
    const btnCancel = document.getElementById("confirmDeleteCancel");
    const btnConfirm = document.getElementById("confirmDeleteConfirm");

    if (!overlay) return;

    let activeForm = null;

    // Tangkap semua form hapus yang punya class "js-delete-form"
    document.querySelectorAll(".js-delete-form").forEach(function (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            activeForm = form;

            const itemName = form.getAttribute("data-item-name") || "data ini";
            messageEl.textContent = `Yakin ingin menghapus ${itemName}? Tindakan ini tidak bisa dibatalkan.`;

            overlay.classList.add("active");
        });
    });

    btnCancel.addEventListener("click", function () {
        overlay.classList.remove("active");
        activeForm = null;
    });

    btnConfirm.addEventListener("click", function () {
        if (activeForm) {
            activeForm.submit();
        }
    });

    // Klik di luar modal box juga menutup
    overlay.addEventListener("click", function (e) {
        if (e.target === overlay) {
            overlay.classList.remove("active");
            activeForm = null;
        }
    });
});