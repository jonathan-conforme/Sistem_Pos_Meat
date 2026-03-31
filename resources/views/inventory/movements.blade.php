<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Movimientos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl font-bold mb-6">Movimientos de Inventario</h1>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Fecha</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Producto</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Tipo</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-right">Cantidad</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-right">Stock Ant.</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-gray-900 text-right">Stock Act.</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Usuario</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-t border-gray-200">
                                @forelse ($movements as $movement)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $movement->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $movement->product->name ?? 'Producto Eliminado' }}
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            @php
                                                $badges = [
                                                    'purchase'   => 'bg-green-100 text-green-700',
                                                    'sale'       => 'bg-blue-100 text-blue-700',
                                                    'adjustment' => 'bg-yellow-100 text-yellow-700',
                                                    'merma'      => 'bg-red-100 text-red-700',
                                                    'return'     => 'bg-purple-100 text-purple-700',
                                                ];
                                                $labels = [
                                                    'purchase'   => 'Compra',
                                                    'sale'       => 'Venta',
                                                    'adjustment' => 'Ajuste',
                                                    'merma'      => 'Merma',
                                                    'return'     => 'Devolución',
                                                ];
                                                $badgeClass = $badges[$movement->type] ?? 'bg-gray-100 text-gray-700';
                                                $label = $labels[$movement->type] ?? ucfirst($movement->type);
                                            @endphp
                                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $badgeClass }}">
                                                {{ $label }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-right font-bold {{ in_array($movement->type, ['purchase', 'return', 'adjustment']) && $movement->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $movement->quantity > 0 && in_array($movement->type, ['purchase', 'return']) ? '+' : '' }}{{ number_format($movement->quantity, 3) }}
                                        </td>

                                        <td class="px-6 py-4 text-right">{{ number_format($movement->stock_before, 3) }}</td>
                                        <td class="px-6 py-4 text-right font-medium text-gray-900">{{ number_format($movement->stock_after, 3) }}</td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $movement->user->name ?? 'Sistema' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                            No hay movimientos de inventario registrados todavía.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $movements->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>