<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="max-w-7xl mx-auto">
        <!-- Botón de registro -->
        <div class="flex justify-end mb-4 mt-2">
            <button data-modal-target="form-modal" data-modal-toggle="form-modal"
                onclick="openModal()"
                class="text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                <i class="fas fa-user-plus mr-2"></i> Registrar
            </button>
        </div>

        <!-- Barra de búsqueda -->
        <form method="GET" action="#" class="mb-6">
            <div class="relative">
                <input type="text" placeholder="Buscar cliente..."
                    class="border border-gray-300 rounded-lg p-3 w-full pl-10 focus:outline-none focus:ring-2 focus:ring-green-400">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </form>

        <!-- Modal Registrar/Editar Cliente -->
        <div id="form-modal"
            class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">

            <!-- Contenedor -->
            <div class="relative bg-white w-full h-full sm:h-auto sm:max-w-md sm:rounded-lg shadow-lg overflow-hidden">

                <!-- Encabezado fijo -->
                <div class="flex items-center justify-between p-4 border-b bg-white sticky top-0 z-10">
                    <h3 id="modal-title" class="text-lg font-semibold text-gray-900">Registrar Nuevo Cliente</h3>
                  
                </div>

                <!-- Formulario -->
                <form id="customer-form" method="POST" action="{{ route('customer.store') }}"
                    class="overflow-y-auto max-h-[calc(100vh-64px)] p-4 space-y-4">
                    @csrf
                    <input type="hidden" id="customer_id" name="customer_id">

                    <div class="space-y-3">
                        <!-- Campos -->
                        <div>
                            <label for="name" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                <i class="fas fa-user text-gray-600 mr-2"></i> Apellidos y Nombres
                            </label>
                            <input type="text" id="name" name="name"
                                class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                placeholder="Ingrese sus nombres completos" required>
                        </div>

                        <div>
                            <label for="cedula" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                <i class="fas fa-id-card text-gray-600 mr-2"></i> Cédula
                            </label>
                            <input type="text" id="cedula" name="cedula"
                                class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                placeholder="0999999999" required>
                        </div>

                        <div>
                            <label for="email" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                <i class="fas fa-envelope text-gray-600 mr-2"></i> Correo Electrónico
                            </label>
                            <input type="email" id="email" name="email"
                                class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                placeholder="ejemplo@correo.com" required>
                        </div>

                        <div>
                            <label for="phone" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                <i class="fas fa-phone text-gray-600 mr-2"></i> Teléfono
                            </label>
                            <input type="text" id="phone" name="phone"
                                class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                placeholder="0999999999" required>
                        </div>

                        <div>
                            <label for="address" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                <i class="fas fa-home text-gray-600 mr-2"></i> Dirección
                            </label>
                            <input type="text" id="address" name="address"
                                class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                placeholder="Ingrese su dirección" required>
                        </div>

                        <div>
                            <label for="comments" class="flex items-center mb-1 text-sm font-medium text-gray-900">
                                <i class="fas fa-comment text-gray-600 mr-2"></i> Comentarios
                            </label>
                            <textarea id="comments" name="comments" rows="2"
                                class="border border-gray-300 rounded-lg p-2 w-full text-sm"
                                placeholder="Escribe tus comentarios aquí..."></textarea>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end pt-4 space-x-2 sticky bottom-0 bg-white pb-2">
                       <button type="button" 
        data-modal-hide="form-modal"
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
                <table class="o min-w-full text-sm text-left text-gray-500 align-middle">
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
                        <tr class="bg-white border-b hover:bg-gray-50 text-xs">
                            <td class="px-6 py-4 text-left font-medium text-gray-900">{{ $customer->name }}</td>
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
                                                title="Editar clienter">
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
                            <td colspan="7" class="px-6 py-4 text-center text-gray-600">No hay clientes registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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

        function openModal() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            resetForm();
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetForm();
        }

        function resetForm() {
            form.reset();
            form.action = "{{ route('customer.store') }}";
            title.textContent = "Registrar Nuevo Cliente";
            submitBtn.innerHTML = '<i class="fas fa-user-plus mr-2"></i> Guardar';
            document.getElementById('customer_id').value = "";
        }

        function editCustomer(customer) {
            openModal();
            title.textContent = "Editar Cliente";
            submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Actualizar';
            form.action = `/customer/${customer.id}`;

            // Añadir método PUT
            if (!document.querySelector('input[name="_method"]')) {
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            }

            // Cargar datos
            document.getElementById('customer_id').value = customer.id;
            document.getElementById('name').value = customer.name;
            document.getElementById('cedula').value = customer.cedula;
            document.getElementById('email').value = customer.email;
            document.getElementById('phone').value = customer.phone;
            document.getElementById('address').value = customer.address;
            document.getElementById('comments').value = customer.comments ?? '';
        }

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
            }, 2000);
        }
    </script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showNotification("{{ session('success') }}", "success");
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showNotification("{{ session('error') }}", "error");
        });
    </script>
    @endif

    <style>
        html,
        body {
            overflow-x: hidden !important;
        }

        * {
            box-sizing: border-box;
        }
    </style>


</x-app-layout>