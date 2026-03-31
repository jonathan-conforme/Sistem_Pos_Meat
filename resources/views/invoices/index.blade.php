<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Facturas de Ventas') }}
        </h2>
    </x-slot>

    <div class="justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Facturas de Ventas</h1>
        <p class="text-gray-600">Facturas generadas por ventas realizadas</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        {{-- Tarjeta de total de facturas pendientes --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex items-center col-span-1 md:col-span-1">
            <div class="p-3 bg-green-100 rounded-lg flex-shrink-0"> <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total de facturas Registradas</p>
                <p id="total-categories" class="text-2xl font-bold text-gray-900">{{ $totalSales }}</p>
            </div>
        </div>

        {{-- Buscador --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 col-span-1 md:col-span-3">
            <form method="GET" action="{{ route('invoices.index') }}">
                <div class="flex flex-col md:flex-row md:items-center md:gap-4">
                    <div class="flex-1">

                        <input type="text" id="searchInput" placeholder="Buscar por número de venta o cliente..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mt-4 md:mt-0 flex gap-2">
                        <select id="statusFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Todos los estados</option>
                            <option value="completed">Completadas</option>
                            <option value="pending">Pendientes</option>
                            <option value="cancelled">Canceladas</option>
                        </select>

                        <button type="button" onclick="window.location='{{ route('credit.index') }}'"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition-all">
                            <i class="fas fa-eraser"></i> Limpiar
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
  


    <!-- Tabla de facturas -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-3">N° Factura</th>
                    <th class="px-4 py-3">Cliente</th>
                    <th class="px-4 py-3">Fecha</th>
                    <th class="px-4 py-3 text-right">Total</th>
                    <th class="px-4 py-3">Estado</th>
                    <th class="px-4 py-3">Método Pago</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-sm">
                        {{ $sale->sale_number }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $sale->customer->name ?? 'Consumidor Final' }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $sale->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-4 py-3 text-right font-semibold">
                        ${{ number_format($sale->subtotal, 2) }}
                    </td>
                    <td class="px-4 py-3">
                        @if($sale->status === 'completed')
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">
                            Completada
                        </span>
                        @elseif($sale->status === 'pending')
                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">
                            Pendiente
                        </span>
                        @else
                        <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">
                            Cancelada
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if($sale->payment_type === 'cash')
                        <span class="flex items-center gap-1">
                            <i class="fas fa-money-bill-wave text-green-600"></i>
                            Efectivo
                        </span>
                        @elseif($sale->payment_type === 'credit')
                        <span class="flex items-center gap-1">
                            <i class="fas fa-credit-card text-yellow-600"></i>
                            Crédito
                        </span>
                        @elseif($sale->payment_type === 'transfer')
                        <span class="flex items-center gap-1">
                            <i class="fas fa-exchange-alt text-blue-600"></i>
                            Transferencia
                        </span>
                        @else
                        <span class="flex items-center gap-1">
                            <i class="fas fa-credit-card text-purple-600"></i>
                            Tarjeta
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('invoices.show', $sale->id) }}"
                                class="text-blue-600 hover:text-blue-800"
                                title="Ver factura">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('pdf.ticket', $sale->id) }}"
                                target="_blank"
                                class="text-green-600 hover:text-green-800"
                                title="Imprimir">
                                <i class="fas fa-print"></i>
                            </a>
                            <a href="{{ route('invoices.pdf', $sale->id) }}"
                                class="text-red-600 hover:text-red-800"
                                title="Descargar PDF">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                            @php
                            $phone = $sale->customer->phone;
                            // Quitar cualquier espacio o signo
                            $phone = preg_replace('/\D/', '', $phone);

                            // Agregar prefijo internacional si no existe
                            if (substr($phone, 0, 3) !== '593') {
                            $phone = '593' . ltrim($phone, '0');
                            }
                            @endphp

                            <a href="https://wa.me/{{ $phone }}?text={{ urlencode('Hola ' . $sale->customer->name . ', aquí tu factura: ' . route('pdf.ticket', $sale->id)) }}"
                                target="_blank"
                                class="text-green-500 hover:text-green-700">
                                <i class="fab fa-whatsapp"></i>
                            </a>



                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-6">
        {{ $sales->links() }}
    </div>

    </div>
    </div>
    </div>
    </div>

    <script>
        // Filtros simples con JavaScript
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchValue = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchValue) ? '' : 'none';
            });
        });

        document.getElementById('statusFilter').addEventListener('change', function(e) {
            const statusValue = e.target.value;
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                if (!statusValue) {
                    row.style.display = '';
                    return;
                }

                const statusCell = row.querySelector('td:nth-child(5)');
                const statusText = statusCell.textContent.toLowerCase();
                row.style.display = statusText.includes(statusValue) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>