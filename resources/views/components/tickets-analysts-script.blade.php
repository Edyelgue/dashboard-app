<script>
    // Dados dos gráficos
    const chartData = @json($chartData);

    // Função para inicializar um gráfico
    function initializeChart(elementId, config) {
        const chartElement = document.getElementById(elementId);
        if (chartElement) {
            return new Chart(chartElement, config);
        }
        return null;
    }

    // Configuração e inicialização do gráfico de tickets fechados
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
                legend: { display: true },
                title: { display: true, text: 'Total de Tickets Fechados por Analista' }
            },
            scales: {
                y: { beginAtZero: true, grace: '20%' }
            }
        }
    };

    initializeChart('closedTicketsChart', configClosed);

    // Configuração e inicialização do gráfico de tickets cancelados
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
                legend: { display: true },
                title: { display: true, text: 'Total de Tickets Cancelados por Analista' }
            },
            scales: {
                y: { beginAtZero: true, grace: '20%' }
            }
        }
    };

    initializeChart('canceledTicketsChart', configCanceled);

    // Configuração e inicialização do gráfico de total de tickets
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
                legend: { display: true },
                title: { display: true, text: 'Total de Tickets por Analista' },
                datalabels: {
                    display: true,
                    color: '#000',
                    font: {
                        weight: 'regular',
                        size: 12
                    },
                    anchor: 'end',
                    align: 'top',
                    formatter: (value) => value // Exibe o valor original
                },
            },
            scales: {
                y: { beginAtZero: true, grace: '20%' }
            }
        },
        plugins: [ChartDataLabels] // Certifique-se de incluir o plugin
    };

    initializeChart('totalTicketsChart', configTotal);

    // Configuração e inicialização do gráfico de tickets fechados/cancelados
    const dataClosedAndCanceled = {
        labels: chartData.labels,
        datasets: [
            {
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
            }
        ]
    };

    const configClosedAndCanceled = {
        type: 'bar',
        data: dataClosedAndCanceled,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: true },
                title: { display: true, text: 'Tickets Fechados/Cancelados por Analista' },
                datalabels: {
                    display: true,
                    color: '#000',
                    font: {
                        weight: 'regular',
                        size: 12
                    },
                    anchor: 'end',
                    align: 'top',
                    formatter: (value) => value // Exibe o valor original
                },
            },
            scales: {
                y: { beginAtZero: true, grace: '20%' }
            }
        },
        plugins: [ChartDataLabels] // Certifique-se de incluir o plugin
    };

    initializeChart('canceldAndClosed', configClosedAndCanceled);
</script>