@include('layouts.header')
<section class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-col px-5 py-24 justify-center items-center">
    <canvas id="myChart"></canvas>
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-1 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Incidentes</h1>
    </div>
    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Plan</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Speed</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Storage</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Price</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="px-4 py-3">Start</td>
            <td class="px-4 py-3">5 Mb/s</td>
            <td class="px-4 py-3">15 GB</td>
            <td class="px-4 py-3 text-lg text-gray-900">Free</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Criação dos dados para o gráfico
    const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    const data = {
      labels: labels,
      datasets: [{
        label: 'myChart',
        data: [65, 59, 80, 81, 56, 55, 40],
        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgb(255, 99, 132)'],
        borderWidth: 1
      }]
    };

    // Configuração do gráfico
    const config = {
      type: 'line', // ou 'bar', 'pie', etc.
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // Renderização do gráfico no canvas
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  });
</script>
@include('layouts.footer')