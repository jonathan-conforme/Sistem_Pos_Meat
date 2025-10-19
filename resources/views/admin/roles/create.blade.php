<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Crear Rol</h1>
        

        <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Nombre del Rol</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block font-medium">Permisos</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($permissions as $perm)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}">
                            {{ $perm->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
