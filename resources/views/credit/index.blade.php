<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-yellow-500"></i>
                Cuentas por Cobrar
            </h2>
            <a href="{{ route('sales.index') }}"
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition-all">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </x-slot>

    <div class="p-6 bg-white rounded-2xl shadow-md border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 border-b text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">F.Emision</th>
                        <th class="px-4 py-3">N.Factura</th>
                        <th class="px-4 py-3">Cliente</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Abono</th>
                        <th class="px-4 py-3">Pendiente</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($sales as $sale)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-4 py-3">{{ $sale->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $sale->sale_number }}</td>
                        <td class="px-4 py-3">{{ $sale->customer->name ?? 'Consumidor Final' }}</td>
                        <td class="px-4 py-3 text-gray-800">${{ number_format($sale->total, 2) }}</td>
                        <td class="px-4 py-3 text-green-600 font-semibold">${{ number_format($sale->total_paid, 2) }}</td>
                        <td class="px-4 py-3 text-red-600 font-semibold">${{ number_format($sale->remaining, 2) }}</td>
                        <td class="px-4 py-3">
                            @if($sale->remaining <= 0)
                            <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                Pagado
                            </span>
                            @else
                            <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full animate-pulse">
                                Pendiente
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button data-sale-id="{{ $sale->id }}"
                                class="openCreditModal inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold px-3 py-2 rounded-lg shadow transition-all">
                                <i class="fas fa-credit-card"></i>Pagar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($sales->isEmpty())
        <div class="text-center text-gray-500 py-10">
            <i class="fas fa-folder-open text-3xl mb-2"></i>
            <p>No hay cuentas por cobrar registradas.</p>
        </div>
        @endif
    </div>

    <!-- Modal -->
<div id="creditModal" tabindex="-1" aria-hidden="true"
     class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/40 backdrop-blur-sm transition-all overflow-x-hidden overflow-y-auto">
    <div class="relative w-full max-w-3xl mx-4 animate-fadeInUp">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">

            <!-- Encabezado -->
            <div class="flex justify-between items-center border-b px-5 py-3 bg-gray-50 sticky top-0 z-10">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-credit-card text-blue-500"></i> Detalle de Crédito
                </h3>
                <button type="button"
                        class="text-gray-500 hover:text-gray-700 transition p-1"
                        data-modal-hide="creditModal"
                        aria-label="Cerrar">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Contenido -->
            <div id="creditModalContent"
                 class="p-6 overflow-y-auto max-h-[75vh] scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <div class="flex flex-col items-center justify-center py-10 text-gray-500">
                    <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mb-4"></div>
                    <p class="text-sm">Cargando información del crédito...</p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Animación Tailwind -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.3s ease-out;
    }

    /* Scrollbar elegante (solo visible si hay contenido largo) */
    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background-color: #cbd5e1;
        border-radius: 10px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background-color: #f1f5f9;
    }
</style>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('creditModal');
            const modalContent = document.getElementById('creditModalContent');

            document.querySelectorAll('.openCreditModal').forEach(btn => {
                btn.addEventListener('click', function() {
                    const saleId = this.dataset.saleId;
                    modal.classList.remove('hidden');

                    modalContent.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-10 text-gray-500">
                            <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mb-4"></div>
                            <p class="text-sm">Cargando información del crédito...</p>
                        </div>
                    `;

                    fetch(`/creditos/${saleId}`)
                        .then(res => res.text())
                        .then(html => {
                            modalContent.innerHTML = html;
                        })
                        .catch(() => {
                            modalContent.innerHTML = `
                                <div class="text-center text-red-500 py-10">
                                    <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                                    <p>Error al cargar el crédito</p>
                                </div>
                            `;
                        });
                });
            });

            document.querySelectorAll('[data-modal-hide="creditModal"]').forEach(btn => {
                btn.addEventListener('click', () => {
                    modal.classList.add('hidden');
                });
            });
        });
    </script>
</x-app-layout>
