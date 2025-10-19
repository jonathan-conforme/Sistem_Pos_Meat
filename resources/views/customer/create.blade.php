<x-app-layout>

    <div class="container mx-auto p-4">
        <!-- Botón de registro -->
        <div class="flex justify-end p-2 mb-4">
            <button data-modal-target="form-modal" data-modal-toggle="form-modal" class="text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 btn-hover-effect flex items-center">
                <i class="fas fa-user-plus mr-2"></i> Registrar
            </button>
        </div>
        
        <!-- Barra de búsqueda -->
        <form method="GET" action="#" class="mb-6">
            <div class="relative">
                <input type="text" placeholder="Buscar cliente..." class="border border-gray-300 rounded-lg p-3 w-full pl-10 focus:outline-none focus:ring-2 focus:ring-green-400">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
        </form>
        
        <!-- Modal -->
        <div id="form-modal" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
            <div class="modal-content relative bg-white rounded-lg shadow-lg max-w-md w-full max-h-[90vh] overflow-y-auto">
                <!-- Encabezado del modal -->
                <div class="flex items-center justify-between p-4 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">Registrar Nuevo Cliente</h3>
                   <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="form-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                </div>
                
                <!-- Formulario -->
                <form method="POST" action="{{ route ('customer.store') }}" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4">
                        @csrf

                        <!-- Nombre -->
                        <div>
                            <label for="name" class="flex items-center block mb-2 text-sm font-medium text-gray-900">
                                <i class="fas fa-user text-gray-600 mr-2"></i>
                                Apellidos y Nombres
                            </label>
                            <input type="text" id="name" name="name" class="form-field border border-gray-300 rounded-lg p-2.5 w-full" placeholder="Apellido y nombre" required>
                        </div>
                        
                        <!-- Cédula -->
                        <div>
                            <label for="cedula" class="flex items-center block mb-2 text-sm font-medium text-gray-900">
                                <i class="fas fa-id-card text-gray-600 mr-2"></i>
                                Cédula
                            </label>
                            <input type="text" id="cedula" name="cedula" class="form-field border border-gray-300 rounded-lg p-2.5 w-full" placeholder="0999999999" required>
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="flex items-center block mb-2 text-sm font-medium text-gray-900">
                                <i class="fas fa-envelope text-gray-600 mr-2"></i>
                                Correo Electrónico
                            </label>
                            <input type="email" id="email" name="email" class="form-field border border-gray-300 rounded-lg p-2.5 w-full" placeholder="ejemplo@correo.com" required>
                        </div>
                        
                        <!-- Teléfono -->
                        <div>
                            <label for="phone" class="flex items-center block mb-2 text-sm font-medium text-gray-900">
                                <i class="fas fa-phone text-gray-600 mr-2"></i>
                                Teléfono
                            </label>
                            <input type="text" id="phone" name="phone" class="form-field border border-gray-300 rounded-lg p-2.5 w-full" placeholder="0999999999" required>
                        </div>
                        
                        <!-- Dirección -->
                        <div>
                            <label for="address" class="flex items-center block mb-2 text-sm font-medium text-gray-900">
                                <i class="fas fa-home text-gray-600 mr-2"></i>
                                Dirección
                            </label>
                            <input type="text" id="address" name="address" class="form-field border border-gray-300 rounded-lg p-2.5 w-full" placeholder="Ingrese su dirección" required>
                        </div>
                        
                        <!-- Comentarios -->
                        <div>
                            <label for="comments" class="flex items-center block mb-2 text-sm font-medium text-gray-900">
                                <i class="fas fa-comment text-gray-600 mr-2"></i>
                                Comentarios
                            </label>
                            <textarea id="comments" name="comments" rows="3" class="form-field border border-gray-300 rounded-lg p-2.5 w-full" placeholder="Escribe tus comentarios aquí..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="flex justify-end pt-4">
                        <button type="button" class="py-2.5 px-5 me-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100" data-modal-toggle="form-modal">
                            Cancelar
                        </button>
                        <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center">
                            <i class="fas fa-user-plus mr-2"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Clientes</h2>
                <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <thead class="text-xs uppercase bg-gray-50">
                    <tr class="text-gray-600">
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-tag"></i>
                                <span>Nombre</span>
                            </div>
                        </th>

                        

                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center gap-2">
                                 <i class="fas fa-id-card"></i>
                                <span>Cédula</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-at"></i>
                                <span>Correo</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-phone"></i>
                                <span>Teléfono</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center gap-2">
                               <i class="fas fa-home"></i>
                                <span>Dirección</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center gap-2">
                                  <i class="fas fa-comment"></i>
                                <span>Comentario</span>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <i class="fas fa-cogs"></i>
                                <span>Acciones</span>
                            </div>
                        </th>
                    </tr>
                </thead>
            </thead>

            <tbody>
                @forelse ($customers as $customer)
                <tr class="bg-white border-b hover:bg-gray-50 text-xs">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $customer->name }}</td>
                    <td class="px-6 py-4">{{ $customer->cedula }}</td>
                    <td class="px-6 py-4">{{ $customer->email }}</td>
                    <td class="px-6 py-4">{{ $customer->phone }}</td>
                    <td class="px-6 py-4">{{ $customer->address }}</td>
                    <td class="px-6 py-4">
                        @if($customer->comments)
                        <span class="badge bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">{{ $customer->comments }}</span>
                        @else
                        <span class="text-gray-400 text-xs">Sin comentarios</span>
                        @endif
                    </td>
                    <td class="flex justify-center items-center gap-2 px-6 py-4">
                        <!-- Editar -->
                        <button data-tooltip-target="tooltip-edit-{{ $customer->id }}" type="button"
                            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center">
                            <i class="fas fa-edit"></i>
                        </button>
                        <div id="tooltip-edit-{{ $customer->id }}" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white 
                        transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Editar cliente
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>

                        <!-- Eliminar -->
                        <form id="delete-form-{{ $customer->id }}" action="{{ route('customer.destroy', $customer) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button type="button"
                                data-modal-target="popup-modal-{{ $customer->id }}"
                                data-modal-toggle="popup-modal-{{ $customer->id }}"
                                data-tooltip-target="tooltip-delete-{{ $customer->id }}"
                                class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <div id="tooltip-delete-{{ $customer->id }}" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white 
                            transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                Eliminar cliente
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>

                            <!-- Modal de confirmación -->
                            <div id="popup-modal-{{ $customer->id }}" tabindex="-1"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <div class="relative bg-white rounded-lg shadow-sm">
                                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal-{{ $customer->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-500">
                                                ¿Seguro desea borrar el cliente {{ $customer->name }}?
                                            </h3>
                                            <button type="button" onclick="document.getElementById('delete-form-{{ $customer->id }}').submit();" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                                Sí, eliminar
                                            </button>
                                            <button data-modal-hide="popup-modal-{{ $customer->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700">
                                                No, cancelar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-600">No hay clientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $customers->links() }}
        </div>
    </div>

        </div>
    </div>
     <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-2">
                    @if(session('success'))
                    <x-toast message="{{ session('success') }}" type="success" />
                    @endif

                    @if(session('error'))
                    <x-toast message="{{ session('error') }}" type="error" />
                    @endif

                    @if(session('info'))
                    <x-toast message="{{ session('info') }}" type="info" />
                    @endif
                </div>


</x-app-layout>