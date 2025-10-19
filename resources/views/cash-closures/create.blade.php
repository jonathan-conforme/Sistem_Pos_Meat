<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-6 mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Cierre de Caja del Día</h1>

        {{-- Resumen de ventas --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="p-4 bg-green-50 rounded-lg border border-green-200 text-center">
                <p class="text-sm text-green-700">Efectivo</p>
                <p class="text-xl font-bold text-green-800">${{ number_format($salesSummary['cash'], 2) }}</p>
            </div>
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-200 text-center">
                <p class="text-sm text-blue-700">Tarjeta</p>
                <p class="text-xl font-bold text-blue-800">${{ number_format($salesSummary['card'], 2) }}</p>
            </div>
            <div class="p-4 bg-purple-50 rounded-lg border border-purple-200 text-center">
                <p class="text-sm text-purple-700">Transferencia</p>
                <p class="text-xl font-bold text-purple-800">${{ number_format($salesSummary['transfer'], 2) }}</p>
            </div>
            <div class="p-4 bg-orange-50 rounded-lg border border-orange-200 text-center">
                <p class="text-sm text-orange-700">Crédito</p>
                <p class="text-xl font-bold text-orange-800">${{ number_format($salesSummary['credit'], 2) }}</p>
            </div>
        </div>

        <div class="text-right text-lg font-semibold mb-6">
            Total de ventas hoy:
            <span class="text-blue-700">${{ number_format($salesSummary['total'], 2) }}</span>
            ({{ $salesSummary['count'] }} ventas)
        </div>

        {{-- Formulario para el cierre --}}
        <form action="{{ route('cash-closures.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- En cash-closures/create.blade.php -->
            <div>
                <label for="physical_cash" class="block text-sm font-medium text-gray-700 mb-1">
                    Efectivo físico contado
                </label>
                <input type="number" name="physical_cash" id="physical_cash" step="0.01" min="0" required
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                    placeholder="El dinero REAL que cuentas físicamente en la caja al final del día">
                @error('physical_cash')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
          
            <div>
                <label for="observations" class="block text-sm font-medium text-gray-700 mb-1">
                    Observaciones (opcional)
                </label>
                <textarea name="observations" id="observations" rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
                    placeholder="Notas adicionales sobre el cierre..."></textarea>
                @error('observations')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('dashboard') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                    Confirmar Cierre
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
