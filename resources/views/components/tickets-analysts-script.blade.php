<script>
    // Grafico de tickets fechados por analista
    const chartData = @json($chartData);

    chartData.totalGeral

    const dataClosed = {
        labels: chartData.labels,
        datasets: [{
            label: 'Tickets Fechados',
            data: chartData.datasets[0].data,
            backgroundColor: 'rgba(235, 181, 30, 0.2)',
            borderColor: 'rgba(235, 181, 30, 1)',
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
                    display: 'auto',
                    clamp: true,
                    clip: true,
                    anchor: 'end',
                    align: 'end',
                    offset: '2',
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
                    beginAtZero: true,
                    grace: '10%'
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
            backgroundColor: 'rgba(235, 181, 30, 0.2)',
            borderColor: 'rgba(235, 181, 30, 1)',
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
                    display: 'auto',
                    clamp: true,
                    clip: true,
                    anchor: 'end',
                    align: 'end',
                    offset: '2',
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
                    beginAtZero: true,
                    grace: '10%'
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
            backgroundColor: 'rgba(235, 181, 30, 0.2)',
            borderColor: 'rgba(235, 181, 30, 1)',
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
                    display: 'auto',
                    clamp: true,
                    clip: true,
                    anchor: 'end',
                    align: 'end',
                    offset: '1',
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
                    beginAtZero: true,
                    grace: '10%'
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
        datasets: [{
                label: 'Fechados',
                data: chartData.datasets[0].data,
                backgroundColor: 'rgba(235, 181, 30, 0.2)',
                borderColor: 'rgba(235, 181, 30, 1)',
                borderWidth: 1,
                yAxisID: 'y'
            },
            {
                label: 'Cancelados',
                data: chartData.datasets[1].data,
                backgroundColor: 'rgba(172,36,7, 0.2)',
                borderColor: 'rgba(172,36,7, 1)',
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
                    display: 'auto',
                    clamp: true,
                    clip: true,
                    anchor: 'end',
                    align: 'end',
                    offset: '2',
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
                    beginAtZero: true,
                    grace: '10%'
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