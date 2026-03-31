<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unidades de Medida') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Tabla de unidades -->
                    <h1 class="text-2xl font-bold mb-4">Lista de Unidades de Medida</h1>
                    <a href="{{ route('admin.units.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-4">
                        Crear Nueva Unidad
                    </a>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Símbolo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          @forelse ($units as $unit)
                            <tr id="row-{{ $unit->id }}" class="{{ !$unit->is_active ? 'opacity-50' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $unit->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $unit->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $unit->symbol }}</td>
                               <td class="px-6 py-4 whitespace-nowrap">
                                    <span id="status-{{ $unit->id }}"
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $unit->is_active ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        
                                        {{ $unit->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                            
                                                                
                                                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox"
                                        class="toggle-status sr-only peer"
                                        data-id="{{ $unit->id }}"
                                        {{ $unit->is_active ? 'checked' : '' }}>

                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer 
                                        peer-checked:bg-green-500
                                        after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                        after:bg-white after:border after:rounded-full after:h-5 after:w-5
                                        after:transition-all
                                        peer-checked:after:translate-x-full relative">
                                    </div>
                                </label>

                                <button 
   onclick="confirmDeleteAjax({{ $unit->id }})"
    class=" text-red px-3 py-1 rounded">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 bg-red-500 hover:bg-red-600 text-white p-1 rounded">
  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
</svg>

</button>
                                </td>
             

                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No hay unidades de medida registradas.</td>
                            </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>


    <x-toast />
    <script>
window.confirmDeleteAjax = function(unitId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        buttonsStyling: false,
         customClass: {
        confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-lg font-bold',
        cancelButton: 'bg-gray-500 hover:bg-gray-600 text-white px-5 py-2.5 rounded-lg font-bold ml-2'
    },

        showClass: { popup: 'animate__animated animate__zoomIn animate__faster' },
        hideClass: { popup: 'animate__animated animate__zoomOut animate__faster' }
    }).then((result) => {

        if (result.isConfirmed) {

            fetch(`/admin/units/${unitId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {

                if (data.success) {

                    let row = document.getElementById(`row-${unitId}`);

                    // animación
                    row.classList.add('opacity-0');

                    setTimeout(() => {
                        row.remove();
                    }, 300);

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Eliminado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });

                } else {
                    Swal.fire({
    title: 'Error',
    text: data.message,
    icon: 'error',

    confirmButtonText: 'OK',
    buttonsStyling: false,

    customClass: {
        confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-bold'
    }
});
                }

            })
            .catch(() => {
                Swal.fire('Error', 'No se pudo eliminar', 'error');
            });
        }
    });
}
</script>
    <script>
document.querySelectorAll('.toggle-status').forEach(toggle => {
    toggle.addEventListener('change', function () {

        let unitId = this.dataset.id;
        let checked = this.checked;

        fetch(`/admin/units/${unitId}/toggle`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
     .then(data => {

    let statusSpan = document.getElementById(`status-${unitId}`);
    let row = document.getElementById(`row-${unitId}`);

    if (data.success) {

       
        if (data.is_active) {
            statusSpan.textContent = 'Activo';
            statusSpan.classList.remove('bg-red-100', 'text-red-600');
            statusSpan.classList.add('bg-green-100', 'text-green-600');
            row.classList.remove('opacity-50');
        } else {
            statusSpan.textContent = 'Inactivo';
            statusSpan.classList.remove('bg-green-100', 'text-green-600');
            statusSpan.classList.add('bg-red-100', 'text-red-600');
            row.classList.add('opacity-50');
        }

        // 👉 Toast dinámico
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: data.is_active ? 'success' : 'error',
            title: data.message,
            showConfirmButton: false,
            timer: 1500
        });

    } else {

        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: data.message || 'Error al actualizar',
            showConfirmButton: false,
            timer: 1500
        });
    }
})
.catch(error => {
    console.error('Error:', error);
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'Error al actualizar el estado',
        showConfirmButton: false,
        timer: 1500
    });
});
    });
});

</script>
</x-app-layout>








