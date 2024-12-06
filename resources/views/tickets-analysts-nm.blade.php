@include('layouts.header')
<section class="w-full flex items-center justify-center pt-[90px]">
    <div class="container justify-center items-center text-center w-full mb-2">
        <h1 class="sm:text-4xl text-3xl font-bold title-font mb-2 text-gray-600">Tickets Fechados/Cancelados - Monitoramento</h1>
    </div>
</section>

<section class="flex h-full mx-2">
        <section class="w-1/6 mr-2 border-r-2 border-r-yellow-400">
            <div class="container mx-auto flex flex-wrap justify-between items-start">
                <!-- Filtro de Datas -->
                <div class="w-full bg-white shadow-md card p-5 border mr-2">
                    <h1 class="text-xl font-semibold mb-4">Filtro de Datas</h1>
                    <form method="GET" action="{{ route('time-assigned.index') }}" class="space-y-4">
                        <div>
                            <label for="startDate" class="block text-sm font-medium text-gray-700">Data de
                                Início</label>
                            <input type="date" id="startDate" name="startDate" value="{{ request('startDate') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="endDate" class="block text-sm font-medium text-gray-700">Data de Término</label>
                            <input type="date" id="endDate" name="endDate" value="{{ request('endDate') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="flex space-x-2 justify-center">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                                Filtrar
                            </button>
                            <a href="{{ url('/time-assigned') }}"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg shadow hover:bg-gray-400">
                                Limpar
                            </a>
                        </div>
                    </form>
                </div>
        </section>

        <section class="w-5/6">
            <!-- CARDS 2.0 -->
            <section class="flex justify-between">
                <div class="card bg-base-100 w-1/3 shadow-xl border">
                    <div class="card-body text-center">
                        <h2 class="font-bold">Tickets Fechados</h2>
                        <div>
                            <h3 class="font-bold text-xl">
                                {{ round(($chartData['totalFechados'] / $chartData['totalGeral']) * 100, 1) }}%
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 w-1/3 shadow-xl border mx-2">
                    <div class="card-body text-center">
                        <h2 class="font-bold">Tickets Cancelados</h2>
                        <div>
                            <h3 class="font-bold text-xl">
                                {{ round(($chartData['totalCancelados'] / $chartData['totalGeral']) * 100, 1)}}%
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-100 w-1/3 shadow-xl border">
                    <div class="card-body text-center">
                        <h2 class="font-bold">Total Tickets Finalizados (Qtd)</h2>
                        <div>
                            <h3 class="font-bold text-xl">
                                {{$chartData['totalGeral']}}
                            </h3>
                        </div>
                    </div>
                </div>
            </section>

            <!-- GRAPHS 2.0 -->
            <section class="text-center items-center flex justify-between mt-4">
                <div class="card w-1/2 shadow-xl border text-center items-center align-text-middle mr-1">
                    <canvas id="closedTicketsChart" class="p-2"></canvas>
                </div>

                <div class="card w-1/2 shadow-xl border text-center items-center align-text-middle ml-1">
                    <canvas id="canceledTicketsChart" class="p-2"></canvas>
                </div>
            </section>

            <section class="text-center items-center flex justify-between mt-4">
                <div class="card w-1/2 shadow-xl border text-center items-center align-text-middle mr-1">
                    <canvas id="totalTicketsChart" class="p-2"></canvas>
                </div>

                <div class="card w-1/2 shadow-xl border text-center items-center align-text-middle ml-1">
                    <canvas id="canceldAndClosed" class="p-2 h-full"></canvas>
                </div>
            </section>
        </section>
    </section>
@include('components.tickets-analysts-script-nm')
@include('layouts.footer')