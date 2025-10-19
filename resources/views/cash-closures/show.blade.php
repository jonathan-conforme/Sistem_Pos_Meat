

<div class="p-4 bg-white rounded-lg shadow space-y-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        Cierre de Caja - {{ $cashClosure->closure_date->format('d/m/Y') }}
    </h1>

    {{-- Estado del cierre --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <p class="text-gray-700">Usuario:
                <span class="font-semibold">{{ $cashClosure->user->name ?? 'Desconocido' }}</span>
            </p>
            <p class="text-gray-700">Hora:
                <span class="font-semibold">{{ $cashClosure->created_at->format('H:i:s') }}</span>
            </p>
        </div>
        <div>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                    @if($cashClosure->status === 'verified') bg-green-100 text-green-700
                    @elseif($cashClosure->status === 'completed') bg-blue-100 text-blue-700
                    @else bg-yellow-100 text-yellow-700 @endif">
                {{ ucfirst($cashClosure->status) }}
            </span>
        </div>
    </div>

    {{-- Calcular totales dinámicos desde las ventas --}}
    @php
    $totals = [
    'cash' => $sales->where('payment_type', 'cash')->sum('total'),
    'card' => $sales->where('payment_type', 'card')->sum('total'),
    'transfer' => $sales->where('payment_type', 'transfer')->sum('total'),
    'credit' => $sales->where('payment_type', 'credit')->sum('total'),
    'total' => $sales->sum('total'),
    ];
    @endphp

    {{-- Resumen de ventas por tipo de pago --}}
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Resumen de Ventas</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-3 bg-green-50 border border-green-200 rounded-lg text-center">
                <p class="text-sm text-green-700">Efectivo</p>
                <p class="text-xl font-bold text-green-800">${{ number_format($totals['cash'], 2) }}</p>
                <p class="text-xs text-green-600 mt-1">💵 En caja</p>
            </div>
            <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg text-center">
                <p class="text-sm text-blue-700">Tarjeta</p>
                <p class="text-xl font-bold text-blue-800">${{ number_format($totals['card'], 2) }}</p>
                <p class="text-xs text-blue-600 mt-1">💳 En banco</p>
            </div>
            <div class="p-3 bg-purple-50 border border-purple-200 rounded-lg text-center">
                <p class="text-sm text-purple-700">Transferencia</p>
                <p class="text-xl font-bold text-purple-800">${{ number_format($totals['transfer'], 2) }}</p>
                <p class="text-xs text-purple-600 mt-1">🏦 En banco</p>
            </div>
            <div class="p-3 bg-orange-50 border border-orange-200 rounded-lg text-center">
                <p class="text-sm text-orange-700">Crédito</p>
                <p class="text-xl font-bold text-orange-800">${{ number_format($totals['credit'], 2) }}</p>
                <p class="text-xs text-orange-600 mt-1">📅 Por cobrar</p>
            </div>
        </div>

        <div class="mt-4 p-3 bg-white border border-gray-200 rounded-lg">
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-700">Total General de Ventas:</span>
                <span class="text-xl font-bold text-blue-700">${{ number_format($totals['total'], 2) }}</span>
            </div>
            <div class="text-sm text-gray-600 mt-1">{{ $sales->count() }} ventas registradas</div>
        </div>
    </div>

    {{-- Detalles del control de efectivo --}}
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
        <h2 class="text-lg font-semibold text-green-800 mb-3">💰 Control de Efectivo</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Columna izquierda - Cálculos --}}
            <div>
                <h3 class="font-semibold text-green-700 mb-2">Cálculos del Cierre</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Efectivo Inicial:</span>
                        <span class="font-semibold">${{ number_format($cashClosure->initial_cash, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">+ Ventas en Efectivo:</span>
                        <span class="font-semibold">${{ number_format($totals['cash'], 2) }}</span>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <span class="text-green-700 font-semibold">= Efectivo Esperado:</span>
                        <span class="text-green-700 font-semibold">${{ number_format($cashClosure->expected_cash, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Columna derecha - Resultados --}}
            <div>
                <h3 class="font-semibold text-green-700 mb-2">Resultados Reales</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Efectivo Físico Contado:</span>
                        <span class="font-semibold">${{ number_format($cashClosure->physical_cash, 2) }}</span>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <span class="font-semibold {{ $cashClosure->difference == 0 ? 'text-green-600' : ($cashClosure->difference > 0 ? 'text-blue-600' : 'text-red-600') }}">
                            Diferencia:
                        </span>
                        <span class="font-semibold {{ $cashClosure->difference == 0 ? 'text-green-600' : ($cashClosure->difference > 0 ? 'text-blue-600' : 'text-red-600') }}">
                            ${{ number_format($cashClosure->difference, 2) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Estado de la diferencia --}}
        <div class="mt-4 p-3 rounded-lg text-center
                @if($cashClosure->difference == 0) bg-green-100 text-green-700 border border-green-200
                @elseif($cashClosure->difference > 0) bg-blue-100 text-blue-700 border border-blue-200
                @else bg-red-100 text-red-700 border border-red-200 @endif">
            @if($cashClosure->difference == 0)
            <span class="font-semibold">✅ CAJA BALANCEADA</span> - El efectivo coincide exactamente
            @elseif($cashClosure->difference > 0)
            <span class="font-semibold">📈 SOBRANTE</span> - Hay ${{ number_format($cashClosure->difference, 2) }} extra en caja
            @else
            <span class="font-semibold">📉 FALTANTE</span> - Faltan ${{ number_format(abs($cashClosure->difference), 2) }} en caja
            @endif
        </div>
    </div>

    {{-- Observaciones --}}
    @if($cashClosure->observations)
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Observaciones</h2>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <p class="text-gray-700">{{ $cashClosure->observations }}</p>
        </div>
    </div>
    @endif

    {{-- Listado de ventas del usuario --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-3">Detalle de Ventas ({{ $sales->count() }})</h2>

        @if($sales->isEmpty())
        <div class="text-center py-8 text-gray-500">
            No hay ventas registradas para este cierre.
        </div>
        @else
        <div class="space-y-3">
            @foreach($sales as $sale)
            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <span class="font-semibold text-gray-800">Venta #{{ $sale->sale_number }}</span>
                        <span class="ml-2 px-2 py-1 text-xs rounded-full 
                                        @if($sale->payment_type === 'cash') bg-green-100 text-green-700
                                        @elseif($sale->payment_type === 'card') bg-blue-100 text-blue-700
                                        @elseif($sale->payment_type === 'transfer') bg-purple-100 text-purple-700
                                        @else bg-orange-100 text-orange-700 @endif">
                            {{ ucfirst($sale->payment_type) }}
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-lg font-bold text-gray-900">${{ number_format($sale->total, 2) }}</span>
                        <p class="text-xs text-gray-500">{{ $sale->created_at->format('H:i') }}</p>
                    </div>
                </div>

                @if($sale->items->isNotEmpty())
                <div class="mt-2">
                    <table class="min-w-full text-sm border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-2 py-1 text-left">Producto</th>
                                <th class="border px-2 py-1 text-center">Cant</th>
                                <th class="border px-2 py-1 text-right">P.Unit</th>
                                <th class="border px-2 py-1 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale->items as $item)
                            <tr>
                                <td class="border px-2 py-1">{{ $item->product->name ?? 'Desconocido' }}</td>
                                <td class="border px-2 py-1 text-center">{{ $item->quantity }}</td>
                                <td class="border px-2 py-1 text-right">${{ number_format($item->price_per_unit, 2) }}</td>
                                <td class="border px-2 py-1 text-right">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Botones de acción --}}
    <div class="flex justify-end space-x-3 pt-4 border-t">
        <a href="{{ route('dashboard') }}"
            class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium">
            ← Volver al Dashboard
        </a>
        <a href="{{ route('cash-closures.index') }}"
            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium">
            📋 Ver todos los cierres
        </a>
    </div>
</div>