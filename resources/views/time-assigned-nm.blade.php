@include('layouts.header')
<section class="text-gray-600 body-font pt-[90px]">
    <div class="container mx-auto flex flex-wrap justify-between items-start">
        <!-- Filtro de Datas -->
        <div class="w-1/5 bg-white shadow-md rounded-lg p-5 border">
            <h1 class="text-xl font-semibold mb-4">Filtro de Datas</h1>
            <form method="GET" action="{{ route('time-assigned-nm') }}" class="space-y-4">
                <div>
                    <label for="startDate" class="block text-sm font-medium text-gray-700">Data de Início</label>
                    <input type="date" id="startDate" name="startDate" value="{{ request('startDate') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label for="endDate" class="block text-sm font-medium text-gray-700">Data de Término</label>
                    <input type="date" id="endDate" name="endDate" value="{{ request('endDate') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                        Filtrar
                    </button>
                    <a href="{{ url('/time-assigned-nm') }}"
                       class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg shadow hover:bg-gray-400">
                        Limpar
                    </a>
                </div>
            </form>
        </div>

        <!-- Gráfico -->
        <div
            class="border shadow-[5px_5px_15px_4.5px_rgba(0,0,0,0.1)] container mx-auto flex flex-col px-5 py-2 justify-center items-center rounded-lg text-gray-100 w-2/3"
            data-theme="light">
            <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-700">Desempenho por Analista -
                Multi</h1>
            <canvas id="myChart" class="h-full w-full pt-[24px]"></canvas>
        </div>
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
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Incidente"
                                       class="font-normal text-sm w-full rounded-md pl-2 pr-8 border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Designado por"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Descrição"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Data criado"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Data designado"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Tempo na fila"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Data finalizado"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Finalizado em"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
                        <th>
                            <div class="relative flex items-center border rounded-md">
                                <input type="text" placeholder="Status"
                                       class="font-normal text-sm rounded-md w-full border">
                                <button
                                    class="absolute right-2 bg-transparent p-1 text-gray-500 hover:text-gray-700 sort-btn"
                                    data-column="incidentid" data-order="asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </th>
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
                        <tr class="h-12">
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
                <div id="pagination" class="join mx-auto flex justify-center container mt-10"></div>
            </div>
        </div>
    </div>
</section>
@include('components.pagination')
@include('components.list-tickets')
@include('components.time-assigned-script-nm')
@include('layouts.footer')
