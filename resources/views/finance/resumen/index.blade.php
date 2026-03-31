<x-app-layout>

<div class="p-6 space-y-6 bg-gray-50 min-h-screen">

    {{-- KPI --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl shadow-sm">
            <p class="text-gray-400 text-sm">Ingresos</p>
            <p class="text-2xl font-bold text-green-500">
                ${{ number_format($totales->total_ingresos ?? 0, 2) }}
            </p>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm">
            <p class="text-gray-400 text-sm">Egresos</p>
            <p class="text-2xl font-bold text-red-500">
                ${{ number_format($totales->total_egresos ?? 0, 2) }}
            </p>
        </div>
    </div>

    {{-- GRÁFICAS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- LINEA MODERNA --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-sm text-gray-500 mb-4">Tendencia</h2>
            <div id="chart-line"></div>
        </div>

        {{-- DONUT MODERNO --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-sm text-gray-500 mb-4">Distribución</h2>
            <div id="chart-donut"></div>
        </div>

    </div>
<<div class="p-6">

    <div id="chart-line"></div>
    <div id="chart-donut"></div>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log("JS funcionando");

    const data = @json($chartDiasData ?? [10,20,30]);
    const labels = @json($chartDiasLabels ?? ['A','B','C']);

    const tipos = @json($chartTiposData ?? [30,40,50]);
    const tiposLabels = @json($chartTiposLabels ?? ['A','B','C']);

    // 🔥 TEST CHART
    new ApexCharts(document.querySelector("#chart-line"), {
        chart: { type: 'line', height: 300 },
        series: [{
            name: 'Test',
            data: data.map(Number)
        }],
        xaxis: {
            categories: labels
        }
    }).render();

    // 🔥 DONUT
    new ApexCharts(document.querySelector("#chart-donut"), {
        chart: { type: 'donut', height: 300 },
        series: tipos.map(Number),
        labels: tiposLabels
    }).render();

});
</script>
</x-app-layout>