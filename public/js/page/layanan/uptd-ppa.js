function setActive(event) {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    event.target.classList.add('active');
}

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("uptdForm");
    const formAlert = document.getElementById("formAlert");

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const submitBtn = form.querySelector(".btn-submit");
            submitBtn.textContent = "Mengirim...";
            submitBtn.disabled = true;

            setTimeout(() => {
                formAlert.style.display = "block";
                formAlert.textContent = "Terima kasih! Pengaduan Anda berhasil dikirim dan akan segera diproses secara rahasia.";

                form.reset();
                submitBtn.textContent = "Kirim Pengaduan";
                submitBtn.disabled = false;

                setTimeout(() => {
                    formAlert.style.display = "none";
                }, 5000);
            }, 1500);
        });
    }

    // ScrollSpy otomatis untuk nav sidebar
    const sections = document.querySelectorAll(".content-section");
    const navLinks = document.querySelectorAll(".nav-link");

    window.addEventListener("scroll", () => {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            if (window.scrollY >= sectionTop - 120) {
                current = section.getAttribute("id");
            }
        });

        navLinks.forEach((link) => {
            link.classList.remove("active");
            if (link.getAttribute("href").includes(current)) {
                link.classList.add("active");
            }
        });
    });
});s