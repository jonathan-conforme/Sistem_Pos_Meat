
<div class="space-y-4">
    <div class="grid grid-cols-2 gap-4 border-b pb-4">
        
        <div>
            <p class="text-sm text-gray-500 uppercase">Proveedor</p>
            <p class="font-bold">{{ $purchase->supplier->name ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500 uppercase">Fecha</p>
            <p class="font-bold">{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y') }}</p>
        </div>
        
    </div>
      @if($purchase->notes)
                <div class="mt-6 bg-gray-50 p-4 rounded border">
                    <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Observaciones</p>
                    <p class="text-gray-800">{{ $purchase->notes }}</p>
                </div>
                @endif

    <table class="w-full text-left text-sm text-gray-500 border">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-gray-900">Producto</th>
                <th class="px-4 py-2 text-gray-900 text-right">Cant.</th>
                <th class="px-4 py-2 text-gray-900 text-right">Costo Unit.</th>
                <th class="px-4 py-2 text-gray-900 text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase->items as $item)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $item->product->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 text-right">{{ number_format($item->quantity, 2) }}</td>
                    <td class="px-4 py-2 text-right">$ {{ number_format($item->cost_per_unit, 2) }}</td>
                    <td class="px-4 py-2 text-right">$ {{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-gray-50 font-bold border-t">
            <tr>
                <td colspan="2" class="px-4 py-2 text-left">TOTAL:</td>
                <td class="px-4 py-2 text-right text-green-600">$ {{ number_format($purchase->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>