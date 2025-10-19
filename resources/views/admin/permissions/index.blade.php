<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Gestión de Roles</h1>
        
        <table class="w-full mt-4 border">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Permisos</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $role->id }}</td>
                    <td class="px-4 py-2">{{ $role->name }}</td>
                    <td class="px-4 py-2">
                        @foreach($role->permissions as $perm)
                            <span class="bg-gray-200 px-2 py-1 rounded">{{ $perm->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <!-- Botón que abre modal -->
                        <button 
                            data-modal-target="form-modal-{{ $role->id }}" 
                            data-modal-toggle="form-modal-{{ $role->id }}"
                            class="group text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 text-green-500 group-hover:text-white mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 25 25">
                                <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
                            </svg> 
                            Editar
                        </button>
                    </td>
                </tr>

                <!-- Modal de edición de rol -->
                <div id="form-modal-{{ $role->id }}" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
                    <div class="modal-content relative bg-white rounded-lg shadow-lg max-w-md w-full max-h-[90vh] overflow-y-auto">
                        <!-- Encabezado del modal -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">Editar Rol - {{ $role->name }}</h3>
                            <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-toggle="form-modal-{{ $role->id }}">
                                ✕
                            </button>
                        </div>
                        
                        <!-- Formulario de edición -->
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="p-4 space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block font-medium">Permisos</label>
                                <div class="grid grid-cols-2 gap-2 max-h-60 overflow-y-auto">
                                    @foreach($permissions as $perm)
                                        <label class="flex items-center gap-2">
                                            <input 
                                                type="checkbox" 
                                                name="permissions[]" 
                                                value="{{ $perm->name }}"
                                                {{ $role->permissions->contains('name', $perm->name) ? 'checked' : '' }}>
                                            {{ $perm->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex justify-end gap-2">
                                <button type="button" data-modal-toggle="form-modal-{{ $role->id }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                                    Cancelar
                                </button>
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                                    Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </div>
</x-app-layout>
