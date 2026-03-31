@php
    $totalGeneral = collect($movimientos)->flatten()->sum('monto');
    
    // He añadido los iconos SVG dentro de la configuración de métodos
    $metodos = [
        'cash'     => [
            'label' => 'Efectivo', 
            'color' => 'bg-green-100 text-green-700 border-green-200',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M1 4.25a.75.75 0 01.75-.75h16.5a.75.75 0 01.75.75v11.5a.75.75 0 01-.75.75H1.75a.75.75 0 01-.75-.75V4.25zM3.25 5v9.5h13.5V5H3.25z" clip-rule="evenodd" /><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /></svg>'
        ],
        'transfer' => [
            'label' => 'Transferencia', 
            'color' => 'bg-blue-100 text-blue-700 border-blue-200',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M17.03 5.72a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H2.75a.75.75 0 010-1.5h11.94l-1.72-1.72a.75.75 0 111.06-1.06l3 3zM2.97 14.28a.75.75 0 010-1.06l3-3a.75.75 0 111.06 1.06l-1.72 1.72h11.94a.75.75 0 010 1.5H5.31l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3z" clip-rule="evenodd" /></svg>'
        ],
        'card'     => [
            'label' => 'Tarjeta', 
            'color' => 'bg-purple-100 text-purple-700 border-purple-200',
            'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5"><path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 001 5.5V6h18v-.5A1.5 1.5 0 0017.5 4h-15zM19 8.5H1v6A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-6zM3 13.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm4.75-.75a.75.75 0 000 1.5h3.5a.75.75 0 000-1.5h-3.5z" clip-rule="evenodd" /></svg>'
        ],
    ];
@endphp

