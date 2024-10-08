@include('layouts.header')
<section class="text-gray-600 body-font pt-[104px]">
  <div class="container mx-auto flex flex-col px-5 py-2 justify-center items-center">
    <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-600">Desempenho por Analista - N1</h1>
    <canvas id="myChart" class="h-full w-full pt-[24px]"></canvas>
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-1 py-[48px] mx-auto">
    <div class="flex flex-col text-center w-full mb-[24px]">
    <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-600">Incidentes</h1>
    </div>
    <div class="w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th
              class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100 rounded-tl-lg rounded-bl-lg">
              <strong>Incidente</strong>
            </th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100"><strong>Designado
                por</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100">
              <strong>Descrição</strong>
            </th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100"><strong>Data
                Criado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100"><strong>Data
                Designado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100"><strong>Tempo na Fila
                até Designar</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100"><strong>Data
                Finalizado</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100"><strong>Finalizado
                em</strong></th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-700 bg-blue-100 rounded-tr rounded-br">
              <strong>Status</strong>
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($changes as $change)
          <tr>
            <td class="px-4 py-1 text-gray-500">{{ $change->incidentid }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->worklogsubmitter }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->incidentsummary }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->earliest_submit_date }}</td>
            <td class="px-4 py-1 text-gray-500">{{ $change->min_createdate }}</td>
            <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->time_assigned }}</td>
            <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->finished_datetime }}</td>
            <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->time_finished }}</td>
            <td class="px-4 py-1 text-gray-500 text-lg">{{ $change->status }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- Adicione os links de paginação aqui -->
      <div class="mt-4">
        {{ $changes->links() }}
      </div>
    </div>
  </div>
</section>
@include('components.time-assigned-script')
@include('layouts.footer')