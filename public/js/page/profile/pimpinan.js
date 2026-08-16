document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchPimpinan");
    const filterButtons = document.querySelectorAll(".filter-btn");
    const profileCards = document.querySelectorAll(".profile-card");

    let currentCategory = "all";
    let searchQuery = "";

    function filterPimpinan() {
        profileCards.forEach((card) => {
            const category = card.getAttribute("data-category");
            const searchText = (card.getAttribute("data-search") || "").toLowerCase();

            const matchesCategory = currentCategory === "all" || category === currentCategory;
            const matchesSearch = searchText.includes(searchQuery);

            if (matchesCategory && matchesSearch) {
                card.style.display = card.classList.contains("featured") ? "grid" : "flex";
            } else {
                card.style.display = "none";
            }
        });
    }

    // Filter Kategori (Pills)
    filterButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            filterButtons.forEach((b) => b.classList.remove("active"));
            this.classList.add("active");

            currentCategory = this.getAttribute("data-filter");
            filterPimpinan();
        });
    });

    // Pencarian Real-Time
    if (searchInput) {
        searchInput.addEventListener("input", function () {
            searchQuery = this.value.toLowerCase().trim();
            filterPimpinan();
        });
    }
});