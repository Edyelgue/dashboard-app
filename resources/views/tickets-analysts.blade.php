@include('layouts.header')
<section class="w-screen pt-36 flex flex-row justify-center items-center">
    <section class="text-gray-600 mr-16">
        <div class="container flex flex-col items-center mb-2 border rounded">
            <div class="w-full border-b py-1">
                <h1 class="text-center">Tickets Fechados</h1>
            </div>

            <div class="w-full">
                <h1 class="text-center text-3xl font-medium pt-2 pb-3">
                    {{ round(($chartData['totalFechados'] / $chartData['totalGeral']) * 100, 1) }}%
                </h1>
            </div>

            <div class="w-full border-t py-1">
                <h1 class="text-center text-xs font-normal">{{$chartData['totalFechados']}}</h1>
            </div>
        </div>

        <div class="container mx-auto flex flex-col">
            <canvas id="closedTicketsChart" width="440" height="380"></canvas>
        </div>
    </section>

    <section class="text-gray-600">
        <div class="container flex flex-col items-center mb-2 border rounded">
            <div class="w-full border-b py-1">
                <h1 class="text-center">Tickets Cancelados</h1>
            </div>

            <div class="w-full">
                <h1 class="text-center text-3xl font-medium pt-2 pb-3">
                    {{ round(($chartData['totalCancelados'] / $chartData['totalGeral']) * 100, 1)}}%
                </h1>
            </div>

            <div class="w-full border-t py-1">
                <h1 class="text-center text-xs font-normal">{{$chartData['totalCancelados']}}</h1>
            </div>
        </div>

        <div class="container mx-auto flex flex-col">
            <canvas id="canceledTicketsChart" width="440" height="380"></canvas>
        </div>
    </section>

    <section class="text-gray-600 ml-16">
        <div class="container flex flex-col items-center mb-8 border rounded">
            <div class="w-full border-b py-1">
                <h1 class="text-center">Total</h1>
            </div>

            <div class="w-full">
                <h1 class="text-center text-3xl font-medium pt-2 pb-3">{{$chartData['totalGeral']}}</h1>
            </div>
        </div>

        <div class="container mx-auto flex flex-col">
            <canvas id="totalTicketsChart" width="440" height="380"></canvas>
        </div>
    </section>
</section>

<section class="w-screen pt-16 flex flex-row justify-center items-center mb-36">
    <section class="text-gray-600">
        <div class="container mx-auto flex flex-col">
            <canvas id="canceldAndClosed" width="1328" height="760"></canvas>
        </div>
    </section>
</section>

<script>
    // Grafico de tickets fechados por analista
    const chartData = @json($chartData);

    chartData.totalGeral

    const dataClosed = {
        labels: chartData.labels,
        datasets: [{
            label: 'Tickets Fechados',
            data: chartData.datasets[0].data,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 216, 235, 1)',
            borderWidth: 1,
            yAxisID: 'y'
        }]
    };

    const configClosed = {
        type: 'bar',
        data: dataClosed,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true
                },
                datalabels: {
                    anchor: 'end',
                    alin: 'end',
                    color: '#666666',
                    font: {
                        weight: 'regular'
                    }
                },
                title: {
                    display: true,
                    text: 'Total de Tickets Fechados por Analista'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    const myChart = new Chart(
        document.getElementById('closedTicketsChart'),
        configClosed
    );

    // Grafico de tickets cancelados por analista
    const dataCanceled = {
        labels: chartData.labels,
        datasets: [{
            label: 'Tickets Cancelados',
            data: chartData.datasets[1].data,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 216, 235, 1)',
            borderWidth: 1,
            yAxisID: 'y'
        }]
    };

    const configCanceled = {
        type: 'bar',
        data: dataCanceled,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true
                },
                datalabels: {
                    anchor: 'end',
                    alin: 'end',
                    color: '#666666',
                    font: {
                        weight: 'regular'
                    }
                },
                title: {
                    display: true,
                    text: 'Total de Tickets Cancelados por Analista'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    const myChart2 = new Chart(
        document.getElementById('canceledTicketsChart'),
        configCanceled
    );

    // Grafico de total de tickets por analista
    const dataTotal = {
        labels: chartData.labels,
        datasets: [{
            label: 'Total de Tickets',
            data: chartData.datasets[2].data,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 216, 235, 1)',
            borderWidth: 1,
            yAxisID: 'y'
        }]
    };

    const configTotal = {
        type: 'bar',
        data: dataTotal,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true
                },
                datalabels: {
                    anchor: 'end',
                    alin: 'end',
                    color: '#666666',
                    font: {
                        weight: 'regular'
                    }
                },
                title: {
                    display: true,
                    text: 'Total de Tickets por Analista'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    const myChart3 = new Chart(
        document.getElementById('totalTicketsChart'),
        configTotal
    );

    // Grafico de total de tickets fechados e cancelados por analista
    const dataClosedAndCanceled = {
        labels: chartData.labels,
        datasets: [
            {
                label: 'Fechados',
                data: chartData.datasets[0].data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 216, 235, 1)',
                borderWidth: 1,
                yAxisID: 'y'
            },
            {
                label: 'Cancelados',
                data: chartData.datasets[1].data,
                backgroundColor: 'rgba(235, 162, 54, 0.2)',
                borderColor: 'rgba(235, 162, 54, 1)',
                borderWidth: 1,
                yAxisID: 'y'
            },
        ]
    };

    const configClosedAndCanceled = {
        type: 'bar',
        data: dataClosedAndCanceled,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true
                },
                datalabels: {
                    anchor: 'end',
                    alin: 'end',
                    color: '#666666',
                    font: {
                        weight: 'regular'
                    }
                },
                title: {
                    display: true,
                    text: 'Tickets Fechados/Cancelados por Analista'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    const myChart4 = new Chart(
        document.getElementById('canceldAndClosed'),
        configClosedAndCanceled
    );
</script>
@include('layouts.footer')