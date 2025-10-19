<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Factura ') }}{{ $sales->sale_number }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    
                    <!-- Encabezado de factura -->
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            @if($empresa)
                            <h1 class="text-2xl font-bold text-gray-800">{{ $empresa->razon_social }}</h1>
                            <p class="text-gray-600">RUC: {{ $empresa->ruc }}</p>
                            <p class="text-gray-600">{{ $empresa->matriz }}</p>
                            <p class="text-gray-600">Tel: {{ $empresa->telefono }}</p>
                            <p class="text-gray-600">Email: {{ $empresa->email }}</p>
                            @endif
                        </div>
                        
                        <div class="text-right">
                            <h2 class="text-xl font-bold text-gray-800">FACTURA</h2>
                            <p class="text-gray-600">N°: <span class="font-mono">{{ $sales->sale_number }}</span></p>
                            <p class="text-gray-600">Fecha: {{ $sales->created_at->format('d/m/Y') }}</p>
                            <p class="text-gray-600">Hora: {{ $sales->created_at->format('H:i') }}</p>
                        </div>
                    </div>

                    <!-- Información del cliente -->
                    <div class="grid grid-cols-2 gap-8 mb-8 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">INFORMACIÓN DEL CLIENTE</h3>
                            <p class="text-gray-600"><strong>Nombre:</strong> {{ $sale->customer->name ?? 'Consumidor Final' }}</p>
                            <p class="text-gray-600"><strong>RUC/Cédula:</strong> {{ $sales->customer->cedula ?? '9999999999' }}</p>
                            <p class="text-gray-600"><strong>Dirección:</strong> {{ $sales->customer->address ?? 'N/A' }}</p>
                            <p class="text-gray-600"><strong>Teléfono:</strong> {{ $sales->customer->phone ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">INFORMACIÓN DE LA VENTA</h3>
                            <p class="text-gray-600"><strong>Vendedor:</strong> {{ $sales->createdBy->name }}</p>
                            <p class="text-gray-600"><strong>Método de Pago:</strong> 
                                @if($sales->payment_type === 'cash') Efectivo
                                @elseif($sales->payment_type === 'credit') Crédito
                                @elseif($sales->payment_type === 'transfer') Transferencia
                                @else Tarjeta @endif
                            </p>
                            <p class="text-gray-600"><strong>Estado:</strong> 
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($sales->status === 'completed') bg-green-100 text-green-800
                                    @elseif($sales->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $sales->status === 'completed' ? 'Completada' : 
                                       ($sales->status === 'pending' ? 'Pendiente' : 'Cancelada') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Tabla de productos -->
                    <div class="mb-8">
                        <h3 class="font-semibold text-gray-700 mb-4">DETALLE DE PRODUCTOS</h3>
                        <table class="w-full text-sm text-left text-gray-700 border-collapse border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 border">Código</th>
                                    <th class="px-4 py-3 border">Descripción</th>
                                    <th class="px-4 py-3 border text-right">Cantidad</th>
                                    <th class="px-4 py-3 border text-right">Precio Unit.</th>
                                    <th class="px-4 py-3 border text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales->items as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-3 border font-mono">{{ $item->product->code ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 border">{{ $item->product->name ?? 'Producto' }}</td>
                                    <td class="px-4 py-3 border text-right">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 border text-right">${{ number_format($item->price_per_unit, 2) }}</td>
                                    <td class="px-4 py-3 border text-right font-semibold">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Totales -->
                    <div class="flex justify-end">
                        <div class="w-64">
                            <div class="flex justify-between py-2 border-b">
                                <span class="font-semibold">Subtotal:</span>
                                <span>${{ number_format($sales->subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b">
                                <span class="font-semibold">IVA (15%):</span>
                                <span>${{ number_format($sale->tax ?? 0, 2) }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b">
                                <span class="font-semibold">Descuento:</span>
                                <span>${{ number_format($sales->discount, 2) }}</span>
                            </div>
                            <div class="flex justify-between py-3 text-lg font-bold">
                                <span>TOTAL:</span>
                                <span class="text-green-600">${{ number_format($sales->subtotal, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t">
                        <a href="{{ route('invoices.index') }}" 
                           class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Volver a la lista
                        </a>
                        <a href="{{ route('invoices.print', $sales->id) }}" 
                           target="_blank"
                           class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-print mr-2"></i>Imprimir
                        </a>
                        <a href="{{ route('invoices.pdf', $sales->id) }}" 
                           class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            <i class="fas fa-file-pdf mr-2"></i>Descargar PDF
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>