<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Compra') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8">
        
        <form action="{{ route('admin.purchases.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">1. Datos Generales de la Compra</h3>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Número de compra <span class="text-red-500">*</span></label>
                            <input type="text"
                                   name="purchase_number"
                                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors px-4 py-2"
                                   placeholder="Ej. COMP-001"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Proveedor <span class="text-red-500">*</span></label>
                            <select name="supplier_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors px-4 py-2" required>
                                <option value="" disabled selected>Seleccione un proveedor...</option>
                                @forelse($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @empty
                                    <option disabled>No hay proveedores registrados</option>
                                @endforelse
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha <span class="text-red-500">*</span></label>
                            <input type="date"
                                   name="purchase_date"
                                   class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors px-4 py-2"
                                   value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Observaciones (Opcional)</label>
                        <textarea name="notes"
                                  rows="2"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-colors px-4 py-2"
                                  placeholder="Detalles adicionales sobre la compra..."></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">2. Detalles de los Productos</h3>
                    
                    <button type="button" id="add-row" class="inline-flex items-center gap-1 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 border border-indigo-200 font-medium px-3 py-1.5 rounded-lg transition-colors text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Agregar Producto
                    </button>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="products-table">
                            <thead>
                                <tr class="border-b-2 border-gray-200 text-sm text-gray-600">
                                    <th class="pb-3 pr-2 font-semibold w-2/5">Producto</th>
                                    <th class="pb-3 px-2 font-semibold w-1/5 text-right">Cantidad</th>
                                    <th class="pb-3 px-2 font-semibold w-1/5 text-right">Costo Unit. ($)</th>
                                    <th class="pb-3 px-2 font-semibold w-1/5 text-right">Subtotal ($)</th>
                                    <th class="pb-3 pl-2 font-semibold w-12 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="product-row hover:bg-gray-50 transition-colors">
                                    <td class="py-3 pr-2">
                                        <select name="products[0][product_id]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 py-1.5 text-sm" required>
                                            <option value="" disabled selected>Seleccionar...</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="py-3 px-2">
                                        <input type="number" step="0.001" min="0.001" name="products[0][quantity]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 py-1.5 text-sm text-right quantity" placeholder="0.00" required>
                                    </td>
                                    <td class="py-3 px-2">
                                        <input type="number" step="0.01" min="0.01" name="products[0][cost]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 py-1.5 text-sm text-right cost" placeholder="0.00" required>
                                    </td>
                                    <td class="py-3 px-2">
                                        <input type="text" class="w-full bg-gray-100 border-gray-200 text-gray-600 rounded-md py-1.5 text-sm text-right font-semibold subtotal cursor-not-allowed" readonly placeholder="0.00">
                                    </td>
                                    <td class="py-3 pl-2 text-center">
                                        <button type="button" class="text-gray-400 hover:text-red-500 transition-colors remove-row" title="Eliminar fila">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex flex-col md:flex-row justify-end items-end md:items-center gap-6 border-t pt-6">
                        <div class="text-right">
                            <p class="text-sm text-gray-500 uppercase tracking-wide font-semibold mb-1">Total de la Compra</p>
                            <h3 class="text-3xl font-bold text-gray-900">
                                $<span id="total">0.00</span>
                            </h3>
                        </div>

                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-colors flex items-center gap-2 text-lg w-full md:w-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Registrar Compra
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

<script>
let index = 1;

// FUNCIÓN PARA AGREGAR FILA
document.getElementById('add-row').addEventListener('click', function () {
    let table = document.querySelector('#products-table tbody');
    
    let row = `
        <tr class="product-row hover:bg-gray-50 transition-colors border-t border-gray-100">
            <td class="py-3 pr-2">
                <select name="products[${index}][product_id]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 py-1.5 text-sm" required>
                    <option value="" disabled selected>Seleccionar...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="py-3 px-2">
                <input type="number" step="0.001" min="0.001" name="products[${index}][quantity]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 py-1.5 text-sm text-right quantity" placeholder="0.00" required>
            </td>
            <td class="py-3 px-2">
                <input type="number" step="0.01" min="0.01" name="products[${index}][cost]" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 py-1.5 text-sm text-right cost" placeholder="0.00" required>
            </td>
            <td class="py-3 px-2">
                <input type="text" class="w-full bg-gray-100 border-gray-200 text-gray-600 rounded-md py-1.5 text-sm text-right font-semibold subtotal cursor-not-allowed" readonly placeholder="0.00">
            </td>
            <td class="py-3 pl-2 text-center">
                <button type="button" class="text-gray-400 hover:text-red-500 transition-colors remove-row" title="Eliminar fila">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </td>
        </tr>
    `;
    
    table.insertAdjacentHTML('beforeend', row);
    index++;
});

// DELEGACIÓN DE EVENTOS PARA CÁLCULOS Y ELIMINAR FILAS
document.querySelector('#products-table').addEventListener('input', function(e) {
    if(e.target.classList.contains('quantity') || e.target.classList.contains('cost')) {
        let row = e.target.closest('tr');
        calculateRow(row);
    }
});

document.querySelector('#products-table').addEventListener('click', function(e) {
    // Si hace clic en el botón de eliminar (o en el icono SVG dentro de él)
    let removeBtn = e.target.closest('.remove-row');
    if(removeBtn) {
        let tbody = document.querySelector('#products-table tbody');
        // Prevenir borrar si solo queda 1 fila
        if(tbody.querySelectorAll('tr').length > 1) {
            removeBtn.closest('tr').remove();
            calculateTotal(); // Recalcular total al eliminar
        } else {
            alert("Debe haber al menos un producto en la compra.");
        }
    }
});

function calculateRow(row) {
    let qty = parseFloat(row.querySelector('.quantity').value) || 0;
    let cost = parseFloat(row.querySelector('.cost').value) || 0;
    let subtotal = qty * cost;
    
    row.querySelector('.subtotal').value = subtotal.toFixed(2);
    calculateTotal();
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    
    // Anima ligeramente el cambio del número dándole un resaltado suave
    let totalEl = document.getElementById('total');
    totalEl.textContent = total.toFixed(2);
}
</script>

<x-toast />
</x-app-layout>