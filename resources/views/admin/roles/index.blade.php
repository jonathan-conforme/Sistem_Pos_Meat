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
  <div class="p-6">
     <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500"">
       <thead class="text-xs uppercase bg-gray-50">
    <tr class="text-gray-600">
        <th scope="col" class="px-6 py-3">ID</th>
        
        <th scope="col" class="px-6 py-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-user-tag"></i>
                <span>Nombre</span>
            </div>
        </th>
        
        <th scope="col" class="px-6 py-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-key"></i>
                <span>Permisos</span>
            </div>
        </th>
        
        <th scope="col" class="px-6 py-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-calendar-alt"></i>
                <span>Fecha de Creación</span>
            </div>
        </th>
        
        <th scope="col" class="px-6 py-3">
            <div class="flex items-center gap-2">
                <i class="fas fa-cogs"></i>
                <span>Acciones</span>
            </div>
        </th>
    </tr>
</thead>

            <tbody >
                @foreach ($roles as $role)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 text-black font-semibold py-2">{{ $role->id }}</td>
                        <td class="px-4 py-2">{{ $role->name }}</td>
                        <td class="px-4 py-2">
                            @foreach($role->permissions as $perm)
                            <span class="bg-green-200 px-2 py-1 rounded">{{ $perm->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-4 py-2">{{ $role->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <button data-modal-target="form-modal-{{ $role->id }}" data-modal-toggle="form-modal-{{ $role->id }}" class="group text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                                Editar
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de edición -->
                    <div id="form-modal-{{ $role->id }}" class="modal-overlay fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
                        <div class="modal-content relative bg-white rounded-lg shadow-lg max-w-md w-full max-h-[90vh] overflow-y-auto">
                            <div class="flex items-center justify-between p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">Editar Rol - {{ $role->name }}</h3>
                                <button type="button" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-toggle="form-modal-{{ $role->id }}">
                                    ✕
                                </button>
                            </div>

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
  </div>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </div>
         </div>
</x-app-layout>
