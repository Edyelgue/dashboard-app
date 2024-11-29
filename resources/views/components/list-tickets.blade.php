<script>
    document.addEventListener("DOMContentLoaded", function () {
        const filters = Array.from(document.querySelectorAll("th input"));
        const tableRows = document.querySelectorAll("#changes-tbody tr");

        filters.forEach((input, index) => {
            input.addEventListener("input", () => {
                const filterValue = input.value.toLowerCase();

                tableRows.forEach(row => {
                    const cell = row.children[index];
                    if (cell) {
                        const cellText = cell.textContent.toLowerCase();
                        row.style.display = cellText.includes(filterValue) ? "" : "none";
                    }
                });
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        const sortButtons = document.querySelectorAll(".sort-btn");

        sortButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const tableBody = document.getElementById("changes-tbody");
                const rows = Array.from(tableBody.querySelectorAll("tr"));
                const column = button.dataset.column;
                const order = button.dataset.order;

                // Determine the column index
                const columnIndex = [...button.closest("tr").children].indexOf(button.closest("th"));

                // Sort rows
                rows.sort((a, b) => {
                    const cellA = a.children[columnIndex].innerText.trim();
                    const cellB = b.children[columnIndex].innerText.trim();

                    if (!isNaN(cellA) && !isNaN(cellB)) {
                        // Compare as números se forem valores numéricos
                        return order === "asc" ? cellA - cellB : cellB - cellA;
                    } else {
                        // Compare como strings
                        return order === "asc" ?
                            cellA.localeCompare(cellB) :
                            cellB.localeCompare(cellA);
                    }
                });

                // Atualizar a ordem no atributo data-order
                button.dataset.order = order === "asc" ? "desc" : "asc";

                // Reorganizar as linhas na tabela
                tableBody.innerHTML = "";
                rows.forEach((row) => tableBody.appendChild(row));
            });
        });
    });
</script>
