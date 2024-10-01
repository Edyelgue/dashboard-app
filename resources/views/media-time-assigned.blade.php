<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Médias de Time Assigned por Analista</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        #myChart {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

    <div style="width: 75%; margin: auto;">
        <h2>Médias de Time Assigned por Analista</h2>
        <canvas id="myChart"></canvas>
    </div>

    <script>
        const labels = @json($analistas);  // Nomes dos analistas
        const times = @json($medias);      // Médias de time_assigned em hh:mm:ss

        // Prepara os dados para o gráfico
        const data = {
            labels: labels,
            datasets: [{
                label: 'Média de Time Assigned (hh:mm:ss)',
                data: times.map(timeToSeconds),  // Converte cada tempo para segundos para o gráfico
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',  // Tipo de gráfico (barras)
            data: data,
            options: {
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
                        color: '#000', // Cor do texto
                        font: {
                            weight: 'bold'
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

</body>
</html>
