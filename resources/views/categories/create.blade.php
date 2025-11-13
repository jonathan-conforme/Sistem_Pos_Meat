<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Header con Botón -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Gestión de Categorías</h1>
                    <p class="text-gray-600">Administra las categorías de tu sistema</p>
                </div>
                <button onclick="openCategoryModal()"
                    class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 flex items-center shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nueva Categoría
                </button>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Categorías</p>
                            <p id="total-categories" class="text-2xl font-bold text-gray-900">{{ $categories->total() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Activas</p>
                            <p id="active-categories" class="text-2xl font-bold text-gray-900">{{ $categories->where('is_active', true)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-orange-100 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Inactivas</p>
                            <p id="inactive-categories" class="text-2xl font-bold text-gray-900">{{ $categories->where('is_active', false)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Con Productos</p>
                            <p id="with-products" class="text-2xl font-bold text-gray-900">{{ $categories->where('products_count', '>', 0)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barra de Búsqueda y Filtros -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input
                                type="text"
                                id="search-input"
                                placeholder="Buscar categorías..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                                onkeyup="filterTable()">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <select
                            id="status-filter"
                            onchange="filterTable()"
                            class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                            <option value="">Todos los estados</option>
                            <option value="active">Activas</option>
                            <option value="inactive">Inactivas</option>
                        </select>

                       
                    </div>
                    <div class="flex gap-4">
                     <select
                            id="parent-filter"
                            onchange="filterTable()"
                            class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200">
                            <option value="">Todas las categorías</option>
                            <option value="main">Solo principales</option>
                            <option value="sub">Solo subcategorías</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tabla Moderna de Categorías -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full" id="categories-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="sortTable(0)">
                                    <div class="flex items-center">
                                        Nombre
                                        <svg class="w-4 h-4 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Padre</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productos</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition duration-150 category-row"
                                data-name="{{ strtolower($category->name) }}"
                                data-status="{{ $category->is_active ? 'active' : 'inactive' }}"
                                data-parent="{{ $category->parent_id ? 'sub' : 'main' }}"
                                data-id="{{ $category->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                                        <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                                    </div>
                                    @if($category->description)
                                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit($category->description, 50) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $category->code ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $category->parent->name ?? '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $category->products_count > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $category->products_count }} productos
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col items-center space-y-2" data-id="{{ $category->id }}">
                                        <!-- Toggle Mejorado -->
                                        <button onclick="toggleCategoryStatus({{ $category->id }})"
                                            class="group relative inline-flex items-center h-7 rounded-full w-14 transition-all duration-300 
                                            {{ $category->is_active ? 'bg-green-500' : 'bg-gray-300' }} 
                                            hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 
                                            {{ $category->is_active ? 'focus:ring-green-500' : 'focus:ring-gray-400' }}"
                                            title="{{ $category->is_active ? 'Desactivar categoría' : 'Activar categoría' }}">
                                            <span class="sr-only">Toggle status</span>
                                            <span class="inline-block w-5 h-5 transform bg-white rounded-full transition-all duration-300 shadow-sm
                                                {{ $category->is_active ? 'translate-x-8' : 'translate-x-1' }}
                                                group-hover:scale-110"></span>
                                        </button>

                                        <!-- Badge de Estado Mejorado -->
                                        <span class="status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1 
                                                {{ $category->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                            {{ $category->is_active ? 'Activa' : 'Inactiva' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $category->sort_order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center space-x-3">
                                        <!-- Botón Editar -->
                                        <div class="relative group">
                                            <button onclick="editCategory({{ $category->id }})"
                                                class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 
                                                       transition-all duration-200 hover:scale-110 hover:shadow-sm
                                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                                title="Editar categoría">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <!-- Tooltip -->
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block">
                                                <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                                    Editar categoría
                                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Botón Eliminar -->
                                        <div class="relative group">
                                            <button onclick="deleteCategory({{ $category->id }})"
                                                class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 
                                                       transition-all duration-200 hover:scale-110 hover:shadow-sm
                                                       focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                                title="Eliminar categoría">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                            <!-- Tooltip -->
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block">
                                                <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                                    Eliminar categoría
                                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-8V4a1 1 0 00-1-1h-2a1 1 0 00-1 1v1M9 7h6" />
                                    </svg>
                                    <p class="mt-2 text-lg font-medium text-gray-900">No hay categorías registradas</p>
                                    <p class="text-gray-600">Comienza creando tu primera categoría</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                @if($categories->hasPages())
                <div class="bg-white px-6 py-4 border-t border-gray-200">
                    {{ $categories->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- === MODAL PARA NUEVA/EDITAR CATEGORÍA (FALTABA ESTE MODAL) === -->
    <div id="category-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden bg-black bg-opacity-50">
        <div class="modal-content relative bg-white rounded-2xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0">
            <!-- Encabezado -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 flex items-center" id="modal-title">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nueva Categoría
                </h3>
                <button type="button" onclick="closeCategoryModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-lg hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Formulario -->
            <form id="category-form" class="p-6 space-y-4" method="POST">
                @csrf
                <input type="hidden" id="category_id" name="id">

                <!-- Nombre -->
                <div>
                    <label for="category_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Categoría *
                    </label>
                    <input
                        type="text"
                        id="category_name"
                        name="name"
                        required
                        oninput="generateCategoryCode()"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 placeholder-gray-400"
                        placeholder="Ej: Lácteos y Huevos">
                </div>

                <!-- Código Automático -->
                <div>
                    <label for="category_code" class="block text-sm font-medium text-gray-700 mb-2">
                        Código Único
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="category_code"
                            name="code"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600 font-mono text-sm">
                        <button type="button" onclick="regenerateCode()"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 p-1 text-gray-400 hover:text-green-600 transition-colors duration-200"
                            title="Regenerar código">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Categoría Padre -->
                <div>
                    <label for="category_parent" class="block text-sm font-medium text-gray-700 mb-2">
                        Categoría Padre
                    </label>
                    <select
                        id="category_parent"
                        name="parent_id"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        <option value="">Sin categoría padre</option>
                        @foreach($categories->where('parent_id', null) as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Color -->
                <div>
                    <label for="category_color" class="block text-sm font-medium text-gray-700 mb-2">
                        Color
                    </label>
                    <input
                        type="color"
                        id="category_color"
                        name="color"
                        value="#6B7280"
                        class="w-full h-12 px-1 py-1 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                </div>

                <!-- Orden -->
                <div>
                    <label for="category_sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                        Orden
                    </label>
                    <input
                        type="number"
                        id="category_sort_order"
                        name="sort_order"
                        value="0"
                        min="0"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                </div>

                <!-- Estado -->
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="category_is_active"
                        name="is_active"
                        value="1"
                        checked
                        class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="category_is_active" class="ml-2 text-sm font-medium text-gray-700">
                        Categoría activa
                    </label>
                </div>

                <!-- Descripción -->
                <div>
                    <label for="category_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>
                    <textarea
                        id="category_description"
                        name="description"
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none placeholder-gray-400"
                        placeholder="Descripción opcional de la categoría..."></textarea>
                </div>
            </form>

            <!-- Botones de Acción -->
            <div class="flex justify-end space-x-3 p-6 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                <button type="button" onclick="closeCategoryModal()"
                    class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:ring-2 focus:ring-gray-200 transition-all duration-200">
                    Cancelar
                </button>
                <button type="button" onclick="saveCategory()" id="save-category-btn"
                    class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 flex items-center shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Guardar Categoría
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para Vista Rápida -->
    <div id="quickview-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden bg-black bg-opacity-50">
        <div class="modal-content relative bg-white rounded-2xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0">
            <!-- Encabezado -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Vista Rápida
                </h3>
                <button type="button" onclick="closeQuickViewModal()"
                    class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1 rounded-lg hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Contenido -->
            <div class="p-6 space-y-4" id="quickview-content">
                <!-- Los datos se cargarán aquí dinámicamente -->
            </div>

            <!-- Botones de Acción -->
            <div class="flex justify-end space-x-3 p-6 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                <button type="button" onclick="closeQuickViewModal()"
                    class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 focus:ring-2 focus:ring-gray-200 transition-all duration-200">
                    Cerrar
                </button>
                <button type="button" id="quickview-edit-btn"
                    class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Editar
                </button>
            </div>
        </div>
    </div>

    <!-- Container para Notificaciones -->
    <div id="notification-container" class="fixed top-4 right-4 space-y-4 z-50"></div>

    <!-- JavaScript Mejorado -->
    <script>
        // =========================
        // 🔹 FUNCIONES DEL MODAL DE CATEGORÍA (FALTABAN)
        // =========================
        function openCategoryModal() {
            const modal = document.getElementById('category-modal');
            const content = modal.querySelector('.modal-content');

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 50);

            // Resetear formulario para nueva categoría
            document.getElementById('category-form').reset();
            document.getElementById('category_id').value = '';
            document.getElementById('category_color').value = '#6B7280';
            document.getElementById('category_is_active').checked = true;
            document.getElementById('modal-title').innerHTML = `
                <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Nueva Categoría
            `;
            document.getElementById('save-category-btn').innerHTML = `
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Guardar Categoría
            `;

            generateCategoryCode();
        }

        function closeCategoryModal() {
            const modal = document.getElementById('category-modal');
            const content = modal.querySelector('.modal-content');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // =========================
        // 🔹 GENERAR CÓDIGO AUTOMÁTICO
        // =========================
        function generateCategoryCode() {
            const name = document.getElementById('category_name').value;
            if (name.trim() === '') {
                document.getElementById('category_code').value = '';
                return;
            }

            const code = name
                .toUpperCase()
                .replace(/[^A-Z]/g, '')
                .substring(0, 6);

            document.getElementById('category_code').value = code || 'CAT' + Math.random().toString(36).substr(2, 3).toUpperCase();
        }

        function regenerateCode() {
            document.getElementById('category_code').value =
                'CAT' + Math.random().toString(36).substr(2, 4).toUpperCase();
        }

        // =========================
        // 🔹 MEJORAS UX/UI PARA TOGGLE Y ACCIONES
        // =========================

        // Función mejorada para toggle de estado
        async function toggleCategoryStatus(categoryId) {
            const button = document.querySelector(`[onclick="toggleCategoryStatus(${categoryId})"]`);
            const row = document.querySelector(`[data-id="${categoryId}"]`);

            // Animación inmediata para mejor feedback
            button.disabled = true;
            const isCurrentlyActive = button.classList.contains('bg-green-500');

            // Cambio visual inmediato
            button.classList.toggle('bg-green-500', !isCurrentlyActive);
            button.classList.toggle('bg-gray-300', isCurrentlyActive);

            const thumb = button.querySelector('span:last-child');
            thumb.classList.toggle('translate-x-8', !isCurrentlyActive);
            thumb.classList.toggle('translate-x-1', isCurrentlyActive);

            try {
                const response = await fetch(`/categories/${categoryId}/toggle`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showNotification(`Categoría ${!isCurrentlyActive ? 'activada' : 'desactivada'} correctamente`, 'success');

                    // Actualizar badge de estado
                    const badge = row.querySelector('.status-badge');
                    if (badge) {
                        badge.className = `status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${!isCurrentlyActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
                        badge.innerHTML = `
                            <span class="w-1.5 h-1.5 rounded-full mr-1 ${!isCurrentlyActive ? 'bg-green-500' : 'bg-red-500'}"></span>
                            ${!isCurrentlyActive ? 'Activa' : 'Inactiva'}
                        `;
                    }

                    // Actualizar estadísticas
                    if (typeof refreshStats === "function") {
                        refreshStats();
                    }
                } else {
                    throw new Error(data.message || 'Error al actualizar el estado');
                }
            } catch (error) {
                console.error('Error:', error);
                // Revertir en caso de error
                button.classList.toggle('bg-green-500', isCurrentlyActive);
                button.classList.toggle('bg-gray-300', !isCurrentlyActive);
                thumb.classList.toggle('translate-x-8', isCurrentlyActive);
                thumb.classList.toggle('translate-x-1', !isCurrentlyActive);

                showNotification(error.message || 'Error de conexión', 'error');
            } finally {
                button.disabled = false;
            }
        }

        // Función para abrir modal de edición
        async function editCategory(categoryId) {
            try {
                const response = await fetch(`/categories/${categoryId}/edit`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();

                if (!data.success) throw new Error(data.message || 'Error al cargar categoría');

                // Rellenar modal con los datos
                document.getElementById('category_id').value = data.category.id;
                document.getElementById('category_name').value = data.category.name;
                document.getElementById('category_code').value = data.category.code || '';
                document.getElementById('category_description').value = data.category.description || '';
                document.getElementById('category_color').value = data.category.color || '#6B7280';
                document.getElementById('category_sort_order').value = data.category.sort_order || 0;
                document.getElementById('category_parent').value = data.category.parent_id || '';
                document.getElementById('category_is_active').checked = data.category.is_active;

                // Actualizar título del modal
                document.getElementById('modal-title').innerHTML = `
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Editar Categoría
                `;
                document.getElementById('save-category-btn').innerHTML = `
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Actualizar Categoría
                `;

                // Abrir modal
                openCategoryModal();
            } catch (error) {
                console.error(error);
                showNotification(error.message || 'Error al cargar categoría', 'error');
            }
        }

        // Función para guardar categoría (crear o actualizar)
        async function saveCategory() {
            const form = document.getElementById('category-form');
            const formData = new FormData(form);
            const categoryId = document.getElementById('category_id').value;

            const url = categoryId ? `/categories/${categoryId}` : "{{ route('categories.store') }}";
            const method = categoryId ? 'PUT' : 'POST';

            const submitButton = document.getElementById('save-category-btn');

            // Mostrar loading
            submitButton.disabled = true;
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                ${categoryId ? 'Actualizando...' : 'Guardando...'}
            `;

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showNotification(
                        categoryId ? 'Categoría actualizada exitosamente!' : 'Categoría creada exitosamente!',
                        'success'
                    );
                    closeCategoryModal();

                    // Recargar la página para ver los cambios
                    setTimeout(() => location.reload(), 1000);
                } else {
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join(', ');
                        showNotification(errorMessages, 'error');
                    } else {
                        showNotification(data.message || 'Error al procesar la categoría', 'error');
                    }
                }

            } catch (error) {
                console.error('Error:', error);
                showNotification('Error de conexión: ' + error.message, 'error');
            } finally {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        }

        // Función para eliminar categoría
        async function deleteCategory(categoryId) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta categoría?')) {
                return;
            }

            try {
                const response = await fetch(`/categories/${categoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showNotification('Categoría eliminada correctamente', 'success');
                    // Recargar la página para ver los cambios
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification(data.message || 'Error al eliminar la categoría', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error de conexión', 'error');
            }
        }

        // Función de notificación
        function showNotification(message, type = 'info') {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');

            const styles = {
                success: 'bg-green-600 text-white border-l-4 border-green-700',
                error: 'bg-red-600 text-white border-l-4 border-red-700',
                info: 'bg-blue-600 text-white border-l-4 border-blue-700',
                warning: 'bg-orange-600 text-white border-l-4 border-orange-700'
            };

            const icons = {
                success: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                error: 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                info: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                warning: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z'
            };

            notification.className = `p-4 rounded-lg shadow-lg transform transition-all duration-300 ${styles[type]} animate-slide-in flex items-center`;
            notification.innerHTML = `
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${icons[type]}" />
                </svg>
                <span class="flex-1">${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-4 text-current hover:opacity-70">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

            container.appendChild(notification);

            setTimeout(() => {
                if (notification.parentElement) {
                    notification.classList.add('opacity-0', 'translate-x-full');
                    setTimeout(() => notification.remove(), 300);
                }
            }, 5000);
        }

        // Funciones para el modal de vista rápida
        function openQuickViewModal() {
            const modal = document.getElementById('quickview-modal');
            const content = modal.querySelector('.modal-content');

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 50);
        }

        function closeQuickViewModal() {
            const modal = document.getElementById('quickview-modal');
            const content = modal.querySelector('.modal-content');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Cerrar modales con ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeCategoryModal();
                closeQuickViewModal();
            }
        });

        // Función para filtrar tabla (básica)
        function filterTable() {
            const search = document.getElementById('search-input').value.toLowerCase();
            const status = document.getElementById('status-filter').value;
            const parent = document.getElementById('parent-filter').value;

            const rows = document.querySelectorAll('.category-row');

            rows.forEach(row => {
                const name = row.getAttribute('data-name');
                const rowStatus = row.getAttribute('data-status');
                const rowParent = row.getAttribute('data-parent');

                const nameMatch = name.includes(search);
                const statusMatch = !status || rowStatus === status;
                const parentMatch = !parent || rowParent === parent;

                row.style.display = nameMatch && statusMatch && parentMatch ? '' : 'none';
            });
        }
    </script>

    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }

        /* Mejoras para el toggle */
        .toggle-thumb {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Efectos hover mejorados */
        .action-btn {
            transition: all 0.2s ease-in-out;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }
    </style>
</x-app-layout>