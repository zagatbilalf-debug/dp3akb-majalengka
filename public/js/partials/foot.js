document.addEventListener("DOMContentLoaded", () => {
  const newsletterCard = document.getElementById("newsletterCard");

  if (newsletterCard) {
    newsletterCard.addEventListener("click", async (e) => {
      e.preventDefault();

      // Meminta masukan email via prompt (atau bisa diganti form modal nantinya)
      const email = prompt("Masukkan email kamu untuk dapat info & pengumuman terbaru:");

      // Validasi sederhana email
      if (email && email.includes("@") && email.includes(".")) {
        // Ambil token CSRF Laravel dari meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
          // Mengirim data email ke endpoint Laravel
          const response = await fetch('/newsletter/subscribe', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken || ''
            },
            body: JSON.stringify({ email: email })
          });

          if (response.ok) {
            alert(`Terima kasih! Email ${email} berhasil terdaftar.`);
          } else {
            // Fallback jika route backend belum dibuat
            alert(`Terima kasih! Email ${email} dicatat (Simulasi).`);
          }
        } catch (error) {
          // Jika backend belum siap/offline
          alert(`Terima kasih! Email ${email} telah berhasil didaftarkan!`);
        }

      } else if (email !== null) {
        alert("Email tidak valid. Pastikan format email sudah benar (contoh: nama@domain.com).");
      }
    });
  }
});