<x-app-layout>
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow p-6 mt-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Historial de Cierres de Caja</h1>
            <a href="{{ route('cash-closures.create') }}"
                class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                + Nuevo Cierre
            </a>
        </div>

        {{-- Tabla de cierres --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">Fecha</th>
                        <th class="py-3 px-4 text-left">Usuario</th>
                        <th class="py-3 px-4 text-center">T.Ventas</th>
                        <th class="py-3 px-4 text-center">E.Inicial</th>
                        <th class="py-3 px-4 text-center">V.Efectivo</th>
                        <th class="py-3 px-4 text-center">V.Credito</th>
                        <th class="py-3 px-4 text-center">Diferencias</th>
                        <th class="py-3 px-4 text-center">Estado</th>
                        <th class="py-3 px-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($closures as $closure)
                    <tr class="border-t border-gray-200 hover:bg-gray-50 text-xs">
                        <td class="py-3 px-4">{{ $closure->closure_date->format('d/m/Y') }}</td>
                        <td class="py-3 px-4">{{ $closure->user->name ?? '—' }}</td>
                        <td class="py-3 px-4 text-center">${{ number_format($closure->total_sales, 2) }}</td>
                        <td class="py-3 px-4 text-center">${{ number_format($closure->initial_cash, 2) }}</td>
                        <td class="py-3 px-4 text-center">${{ number_format($closure->cash_sales, 2) }}</td>
                        <td class="px-4 py-2 text-center text-sm font-semibold">
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-lg transition-colors duration-300 hover:bg-yellow-200">
                                ${{ number_format($closure->credit_sales, 2) }}
                            </span>
                        </td>
                        

                        <td class="py-3 px-4 text-center">
                            <span class="{{ $closure->difference >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                ${{ number_format($closure->difference, 2) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            {!! $closure->status_badge !!}
                        </td>
                       
                        <td class="px-4 py-3 text-center">
                            <button data-sale-id="{{ $closure->id }}"
                                class="openCreditModal inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-2 rounded-lg shadow transition-all">
                                <i class="fas fa-credit-card"></i>Ver
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-gray-500">
                            No hay cierres registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-6">
            {{ $closures->links() }}
        </div>
    </div>
<!-- Modal de detalles del cierre -->
<div id="creditModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    
    <div
        class="relative bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b px-6 py-3 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800">Detalles del Cierre</h2>
            <button type="button" data-modal-hide="creditModal"
                class="text-gray-400 hover:text-gray-600 text-2xl leading-none">
                &times;
            </button>
        </div>

        <!-- Contenido con scroll interno -->
        <div id="creditModalContent" class="overflow-y-auto px-6 py-4 flex-1">
            <p class="text-gray-600 text-center py-6">Cargando información...</p>
        </div>

        <!-- Footer opcional -->
        <div class="border-t px-6 py-3 text-right bg-gray-50">
            <button data-modal-hide="creditModal"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg font-semibold text-gray-700">
                Cerrar
            </button>
        </div>
    </div>
</div>


   <script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('creditModal');
    const modalContent = document.getElementById('creditModalContent');

    // 🔹 Abrir modal al hacer clic en "ver"
    document.querySelectorAll('.openCreditModal').forEach(btn => {
        btn.addEventListener('click', async () => {
            const id = btn.getAttribute('data-sale-id');
            modal.classList.remove('hidden');
            modalContent.innerHTML = `
                <div class="text-center py-6">
                    <div class="animate-spin rounded-full h-8 w-8 border-4 border-blue-500 border-t-transparent mx-auto mb-3"></div>
                    <p class="text-gray-600">Cargando detalles...</p>
                </div>`;

            try {
                // 🔹 Llamar al show.blade.php (ruta del controlador)
                const response = await fetch(`/cash-closures/${id}`);
                const html = await response.text();
                modalContent.innerHTML = html;
            } catch (error) {
                modalContent.innerHTML = `<p class="text-red-500 text-center">Error al cargar los detalles.</p>`;
            }
        });
    });

    // 🔹 Cerrar modal
    document.querySelectorAll('[data-modal-hide="creditModal"]').forEach(btn => {
        btn.addEventListener('click', () => modal.classList.add('hidden'));
    });

    // 🔹 Cerrar al hacer clic fuera del modal
    modal.addEventListener('click', e => {
        if (e.target === modal) modal.classList.add('hidden');
    });
});
</script>

</x-app-layout>