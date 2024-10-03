@include('layouts.header')
<section class="text-gray-600 body-font pt-36">
  <div class="container mx-auto flex flex-col px-5 py-4 justify-center items-center">
    <canvas id="myChart"></canvas>
  </div>
</section>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-1 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-900">Incidentes</h1>
    </div>
    <div class="lg:w-5/6 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 rounded-tl rounded-bl"><strong>Incidente</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700"><strong>Designado por</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700"><strong>Descrição</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700"><strong>Data Criado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700"><strong>Data Designado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 rounded-tr rounded-br"><strong>Tempo na Fila até Designar</strong></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($changes as $change)
          <tr>
            <td class="px-4 py-1 text-gray-500">{{ $change->incidentid }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->worklogsubmitter }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->incidentsummary }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->earliest_submit_date }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->min_createdate }}</td>
            <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->time_assigned }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Adicione os links de paginação aqui -->
      <div class="mt-4">
        {{ $changes->links() }}
      </div>
    </div>
  </div>
</section>


<script>
  // Dados dos analistas e médias passados da função media()
  const analistas = @json($nomesAnalistas); // Nomes dos analistas
  const medias = @json($medias); // Médias de time_assigned em hh:mm:ss

  // Outros dados passados do index() (como 'changes')
  const changes = @json($changes);

  // Use essas variáveis conforme necessário no seu gráfico ou layout

  // Prepara os dados para o gráfico
  const data = {
    labels: analistas,
    datasets: [{
      label: 'Tempo Médio p/Designar (h)',
      data: medias.map(timeToSeconds), // Converte cada tempo para segundos para o gráfico
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar', // Tipo de gráfico (barras)
    data: data,
    options: {
      responsive: true, // Torna o gráfico responsivo
      maintainAspectRatio: true, // Permite ajustar a proporção ao redimensionar
      responsive: true,
      plugins: {
        legend: {
          display: true,
        },
        datalabels: {
          anchor: 'end',
          align: 'end',
          formatter: function(value) {
            return secondsToTime(value); // Formata o valor como hh:mm:ss
          },
          color: '#666666', // Cor do texto
          font: {
            weight: 'regular'
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            // Converte de volta para hh:mm:ss para o rótulo do eixo Y
            callback: function(value) {
              return secondsToTime(value);
            },
            stepSize: 1200 // Intervalo entre os valores
          }
        }
      }
    },
    plugins: [ChartDataLabels] // Adiciona o plugin de data labels
  };

  // Cria o gráfico
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

  // Converte hh:mm:ss para segundos
  function timeToSeconds(time) {
    const parts = time.split(':');
    return (+parts[0] * 3600) + (+parts[1] * 60) + (+parts[2]);
  }

  // Converte segundos para hh:mm:ss
  function secondsToTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
  }
</script>
@include('layouts.footer')