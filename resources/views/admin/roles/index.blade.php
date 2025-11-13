<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Gestión de Roles</h1>

        <div class="container mx-auto px-4 py-8 max-w-7xl">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white rounded-xl p-6 mb-8 shadow-lg">
                <div class="flex items-center">
                    <i class="fas fa-key text-4xl mr-4"></i>
                    <div>
                        <h1 class="text-3xl font-bold">Gestión de Permisos</h1>
                        <p class="text-blue-100 mt-2">Administra los permisos del sistema</p>
                    </div>
                </div>
            </div>

            <!-- Mensajes de éxito -->
            <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 hidden">
                <span id="success-text"></span>
            </div>

            <!-- Mensajes de error -->
            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 hidden">
                <ul id="error-list" class="list-disc list-inside"></ul>
            </div>
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-list mr-2"></i>Permisos Existentes
                    </h2>
                </div>


                <!-- table roles -->
                <div class="p-6">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-gray-600">
                            <thead class="text-xs font-semibold uppercase bg-gray-50 text-gray-700">
                                <tr>
                                    <th class="px-4 py-3 text-center w-16">ID</th>

                                    <th class="px-6 py-3 text-left">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-user-tag text-blue-500"></i>
                                            <span>Nombre</span>
                                        </div>
                                    </th>

                                    <th class="px-6 py-3 text-left">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-key text-yellow-500"></i>
                                            <span>Permisos</span>
                                        </div>
                                    </th>

                                    <th class="px-6 py-3 text-center w-40">
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fas fa-calendar-alt text-green-500"></i>
                                            <span>Fecha</span>
                                        </div>
                                    </th>

                                    <th class="px-6 py-3 text-center w-32">
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fas fa-cogs text-gray-500"></i>
                                            <span>Acciones</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($roles as $role)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-center font-semibold text-gray-700">{{ $role->id }}</td>

                                    <td class="px-6 py-3 text-gray-800 capitalize">{{ $role->name }}</td>

                                    <td class="px-6 py-3">
                                        @foreach($role->permissions as $perm)
                                        <span class="inline-block bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                            {{ $perm->name }}
                                        </span>
                                        @endforeach
                                    </td>

                                    <td class="px-6 py-3 text-center text-gray-700">
                                        {{ $role->created_at->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center items-center">
                                            <!-- Botón Editar -->
                                            <div class="relative group">
                                                <button data-modal-target="form-modal-{{ $role->id }}" data-modal-toggle="form-modal-{{ $role->id }}"
                                                    class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 
                                       transition-all duration-200 hover:scale-110 hover:shadow-sm
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>

                                                <!-- Tooltip -->
                                                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block">
                                                    <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                                        Editar Rol
                                                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal de edición -->
                                <div id="form-modal-{{ $role->id }}"
                                    class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
                                    <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl overflow-hidden animate-fadeIn">

                                        <!-- Header -->
                                        <div class="flex items-center justify-between p-5 border-b bg-gradient-to-r from-blue-50 to-white">
                                            <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                                </svg>
                                                Editar Rol — <span class="text-blue-600">{{ $role->name }}</span>
                                            </h2>
                                            <button type="button"
                                                data-modal-toggle="form-modal-{{ $role->id }}"
                                                class="text-gray-400 hover:text-gray-600 transition">
                                                ✕
                                            </button>
                                        </div>
                                        <div class="p-6">
                                            <div class="relative overflow-x-auto">
                                                <!-- Body -->
                                                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div>
                                                        <label class="block text-sm text-center font-semibold text-gray-700 mb-2">Permisos disponibles</label>
                                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 max-h-64 overflow-y-auto p-1">
                                                            @foreach($permissions as $perm)
                                                            <label class="flex items-center gap-2 p-3 rounded-lg border border-gray-200 hover:border-blue-400 hover:bg-blue-50 transition cursor-pointer">
                                                                <input type="checkbox"
                                                                    name="permissions[]"
                                                                    value="{{ $perm->name }}"
                                                                    class="text-blue-600 focus:ring-blue-500 rounded"
                                                                    {{ $role->permissions->contains('name', $perm->name) ? 'checked' : '' }}>
                                                                <span class="text-gray-700 text-sm">{{ ucfirst($perm->name) }}</span>
                                                            </label>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!-- Footer -->
                                                    <div class="flex justify-end gap-3 border-t pt-4">
                                                        <button type="button"
                                                            data-modal-toggle="form-modal-{{ $role->id }}"
                                                            class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-200 transition">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit"
                                                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                                            </svg>

                                                            Guardar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
</x-app-layout>