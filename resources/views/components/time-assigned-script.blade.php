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
      // borderColor: '#F2BB0580',
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
      backgroundColor: 'rgb(251, 139, 36)',
      borderColor: 'rgb(251, 139, 36)',
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
        size: 16
      },
      responsive: true, // Torna o gráfico responsivo
      maintainAspectRatio: true, // Permite ajustar a proporção ao redimensionar
      plugins: {
        tooltip: {
          callbacks: {
            label: function (tooltipItem) {
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
            size: 16
          },
          display: true
        },
        datalabels: {
          display: 'auto',
          clamp: true,
          clip: true,
          anchor: 'end',
          align: 'end',
          formatter: function (value, context) {
            // Formata o rótulo de tempo médio como hh:mm:ss e o rótulo de incidentes como inteiro
            if (context.dataset.label === 'Tempo Médio p/Designar (h)' || context.dataset.label === 'Tempo Médio p/Finalização (h)') {
              return secondsToTime(value); // Formata para hh:mm:ss
            } else {
              return value.toFixed(0); // Formata para inteiro
            }
          },
          // color: '#c1c6cc', // Cor dos rotulos de barra
          font: {
            weight: 'regular',
            size: 16 // Tamanho da fonte para a legenda
          }
        }
      },
      scales: {
        x: {
          ticks: {
            // color: '#c1c6cc' // Cor das labels no eixo X
          },
          // grid: {
          //   color: '#c1c6cc', // Cor da grade no eixo X
          // }
        },
        y: {
          // grid: {
          //   color: '#c1c6cc', // Cor da grade no eixo Y
          // },
          beginAtZero: true,
          grace: '10%',
          ticks: {
            callback: function (value) {
              return secondsToTime(value); // Converte para hh:mm:ss no eixo Y das barras
            },
            stepSize: 3600, // Intervalo dos ticks do eixo Y das barras
            // color: '#c1c6cc' // Cor das labels no eixo y
            font: {
              size: 12, // Tamanho da fonte dos rótulos no eixo Y
            },
          }
        },
        y1: {
          grid: {
            drawOnChartArea: false, // Evita que a grade do y1 interfira no y
          },
          beginAtZero: true,
          position: 'right', // Posiciona o segundo eixo Y à direita
          grace: '10%',
          ticks: {
            font: {
              size: 11, // Tamanho da fonte
              weight: '500', // Peso da fonte
            },
            color: '#fff', // Cor dos rótulos
            stepSize: 500, // Intervalo dos ticks
            callback: function (value) {
              return value; // Exibe os valores inteiros no eixo Y1
            },
          },
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
    return `${String(hours).padStart(1, '0')}h${String(minutes).padStart(2, '0')}m`; // :${String(secs).padStart(2, '0')}
  }
</script>