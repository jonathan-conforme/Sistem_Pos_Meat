<x-app-layout>

   <!-- Barra de búsqueda -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" action="{{ route('admin.products.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Buscar producto..." 
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                
                <select name="unit_type" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
                    <option value="">Tipo de unidad</option>
                    <option value="lb" {{ request('unit_type') == 'lb' ? 'selected' : '' }}>Libra (lb)</option>
                    <option value="unit" {{ request('unit_type') == 'unit' ? 'selected' : '' }}>Unidad</option>
                    <option value="package" {{ request('unit_type') == 'package' ? 'selected' : '' }}>Paquete</option>
                </select>
                
                <select name="active" class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500">
                    <option value="">Estado</option>
                    <option value="1" {{ request('active') == '1' ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ request('active') == '0' ? 'selected' : '' }}>Inactivo</option>
                </select>
                
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Filtrar
                </button>
            </form>
        </div>     
  <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-900">Lista de Productos</h2>
            </div>
            
            @if($products->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->sku ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->code ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $product->unit_type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    ${{ number_format($product->default_price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <!-- RUTAS CORREGIDAS -->
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="px-6 py-8 text-center">
                    <p class="text-gray-500">No hay productos registrados.</p>
                </div>
            @endif
        </div>

        <!-- Paginación -->
        @if($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('form-modal');
            const toggleButtons = document.querySelectorAll('[data-modal-toggle="form-modal"]');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    modal.classList.toggle('hidden');
                });
            });
            
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
<x-toast />
</x-app-layout>
