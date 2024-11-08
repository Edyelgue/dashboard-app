@include('layouts.header')
<main class="mx-2">
    <div class="w-full flex-col pt-[90px]">
        <h1 class="sm:text-4xl text-3xl title-font font-bold rounded-box grid h-20 place-items-center text-gray-900" data-theme="light">Tickets Fechados/Cancelados - N1</h1>
    </div>

    <!-- CARDS -->
    <section class="text-gray-900 body-font w-full mb-1">
        <div class="flex mt-1">
            <div class="w-1/3 border rounded-lg">
                <div class="rounded-lg" data-theme="light">
                    <div class="w-full h-10 inline-flex items-center justify-center rounded text-indigo-500 mb-4">
                        <h2 class="text-lg text-gray-900 title-font font-bold">Tickets Fechados</h2>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl text-gray-900 font-medium title-font mb-2">
                            {{ round(($chartData['totalFechados'] / $chartData['totalGeral']) * 100, 1) }}%
                        </h3>
                    </div>
                    <div class="text-center p-2">
                        <h4 class="text-sm text-gray-900 font-medium title-font">
                            {{$chartData['totalFechados']}}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="w-1/3 mx-1 border rounded-lg">
                <div class="rounded-lg" data-theme="light">
                    <div class="w-full h-10 inline-flex items-center justify-center rounded text-indigo-500 mb-4">
                        <h2 class="text-lg text-gray-900 title-font font-bold">Tickets Cancelados</h2>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl text-gray-900 font-medium title-font mb-2">
                            {{ round(($chartData['totalCancelados'] / $chartData['totalGeral']) * 100, 1)}}%
                        </h3>
                    </div>
                    <div class="text-center p-2">
                        <h4 class="text-sm text-gray-900 font-medium title-font">
                            {{$chartData['totalCancelados']}}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="w-1/3 border rounded-lg">
                <div class="rounded-lg" data-theme="light">
                    <div class="w-full h-10 inline-flex items-center justify-center rounded text-indigo-500 mb-4">
                        <h2 class="text-lg text-gray-900 title-font font-bold">Total</h2>
                    </div>
                    <div class="text-center">
                        <h3 class="text-xl text-gray-900 font-medium title-font mb-2">
                            {{$chartData['totalGeral']}}
                        </h3>
                    </div>
                    <div class="text-center p-2">
                        <h4 class="text-sm text-gray-900 font-medium title-font">&nbsp;</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GRAPHS -->
    <section class="lg:flex mt-0 w-3/3">
        <div class="lg:w-1/3 w-3/3 flex h-full lg:my-0 mb-1 rounded-lg border shadow-[5px_5px_15px_4.5px_rgba(0,0,0,0.1)]" data-theme="light">
            <canvas id="closedTicketsChart" class="p-2"></canvas>
        </div>

        <div class="lg:w-1/3 w-3/3 flex h-full md:my-0 rounded-lg lg:mx-1 border shadow-[5px_5px_15px_4.5px_rgba(0,0,0,0.1)]" data-theme="light">
            <canvas id="canceledTicketsChart" class="p-2"></canvas>
        </div>

        <div class="lg:w-1/3 w-3/3 flex h-full my-1 lg:my-0 rounded-lg border shadow-[5px_5px_15px_4.5px_rgba(0,0,0,0.1)]" data-theme="light">
            <canvas id="totalTicketsChart" class="p-2"></canvas>
        </div>
    </section>

    <!-- GRAPH UNIQUE -->
    <section class="lg:container">
        <div class="rounded-lg my-1 lg:h-96 lg:w-1/2 flex border shadow-[5px_5px_15px_4.5px_rgba(0,0,0,0.1)]" data-theme="light">
            <canvas id="canceldAndClosed" class="p-2 h-full"></canvas>
        </div>
    </section>
</main>
@include('components.tickets-analysts-script')
@include('layouts.footer')