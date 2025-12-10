<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Botón de registro -->
            <div class="flex justify-end mb-4 mt-2">
                <button onclick="openModal()"
                    class="text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                    <i class="fas fa-user-plus mr-2"></i> Registrar
                </button>
            </div>

            <!-- Barra de búsqueda -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

                {{-- Tarjeta de total de facturas pendientes --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex items-center col-span-1 md:col-span-1">
                    <div class="p-3 bg-purple-100 rounded-lg flex-shrink-0">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total clientes registrados</p>
                        <p id="total-categories" class="text-2xl font-bold text-gray-900">{{ $totalCustomers }}</p>
                    </div>
                </div>

                {{-- Buscador --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 col-span-1 md:col-span-3">
                    <form method="GET" action="{{ route('customer.index') }}">
                        <div class="flex flex-col md:flex-row md:items-center md:gap-4">
                            <div class="flex-1">
                                <input type="text" name="search" placeholder="Buscar por factura, cédula o nombre"
                                    value="{{ old('search', request('search')) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="mt-4 md:mt-0 flex gap-2">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition-all">
                                    <i class="fas fa-search"></i> Buscar
                                </button>

                                <button type="button" onclick="window.location='{{ route('customer.create') }}'"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition-all">
                                    <i class="fas fa-eraser"></i> Limpiar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Modal Registrar/Editar Cliente -->
            <div id="form-modal"
                class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 p-4 transition-opacity duration-300">

                <!-- Contenedor -->
                <div class="relative bg-white w-full max-w-md rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300">

                    <!-- Encabezado fijo -->
                    <div class="flex items-center justify-between p-4 border-b bg-white">
                        <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Registrar Nuevo Cliente</h3>
                        <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Formulario -->
                    <form id="customer-form" method="POST" action="{{ route('customer.store') }}"
                        class="overflow-y-auto max-h-[60vh] p-4 space-y-4">
                        @csrf

                        <input type="hidden" id="customer_id" name="customer_id">
                        <!-- Campo oculto para guardar la página actual -->
                        <input type="hidden" id="current_page" name="current_page" value="{{ request('page', 1) }}">

                        <div class="space-y-3">
                            <!-- Campos -->
                            <div>
                                <label for="name" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                    <i class="fas fa-user text-gray-600 mr-2"></i> Apellidos y Nombres
                                </label>
                                <input type="text" id="name" name="name"
                                    class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                    placeholder="Ingrese sus nombres completos" value="{{ old('name') }}" required>
                            </div>

                            <div>
                                <label for="cedula" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                    <i class="fas fa-id-card text-gray-600 mr-2"></i> Cédula
                                </label>
                                <input type="text" id="cedula" name="cedula"
                                    class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                    placeholder="0999999999" value="{{ old('cedula') }}" required>
                            </div>

                            <div>
                                <label for="email" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                    <i class="fas fa-envelope text-gray-600 mr-2"></i> Correo Electrónico
                                </label>
                                <input type="email" id="email" name="email"
                                    class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                    placeholder="ejemplo@correo.com" value="{{ old('email') }}" required>
                            </div>

                            <div>
                                <label for="phone" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                    <i class="fas fa-phone text-gray-600 mr-2"></i> Teléfono
                                </label>
                                <input type="text" id="phone" name="phone"
                                    class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                    placeholder="0999999999" value="{{ old('phone') }}" required>
                            </div>

                            <div>
                                <label for="address" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                    <i class="fas fa-home text-gray-600 mr-2"></i> Dirección
                                </label>
                                <input type="text" id="address" name="address"
                                    class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                    placeholder="Ingrese su dirección" value="{{ old('address') }}" required>
                            </div>

                            <div>
                                <label for="comments" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                    <i class="fas fa-comment text-gray-600 mr-2"></i> Comentarios
                                </label>
                                <textarea id="comments" name="comments" rows="2"
                                    class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                    placeholder="Escribe tus comentarios aquí...">{{ old('comments') }}</textarea>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end pt-4 space-x-2 bg-white">
                            <button type="button" onclick="closeModal()"
                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                                Cancelar
                            </button>
                            <button id="submit-btn" type="submit"
                                class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-4 py-2 flex items-center">
                                <i class="fas fa-user-plus mr-2"></i> Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla de clientes -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Clientes</h2>

                <div class="bg-white overflow-x-auto sm:overflow-x-visible">
                    <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-500 align-middle">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr class="text-gray-600">
                                <th class="px-4 sm:px-6 py-3 text-left">Nombre</th>
                                <th class="px-4 sm:px-6 py-3 text-center">Cédula</th>
                                <th class="px-4 sm:px-6 py-3 text-center">Correo</th>
                                <th class="px-4 sm:px-6 py-3 text-center">Teléfono</th>
                                <th class="px-4 sm:px-6 py-3 text-center">Dirección</th>
                                <th class="px-4 sm:px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                            <tr id="row-{{ $customer->id }}" class="  @if (request()->edited == $customer->id)
            bg-yellow-200 animate-pulse
        @endif
        bg-white border-b hover:bg-gray-50 text-xs @if(session('highlight_customer_id') == $customer->id) bg-green-50 border-l-4 border-green-500 @endif"
                                id="customer-{{ $customer->id }}">
                                <td class="px-6 py-4 text-left font-medium text-gray-900">
                                    {{ $customer->name }}
                                    @if(session('highlight_customer_id') == $customer->id)
                                    <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Nuevo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">{{ $customer->cedula }}</td>
                                <td class="px-6 py-4 text-center">{{ $customer->email }}</td>
                                <td class="px-6 py-4 text-center">{{ $customer->phone }}</td>
                                <td class="px-6 py-4 text-center">{{ $customer->address }}</td>
                                <td class="px-6 py-4 flex justify-center items-center text-center align-middle">
                                    <!-- Botón Editar -->
                                    <div class="relative group">
                                        <button onclick="editCustomer({{ json_encode($customer) }})"
                                            class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 
                                                       transition-all duration-200 hover:scale-110 hover:shadow-sm
                                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                            title="Editar cliente">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <!-- Tooltip -->
                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block">
                                            <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                                Editar cliente
                                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-600">No hay clientes registrados.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    <div class="p-4">{{ $customers->links() }}</div>
                </div>
            </div>
        </div>
        <!-- Contenedor para las notificaciones -->
        <div id="notification-container" class="fixed top-4 right-4 space-y-4 z-50"></div>
    </div>
    <script>
        const modal = document.getElementById('form-modal');
        const title = document.getElementById('modal-title');
        const form = document.getElementById('customer-form');
        const submitBtn = document.getElementById('submit-btn');

        const notificationDurations = {
            success: 1000,
            error: 5000,
            info: 3000,
            warning: 4000
        };

        // --- Modal ---
        function openModal(clearData = true) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            if (clearData) resetForm();
        }

        function closeModal() {
            showNotification('Edición cancelada.', 'warning'); 
            
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function resetForm() {
            form.reset();
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
            form.action = "{{ route('customer.store') }}";
            title.textContent = "Registrar Nuevo Cliente";
            submitBtn.innerHTML = '<i class="fas fa-user-plus mr-2"></i> Guardar';
            document.getElementById('customer_id').value = "";

            // Restaurar la página actual en el formulario de registro
            const currentPage = new URLSearchParams(window.location.search).get("page") || 1;
            document.getElementById('current_page').value = currentPage;
        }

        function editCustomer(customer) {
            openModal(false);
            title.textContent = "Editar Cliente";
            submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Actualizar';

            // Obtener la página actual de la URL
            const currentPage = new URLSearchParams(window.location.search).get("page") || 1;

            // Configurar el formulario para edición
            form.action = `/customer/${customer.id}?page=${currentPage}`;

            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            // Guardar la página actual en el campo oculto
            document.getElementById('current_page').value = currentPage;

            document.getElementById('customer_id').value = customer.id;
            document.getElementById('name').value = customer.name;
            document.getElementById('cedula').value = customer.cedula;
            document.getElementById('email').value = customer.email;
            document.getElementById('phone').value = customer.phone;
            document.getElementById('address').value = customer.address;
            document.getElementById('comments').value = customer.comments ?? '';
        }

        // --- Cerrar modal ---
        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });

        // --- Notificaciones ---
        function showNotification(message, type = 'info') {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');

            const styles = {
                success: 'bg-green-600 text-white border-l-4 border-green-700',
                error: 'bg-red-600 text-white border-l-4 border-red-700',
                info: 'bg-blue-600 text-white border-l-4 border-blue-700',
                warning: 'bg-orange-600 text-white border-l-4 border-orange-700'
            };

            const duration = notificationDurations[type] || 3000;

            notification.className = `p-4 rounded-lg shadow-lg flex items-center transform transition-all duration-300 translate-x-full opacity-0 ${styles[type]}`;
            notification.innerHTML = `
        <span class="flex-1">${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-4 text-white hover:opacity-70 transition-opacity">&times;</button>
    `;

            container.appendChild(notification);

            requestAnimationFrame(() => {
                notification.classList.remove('translate-x-full', 'opacity-0');
                notification.classList.add('translate-x-0', 'opacity-100');
            });

            setTimeout(() => {
                if (notification.parentElement) {
                    notification.classList.remove('translate-x-0', 'opacity-100');
                    notification.classList.add('translate-x-full', 'opacity-0');
                    setTimeout(() => {
                        if (notification.parentElement) notification.remove();
                    }, 300);
                }
            }, duration);
        }

        // --- Quitar resaltado de cliente nuevo después de 5 segundos ---
        document.addEventListener('DOMContentLoaded', function() {
            const highlightedRow = document.querySelector('.bg-green-50');
            if (highlightedRow) {
                setTimeout(() => {
                    highlightedRow.classList.remove('bg-green-50', 'border-l-4', 'border-green-500');
                    const newBadge = highlightedRow.querySelector('span');
                    if (newBadge) {
                        newBadge.remove();
                    }
                }, 5000);
            }
        });

        // --- Mostrar modal y errores automáticamente ---
        @if($errors -> any())
        document.addEventListener('DOMContentLoaded', () => {
            openModal(false);
            let errors = @json($errors -> all());
            errors.forEach(err => showNotification(err, 'error'));
        });
        @endif

        // --- Notificaciones desde sesión ---
        @if(session('success'))
        document.addEventListener('DOMContentLoaded', () => showNotification("{{ session('success') }}", 'success'));
        @endif

        @if(session('error'))
        document.addEventListener('DOMContentLoaded', () => showNotification("{{ session('error') }}", 'error'));
        @endif
        @if(session('info'))
    document.addEventListener('DOMContentLoaded', () =>
        showNotification("{{ session('info') }}", 'info')
    );
@endif
        @if(session('warning'))
        document.addEventListener('DOMContentLoaded', () => showNotification("{{ session('warning') }}", 'warning'));
        @endif
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const edited = "{{ request()->edited }}";

            if (edited) {
                const row = document.getElementById("row-" + edited);
                if (row) {
                    row.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });

                    // (Opcional) resaltar la fila suavemente
                    row.classList.add("bg-yellow-200");
                    setTimeout(() => row.classList.remove("bg-yellow-200"), 2500);
                }
            }
        });
        
    </script>

</x-app-layout>