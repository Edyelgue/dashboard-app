@include('layouts.header')
<section class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-col px-5 py-24 justify-center items-center">
    <canvas id="myChart"></canvas>
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-1 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2">Incidentes</h1>
    </div>
    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"><strong>Incidente</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Designado por</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Data Criado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Data Designado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Tempo na Fila até Designar</strong></th>
          </tr>
        </thead>
        <tbody>
          @php
          // Ordenar por DiferencaEmHoras da maior para a menor
          $sortedChanges = $changes->sortByDesc('DiferencaEmHoras');
          @endphp

          @foreach ($sortedChanges as $change)
          <tr>
            <td class="px-4 py-3">{{ $change->incidentid }}</td>
            <td class="px-4 py-3">
              @php
              // Pegar o worklogsubmitter e remover o ponto final
              $worklogsubmitter = str_replace('.', ' ', $change->worklogsubmitter);

              // Capitalizar a primeira letra de cada nome
              $formattedSubmitter = ucwords($worklogsubmitter);
              @endphp
              {{ $formattedSubmitter }}
            </td>
            <td class="px-4 py-3">{{ $change->createdate }}</td>
            <td class="px-4 py-3">{{ $change->modifieddate }}</td>
            @php
            // Pegar o valor decimal de horas
            $decimalHours = $change->DiferencaEmHoras;

            // Calcular horas
            $hours = floor($decimalHours);

            // Calcular minutos
            $minutes = floor(($decimalHours - $hours) * 60);

            // Calcular segundos
            $seconds = floor((($decimalHours - $hours) * 60 - $minutes) * 60);
            @endphp
            <td class="px-4 py-3 text-lg">{{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Criação dos dados para o gráfico
    const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    const data = {
      labels: labels,
      datasets: [{
        label: 'myChart',
        data: [65, 59, 80, 81, 56, 55, 40],
        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgb(255, 99, 132)'],
        borderWidth: 1
      }]
    };

    // Configuração do gráfico
    const config = {
      type: 'bar', // ou 'line', 'pie', etc.
      data: data,
      options: {
        responsive: true, // Torna o gráfico responsivo
        maintainAspectRatio: true, // Permite ajustar o gráfico sem manter a proporção
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // Renderização do gráfico no canvas
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  });
</script>
@include('layouts.footer')