<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inventario
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjetas de resumen (igual que en categorías pero con datos de inventario) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total productos -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total productos</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalProductos }}</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stock bajo -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Stock bajo</p>
                            <p class="text-2xl font-bold text-red-600">{{ $productosCriticos }}</p>
                            
                        </div>
                        <div class="p-3 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Agotados -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Agotados</p>
                            <p class="text-2xl font-bold text-orange-600">{{ $productosAgotados }}</p>
                            
                        </div>
                        <div class="p-3 bg-orange-100 rounded-full">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stock promedio -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Stock promedio</p>
                            <p class="text-2xl font-bold text-gray-900">{{ round($stockPromedio, 0) }}</p>
                            <p class="text-xs text-gray-500">unidades por producto</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros rápidos -->
           <div class="mb-6 flex flex-wrap gap-3">
    <a href="{{ route('admin.inventory.index', ['filtro' => 'todos']) }}" 
       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 border 
       {{ $filtroActual == 'todos' ? 'bg-blue-600 text-white' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
        Todos
    </a>

    <a href="{{ route('admin.inventory.index', ['filtro' => 'critico']) }}" 
       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 border 
       {{ $filtroActual == 'critico' ? 'bg-red-50 text-red-700 border-red-200 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
        Stock bajo ({{ $productosCriticos }})
    </a>

    <a href="{{ route('admin.inventory.index', ['filtro' => 'agotado']) }}" 
       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 border 
       {{ $filtroActual == 'agotado' ? 'bg-orange-50 text-orange-700 border-orange-200 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
        Agotados ({{ $productosAgotados }})
    </a>

    <a href="{{ route('admin.inventory.index', ['filtro' => 'normal']) }}" 
       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 border 
       {{ $filtroActual == 'normal' ? 'bg-green-50 text-green-700 border-green-200 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
        Stock normal
    </a>
</div>
   <div class="mb-5 ">
                <a href="{{ route('admin.inventory-movements.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Ver Movimientos de Inventario
                </a>
            </div>
        
            <!-- Tabla con diseño de categorías -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                               
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Producto
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad Disponible
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock Mínimo
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock Máximo
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($inventory as $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $item->product->name }}
                                    </div>
                                  
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $isCritico = $item->available_quantity <= $item->min_stock && $item->min_stock > 0;
                                        $isAgotado = $item->available_quantity <= 0;
                                    @endphp
                                    
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-semibold 
                                            {{ $isCritico ? 'text-red-600' : ($isAgotado ? 'text-orange-600' : 'text-gray-900') }}">
                                            {{ number_format($item->available_quantity, 2) }}
                                        </span>
                                        
                                        @if($isCritico && !$isAgotado)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                 ¡Bajo!
                                            </span>
                                        @endif
                                        
                                        @if($isAgotado)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                 ¡Agotado!
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">
                                        {{ number_format($item->min_stock, 2) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">
                                        {{ number_format($item->max_stock, 2) }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($isCritico && !$isAgotado)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1"></span>
                                            Reponer pronto
                                        </span>
                                    @elseif($isAgotado)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500 mr-1"></span>
                                            Agotado
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1"></span>
                                            Stock OK
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-8V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v1M9 7h6"></path>
                                    </svg>
                                    <p class="mt-2 text-lg font-medium text-gray-900">No hay productos en inventario</p>
                                    <p class="text-gray-600">Agrega productos para comenzar</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        
                    </table>
                </div>
                
                <div class="mt-4 mx-6 py-4 ">
                    {{ $inventory->links() }}
                </div>
                
            </div>
            
           
         

        </div>
    </div>
</x-app-layout>