@include('layouts.header')
<section class="text-gray-600 body-font pt-[104px]">
  <div class="container mx-auto flex flex-col px-5 py-2 justify-center items-center rounded-lg text-gray-100 w-2/3" data-theme="dark">
    <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-300">Desempenho por Analista - Monitoramento</h1>
    <canvas id="myChart" class="h-full w-full pt-[24px]"></canvas>
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-1 py-[48px] mx-auto">
    <div class="flex flex-col text-center w-full mb-[24px]">
      <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-600">Incidentes</h1>
    </div>
    <div id="changes-list" class="w-full mx-auto overflow-auto">
      <div class="overflow-x-auto">
        <table class="table table-xs">
          <thead>
            <tr>
              <th>Incidente</th>
              <th>Designado por</th>
              <th>Descrição</th>
              <th>Data criado</th>
              <th>Data designado</th>
              <th>Tempo na fila</th>
              <th>Data finalizado</th>
              <th>Finalizado em</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="changes-tbody">
            @foreach ($changes as $change)
            <tr>
              <td>{{ $change->incidentid }}</td>
              <td>{{ $change->worklogsubmitter }}</td>
              <td>{{ $change->incidentsummary }}</td>
              <td>{{ $change->earliest_submit_date }}</td>
              <td>{{ $change->min_createdate }}</td>
              <td>{{ $change->time_assigned }}</td>
              <td>{{ $change->finished_datetime }}</td>
              <td>{{ $change->time_finished }}</td>
              <td>{{ $change->status }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- Adicione os links de paginação aqui -->
      <div class="mt-4">
        {{ $changes->links() }}
      </div>
    </div>
  </div>
</section>
@include('components.time-assigned-script-nm')
@include('layouts.footer')