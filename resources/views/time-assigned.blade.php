@include('layouts.header')
<section class="text-gray-600 body-font">
  <div class="container mx-auto flex flex-col px-5 py-24 justify-center items-center">
    <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2">Incidentes</h1>
    </div>
    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"><strong>Incidente</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Designado por</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Data Criado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Data Designado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100"><strong>Tempo na Fila até Designar</strong></th>
          </tr>
        </thead>
        <tbody>
          @php
            // Ordenar por DiferencaEmHoras da maior para a menor
            $sortedChanges = $changes->sortByDesc('DiferencaEmHoras');
          @endphp

          @foreach ($sortedChanges as $change)
          <tr>
            <td class="px-4 py-3">{{ $change->incidentid }}</td>
            <td class="px-4 py-3">
              @php
                // Pegar o worklogsubmitter e remover o ponto final
                $worklogsubmitter = str_replace('.', ' ', $change->worklogsubmitter);

                // Capitalizar a primeira letra de cada nome
                $formattedSubmitter = ucwords($worklogsubmitter);
              @endphp
              {{ $formattedSubmitter }}
            </td>
            <td class="px-4 py-3">{{ $change->createdate }}</td>
            <td class="px-4 py-3">{{ $change->modifieddate }}</td>
            @php
              // Pegar o valor decimal de horas
              $decimalHours = $change->DiferencaEmHoras;

              // Calcular horas
              $hours = floor($decimalHours);

              // Calcular minutos
              $minutes = floor(($decimalHours - $hours) * 60);

              // Calcular segundos
              $seconds = floor((($decimalHours - $hours) * 60 - $minutes) * 60);
            @endphp
            <td class="px-4 py-3 text-lg">{{ sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@include('layouts.footer')