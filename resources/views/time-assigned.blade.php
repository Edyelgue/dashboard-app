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
  const incByAnalist = @json($repeticoes); // Número de incidentes por analista

  // Outros dados passados do index() (como 'changes')
  const changes = @json($changes);

  // Prepara os dados para o gráfico
  const data = {
    labels: analistas,
    datasets: [
      {
        label: 'Tempo Médio p/Designar (h)',
        data: medias.map(timeToSeconds), // Converte cada tempo para segundos para o gráfico
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1,
        yAxisID: 'y',
      },
      {
        label: 'Incidentes por Analista', // IncByAnalist plotado em uma linha
        data: incByAnalist, // Dados do número de incidentes
        type: 'line', // Define o tipo de gráfico como linha
        borderColor: 'rgba(255, 99, 132, 1)', // Cor da linha
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderWidth: 2,
        fill: false, // Linha sem preenchimento abaixo
        yAxisID: 'y1', // Usa um segundo eixo Y para a escala dos incidentes
      }
    ]
  };

  const config = {
    type: 'bar', // Tipo de gráfico principal (barras)
    data: data,
    options: {
      responsive: true, // Torna o gráfico responsivo
      maintainAspectRatio: true, // Permite ajustar a proporção ao redimensionar
      plugins: {
        legend: {
          display: true,
        },
        datalabels: {
          anchor: 'end',
          align: 'end',
          formatter: function(value, context) {
            // Formata o rótulo de tempo médio como hh:mm:ss e o rótulo de incidentes como inteiro
            if (context.dataset.label === 'Tempo Médio p/Designar (h)') {
              return secondsToTime(value); // Formata para hh:mm:ss
            } else {
              return value.toFixed(0); // Formata para inteiro
            }
          },
          color: '#666666',
          font: {
            weight: 'regular'
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return secondsToTime(value); // Converte para hh:mm:ss no eixo Y das barras
            },
            stepSize: 1200 // Intervalo dos ticks do eixo Y das barras
          }
        },
        y1: {
          beginAtZero: true,
          position: 'right', // Posiciona o segundo eixo Y à direita
          grid: {
            drawOnChartArea: false, // Evita que a grade do y1 interfira no y
          },
          ticks: {
            stepSize: 1, // Intervalo dos ticks do eixo Y da linha (incidentes)
            callback: function(value) {
              return value; // Exibe os valores inteiros no eixo Y da linha
            }
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