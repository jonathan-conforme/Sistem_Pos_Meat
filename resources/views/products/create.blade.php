<x-app-layout>
    <div class="container mx-auto p-4">
        <!-- Botón de registro -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestión de Productos</h1>
                <p class="text-gray-600">Administra los productos de tu sistema</p>
            </div>
            <button onclick="openCreate()" class="group text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 btn-hover-effect flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 text-green-500 hover:scale-110 hover:text-white transition duration-75 dark:text-white group-hover:text-white dark:group-hover:text-white mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 25 25">
                    <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
                </svg> Registrar Producto
            </button>
        </div>
        <!-- Estadísticas -->

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Total de Productos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Productos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['totalProducts'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Productos Activos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Productos Activos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['activeProducts'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Productos Inactivos -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Productos Inactivos</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['inactiveProducts'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Stock Bajo -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Stock Bajo</p>
                        <p class="text-2xl font-bold text-gray-900"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Principal de Producto -->
     <div id="form-modal"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full">
    <div class="modal-content relative bg-white rounded-lg shadow-lg max-w-4xl w-full max-h-[95vh] overflow-y-auto">
                <!-- Encabezado del modal -->
                <div class="flex items-center justify-between p-6 border-b rounded-t bg-gray-50">
                    <h3 id="modal-title" class="text-xl font-semibold text-gray-900">Registrar Nuevo Producto</h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="form-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>


                <!-- Formulario -->
                <form id="product-form" class="p-6 space-y-6">
                    @csrf

                    <!-- Sección: Información Básica -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-blue-50 rounded-lg">
                        <h4 class="md:col-span-2 text-lg font-semibold text-blue-800 mb-2">Información Básica</h4>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre del Producto *
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="Ej: Arroz Integral">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        
                            <select id="unit_id" name="unit_id" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">

                            <option value="">Seleccione unidad</option>

                           @forelse($units as $unit)
    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
@empty
    <option disabled>No hay unidades registradas</option>
@endforelse

                            </select>
                            <!-- Categoría -->
<div class="mb-4">
    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
        Categoría
    </label>
    <select name="category_id" id="category_id"
        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
        <option value="">Sin categoría</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
                        
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                                SKU (Código automático)
                            </label>
                            <input
                                type="text"
                                id="sku"
                                name="sku"
                                value="{{ old('sku') }}"
                                readonly
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed"
                                placeholder="Se generará automáticamente al guardar">
                            @error('sku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Código Interno
                            </label>
                            <input
                                type="text"
                                id="code"
                                name="code"
                                value="{{ old('code') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="Código opcional">
                        </div>
                       
                    </div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 border-t pt-4">
    <div>
        <label for="min_stock" class="block text-sm font-medium text-gray-700">Stock Mínimo (Alerta)</label>
        <input type="number" 
               id="min_stock" 
               name="min_stock" 
               value="{{ old('min_stock', $product->inventory->min_stock ?? 0) }}" 
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
               required>
    </div>

    <div>
        <label for="max_stock" class="block text-sm font-medium text-gray-700">Stock Máximo (Capacidad)</label>
        <input type="number" 
               id="max_stock" 
               name="max_stock" 
               value="{{ old('max_stock', $product->inventory->max_stock ?? 0) }}" 
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
               required>
    </div>
</div>
                    <!-- Sección: Precios y Costos -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4 bg-green-50 rounded-lg">
                        <h4 class="md:col-span-3 text-lg font-semibold text-green-800 mb-2">Precios y Costos</h4>

                        <div>
                            <label for="default_cost" class="block text-sm font-medium text-gray-700 mb-2">
                                Costo Unitario *
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">$</span>
                                <input
                                    type="number"
                                    id="default_cost"
                                    name="default_cost"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('default_cost') }}"
                                    required
                                    class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                    placeholder="0.00">
                            </div>
                            @error('default_cost')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="default_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Precio de Venta
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">$</span>
                                <input
                                    type="number"
                                    id="default_price"
                                    name="default_price"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('default_price') }}"
                                    required
                                    class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                    placeholder="0.00">
                            </div>
                            @error('default_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-center">
                            <div id="profit-margin" class="text-center p-3 bg-white rounded-lg border">
                                <span class="block text-xs text-gray-500">Margen</span>
                                <span class="block text-lg font-semibold text-green-600">0%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sección: Configuraciones -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg">
                        <h4 class="md:col-span-2 text-lg font-semibold text-gray-800 mb-2">Configuraciones</h4>

                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="active"
                                    name="active"
                                    value="1"
                                    {{ old('active', true) ? 'checked' : '' }}
                                    class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                <label for="active" class="ml-3 text-sm font-medium text-gray-700">
                                    Producto activo
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="track_quantity"
                                    name="track_quantity"
                                    value="1"
                                    {{ old('track_quantity', true) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="track_quantity" class="ml-3 text-sm font-medium text-gray-700">
                                    Controlar inventario
                                </label>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input
                                    type="checkbox"
                                    id="track_expiration"
                                    name="track_expiration"
                                    value="1"
                                    {{ old('track_expiration') ? 'checked' : '' }}
                                    class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                <label for="track_expiration" class="ml-3 text-sm font-medium text-gray-700">
                                    Controlar caducidad
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <button type="button"
                            data-modal-hide="form-modal"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                            Cancelar
                        </button>
                        <button type="submit" id="save-product-btn" class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Guardar Producto
                        </button>
                    </div>
                </form>
            </div>
        </div>



        <!-- Barra de búsqueda -->
      <!-- Barra de búsqueda y filtros -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.products.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <!-- Búsqueda por texto -->
        <div class="relative md:col-span-2">
            <input
                type="text"
                name="search"
                placeholder="Buscar por nombre, SKU o código..."
                value="{{ request('search') }}"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Filtro por categoría -->
        <div>
            <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Todas las categorías</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por unidad -->
        <div>
            <select name="unit_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Todas las unidades</option>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por estado -->
        <div>
            <select name="active" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">Todos los estados</option>
                <option value="1" {{ request('active') == '1' ? 'selected' : '' }}>Activos</option>
                <option value="0" {{ request('active') == '0' ? 'selected' : '' }}>Inactivos</option>
            </select>
        </div>

        <!-- Botones de acción -->
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Filtrar
            </button>
            
            <a href="{{ route('admin.products.index') }}" class="flex-1 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Limpiar
            </a>
        </div>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>   
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">P.Costo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">P.Venta</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">{{ $product->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">{{ $product->sku ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">{{ $product->code ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                {{ $product->unit ? $product->unit->name : 'N/A' }} 
                            </td>
                            <!-- Categoría (CORREGIDA) -->
                        
                           <td class="px-6 py-4 whitespace-nowrap">
            @if($product->category)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                      style="background-color: {{ $product->category->color }}20; color: {{ $product->category->color }}">
                    <span class="w-2 h-2 rounded-full mr-1" style="background-color: {{ $product->category->color }}"></span>
                    {{ $product->category->name }}
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-1"></span>
                    Sin categoría
                </span>
            @endif
        </td>               
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                ${{ number_format($product->default_cost, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                ${{ number_format($product->default_price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col items-center space-y-2" data-id="{{ $product->id }}">
                                    <!-- Toggle Mejorado -->
                                    <button onclick="toggleProductStatus({{ $product->id }})"
                                        class="group relative inline-flex items-center h-7 rounded-full w-14 transition-all duration-300 
                  {{ $product->active ? 'bg-green-500' : 'bg-gray-300' }} 
                  hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 
                  {{ $product->active ? 'focus:ring-green-500' : 'focus:ring-gray-400' }}"
                                        title="{{ $product->active ? 'Desactivar producto' : 'Activar producto' }}">
                                        <span class="sr-only">Toggle status</span>
                                        <span class="inline-block w-5 h-5 transform bg-white rounded-full transition-all duration-300 shadow-sm
                  {{ $product->active ? 'translate-x-8' : 'translate-x-1' }}
                  group-hover:scale-110"></span>
                                    </button>

                                    <!-- Badge de Estado Mejorado -->
                                    <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
              {{ $product->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1 
                  {{ $product->active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        {{ $product->active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-align font-medium space-x-2">
                                <div class="relative group">
                                    <div class="flex space-x-4 justify-center">
                                        <button
                                            onclick="editProduct({{ $product->id }})"
                                            class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 
                                                       transition-all duration-200 hover:scale-110 hover:shadow-sm
                                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                    <!-- Tooltip -->
                                    <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block">
                                        <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                            Editar Producto
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                        </div>
                                    </div>
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
    console.log(' Script cargado correctamente');

    /* --------------------------------------------------------------------------
     *  ELEMENTOS PRINCIPALES Y MODAL
     * -------------------------------------------------------------------------- */
    const modalEl = document.getElementById('form-modal');
    const formModal = new Modal(modalEl);
    const form = document.getElementById('product-form');
    const saveBtn = document.getElementById('save-product-btn');


    /* --------------------------------------------------------------------------
     *  ABRIR MODAL EN MODO CREAR
     * -------------------------------------------------------------------------- */
    window.openCreate = function() {
        setModalMode("create");

        form.reset();
        form.dataset.productId = "";
        document.getElementById("sku").value = "";

        // Resetear checkboxes a valores por defecto
        document.getElementById("active").checked = true;
        document.getElementById("track_quantity").checked = true;
        document.getElementById("track_expiration").checked = false;
        
        // Resetear selects
        document.getElementById("unit_id").value = "";
        document.getElementById("category_id").value = "";

        document.getElementById("modal-title").textContent = "Registrar Producto";
        saveBtn.textContent = "Guardar Producto";

        formModal.show();
    };


    /* --------------------------------------------------------------------------
     *  GENERAR SKU AUTOMÁTICAMENTE SEGÚN EL NOMBRE
     * -------------------------------------------------------------------------- */
    document.getElementById('name').addEventListener('input', async function() {
        const name = this.value.trim();
        const skuInput = document.getElementById('sku');

        if (!name) {
            skuInput.value = '';
            return;
        }

        const words = name.split(' ').filter(w => w.length > 0);
        let prefix = words.map(w => w[0].toUpperCase()).join('').slice(0, 3);
        while (prefix.length < 3) prefix += 'X';

        try {
            const response = await fetch(`{{ route('admin.products.create') }}?prefix=${prefix}`);
            const data = await response.json();
            skuInput.value = data.nextSku || `${prefix}-001`;
        } catch (err) {
            console.error(' Error al generar SKU:', err);
            skuInput.value = `${prefix}-001`;
        }
    });


    /* --------------------------------------------------------------------------
     *  GUARDAR PRODUCTO (CREATE / UPDATE)
     * -------------------------------------------------------------------------- */
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const productId = form.dataset.productId || null;
        await saveProduct(productId);
    });

    async function saveProduct(productId = null) {
        console.log(' Iniciando guardado...');

        const url = productId ?
            `/admin/products/${productId}` :
            "{{ route('admin.products.store') }}";

        const formData = new FormData(form);
        if (productId) formData.append('_method', 'PUT');
        
        // Asegurar que los checkboxes se envíen correctamente
        formData.set('active', form.querySelector('#active').checked ? '1' : '0');
        formData.set('track_quantity', form.querySelector('#track_quantity').checked ? '1' : '0');
        formData.set('track_expiration', form.querySelector('#track_expiration').checked ? '1' : '0');

        const originalBtnContent = saveBtn.innerHTML;
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Guardando...';

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            let data;
            try {
                data = await response.json();
            } catch {
                throw new Error(`Respuesta no válida del servidor (${response.status})`);
            }

            if (response.status === 422) {
                const messages = Object.values(data.errors || {}).flat().join('\n');
                Swal.fire({
                    icon: 'warning',
                    title: 'Error de validación',
                    text: messages || 'Revise los campos obligatorios.',
                    timer: 4500,
                });
                return;
            }

            if (!response.ok) throw new Error(data.message || `Error ${response.status}`);

            if (data.success) {
                console.log(' Producto guardado exitosamente');
                formModal.hide();
                form.reset();
                document.getElementById('sku').value = '';

                if (productId) {
                    // MODO EDICIÓN: Actualizar la fila existente
                    updateProductInTable(data.product);
                } else {
                    // MODO CREACIÓN: Agregar fila nueva
                    if (typeof addProductToTable === 'function') {
                        addProductToTable(data.product);
                    }
                }
                
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.message || 'Producto guardado correctamente.',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                throw new Error(data.message || 'Error desconocido del servidor.');
            }

        } catch (error) {
            console.error(' Error al guardar producto:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Ocurrió un problema al guardar el producto.'
            });
        } finally {
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalBtnContent;
        }
    }


    /* --------------------------------------------------------------------------
     *  CONFIGURAR MODO DEL MODAL
     * -------------------------------------------------------------------------- */
    function setModalMode(mode = "create") {
        const title = document.getElementById("modal-title");

        if (mode === "create") {
            title.textContent = "Registrar Producto";
            saveBtn.textContent = "Guardar Producto";
            form.dataset.productId = "";
        }

        if (mode === "edit") {
            title.textContent = "Editar Producto";
            saveBtn.textContent = "Actualizar Producto";
        }
    }


    /* --------------------------------------------------------------------------
     *  EDITAR PRODUCTO - CORREGIDO
     * -------------------------------------------------------------------------- */
    window.editProduct = async function(productId) {
        console.log(" Editar producto:", productId);

        setModalMode("edit");
        form.dataset.productId = productId; 

        try {
            const response = await fetch(`/admin/products/${productId}/edit`, {
                headers: { 
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            if (!data.product) throw new Error('No se encontraron datos');

            const p = data.product;

            // Información básica
            form.querySelector('#name').value = p.name || '';
            form.querySelector('#sku').value = p.sku || '';
            form.querySelector('#code').value = p.code || '';
            
            // Unidad - CORREGIDO: usar unit_id en lugar de unit_type
            const unitSelect = form.querySelector('#unit_id');
            if (unitSelect && p.unit_id) {
                unitSelect.value = p.unit_id;
            }
            
            // Categoría
            const categorySelect = form.querySelector('#category_id');
            if (categorySelect && p.category_id) {
                categorySelect.value = p.category_id;
            }
            
            // Precios
            form.querySelector('#default_cost').value = p.default_cost || 0;
            form.querySelector('#default_price').value = p.default_price || 0;
            
            // Inventario
            if (p.inventory) {
                form.querySelector('#min_stock').value = p.inventory.min_stock || 0;
                form.querySelector('#max_stock').value = p.inventory.max_stock || 0;
            } else {
                form.querySelector('#min_stock').value = 0;
                form.querySelector('#max_stock').value = 0;
            }
            
            // Checkboxes
            form.querySelector('#active').checked = p.active === 1;
            form.querySelector('#track_quantity').checked = p.track_quantity === 1;
            form.querySelector('#track_expiration').checked = p.track_expiration === 1;
            
            // Calcular margen después de cargar los valores
            updateProfitMargin();

            formModal.show();

        } catch (err) {
            console.error('❌ Error al cargar producto:', err);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: err.message || 'No se pudo cargar la información del producto',
            });
        }
    };


    /* --------------------------------------------------------------------------
     *  STATS Y TOGGLES
     * -------------------------------------------------------------------------- */
    function updateStats(stats) {
        const statElements = {
            totalProducts: document.querySelector('.grid.grid-cols-1.md\\:grid-cols-4 .text-2xl.font-bold.text-gray-900:first-child'),
            activeProducts: document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-4 .text-2xl.font-bold.text-gray-900')[1],
            inactiveProducts: document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-4 .text-2xl.font-bold.text-gray-900')[2],
            lowStockProducts: document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-4 .text-2xl.font-bold.text-gray-900')[3]
        };
        
        if (stats.totalProducts && statElements.totalProducts) statElements.totalProducts.textContent = stats.totalProducts;
        if (stats.activeProducts && statElements.activeProducts) statElements.activeProducts.textContent = stats.activeProducts;
        if (stats.inactiveProducts && statElements.inactiveProducts) statElements.inactiveProducts.textContent = stats.inactiveProducts;
        if (stats.lowStockProducts && statElements.lowStockProducts) statElements.lowStockProducts.textContent = stats.lowStockProducts;
    }

    window.toggleProductStatus = async function(id) {
        console.log(' Toggle producto:', id);

        const button = event.currentTarget;
        const isCurrentlyActive = button.classList.contains('bg-green-500');
        const newState = !isCurrentlyActive;

        // Actualiza visualmente al instante
        updateProductUI(id, newState);

        try {
            const response = await fetch(`/admin/products/${id}/toggle`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            if (!data.success) {
                // Revertir si fallo
                updateProductUI(id, isCurrentlyActive);
                console.error("Error:", data.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Error al cambiar el estado del producto',
                    timer: 2000
                });
            } else {
                // Si tienes estadísticas, actualízalas
                if (data.stats) updateStats(data.stats);
            }

        } catch (error) {
            console.error(" Error en toggle:", error);
            updateProductUI(id, isCurrentlyActive);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error de conexión al cambiar el estado',
                timer: 2000
            });
        }
    };

    function updateProductUI(productId, isActive) {
        const button = document.querySelector(`button[onclick="toggleProductStatus(${productId})"]`);
        if (!button) return;

        const container = button.closest('td');

        button.classList.toggle('bg-green-500', isActive);
        button.classList.toggle('bg-gray-300', !isActive);

        const circle = button.querySelector('span:last-child');
        if (circle) {
            circle.classList.toggle('translate-x-8', isActive);
            circle.classList.toggle('translate-x-1', !isActive);
        }

        const badge = container.querySelector('.status-badge');
        if (badge) {
            badge.textContent = isActive ? 'Activo' : 'Inactivo';
            badge.className = `status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
            }`;

            const dot = badge.querySelector('span:first-child');
            if (dot) {
                dot.className = `w-1.5 h-1.5 rounded-full mr-1 ${
                    isActive ? 'bg-green-500' : 'bg-red-500'
                }`;
            }
        }
    }


    /* --------------------------------------------------------------------------
     *  CÁLCULO DEL MARGEN
     * -------------------------------------------------------------------------- */
    function updateProfitMargin() {
        const cost = parseFloat(document.getElementById('default_cost').value) || 0;
        const price = parseFloat(document.getElementById('default_price').value) || 0;
        const marginElement = document.getElementById('profit-margin');
        
        let margin = 0;
        if (cost > 0) {
            margin = ((price - cost) / cost) * 100;
        }
        
        const marginSpan = marginElement.querySelector('span:last-child');
        marginSpan.textContent = `${margin.toFixed(1)}%`;
        
        // Cambiar color según el margen
        marginSpan.classList.remove('text-green-600', 'text-yellow-600', 'text-red-600');
        if (margin > 50) {
            marginSpan.classList.add('text-green-600');
        } else if (margin > 20) {
            marginSpan.classList.add('text-yellow-600');
        } else if (margin > 0) {
            marginSpan.classList.add('text-red-600');
        }
    }

    document.getElementById('default_cost').addEventListener('input', updateProfitMargin);
    document.getElementById('default_price').addEventListener('input', updateProfitMargin);
    
    // Inicializar margen
    updateProfitMargin();
});

// ============================================
// FUNCIÓN PARA AGREGAR PRODUCTO A LA TABLA SIN RECARGAR
// ============================================
window.addProductToTable = function(product) {
    console.log('Agregando producto a la tabla:', product);
    
    const tbody = document.querySelector('.bg-white.divide-y.divide-gray-200');
    
    if (!tbody) {
        console.warn('No se encontró el tbody de la tabla');
        return;
    }
    
    // Si la tabla tiene un mensaje de "No hay productos", eliminarlo
    const emptyMessage = tbody.querySelector('tr td[colspan="10"]');
    if (emptyMessage && emptyMessage.parentElement) {
        emptyMessage.parentElement.remove();
    }
    
    // Crear la nueva fila
    const newRow = document.createElement('tr');
    newRow.className = 'hover:bg-gray-50';
    newRow.id = `product-row-${product.id}`;
    
    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    newRow.innerHTML = `
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">${product.id}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900">${escapeHtml(product.name)}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">${escapeHtml(product.sku || 'N/A')}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">${escapeHtml(product.code || 'N/A')}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">${product.unit ? escapeHtml(product.unit.name) : 'N/A'}</td>
        <td class="px-6 py-4 whitespace-nowrap">
            ${product.category ? `
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                      style="background-color: ${product.category.color}20; color: ${product.category.color}">
                    <span class="w-2 h-2 rounded-full mr-1" style="background-color: ${product.category.color}"></span>
                    ${escapeHtml(product.category.name)}
                </span>
            ` : `
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                    <span class="w-2 h-2 rounded-full bg-gray-400 mr-1"></span>
                    Sin categoría
                </span>
            `}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">$${parseFloat(product.default_cost || 0).toFixed(2)}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">$${parseFloat(product.default_price || 0).toFixed(2)}</td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex flex-col items-center space-y-2" data-id="${product.id}">
                <button onclick="toggleProductStatus(${product.id})"
                    class="group relative inline-flex items-center h-7 rounded-full w-14 transition-all duration-300 ${product.active ? 'bg-green-500' : 'bg-gray-300'}">
                    <span class="inline-block w-5 h-5 transform bg-white rounded-full transition-all duration-300 shadow-sm ${product.active ? 'translate-x-8' : 'translate-x-1'}"></span>
                </button>
                <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${product.active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                    <span class="w-1.5 h-1.5 rounded-full mr-1 ${product.active ? 'bg-green-500' : 'bg-red-500'}"></span>
                    ${product.active ? 'Activo' : 'Inactivo'}
                </span>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium space-x-2">
            <div class="relative group">
                <div class="flex space-x-4 justify-center">
                    <button onclick="editProduct(${product.id})"
                        class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-all duration-200 hover:scale-110 hover:shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                </div>
            </div>
        </td>
    `;
    
    tbody.prepend(newRow);
    
    // Actualizar contadores de estadísticas
    updateProductStatsAfterAdd();
    
    console.log('✅ Producto agregado a la tabla correctamente');
};

function updateProductStatsAfterAdd() {
    const statsElements = document.querySelectorAll('.grid.grid-cols-1.md\\:grid-cols-4 .text-2xl.font-bold.text-gray-900');
    if (statsElements.length >= 2) {
        const currentTotal = parseInt(statsElements[0].textContent) || 0;
        const currentActive = parseInt(statsElements[1].textContent) || 0;
        statsElements[0].textContent = currentTotal + 1;
        statsElements[1].textContent = currentActive + 1;
    }
}

window.updateProductInTable = function(product) {
    const row = document.getElementById(`product-row-${product.id}`);
    if (!row) {
        window.location.reload(); 
        return;
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    row.innerHTML = `
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">${product.id}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900">${escapeHtml(product.name)}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">${escapeHtml(product.sku || 'N/A')}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">${escapeHtml(product.code || 'N/A')}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">${product.unit ? escapeHtml(product.unit.name) : 'N/A'}</td>
        <td class="px-6 py-4 whitespace-nowrap">
            ${product.category ? `
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                      style="background-color: ${product.category.color}20; color: ${product.category.color}">
                    <span class="w-2 h-2 rounded-full mr-1" style="background-color: ${product.category.color}"></span>
                    ${escapeHtml(product.category.name)}
                </span>
            ` : `<span class="text-gray-400">Sin categoría</span>`}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">$${parseFloat(product.default_cost || 0).toFixed(2)}</td>
        <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">$${parseFloat(product.default_price || 0).toFixed(2)}</td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex flex-col items-center space-y-2">
                <button onclick="toggleProductStatus(${product.id})"
                    class="group relative inline-flex items-center h-7 rounded-full w-14 transition-all duration-300 ${product.active ? 'bg-green-500' : 'bg-gray-300'}">
                    <span class="inline-block w-5 h-5 transform bg-white rounded-full transition-all duration-300 shadow-sm ${product.active ? 'translate-x-8' : 'translate-x-1'}"></span>
                </button>
                <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${product.active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                    ${product.active ? 'Activo' : 'Inactivo'}
                </span>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium">
            <button onclick="editProduct(${product.id})" class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
            </button>
        </td>
    `;
    
    row.classList.add('bg-blue-50');
    setTimeout(() => row.classList.remove('bg-blue-50'), 2000);
};
</script>

</x-app-layout>