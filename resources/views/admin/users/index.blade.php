<x-app-layout>
    <div class="container">
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white rounded-xl p-6 mb-8 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-users text-4xl mr-4"></i>
                    <div>
                        <h1 class="text-3xl font-bold">Gestión de Usuarios</h1>
                        <p class="text-blue-100 mt-2">Administra los usuarios y sus roles en el sistema</p>
                    </div>
                </div>
                <a href="{{ route('admin.register') }}" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Crear Nuevo Usuario
                </a>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-list mr-2"></i>Lista de Usuarios
                </h2>
            </div>
            <div class="p-6">
                <div class="relative overflow-x-auto ">
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
                                            <i class="fas fa-at"></i>
                                            <span>Correo</span>
                                        </div>
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-users-cog"></i>
                                            <span>Roles</span>
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
                            @foreach($users as $user)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @foreach($user->roles as $role)
                                    <span class="badge bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="flex justify-center items-center gap-2 px-6 py-4">
                                    <button data-tooltip-target="tooltip-edit-{{ $user->id }}" type="button"
                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
               hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
               dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div id="tooltip-edit-{{ $user->id }}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white 
               transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip 
               dark:bg-gray-700">
                                        Editar usuario
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')

                                        <!-- Botón para abrir modal con tooltip -->
                                        <button
                                            type="button"
                                            data-modal-target="popup-modal-{{ $user->id }}"
                                            data-modal-toggle="popup-modal-{{ $user->id }}"
                                            data-tooltip-target="tooltip-delete-{{ $user->id }}"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 
               hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 
               dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <!-- Tooltip -->
                                        <div id="tooltip-delete-{{ $user->id }}" role="tooltip"
                                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white 
               transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip 
               dark:bg-gray-700">
                                            Eliminar usuario
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>

                                        <!-- Modal -->
                                        <div id="popup-modal-{{ $user->id }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
               justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                                    <!-- Botón cerrar -->
                                                    <button type="button"
                                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                           hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex 
                           justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="popup-modal-{{ $user->id }}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-4 md:p-5 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                            ¿Seguro desea borrar el usuario {{ $user->name }}?
                                                        </h3>

                                                        <!-- Botón confirmar -->
                                                        <button type="button"
                                                            onclick="document.getElementById('delete-form-{{ $user->id }}').submit();"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none 
                               focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg 
                               text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                            Sí, estoy seguro
                                                        </button>

                                                        <!-- Botón cancelar -->
                                                        <button data-modal-hide="popup-modal-{{ $user->id }}" type="button"
                                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none 
                               bg-white rounded-lg border border-gray-200 hover:bg-gray-100 
                               hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 
                               dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 
                               dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                            No, cancelar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
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
            </div>
        </div>
    </div>
</x-app-layout>