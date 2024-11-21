@include('layouts.header')
<section class="text-gray-600 body-font pt-[90px]">
  <div class="border shadow-[5px_5px_15px_4.5px_rgba(0,0,0,0.1)] container mx-auto flex flex-col px-5 py-2 justify-center items-center rounded-lg text-gray-100 w-2/3" data-theme="light">
    <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-700">Desempenho por Analista - N1</h1>
    <canvas id="myChart" class="h-full w-full pt-[12px]"></canvas>
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-1 py-[48px] mx-auto">
    <div class="flex flex-col text-center w-full mb-[12px]">
      <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-600">Incidentes</h1>
    </div>
    <div id="changes-list" class="w-full mx-auto overflow-auto">
      <div class="overflow-x-auto">
        <table class="table table-xs">
          <thead>
            <tr>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Incidente" class="font-normal text-sm w-full rounded-md pl-2 pr-8 border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Designado por" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Descrição" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Data criado" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Data designado" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Tempo na fila" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Data finalizado" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Finalizado em" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
              <th>
                <div class="relative flex items-center border rounded-md">
                  <input type="text" placeholder="Status" class="font-normal text-sm rounded-md w-full border">
                  <button class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn" data-column="incidentid" data-order="asc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </th>
            </tr>
            <tr>
              <th>Incidente</th>
              <th>Designado por</th>
              <th>Descrição</th>
              <th>Data criado</th>
              <th>Data designado</th>
              <th>Tempo na fila</th>
              <th>Data finalizado</th>
              <th>Finalizado em</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="changes-tbody">
            @foreach ($changes as $change)
            <tr>
              <td>{{ $change->incidentid }}</td>
              <td>{{ $change->worklogsubmitter }}</td>
              <td>{{ $change->incidentsummary }}</td>
              <td>{{ $change->earliest_submit_date }}</td>
              <td>{{ $change->min_createdate }}</td>
              <td>{{ $change->time_assigned }}</td>
              <td>{{ $change->finished_datetime }}</td>
              <td>{{ $change->time_finished }}</td>
              <td>{{ $change->status }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function() {
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

  document.addEventListener("DOMContentLoaded", function() {
    const sortButtons = document.querySelectorAll(".sort-btn");

    sortButtons.forEach((button) => {
      button.addEventListener("click", function() {
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
@include('components.time-assigned-script')
@include('layouts.footer')