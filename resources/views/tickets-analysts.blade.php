@include('layouts.header')
<section class="w-screen pt-36 flex flex-row justify-center items-center">
    <section class="text-gray-600 mr-16">
        <div class="container flex flex-col items-center mb-2 border rounded">
            <div class="w-full border-b py-1">
                <h1 class="text-center">Tickets Fechados</h1>
            </div>

            <div class="w-full">
                <h1 class="text-center text-3xl font-medium pt-2 pb-3">
                    {{ round(($chartData['totalFechados'] / $chartData['totalGeral']) * 100, 1) }}%
                </h1>
            </div>

            <div class="w-full border-t py-1">
                <h1 class="text-center text-xs font-normal">{{$chartData['totalFechados']}}</h1>
            </div>
        </div>

        <div class="container mx-auto flex flex-col">
            <canvas id="closedTicketsChart" width="440" height="410"></canvas>
        </div>
    </section>

    <section class="text-gray-600">
        <div class="container flex flex-col items-center mb-2 border rounded">
            <div class="w-full border-b py-1">
                <h1 class="text-center">Tickets Cancelados</h1>
            </div>

            <div class="w-full">
                <h1 class="text-center text-3xl font-medium pt-2 pb-3">
                    {{ round(($chartData['totalCancelados'] / $chartData['totalGeral']) * 100, 1)}}%
                </h1>
            </div>

            <div class="w-full border-t py-1">
                <h1 class="text-center text-xs font-normal">{{$chartData['totalCancelados']}}</h1>
            </div>
        </div>

        <div class="container mx-auto flex flex-col">
            <canvas id="canceledTicketsChart" width="440" height="410"></canvas>
        </div>
    </section>

    <section class="text-gray-600 ml-16">
        <div class="container flex flex-col items-center mb-8 border rounded">
            <div class="w-full border-b py-1">
                <h1 class="text-center">Total</h1>
            </div>

            <div class="w-full">
                <h1 class="text-center text-3xl font-medium pt-2 pb-3">{{$chartData['totalGeral']}}</h1>
            </div>
        </div>

        <div class="container mx-auto flex flex-col">
            <canvas id="totalTicketsChart" width="440" height="410"></canvas>
        </div>
    </section>
</section>

<section class="w-screen pt-16 flex flex-row justify-center items-center mb-36">
    <section class="text-gray-600">
        <div class="container mx-auto flex flex-col">
            <canvas id="canceldAndClosed" width="1200" height="760"></canvas>
        </div>
    </section>
</section>

@include('components.tickets-analysts-script')
@include('layouts.footer')