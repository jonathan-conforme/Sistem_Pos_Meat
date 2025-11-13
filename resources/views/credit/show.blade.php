<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800">Detalle de Crédito: {{ $sale->sale_number }}</h2>
</x-slot>

<div class="p-4 sm:p-6 bg-white rounded-lg shadow space-y-6">
    <!-- Resumen del crédito - RESPONSIVE -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 p-3 sm:p-4 bg-gray-50 rounded-lg">
        <div class="text-center">
            <p class="text-xs sm:text-sm text-gray-600">Cliente</p>
            <p class="font-semibold text-gray-800 text-sm sm:text-base truncate" title="{{ $sale->customer->name ?? 'Consumidor Final' }}">
                {{ $sale->customer->name ?? 'Consumidor Final' }}
            </p>
        </div>
        <div class="text-center">
            <p class="text-xs sm:text-sm text-gray-600">Total</p>
            <p class="font-semibold text-gray-800 text-sm sm:text-base">${{ number_format($sale->subtotal, 2) }}</p>
        </div>
        <div class="text-center">
            <p class="text-xs sm:text-sm text-gray-600">Pagado</p>
            <p class="font-semibold text-green-600 text-sm sm:text-base">${{ number_format($sale->total_paid, 2) }}</p>
        </div>
        <div class="text-center">
            <p class="text-xs sm:text-sm text-gray-600">Saldo</p>
            <p class="font-semibold text-red-600 text-sm sm:text-base">${{ number_format($sale->remaining, 2) }}</p>
        </div>
    </div>

    <!-- Formulario de pago - RESPONSIVE -->
    <form id="paymentForm" action="{{ route('credit.pay', $sale) }}" method="POST" class="bg-white rounded-lg border border-gray-200 p-3 sm:p-4">
        @csrf
        <input type="hidden" name="sale_id" value="{{ $sale->id }}">

        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-end">
            <!-- Monto -->
            <div class="flex-1 w-full sm:min-w-0">
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">
                    Monto
                </label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">$</span>
                    <input
                        type="number"
                        step="0.01"
                        name="amount"
                        id="amount"
                        placeholder="0.00"
                        class="pl-8 w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
            </div>

            <!-- Notas -->
            <div class="flex-1 w-full sm:min-w-0">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                    Notas
                </label>
                <input
                    type="text"
                    name="notes"
                    id="notes"
                    placeholder="Observaciones"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Botón -->
            <div class="flex-shrink-0 w-full sm:w-auto">
                <button
                    type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg text-sm transition-colors">
                    <i class="fas fa-plus"></i>
                    Agregar Pago
                </button>
            </div>
        </div>
    </form>

    <!-- Historial de pagos - COMPLETAMENTE RESPONSIVE -->
    <div class="mt-6">
        <h3 class="font-semibold text-lg text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-history text-blue-500"></i>
            Historial de Pagos
        </h3>

        @if($sale->payments->count() > 0)
        <!-- Versión desktop (tabla) -->
        <div class="hidden md:block overflow-hidden rounded-lg border border-gray-200 shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registrado por</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                            <th class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Factura</th>
                            <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notas</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sale->payments as $payment)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-calendar text-gray-400 hidden sm:inline"></i>
                                    {{ $payment->created_at->format('d/m/Y') }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $payment->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-user text-gray-400 hidden sm:inline"></i>
                                    {{ $payment->user->name ?? 'Sistema' }}
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-dollar-sign mr-1"></i>
                                    {{ number_format($payment->amount, 2) }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                 <div class="flex items-center gap-2">
                                    <a href="{{ route('pdf.credito.factura', $sale->id) }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 hover:bg-blue-700 text-sm text-gray-700 hover:text-gray-400 font-medium rounded-md border border-gray-300 shadow-sm transition-all">
                                         <i class="fas fa-file-invoice text-gray-400 hidden sm:inline mr-1"></i> Ver
                                    </a>
                               </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-900">
                                @if($payment->notes)
                                <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs text-center">{{ $payment->notes }}</span>
                                @else
                                <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs">----</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Versión móvil (cards) -->
        <div class="md:hidden space-y-3">
            @foreach($sale->payments as $payment)
            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar text-gray-400"></i>
                        <span class="text-sm font-medium text-gray-900">
                            {{ $payment->created_at->format('d/m/Y') }}
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $payment->created_at->format('H:i') }}
                        </span>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        ${{ number_format($payment->amount, 2) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div>
                        <span class="text-gray-600">Registrado por:</span>
                        <p class="font-medium">{{ $payment->user->name ?? 'Sistema' }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-600">Notas:</span>
                        <p class="font-medium">
                            @if($payment->notes)
                            {{ $payment->notes }}
                            @else
                            <span class="text-gray-400">—</span>
                            @endif
                        </p>
                    </div>
                     <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                              <div class="flex items-center gap-2">
                                    <a href="{{ route('pdf.credito.factura', $sale->id) }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 hover:bg-blue-700 text-sm text-gray-700 hover:text-gray-400 font-medium rounded-md border border-gray-300 shadow-sm transition-all">
                                         <i class="fas fa-file-invoice text-gray-400 hidden sm:inline mr-1"></i> Ver
                                    </a>
                               </div>
                            </td>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Resumen total de pagos -->
        <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium text-blue-700">Total pagado:</span>
                <span class="text-lg font-bold text-blue-800">${{ number_format($sale->total_paid, 2) }}</span>
            </div>
        </div>
        @else
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
            <i class="fas fa-receipt text-gray-300 text-4xl mb-3"></i>
            <p class="text-gray-500 text-lg">No hay pagos registrados</p>
            <p class="text-gray-400 text-sm mt-1">Los pagos aparecerán aquí una vez que se registren</p>
        </div>
        @endif
    </div>
</div>

<script>
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("credit.pay", $sale) }}',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                Swal.fire({
                    title: 'Registrando pago...',
                    text: 'Por favor espera un momento',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });
            },
            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: '✅ Pago registrado',
                    text: res.message,
                    confirmButtonText: 'Aceptar',
                    timer: 2000,
                    timerProgressBar: true
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                let msg = 'No se pudo registrar el pago.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire({
                    icon: 'error',
                    title: '❌ Error',
                    text: msg
                });
            }
        });
    });
</script>