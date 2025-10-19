
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Detalle de Crédito: {{ $sale->sale_number }}</h2>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow space-y-4">
        <p><strong>Cliente:</strong> {{ $sale->customer->name ?? 'Consumidor Final' }}</p>
        <p><strong>Total:</strong> ${{ number_format($sale->total, 2) }}</p>
        <p><strong>Pagado:</strong> ${{ number_format($sale->total_paid, 2) }}</p>
        <p><strong>Saldo:</strong> <span class="text-red-600 font-semibold">${{ number_format($sale->remaining, 2) }}</span></p>

        <form id="paymentForm" action="{{ route('credit.pay', $sale) }}" method="POST">
            @csrf
            <input type="hidden" name="sale_id" value="{{ $sale->id }}">
            <div class="flex gap-2 items-center">
                <input type="number" step="0.01" name="amount" placeholder="Monto a abonar" class="border rounded p-2 w-1/3">
                <input type="text" name="notes" placeholder="Nota (opcional)" class="border rounded p-2 flex-1">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Registrar Pago</button>
            </div>
        </form>

        <h3 class="font-semibold text-gray-700 mt-4">Historial de Pagos</h3>
        <table class="min-w-full text-sm border">
            <thead class="bg-gray-100">
                <tr>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Registrado por</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sale->payments as $payment)
                <tr class="border-b">
                    <td>{{ $payment->payment_date }}</td>
                    <td>${{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->user->name ?? 'N/A' }}</td>
                    <td>{{ $payment->notes ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 py-2">Sin pagos registrados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>$('#paymentForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route("credit.pay", $sale) }}',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json', // 👈 importante para que jQuery lo interprete como JSON
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
                text: res.message, // 👈 ahora sí muestra solo el mensaje
                confirmButtonText: 'Aceptar'
            }).then(() => {
                location.reload(); // recarga para mostrar el nuevo pago
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

