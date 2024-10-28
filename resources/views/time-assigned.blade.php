@include('layouts.header')
<section class="text-gray-600 body-font pt-[90px]">
  <div class="border shadow-[5px_5px_15px_4.5px_rgba(0,0,0,0.1)] container mx-auto flex flex-col px-5 py-2 justify-center items-center rounded-lg text-gray-100 w-2/3" data-theme="light">
    <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-700">Desempenho por Analista - N1</h1>
    <canvas id="myChart" class="h-full w-full pt-[12px]"></canvas>
  </div>
</section>
<section class="text-gray-600 body-font">
  <div class="container px-1 py-[48px] mx-auto">
    <div class="flex flex-col text-center w-full mb-[12px]">
      <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-600">Incidentes</h1>
    </div>
    <div id="changes-list" class="w-full mx-auto overflow-auto">
      <div class="overflow-x-auto">
        <table class="table table-xs">
          <thead>
            <tr>
              <th><input type="text" placeholder="Incidente" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Designado por" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Descrição" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Data criado" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Data designado" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Tempo na fila" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Data finalizado" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Finalizado em" class="font-normal text-sm rounded-md w-full border"></th>
              <th><input type="text" placeholder="Status" class="font-normal text-sm rounded-md w-full border"></th>
            </tr>
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
@include('components.time-assigned-script')
@include('layouts.footer')