<x-app-layout>
    {{-- Envolvemos todo en Alpine agregando x-data="{ modalOpen: false }" --}}
    <div x-data="{ modalOpen: false }" class="space-y-6">
        
        {{-- Tarjeta de Total y Filtros --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    
                    {{-- Total de Ingresos --}}
                    <div class="w-full lg:w-auto">
                        <p class="text-sm text-gray-500 mb-1">Total Ingresos Filtrados</p>
                        <p class="text-3xl font-bold text-gray-900">
                            ${{ number_format($totalGeneral, 2) }}
                        </p>
                    </div>

                    {{-- Formulario de Filtros Mejorado para Móvil --}}
                    <form method="GET" class="w-full lg:w-auto flex flex-col sm:flex-row flex-wrap gap-4 items-end">
                        <div class="w-full sm:w-auto flex-1">
                            <label for="from" class="block text-sm font-medium text-gray-700">Desde</label>
                            <input type="date" name="from" id="from" value="{{ request('from') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="w-full sm:w-auto flex-1">
                            <label for="to" class="block text-sm font-medium text-gray-700">Hasta</label>
                            <input type="date" name="to" id="to" value="{{ request('to') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="w-full sm:w-auto flex gap-2 pt-2 sm:pt-0">
                            <button type="submit" class="w-full sm:w-auto flex-1 justify-center inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition">
                                Filtrar
                            </button>
                            <a href="{{ route('admin.income.index') }}" class="w-full sm:w-auto flex-1 justify-center inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition">
                                Limpiar
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- Tarjeta de Lista de Ingresos --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Ingresos') }}
                    </h2>
                    {{-- Botón corregido usando Alpine.js --}}
                    <button @click="modalOpen = true" 
                            class="w-full sm:w-auto justify-center inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        + Nuevo Ingreso
                    </button>
                </div>
            </div>

            {{-- Sección Historial --}}
            <div class="p-6">
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 flex items-center gap-2 mb-6">
                    <span class="bg-white p-2 rounded-lg shadow-sm border border-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-700">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span> 
                    Historial de Movimientos
                </h2>

                <div class="space-y-6">
                    @forelse($movimientos as $fecha => $items)
                        @php
                            $fechaCarbon = \Carbon\Carbon::parse($fecha);
                            $titulo = $fechaCarbon->isToday() ? 'Hoy' : ($fechaCarbon->isYesterday() ? 'Ayer' : $fechaCarbon->translatedFormat('l, d \d\e F'));
                            $totalDia = $items->sum('monto');
                        @endphp

                        <div class="relative">
                            {{-- Cabecera del Día tipo App de Banco (Sticky) --}}
                            <div class="sticky top-0 bg-gray-50 bg-opacity-95 backdrop-blur-sm py-2 px-1 flex justify-between items-center z-10 border-b border-gray-200 mb-2">
                                <span class="text-sm font-bold text-gray-600 capitalize">
                                    {{ $titulo }}
                                </span>
                                <span class="text-xs font-semibold text-gray-500 bg-white px-3 py-1 rounded-full border border-gray-100 shadow-sm">
                                    +${{ number_format($totalDia, 2) }}
                                </span>
                            </div>

                            {{-- Contenedor de transacciones del día --}}
                            <div class="bg-white shadow-sm rounded-2xl divide-y divide-gray-100 overflow-hidden border border-gray-100">
                                @foreach($items as $mov)
                                    @php 
                                        $infoMetodo = $metodos[$mov->metodo_pago] ?? [
                                            'label' => 'Otro', 
                                            'color' => 'bg-gray-100 text-gray-600 border-gray-200',
                                            'icon' => ''
                                        ]; 
                                    @endphp
                                    <div class="p-4 hover:bg-gray-50 transition-colors flex items-center justify-between gap-4">
                                        
                                        {{-- Izquierda: Icono y Detalles --}}
                                        <div class="flex items-center gap-3 flex-1 min-w-0">
                                            
                                            {{-- Círculo con Icono según el método --}}
                                            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center border {{ $infoMetodo['color'] }}">
                                                {!! $infoMetodo['icon'] !!}
                                            </div>

                                            {{-- Textos Principales --}}
                                            <div class="truncate">
                                                <p class="text-sm font-semibold text-gray-900 truncate">
                                                    {{ optional($mov->cuenta)->nombre ?? 'Cuenta no encontrada' }}
                                                </p>
                                                <div class="flex items-center gap-2 mt-0.5 text-xs text-gray-500">
                                                    <span>{{ $mov->created_at->format('H:i') }}</span>
                                                    <span>•</span>
                                                    <span class="truncate">{{ $mov->descripcion ?? 'Ingreso sin descripción' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Derecha: Monto (En verde y grande estilo Ingreso) --}}
                                        <div class="text-right flex-shrink-0">
                                            <span class="text-base md:text-lg font-bold text-green-600">
                                                +${{ number_format($mov->monto, 2) }}
                                            </span>
                                            <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mt-0.5">
                                                {{ $infoMetodo['label'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                            <div class="text-5xl mb-3">💰</div>
                            <p class="text-gray-500 font-medium">No hay registros de ingresos para mostrar.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- MODAL PARA NUEVO INGRESO --}}
            <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    
                    {{-- Fondo oscuro --}}
                    <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" @click="modalOpen = false"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    {{-- Contenido del Modal --}}
                    <div x-show="modalOpen" 
                         x-transition:enter="ease-out duration-300" 
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave="ease-in duration-200" 
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 w-full">
                        
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Registrar Nuevo Ingreso / Abono</h3>
                            <button @click="modalOpen = false" class="text-gray-400 hover:text-gray-500">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        {{-- Formulario --}}
                        <form action="{{ route('admin.income.store') }}" method="POST">
                            @csrf
                            
                            <div class="space-y-4 text-left">
                                {{-- Seleccionar Cuenta --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Cuenta de Destino</label>
                                    <select name="cuenta_id" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm md:text-base">
                                        <option value="" disabled selected>Seleccione donde entrará el dinero</option>
                                        @foreach($cuentas as $cuenta)
                                            <option value="{{ $cuenta->id }}">{{ $cuenta->nombre }} (Actual: ${{ number_format($cuenta->saldo_actual, 2) }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Monto --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Monto ($)</label>
                                    <input type="number" step="0.01" min="0.01" name="monto" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm md:text-base" placeholder="0.00">
                                </div>

                                {{-- Método de Pago --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Método de Ingreso</label>
                                    <select name="metodo_pago" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm md:text-base">
                                        <option value="cash">Efectivo</option>
                                        <option value="transfer">Transferencia</option>
                                        <option value="card">Tarjeta</option>
                                    </select>
                                </div>

                                {{-- Descripción --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Motivo / Descripción</label>
                                    <input type="text" name="descripcion" required class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm md:text-base" placeholder="Ej. Devolución de préstamo, Aporte inicial...">
                                </div>
                            </div>

                            <div class="mt-6 flex flex-col-reverse sm:flex-row justify-end gap-3">
                                <button type="button" @click="modalOpen = false" class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 text-center">
                                    Cancelar
                                </button>
                                <button type="submit" class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-xl hover:bg-green-700 shadow-sm text-center">
                                    Guardar Ingreso
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-toast/>
</x-app-layout>