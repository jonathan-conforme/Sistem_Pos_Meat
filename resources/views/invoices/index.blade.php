<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Facturas de Ventas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Filtros -->
                    <!-- En la sección de filtros, agrega: -->



                    <div class="mb-6 flex flex-col sm:flex-row gap-4">
                        <input type="text" id="searchInput" placeholder="Buscar por número de venta o cliente..."
                            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                        <select id="statusFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Todos los estados</option>
                            <option value="completed">Completadas</option>
                            <option value="pending">Pendientes</option>
                            <option value="cancelled">Canceladas</option>
                        </select>
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