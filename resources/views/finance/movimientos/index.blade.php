<x-app-layout>


    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">

            {{-- CHIPS RÁPIDOS --}}
            <div class="flex flex-wrap gap-2">
                <a href="?range=hoy"
                    class="px-4 py-1.5 rounded-full text-sm bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    Hoy
                </a>

                <a href="?range=semana"
                    class="px-4 py-1.5 rounded-full text-sm bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-700 transition">
                    Esta semana
                </a>

                <a href="?tipo=ingreso"
                    class="px-4 py-1.5 rounded-full text-sm bg-green-100 text-green-700 hover:bg-green-200 transition">
                    Ingresos
                </a>

                <a href="?tipo=egreso"
                    class="px-4 py-1.5 rounded-full text-sm bg-red-100 text-red-700 hover:bg-red-200 transition">
                    Egresos
                </a>
            </div>

            {{-- FORMULARIO --}}
            <form method="GET"
                class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">

                {{-- DESDE --}}
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Desde</label>
                    <input type="date"
                        name="from"
                        value="{{ request('from') }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-full px-4 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">
                </div>

                {{-- HASTA --}}
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Hasta</label>
                    <input type="date"
                        name="to"
                        value="{{ request('to') }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-full px-4 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">
                </div>

                {{-- TIPO --}}
                <div>
                    <label class="block text-xs text-gray-400 mb-1">Tipo</label>
                    <select name="tipo"
                        class="w-full bg-gray-50 border border-gray-200 rounded-full px-4 py-2 text-sm
                           focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition">
                        <option value="">Todos</option>
                        <option value="ingreso" @selected(request('tipo')=='ingreso' )>Ingreso</option>
                        <option value="egreso" @selected(request('tipo')=='egreso' )>Egreso</option>
                        <option value="transferencia" @selected(request('tipo')=='transferencia' )>Transferencia</option>
                    </select>
                </div>

                {{-- FILTRAR --}}
                <div>
                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
                       rounded-full px-4 py-2 transition">
                        🔍 Filtrar
                    </button>
                </div>

                {{-- LIMPIAR --}}
                <div>
                    <a href="{{ route('admin.movimientos.index') }}"
                        class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-700
                      rounded-full px-4 py-2 text-sm transition">
                        Limpiar
                    </a>
                </div>

            </form>

            {{-- FILTROS ACTIVOS --}}
           @if(request()->anyFilled(['from','to','tipo','range']))
<div class="text-xs text-gray-400">
    Filtros activos:
    @if(request('range')) <span class="font-medium">{{ request('range') }}</span> · @endif
    @if(request('from')) Desde {{ request('from') }} · @endif
    @if(request('to')) Hasta {{ request('to') }} · @endif
    @if(request('tipo')) Tipo: {{ request('tipo') }} @endif
</div>
@endif


        </div>
<br>
        {{-- TITULO --}}    
        <h1 class="text-2xl font-bold mb-6">🕒 Historial de Movimientos</h1>
        <div class="relative border-l border-gray-200 ml-6 mt-8">


          @forelse($movimientos as $fecha => $items)

    @php
        $fechaCarbon = \Carbon\Carbon::parse($fecha);

        if ($fechaCarbon->isToday()) {
            $titulo = 'Hoy ' . $fechaCarbon->translatedFormat('d F Y');
        } elseif ($fechaCarbon->isYesterday()) {
            $titulo = 'Ayer ' . $fechaCarbon->translatedFormat('d F Y');
        } else {
            $titulo = $fechaCarbon->translatedFormat('l d F Y');
        }
    @endphp

    {{-- TÍTULO DEL DÍA --}}
    <h2 class="text-lg font-bold mt-8 mb-4 capitalize">
        {{ $titulo }}
    </h2>

    @foreach($items as $mov)
        <div class="mb-6 ml-6 relative">

            <span class="absolute -left-[11px] top-4 w-4 h-4 rounded-full ring-4 ring-white
                {{ $mov->tipo === 'ingreso' ? 'bg-green-500' : ($mov->tipo === 'egreso' ? 'bg-red-500' : 'bg-blue-500') }}">
            </span>

            <div class="bg-white rounded-xl shadow p-5">

                <div class="flex justify-between items-center mb-1">
                    <div class="text-xs text-gray-400">
    {{ $mov->created_at->diffForHumans() }}
</div>

                    <span class="font-bold
                        {{ $mov->tipo === 'egreso' ? 'text-red-600' : 'text-green-600' }}">
                        {{ $mov->tipo === 'egreso' ? '-' : '+' }}
                        ${{ number_format($mov->monto, 2) }}
                    </span>
                </div>

                <div class="text-sm font-semibold capitalize">
                    {{ $mov->tipo }} · {{ $mov->cuenta->nombre }} 
                </div>

                <div class="text-sm text-gray-600">
                   {{ $mov->created_at->format('d/m/Y') }} {{ $mov->descripcion }} {{ $mov->created_at->format('H:i') }}
                </div>

                <div class="text-xs text-gray-400 mt-1">
                    Método: {{ $mov->metodo_pago ?? '—' }}
                    
                </div>

            </div>
        </div>
    @endforeach

@empty
    <p class="text-center text-gray-500 mt-10">
        No hay movimientos registrados
    </p>
@endforelse


        </div>
    </div>

</x-app-layout>