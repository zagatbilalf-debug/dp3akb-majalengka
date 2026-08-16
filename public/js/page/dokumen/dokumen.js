document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchDokumen");
    const filterButtons = document.querySelectorAll(".filter-btn");
    const dokumenItems = document.querySelectorAll(".dokumen-item");
    const noDataMessage = document.getElementById("noDataMessage");

    let currentCategory = "all";
    let searchQuery = "";

    function filterDokumen() {
        let visibleCount = 0;

        dokumenItems.forEach((item) => {
            const category = item.getAttribute("data-category");
            const searchText = item.getAttribute("data-search").toLowerCase();

            const matchesCategory = currentCategory === "all" || category === currentCategory;
            const matchesSearch = searchText.includes(searchQuery);

            if (matchesCategory && matchesSearch) {
                item.style.display = "flex";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        // Kontrol tampilan pesan jika data tidak ditemukan
        if (visibleCount === 0) {
            noDataMessage.style.display = "block";
        } else {
            noDataMessage.style.display = "none";
        }
    }

    // Event listener untuk tombol filter kategori (Pills)
    filterButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            filterButtons.forEach((b) => b.classList.remove("active"));
            this.classList.add("active");

            currentCategory = this.getAttribute("data-filter");
            filterDokumen();
        });
    });

    // Event listener untuk kotak pencarian real-time
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            searchQuery = this.value.toLowerCase().trim();
            filterDokumen();
        });
    }
});