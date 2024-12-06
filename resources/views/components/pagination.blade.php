<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rowsPerPage = 10; // Número de linhas por página
        const tableBody = document.getElementById('changes-tbody');
        const pagination = document.getElementById('pagination');
        const rows = Array.from(tableBody.querySelectorAll('tr')); // Todas as linhas da tabela
        let currentPage = 1;

        // Função para exibir uma página específica
        function displayPage(page) {
            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = index >= startIndex && index < endIndex ? '' : 'none';
            });

            updatePagination(page);
        }

        // Função para criar controles de paginação com setas
        function updatePagination(current) {
            pagination.innerHTML = ''; // Limpa os botões de paginação

            const totalPages = Math.ceil(rows.length / rowsPerPage);

            // Botão "Anterior"
            const prevBtn = document.createElement('button');
            prevBtn.textContent = '«';
            prevBtn.className = `px-4 py-2 rounded ${current === 1 ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-500 text-white'}`;
            prevBtn.disabled = current === 1;
            prevBtn.addEventListener('click', () => {
                if (current > 1) {
                    currentPage--;
                    displayPage(currentPage);
                }
            });
            pagination.appendChild(prevBtn);

            // Botão da página atual
            const pageBtn = document.createElement('button');
            pageBtn.textContent = `Página ${current}`;
            pageBtn.className = `px-4 py-2 rounded bg-blue-500 text-white mx-1`;
            pagination.appendChild(pageBtn);

            // Botão "Próximo"
            const nextBtn = document.createElement('button');
            nextBtn.textContent = '»';
            nextBtn.className = `px-4 py-2 rounded ${current === totalPages ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-500 text-white'}`;
            nextBtn.disabled = current === totalPages;
            nextBtn.addEventListener('click', () => {
                if (current < totalPages) {
                    currentPage++;
                    displayPage(currentPage);
                }
            });
            pagination.appendChild(nextBtn);
        }

        // Exibir a primeira página ao carregar
        displayPage(currentPage);
    });
</script>
