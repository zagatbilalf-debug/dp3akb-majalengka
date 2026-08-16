document.addEventListener('DOMContentLoaded', function() {
    
    // Ambil semua elemen header accordion
    const accordionHeaders = document.querySelectorAll('.accordion-header');

    accordionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            // Ambil parent item dari header yang diklik
            const currentItem = this.parentElement;

            // Jika item yang diklik sudah aktif, tutup item tersebut (bisa tutup semua)
            if (currentItem.classList.contains('active')) {
                currentItem.classList.remove('active');
            } else {
                // Hapus class 'active' dari semua item lain agar yang terbuka hanya satu
                document.querySelectorAll('.accordion-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Tambahkan class 'active' ke item yang sedang diklik
                currentItem.classList.add('active');
            }
        });
    });

});