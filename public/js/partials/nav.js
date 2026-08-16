const navItems = document.querySelectorAll(".nav-item");
const navbar = document.querySelector("nav.navbar");

navItems.forEach((item) => {
  const link = item.querySelector(".nav-trigger");
  const dropdown = item.querySelector(".dropdown");

  if (link && dropdown) {
    link.addEventListener("click", (e) => {
      const isCurrentlyOpen = item.classList.contains("dropdown-open");

      navItems.forEach((otherItem) => {
        if (otherItem !== item) {
          otherItem.classList.remove("dropdown-open");
        }
      });

      if (!isCurrentlyOpen) {
        e.preventDefault();
        e.stopPropagation();
        item.classList.add("dropdown-open");
      }
    });
  }
});

document.addEventListener("click", (e) => {
  if (!e.target.closest("nav.navbar")) {
    navItems.forEach((item) => item.classList.remove("dropdown-open"));
  }
});

const hamburgerBtn = document.getElementById('hamburgerBtn');
const navLinks = document.getElementById('navLinks');
const menuBackdrop = document.getElementById('menuBackdrop');

function closeMobileMenu() {
  if (hamburgerBtn) hamburgerBtn.classList.remove('active');
  if (navLinks) navLinks.classList.remove('active');
  if (menuBackdrop) menuBackdrop.classList.remove('active');
}

if (hamburgerBtn && navLinks) {
  hamburgerBtn.addEventListener('click', () => {
    hamburgerBtn.classList.toggle('active');
    navLinks.classList.toggle('active');
    if (menuBackdrop) menuBackdrop.classList.toggle('active');
  });

  if (menuBackdrop) {
    menuBackdrop.addEventListener('click', closeMobileMenu);
  }
}

window.addEventListener("scroll", () => {
  if (navbar) {
    if (window.scrollY > 40) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  }
});

const overlay = document.getElementById("overlay");
const openAdminBtn = document.getElementById("openAdmin");
const openAdminMobile = document.getElementById("openAdminMobile");
const closeModalBtn = document.getElementById("closeModal");
const loginForm = document.getElementById("loginForm");
const msg = document.getElementById("msg");
const loginSubmitBtn = document.getElementById("loginSubmitBtn");

function openAdminModal(e) {
  if (e) e.preventDefault();
  if (overlay) {
    overlay.classList.add("active");
    if (msg) {
      msg.textContent = "";
      msg.className = "msg";
    }
  }
  closeMobileMenu();
}

if (openAdminBtn) {
  openAdminBtn.addEventListener("click", openAdminModal);
}

if (openAdminMobile) {
  openAdminMobile.addEventListener("click", openAdminModal);
}

if (closeModalBtn && overlay) {
  closeModalBtn.addEventListener("click", () => {
    overlay.classList.remove("active");
    if (loginForm) loginForm.reset();
  });
}

if (overlay) {
  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) {
      overlay.classList.remove("active");
    }
  });
}

function lockLoginButton(seconds) {
  if (!loginSubmitBtn) return;

  loginSubmitBtn.disabled = true;
  const originalText = "Login";
  let remaining = seconds;

  const interval = setInterval(() => {
    loginSubmitBtn.textContent = `Coba lagi dalam ${remaining}s`;
    remaining -= 1;

    if (remaining < 0) {
      clearInterval(interval);
      loginSubmitBtn.disabled = false;
      loginSubmitBtn.textContent = originalText;
    }
  }, 1000);
}

if (loginForm) {
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(loginForm);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");

    try {
      const response = await fetch(loginForm.action, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": csrfToken || "",
          "Accept": "application/json"
        },
        body: formData,
      });

      const result = await response.json();

      if (response.ok && result.success) {
        if (msg) {
          msg.textContent = result.message || "Login berhasil!";
          msg.className = "msg success";
        }

        setTimeout(() => {
          if (overlay) overlay.classList.remove("active");
          window.location.href = result.redirect || "/admin/dashboard";
        }, 500);

        return;
      }

      // Gagal login: captcha salah, kredensial salah, atau terkunci
      if (msg) {
        msg.textContent = result.message || "Terjadi kesalahan.";
        msg.className = "msg error";
      }

      if (result.locked && result.retry_after) {
        lockLoginButton(result.retry_after);
      }

    } catch (error) {
      if (msg) {
        msg.textContent = "Terjadi kesalahan pada server.";
        msg.className = "msg error";
      }
    }
  });
}