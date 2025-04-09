document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector(".users-table");
    const headers = table.querySelectorAll("th.sortable");

    headers.forEach(header => {
        header.addEventListener("click", function () {
            const column = this.getAttribute("data-column");
            const order = this.classList.contains("sorted-asc") ? "desc" : "asc";

            // Resetowanie strzałek we wszystkich nagłówkach
            headers.forEach(h => h.classList.remove("sorted-asc", "sorted-desc"));

            // Dodanie odpowiedniej klasy dla sortowanego nagłówka
            this.classList.add(order === "asc" ? "sorted-asc" : "sorted-desc");

            sortTable(table, column, order);
        });
    });

    function sortTable(table, column, order) {
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));

        const columnIndex = Array.from(table.querySelectorAll("th")).findIndex(th => th.getAttribute("data-column") === column);

        rows.sort((rowA, rowB) => {
            const cellA = rowA.cells[columnIndex].textContent.trim().toLowerCase();
            const cellB = rowB.cells[columnIndex].textContent.trim().toLowerCase();

            return order === "asc" ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        });

        // Przebudowanie tabeli z posortowanymi wierszami
        tbody.innerHTML = "";
        rows.forEach(row => tbody.appendChild(row));
    }
});
