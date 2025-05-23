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
      data: mediasAssigned.map(timeToSeconds),
      backgroundColor: '#F2BB0580',
      // borderColor: 'rgba(75, 192, 192, 1)',
      // borderWidth: 1,
      yAxisID: 'y',
    },
    {
      label: 'Assumido por analista',
      data: incByAnalist,
      type: 'line',
      backgroundColor: '#84a9c0',
      borderColor: '#84a9c0',
      borderWidth: 2,
      fill: false,
      yAxisID: 'y1',
    },
    {
      label: 'Fechados por Analista',
      data: sameAsFinishedCount,
      type: 'line',
      backgroundColor: '#fb8b24',
      borderColor: '#fb8b24',
      borderWidth: 2,
      fill: false,
      yAxisID: 'y1',
    },
    {
      label: 'Tempo Médio p/Finalização (h)',
      data: mediasFinished.map(timeToSeconds),
      backgroundColor: '#ac050680',
      // borderColor: '#6e0e0a80',
      // borderWidth: 1,
      yAxisID: 'y',
    }
    ]
  };

  const config = {
    type: 'bar', // Tipo de gráfico principal (barras)
    data: data,
    options: {
      font: {
        // color: '#FF0000', // Cor global para todas as fontes
      },
      responsive: true, // Torna o gráfico responsivo
      maintainAspectRatio: true, // Permite ajustar a proporção ao redimensionar
      plugins: {
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              console.log(tooltipItem)
              console.log(data)

              const value = tooltipItem.raw;
              const label = tooltipItem.dataset.label;

              if (label === 'Tempo Médio p/Designar (h)' || label === 'Tempo Médio p/Finalização (h)') {
                return label + ': ' + secondsToTime(value); // Formata para hh:mm:ss
              } else {
                return label + ': ' + value.toFixed(0); // Formata para inteiro
              }
            }
          }
        },
        legend: {
          labels: {
            // color: '#c1c6cc', // Cor da fonte da legenda
          },
          display: true
        },
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
          // color: '#c1c6cc', // Cor dos rotulos de barra
          font: {
            weight: 'regular'
          }
        }
      },
      scales: {
        x: {
          ticks: {
                // color: '#c1c6cc' // Cor das labels no eixo X
          }
        },
        y: {
          beginAtZero: true,
          grace:'10%',
          ticks: {
            callback: function(value) {
              return secondsToTime(value); // Converte para hh:mm:ss no eixo Y das barras
            },
            stepSize: 3600, // Intervalo dos ticks do eixo Y das barras
            // color: '#c1c6cc'// Cor das labels no eixo y
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
            // color: '#c1c6cc', // Cor das labels no eixo y
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