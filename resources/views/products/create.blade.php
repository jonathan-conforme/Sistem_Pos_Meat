<x-app-layout>
    <div class="container mx-auto p-4">
        <!-- Botón de registro -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestión de Productos</h1>
                <p class="text-gray-600">Administra los productos de tu sistema</p>
            </div>
            <button data-modal-target="form-modal" data-modal-toggle="form-modal" class="group text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 btn-hover-effect flex items-center">
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
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['lowStockProducts'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Principal de Producto -->
        <div id="form-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
            <div class="modal-content relative bg-white rounded-lg shadow-lg max-w-4xl w-full max-h-[95vh] overflow-y-auto">
                <!-- Encabezado del modal -->
                <div class="flex items-center justify-between p-6 border-b rounded-t bg-gray-50">
                    <h3 class="text-xl font-semibold text-gray-900">Registrar Nuevo Producto</h3>
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
                        <!-- NUEVO CAMPO: CATEGORÍA -->
                        <div>
                            <label for="unit_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipo de unidad *
                            </label>
                            <select
                                id="unit_type"
                                name="unit_type"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                <option value="">Seleccione...</option>
                                <option value="lb" {{ old('unit_type') == 'lb' ? 'selected' : '' }}>Libra (lb)</option>
                                <option value="unit" {{ old('unit_type') == 'unit' ? 'selected' : '' }}>Unidad</option>
                                <option value="package" {{ old('unit_type') == 'package' ? 'selected' : '' }}>Paquete</option>
                            </select>
                            @error('unit_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
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

                    <!-- Sección: Gestión de Inventario -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-4 bg-yellow-50 rounded-lg">
                        <h4 class="md:col-span-3 text-lg font-semibold text-yellow-800 mb-2">Gestión de Inventario</h4>

                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Cantidad Inicial
                            </label>
                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                step="0.001"
                                min="0"
                                value="{{ old('quantity', 0) }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200">
                            @error('quantity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="min_stock" class="block text-sm font-medium text-gray-700 mb-2">
                                Stock Mínimo
                            </label>
                            <input
                                type="number"
                                id="min_stock"
                                name="min_stock"
                                step="0.001"
                                min="0"
                                value="{{ old('min_stock', 0) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="max_stock" class="block text-sm font-medium text-gray-700 mb-2">
                                Stock Máximo
                            </label>
                            <input
                                type="number"
                                id="max_stock"
                                name="max_stock"
                                step="0.001"
                                min="0"
                                value="{{ old('max_stock') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition duration-200">
                        </div>
                    </div>

                    <!-- Sección: Fechas Importantes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-purple-50 rounded-lg">
                        <h4 class="md:col-span-2 text-lg font-semibold text-purple-800 mb-2">Fechas Importantes</h4>

                        <div>
                            <label for="entry_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de Ingreso
                            </label>
                            <input
                                type="date"
                                id="entry_date"
                                name="entry_date"
                                value="{{ old('entry_date', now()->format('Y-m-d')) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
                        </div>

                        <div>
                            <label for="expiration_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de Expiración
                            </label>
                            <input
                                type="date"
                                id="expiration_date"
                                name="expiration_date"
                                value="{{ old('expiration_date') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition duration-200">
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
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form method="GET" action="{{ route('admin.products.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar producto..."
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
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
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $product->unit_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-900">
                                {{ $product->quantity }}
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
                                <div class="flex space-x-4 justify-center">
                                    <button
                                        onclick="editProduct({{ $product->id }})"
                                        class="text-blue-600 hover:text-blue-900 flex items-center space-x-1">
                                        <i class="fas fa-edit"></i>
                                    </button>
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
            console.log('✅ Script cargado correctamente');

            /* --------------------------------------------------------------------------
             * 🔧 ELEMENTOS PRINCIPALES Y MODAL
             * -------------------------------------------------------------------------- */
            const modalEl = document.getElementById('form-modal');
            const formModal = new Modal(modalEl);
            const form = document.getElementById('product-form');
            const saveBtn = document.getElementById('save-product-btn');

            /* --------------------------------------------------------------------------
             * 🔠 GENERAR SKU AUTOMÁTICAMENTE SEGÚN EL NOMBRE
             * -------------------------------------------------------------------------- */
            document.getElementById('name').addEventListener('input', async function() {
                const name = this.value.trim();
                const skuInput = document.getElementById('sku');

                if (!name) {
                    skuInput.value = '';
                    return;
                }

                // Toma las primeras 3 letras del nombre
                const words = name.split(' ').filter(w => w.length > 0);
                let prefix = words.map(w => w[0].toUpperCase()).join('').slice(0, 3);
                while (prefix.length < 3) prefix += 'X';

                try {
                    // Petición al backend para obtener el siguiente SKU disponible
                    const response = await fetch(`{{ route('admin.products.create') }}?prefix=${prefix}`);
                    const data = await response.json();
                    skuInput.value = data.nextSku || `${prefix}-001`;
                } catch (err) {
                    console.error('❌ Error al generar SKU:', err);
                    skuInput.value = `${prefix}-001`;
                }
            });

            /* --------------------------------------------------------------------------
             * 💾 MANEJO DE FORMULARIO (CREAR Y EDITAR PRODUCTO)
             * -------------------------------------------------------------------------- */

            // 🔹 Captura el envío del formulario
            form.addEventListener('submit', async function(e) {
                e.preventDefault(); // Evita recargar la página
                const productId = form.dataset.productId || null; // Si tiene data-product-id, edita; si no, crea
                await saveProduct(productId);
            });

            // 🔹 Función principal para crear o actualizar producto
            async function saveProduct(productId = null) {
                console.log('💾 Iniciando guardado...');

                const url = productId ?
                    `/admin/products/${productId}` :
                    "{{ route('admin.products.store') }}";

                const formData = new FormData(form);
                if (productId) formData.append('_method', 'PUT'); // Laravel necesita esto
                formData.append('active', form.querySelector('#active').checked ? 1 : 0);

                // 🔄 Desactivar botón
                const originalBtnContent = saveBtn.innerHTML;
                saveBtn.disabled = true;
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Guardando...';

                try {
                    const response = await fetch(url, {
                        method: 'POST', // Laravel usará PUT internamente si tiene _method
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

                    // ⚠️ Validación fallida (422)
                    if (response.status === 422) {
                        const messages = Object.values(data.errors || {})
                            .flat()
                            .join('\n');

                        Swal.fire({
                            icon: 'warning',
                            title: 'Error de validación',
                            text: messages || 'Revise los campos obligatorios.',
                        });
                        return;
                    }

                    // ⚠️ Error del servidor
                    if (!response.ok) {
                        throw new Error(data.message || `Error ${response.status}`);
                    }

                    // ✅ Éxito
                    if (data.success) {
                        console.log('✅ Producto guardado exitosamente');
                        formModal.hide();
                        form.reset();
                        document.getElementById('sku').value = '';

                        if (typeof addProductToTable === 'function') {
                            addProductToTable(data.product);
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
                    console.error('❌ Error al guardar producto:', error);
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
             * 🟢🔴 ACTIVAR / DESACTIVAR PRODUCTO (Toggle)
             * -------------------------------------------------------------------------- */
            window.toggleProductStatus = async function(id) {
                console.log('🔁 Toggle de estado para producto:', id);

                const button = event.currentTarget;
                const isCurrentlyActive = button.classList.contains('bg-green-500');
                const newState = !isCurrentlyActive;

                try {
                    // Confirmación con SweetAlert2
                    const confirmed = await Swal.fire({
                        title: newState ? '¿Activar producto?' : '¿Desactivar producto?',
                        text: newState ?
                            'El producto estará disponible para ventas.' : 'El producto dejará de estar disponible para ventas.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, continuar',
                        cancelButtonText: 'Cancelar',
                        customClass: {
                            popup: 'rounded-lg shadow-xl',
                            title: 'text-lg font-semibold',
                            confirmButton: 'px-4 py-2 rounded-lg font-medium bg-green-600 text-white hover:bg-green-700',
                            cancelButton: 'px-4 py-2 rounded-lg font-medium bg-gray-200 text-gray-700 hover:bg-gray-300'
                        }
                    });

                    if (!confirmed.isConfirmed) return;

                    // 🟡 Actualización visual inmediata (optimistic UI)
                    updateProductUI(id, newState);

                    // 📨 Petición al backend
                    const response = await fetch(`/admin/products/${id}/toggle`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        if (data.stats) updateStats(data.stats);

                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        // 🔴 Revertir cambio si hay error
                        updateProductUI(id, isCurrentlyActive);
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('❌ Error en toggle:', error);
                    updateProductUI(id, isCurrentlyActive);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message || 'No se pudo cambiar el estado del producto.'
                    });
                }
            };

            /* --------------------------------------------------------------------------
             * ✏️ EDITAR PRODUCTO (Cargar datos en modal)
             * -------------------------------------------------------------------------- */
            window.editProduct = async function(productId) {
                try {
                    const saveBtn = document.getElementById('save-product-btn');
                    saveBtn.textContent = 'Actualizar Producto';

                    const response = await fetch(`/admin/products/${productId}/edit`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();

                    if (!data.product) throw new Error('No se encontraron datos');

                    // Rellenar campos
                    const p = data.product;
                    form.querySelector('#name').value = p.name;
                    form.querySelector('#sku').value = p.sku;
                    form.querySelector('#code').value = p.code || '';
                    form.querySelector('#unit_type').value = p.unit_type;
                    form.querySelector('#default_cost').value = p.default_cost;
                    form.querySelector('#default_price').value = p.default_price;
                    form.querySelector('#quantity').value = p.quantity;
                    form.querySelector('#min_stock').value = p.min_stock;
                    form.querySelector('#max_stock').value = p.max_stock;
                    form.querySelector('#entry_date').value = p.entry_date;
                    form.querySelector('#expiration_date').value = p.expiration_date || '';

                    form.querySelector('#active').checked = p.active;
                    form.querySelector('#track_quantity').checked = p.track_quantity;
                    form.querySelector('#track_expiration').checked = p.track_expiration;

                    formModal.show();

                    // Cambiar comportamiento del submit a UPDATE
                    form.onsubmit = async function(e) {
                        e.preventDefault();
                        await saveProduct(productId);
                    };
                } catch (err) {
                    console.error('❌ Error al cargar producto:', err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo cargar la información del producto',
                        confirmButtonText: 'Cerrar'
                    });
                }
            };

            /* --------------------------------------------------------------------------
             * 📊 ACTUALIZAR ESTADÍSTICAS DE PRODUCTOS
             * -------------------------------------------------------------------------- */
            function updateStats(stats) {
                const ids = {
                    totalProducts: 'totalProducts',
                    activeProducts: 'activeProducts',
                    inactiveProducts: 'inactiveProducts',
                    lowStockProducts: 'lowStockProducts'
                };
                Object.entries(ids).forEach(([key, id]) => {
                    const el = document.getElementById(id);
                    if (el && stats[key] !== undefined) el.textContent = stats[key];
                });
            }

            /* --------------------------------------------------------------------------
             * 🧩 ACTUALIZAR LA UI DEL PRODUCTO (estado, badge, switch)
             * -------------------------------------------------------------------------- */
            function updateProductUI(productId, isActive) {
                // Encontrar la fila que contiene el producto (podemos usar el data-id en el div contenedor)
                const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                // Pero actualmente no tenemos data-product-id en la fila, así que mejor usamos el botón que tiene el onclick

                // En su lugar, podemos buscar el botón que tiene el onclick con el productId
                const button = document.querySelector(`button[onclick="toggleProductStatus(${productId})"]`);
                if (!button) return;

                // El contenedor del toggle y badge es el div con class "flex flex-col ..."
                const container = button.closest('div');

                // Actualizar el toggle (botón)
                button.classList.toggle('bg-green-500', isActive);
                button.classList.toggle('bg-gray-300', !isActive);
                button.classList.toggle('focus:ring-green-500', isActive);
                button.classList.toggle('focus:ring-gray-400', !isActive);

                // Actualizar el círculo dentro del toggle
                const circle = button.querySelector('span:last-child');
                if (circle) {
                    circle.classList.toggle('translate-x-8', isActive);
                    circle.classList.toggle('translate-x-1', !isActive);
                }

                // Actualizar el badge
                const badge = container.querySelector('.status-badge');
                if (badge) {
                    badge.textContent = isActive ? 'Activo' : 'Inactivo';
                    badge.className = `status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
              isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
          }`;

                    // Actualizar el punto del badge
                    const dot = badge.querySelector('span:first-child');
                    if (dot) {
                        dot.className = `w-1.5 h-1.5 rounded-full mr-1 ${
                  isActive ? 'bg-green-500' : 'bg-red-500'
              }`;
                    }
                }
            }

            /* --------------------------------------------------------------------------
             * ➕ AGREGAR PRODUCTO NUEVO A LA TABLA (sin recargar)
             * -------------------------------------------------------------------------- */
            function addProductToTable(product) {
                const tbody = document.querySelector('tbody');
                if (!tbody) return;

                const newRow = document.createElement('tr');
                newRow.className = 'hover:bg-gray-50';
                newRow.innerHTML = `
            <td class="px-6 py-4 text-sm">${product.id}</td>
            <td class="px-6 py-4 text-sm font-medium">${product.name}</td>
            <td class="px-6 py-4 text-sm">${product.sku}</td>
            <td class="px-6 py-4 text-sm">${product.code || 'N/A'}</td>
            <td class="px-6 py-4 text-sm"><span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">${product.unit_type}</span></td>
            <td class="px-6 py-4 text-sm">${parseFloat(product.quantity).toFixed(3)}</td>
            <td class="px-6 py-4 text-sm">$${parseFloat(product.default_cost || 0).toFixed(2)}</td>
            <td class="px-6 py-4 text-sm">$${parseFloat(product.default_price || 0).toFixed(2)}</td>
            <td class="px-6 py-4 text-sm">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                    product.active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                }">${product.active ? 'Activo' : 'Inactivo'}</span>
            </td>
            <td class="px-6 py-4 text-sm">
                <button onclick="editProduct(${product.id})" class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-edit"></i>
                </button>
            </td>
            <td class="px-6 py-4 text-sm">
                <button onclick="toggleProductStatus(${product.id})"
                    class="relative inline-flex items-center h-6 w-11 rounded-full transition-colors duration-300 ${
                        product.active ? 'bg-green-500' : 'bg-gray-300'
                    }">
                    <span class="sr-only">Toggle</span>
                    <span class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform duration-300 ${
                        product.active ? 'translate-x-6' : 'translate-x-1'
                    }"></span>
                </button>
            </td>
        `;
                tbody.insertBefore(newRow, tbody.firstChild);
            }

            /* --------------------------------------------------------------------------
             * 📈 CÁLCULO AUTOMÁTICO DEL MARGEN DE GANANCIA
             * -------------------------------------------------------------------------- */
            function updateProfitMargin() {
                const cost = parseFloat(document.getElementById('default_cost').value) || 0;
                const price = parseFloat(document.getElementById('default_price').value) || 0;
                const marginElement = document.getElementById('profit-margin');
                const margin = cost > 0 && price > cost ? ((price - cost) / cost) * 100 : 0;

                marginElement.querySelector('span:last-child').textContent = `${margin.toFixed(1)}%`;

                marginElement.classList.toggle('text-green-600', margin > 50);
                marginElement.classList.toggle('text-yellow-600', margin > 20 && margin <= 50);
                marginElement.classList.toggle('text-red-600', margin <= 20);
            }

            document.getElementById('default_cost').addEventListener('input', updateProfitMargin);
            document.getElementById('default_price').addEventListener('input', updateProfitMargin);
        });
    </script>

</x-app-layout>