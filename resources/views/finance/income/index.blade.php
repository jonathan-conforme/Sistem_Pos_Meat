        {{-- 1. Definimos el mapeo de nombres y colores al inicio --}}
        @php
            $totalGeneral = collect($movimientos)->flatten()->sum('monto');
            
            $metodos = [
                'cash'     => ['label' => 'Efectivo', 'color' => 'bg-green-100 text-green-700 border-green-200'],
                'transfer' => ['label' => 'Transferencia', 'color' => 'bg-blue-100 text-blue-700 border-blue-200'],
                'card'     => ['label' => 'Tarjeta', 'color' => 'bg-purple-100 text-purple-700 border-purple-200'],
            ];
        @endphp

        <x-app-layout>
            <div class="max-w-5xl mx-auto space-y-8 pb-10">

                {{-- Encabezado Principal --}}
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">📈 Ingresos</h1>
                        <p class="text-sm text-gray-500">Control y registro de entradas de dinero</p>
                    </div>
                </div>

                {{-- Grid de Total y Filtros (Alineación corregida) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Card Total --}}
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-center">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total ingresos</p>
                        <p class="text-3xl font-black text-green-600">
                            <span class="text-xl">$</span>{{ number_format($totalGeneral, 2) }}
                        </p>
                    </div>

                    {{-- Card Filtros --}}
                    <div class="md:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <form method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                            <div class="flex-1 w-full">
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Desde</label>
                                <input type="date" name="from" value="#" class="bg-gray-50 border-gray-200 rounded-xl px-3 py-2.5 w-full focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>

                            <div class="flex-1 w-full">
                                <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Hasta</label>
                                <input type="date" name="to" value="#" class="bg-gray-50 border-gray-200 rounded-xl px-3 py-2.5 w-full focus:ring-blue-500 focus:border-blue-500 transition-all">
                            </div>

                            <div class="flex gap-2 w-full md:w-auto">
                                <button type="submit" class="flex-1 md:flex-none bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-2.5 rounded-xl transition-all shadow-md active:scale-95">
                                    Filtrar
                                </button>
                                <a href="{{ route('admin.income.index') }}" class="flex-1 md:flex-none bg-gray-100 hover:bg-gray-200 px-6 py-2.5 rounded-xl text-gray-600 font-semibold text-center transition-all">
                                    Limpiar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Sección Historial --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="bg-white p-2 rounded-lg shadow-sm border border-gray-100"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        </span> 
                        Historial de Cierres
                    </h2>

                    <div class="relative border-l-2 border-gray-200 ml-6 mt-8 space-y-12">
                        @forelse($movimientos as $fecha => $items)
                            @php
                                $fechaCarbon = \Carbon\Carbon::parse($fecha);
                                $titulo = $fechaCarbon->isToday() ? 'Hoy' : ($fechaCarbon->isYesterday() ? 'Ayer' : $fechaCarbon->translatedFormat('l d F Y'));
                                $totalDia = $items->sum('monto');
                            @endphp

                            <div class="relative">
                                {{-- Header del Día --}}
                                <div class="flex justify-between items-center mb-6 -ml-6">
                                    <h3 class="bg-gray-800 text-white px-4 py-1.5 rounded-full text-sm font-bold capitalize shadow-sm">
                                        {{ $titulo }}
                                    </h3>
                                    <span class="text-sm font-bold text-green-700 bg-green-100 px-4 py-1.5 rounded-full border border-green-200">
                                        Total día: ${{ number_format($totalDia, 2) }}
                                    </span>
                                </div>

                                @foreach($items as $mov)
                                    <div class="mb-8 ml-6 relative group">
                                        {{-- Punto en la línea de tiempo --}}
                                        <span class="absolute -left-[35px] top-6 w-5 h-5 rounded-full border-4 border-white bg-green-500 shadow-sm group-hover:scale-125 transition-transform"></span>

                                        {{-- Tarjeta de Movimiento --}}
                                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                                            <div class="flex justify-between items-start mb-3">
                                                <div>
                                                    <p class="text-xs font-medium text-gray-400 uppercase tracking-tighter">{{ $mov->created_at->diffForHumans() }}</p>
                                                    <h4 class="text-base font-bold text-gray-800 capitalize mt-1">{{ $mov->cuenta->nombre }}</h4>
                                                </div>
                                                <div class="text-right">
                                                    <span class="text-xl font-black text-green-600">+${{ number_format($mov->monto, 2) }}</span>
                                                </div>
                                            </div>

                                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 border-t border-gray-50 pt-3">
                                                <div class="flex items-center gap-1">
                                                    <span class="text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
        </svg>

        </span>
                                                    {{ $mov->updated_at->format('H:i') }}
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <span class="text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
        </span>
                                                    {{ $mov->descripcion ?? 'Venta sin descripción' }}
                                                </div>
                                                
                                                {{-- Badge de Método Dinámico --}}
                                                <div class="ml-auto">
                                                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase border {{ $metodos[$mov->metodo_pago]['color'] ?? 'bg-gray-100 text-gray-600' }}">
                                                        {{ $metodos[$mov->metodo_pago]['label'] ?? 'Otro' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @empty
                            <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200 ml-4">
                                <div class="text-5xl mb-4">empty</div>
                                <p class="text-gray-500 font-medium">No hay registros de ingresos para mostrar.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </x-app-layout>