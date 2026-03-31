<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Contenido para listar compras -->
                    <h1 class="text-2xl font-bold mb-4">Lista de Compras</h1>
                    <a href="{{ route('admin.purchases.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mb-4">
                        Crear Nueva Compra
                    </a>
                    <a href="{{ route('admin.inventory.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mb-4">
                        Ver Inventario  
                    </a>

                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2">ID</th>
                                <th class="py-2">Proveedor</th>
                                <th class="py-2">Fecha</th>
                                <th class="py-2">Total</th>
                                <th class="py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr class="hover:bg-gray-50 text-center">
                                    <td class="py-2">{{ $purchase->id }}</td>
                                    <td class="py-2">{{ $purchase->supplier->name }}</td>
                                    <td class="py-2">{{ $purchase->created_at->format('d/m/Y') }}</td>
                                    <td class="py-2">$ {{ number_format($purchase->total, 2) }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-center">
                                    <button onclick="openModal({{ $purchase->id }}, '{{ $purchase->purchase_number }}')" 
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                                        
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                        </svg>
                                        
                                        Ver detalle
                                    </button>
                                </td>
                                </tr>


                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><div id="purchaseModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4">
        
        <div class="flex justify-between items-center border-b px-6 py-4">
            <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Detalle de Compra</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-red-500 font-bold text-xl">&times;</button>
        </div>

        <div id="modalContent" class="p-6">
            <div class="text-center text-gray-500">Cargando detalles...</div>
        </div>

        <div class="border-t px-6 py-4 flex justify-end">
            <button onclick="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cerrar
            </button>
        </div>
    </div>
</div><script>
    function openModal(purchaseId, purchaseNumber) {
        // Mostrar el modal y poner "Cargando..."
        document.getElementById('purchaseModal').classList.remove('hidden');
        document.getElementById('modalTitle').innerText = 'Detalle de Compra #' + purchaseNumber;
        document.getElementById('modalContent').innerHTML = '<div class="text-center py-4">Cargando...</div>';

        // Hacer la petición a la ruta show
        fetch(`/admin/purchases/${purchaseId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest' // Esto le dice a Laravel que es AJAX
            }
        })
        .then(response => response.text())
        .then(html => {
            // Inyectar el HTML en el modal
            document.getElementById('modalContent').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('modalContent').innerHTML = '<div class="text-red-500 text-center">Error al cargar los datos.</div>';
        });
    }

    function closeModal() {
        document.getElementById('purchaseModal').classList.add('hidden');
    }
</script>
    <x-toast />
</x-app-layout>
