<script>
  // Dados dos analistas e médias passados da função media()
  const analistas = @json($nomesAnalistas); // Nomes dos analistas
  const mediasAssigned = @json($mediasAssigned); // Médias de time_assigned em hh:mm:ss
  const mediasFinished = @json($mediasFinished);
  const incByAnalist = @json($repeticoes); // Número de incidentes por analista
  const sameAsFinishedCount = @json($sameAsFinishedCount); // Número de incidentes por analista

  // Outros dados passados do index() (como 'changes')
  const changes = @json($changes);

  // Prepara os dados para o gráfico
  const data = {
    labels: analistas,
    datasets: [{
        label: 'Tempo Médio p/Designar (h)',
        data: mediasAssigned.map(timeToSeconds), // Converte cada tempo para segundos para o gráfico
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1,
        yAxisID: 'y',
      },
      {
        label: 'Assumido por analista', // IncByAnalist plotado em uma linha
        data: incByAnalist, // Dados do número de incidentes
        type: 'line', // Define o tipo de gráfico como linha
        borderColor: 'rgba(255, 99, 132, 1)', // Cor da linha
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderWidth: 2,
        fill: false, // Linha sem preenchimento abaixo
        yAxisID: 'y1', // Usa um segundo eixo Y para a escala dos incidentes
      },
      {
        label: 'Fechados por Analista', // IncByAnalist plotado em uma linha
        data: sameAsFinishedCount, // Dados do número de incidentes
        type: 'line', // Define o tipo de gráfico como linha
        borderColor: 'rgba(75, 192, 192, 1)', // Cor verde sólido para a linha
        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Cor verde com transparência
        borderWidth: 2,
        fill: false, // Linha sem preenchimento abaixo
        yAxisID: 'y1', // Usa um segundo eixo Y para a escala dos incidentes
      },
      {
        label: 'Tempo Médio p/Finalização (h)',
        data: mediasFinished.map(timeToSeconds), // Converte cada tempo para segundos para o gráfico
        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Tom vermelho com transparência
        borderColor: 'rgba(255, 99, 132, 1)', // Tom vermelho sólido
        borderWidth: 1,
        yAxisID: 'y',
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
        // title: {
        //   display: true,
        //   text: 'Desemenho por Analista N1',
        //   font: {
        //     size: 14
        //   }
        // },
        datalabels: {
          display: 'auto',
          clamp: true,
          clip: true,
          anchor: 'end',
          align: 'end',
          formatter: function(value, context) {
            // Formata o rótulo de tempo médio como hh:mm:ss e o rótulo de incidentes como inteiro
            if (context.dataset.label === 'Tempo Médio p/Designar (h)' || context.dataset.label === 'Tempo Médio p/Finalização (h)') {
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
            stepSize: 3600 // Intervalo dos ticks do eixo Y das barras
          }
        },
        y1: {
          beginAtZero: true,
          position: 'right', // Posiciona o segundo eixo Y à direita
          grid: {
            drawOnChartArea: false, // Evita que a grade do y1 interfira no y
          },
          grace: '10%',
          ticks: {
            stepSize: 500, // Intervalo dos ticks do eixo Y da linha (incidentes)
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