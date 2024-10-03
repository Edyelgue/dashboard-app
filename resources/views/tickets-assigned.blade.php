@include('layouts.header')
<section class="text-gray-600 body-font pt-36">
    <div class="container mx-auto flex flex-col px-5 py-4 justify-center items-center">
        <canvas id="myChart"></canvas>
    </div>
</section>

<script>
    const data = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 216, 235, 1)',
            borderWidth: 1,
            yAxisID: 'y'
        }]
    };

    const config = {
        type: 'bar',
        data: data,
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
        document.getElementById('myChart'),
        config
    );
</script>
@include('layouts.footer')