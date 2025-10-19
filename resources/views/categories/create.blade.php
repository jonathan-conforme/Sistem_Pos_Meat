<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="max-w-7xl mx-auto">

            <!-- Header con Botón -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Gestión de Categorías</h1>
                    <p class="text-gray-600">Administra las categorías de tu sistema</p>
                </div>
                <button
                    onclick="openCategoryModal()"
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
                            <p id="total-categories" class="text-2xl font-bold text-gray-900">0</p>
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
                            <p id="active-categories" class="text-2xl font-bold text-gray-900">0</p>
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
                            <p id="inactive-categories" class="text-2xl font-bold text-gray-900">0</p>
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
                            <p id="with-products" class="text-2xl font-bold text-gray-900">0</p>
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
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 transition duration-150 category-row"
                                data-name="{{ strtolower($category->name) }}"
                                data-status="{{ $category->is_active ? 'active' : 'inactive' }}"
                                data-parent="{{ $category->parent_id ? 'sub' : 'main' }}">
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
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $category->is_active ? 'Activa' : 'Inactiva' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $category->sort_order }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="editCategory({{ $category->id }})"
                                            class="text-blue-600 hover:text-blue-900 transition duration-150 p-1 rounded hover:bg-blue-50"
                                            title="Editar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>

                                        <button onclick="toggleStatus({{ $category->id }})"
                                            class="text-orange-600 hover:text-orange-900 transition duration-150 p-1 rounded hover:bg-orange-50"
                                            title="{{ $category->is_active ? 'Desactivar' : 'Activar' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>

                                        <button onclick="deleteCategory({{ $category->id }})"
                                            class="text-red-600 hover:text-red-900 transition duration-150 p-1 rounded hover:bg-red-50"
                                            title="Eliminar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
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

    <!-- Modal para Nueva Categoría -->
    <div id="category-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden bg-black bg-opacity-50">
        <div class="modal-content relative bg-white rounded-2xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto transform transition-all duration-300 scale-95 opacity-0">
            <!-- Encabezado -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
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
            <form id="category-form" class="p-6 space-y-4">
                @csrf

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
                            readonly
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
                <button type="button" onclick="saveCategory()"
                    class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 rounded-xl hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 flex items-center shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Guardar Categoría
                </button>
            </div>
        </div>
    </div>

    <!-- Container para Notificaciones -->
    <div id="notification-container" class="fixed top-4 right-4 space-y-4 z-50"></div>

    <!-- JavaScript -->
    <script>
        // =========================
        // 🔹 FUNCIONES DEL MODAL
        // =========================
        function openCategoryModal() {
            const modal = document.getElementById('category-modal');
            const content = document.querySelector('.modal-content');

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 50);

            generateCategoryCode();
        }

        function closeCategoryModal() {
            const modal = document.getElementById('category-modal');
            const content = document.querySelector('.modal-content');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('category-form').reset();
                document.getElementById('category_color').value = '#6B7280';
                document.getElementById('category_is_active').checked = true;
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
        // 🔹 FUNCIÓN GLOBAL PARA REFRESCAR ESTADÍSTICAS
        // =========================
        async function refreshStats() {
            try {
                const response = await fetch("{{ route('categories.stats') }}");
                const data = await response.json();

                if (data.success) {
                    document.getElementById("total-categories").textContent = data.total;
                    document.getElementById("active-categories").textContent = data.active;
                    document.getElementById("inactive-categories").textContent = data.inactive;
                    document.getElementById("with-products").textContent = data.with_products;
                } else {
                    showNotification(data.message || "No se pudieron actualizar las estadísticas", "warning");
                }

            } catch (error) {
                console.error("Error al obtener estadísticas:", error);
                showNotification("No se pudieron actualizar las estadísticas", "error");
            }
        }

        // =========================
        // 🔹 INICIALIZAR ESTADÍSTICAS AL CARGAR LA PÁGINA
        // =========================
        document.addEventListener('DOMContentLoaded', function() {
            refreshStats();
        });

        // =========================
        // 🔹 GUARDAR CATEGORÍA (SIN RECARGAR)
        // =========================
        async function saveCategory() {
            const form = document.getElementById('category-form');
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="button"]');

            // Mostrar loading
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Guardando...
            `;

            try {
                const response = await fetch('{{ route("categories.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    showNotification('Categoría creada exitosamente!', 'success');
                    closeCategoryModal();
                    // ✅ Actualizar estadísticas después de crear
                    await refreshStats();
                    // Recargar la página para ver la nueva categoría en la tabla
                    setTimeout(() => location.reload(), 1000);
                } else {
                    if (data.errors) {
                        showValidationErrors(data.errors);
                    } else {
                        showNotification(data.message || 'Error al crear la categoría', 'error');
                    }
                }

            } catch (error) {
                console.error('Error:', error);
                showNotification('Error de conexión: ' + error.message, 'error');
            } finally {
                submitButton.disabled = false;
                submitButton.innerHTML = `
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Guardar Categoría
                `;
            }
        }

        // =========================
        // 🔹 FUNCIONES PARA EDITAR, ELIMINAR Y CAMBIAR ESTADO
        // =========================
        async function editCategory(categoryId) {
            try {
                // Redirigir a la página de edición
                window.location.href = `/categories/${categoryId}/edit`;
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error de conexión', 'error');
            }
        }

        async function toggleStatus(categoryId) {
            if (!confirm('¿Estás seguro de que quieres cambiar el estado de esta categoría?')) {
                return;
            }

            try {
                const response = await fetch(`/categories/${categoryId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'X-HTTP-Method-Override': 'PATCH'
                    },
                    body: JSON.stringify({
                        is_active: false
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    showNotification('Estado actualizado correctamente', 'success');
                    await refreshStats();
                    // Recargar la página para ver los cambios
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showNotification(data.message || 'Error al actualizar el estado', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteCategory(categoryId) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta categoría?')) {
                return;
            }

            try {
                const response = await fetch(`/categories/${categoryId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showNotification('Categoría eliminada correctamente', 'success');
                    await refreshStats();
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

        // =========================
        // 🔹 FILTRO Y UTILIDADES
        // =========================
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

        function showValidationErrors(errors) {
            document.querySelectorAll('.error-message').forEach(el => el.remove());

            for (const field in errors) {
                const input = document.querySelector(`[name="${field}"]`);
                if (input) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message text-sm text-red-600 mt-1';
                    errorDiv.textContent = errors[field][0];
                    input.parentNode.appendChild(errorDiv);
                    input.classList.add('border-red-500');
                    setTimeout(() => input.classList.remove('border-red-500'), 5000);
                }
            }
        }

        function showNotification(message, type = 'info') {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');

            const styles = {
                success: 'bg-green-600 text-white',
                error: 'bg-red-600 text-white',
                info: 'bg-blue-600 text-white',
                warning: 'bg-orange-600 text-white'
            };

            notification.className = `p-4 rounded-lg shadow-lg transform transition-all duration-300 ${styles[type]} animate-slide-in`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>${message}</span>
                </div>
            `;

            container.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('opacity-0', 'translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Cerrar modal con ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeCategoryModal();
        });
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
        .hover-lift:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
        }
    </style>
</x-app-layout>