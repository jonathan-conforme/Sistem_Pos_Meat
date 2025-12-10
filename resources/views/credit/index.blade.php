<x-app-layout>
    <div class="justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Gestión de Categorías</h1>
        <p class="text-gray-600">Administra las categorías de tu sistema</p>
    </div>
 <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    {{-- Tarjeta de total de facturas pendientes --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 flex items-center col-span-1 md:col-span-1">
        <div class="p-3 bg-purple-100 rounded-lg flex-shrink-0">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-600">Total de facturas pendientes</p>
            <p id="total-categories" class="text-2xl font-bold text-gray-900">{{ $sales->count() }}</p>
        </div>
    </div>

    {{-- Buscador --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 col-span-1 md:col-span-3">
        <form method="GET" action="{{ route('credit.index') }}">
            <div class="flex flex-col md:flex-row md:items-center md:gap-4">
                <div class="flex-1">
                    <input type="text" name="search" placeholder="Buscar por factura, cédula o nombre"
                        value="{{ old('search', request('search')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mt-4 md:mt-0 flex gap-2">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition-all">
                        <i class="fas fa-search"></i> Buscar
                    </button>

                    <button type="button" onclick="window.location='{{ route('credit.index') }}'"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2 transition-all">
                        <i class="fas fa-eraser"></i> Limpiar
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>


   
    {{-- Contenedor de resultados --}}
    <div class="p-6 bg-white rounded-2xl shadow-md border border-gray-100">
        @if($sales->isEmpty())
        {{-- Mensaje si no hay registros --}}
        <div class="text-center text-gray-500 py-10">
            <i class="fas fa-folder-open text-3xl mb-2"></i>
            <p>No hay cuentas por cobrar registradas.</p>
        </div>
        @else
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b text-gray-700 uppercase text-xs">
                        <tr>

                            <th class="px-4 py-3">vendedor</th>
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
                        <tr id="sale-{{ $sale->id }}" class="hover:bg-gray-50 transition duration-150 text-xs">
                            <td class="px-4 py-3">
                                <span class="font-medium text-gray-800">{{ $sale->createdBy->name ?? 'Sistema' }}</span>
                            </td>
                            <td class="px-4 py-3">{{ $sale->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $sale->sale_number }}</td>
                            <td class="px-4 py-3">{{ $sale->customer->name ?? 'Consumidor Final' }}</td>
                            <td class="px-4 py-3 text-gray-800">${{ number_format($sale->subtotal, 2) }}</td>
                            <td data-sale-id="{{ $sale->id }}" class="paid px-4 py-3 text-green-600 font-semibold">${{ number_format($sale->total_paid, 2, '.', ',') }}</td>
                            <td data-sale-id="{{ $sale->id }}" class="remaining px-4 py-3 text-red-600 font-semibold">${{ number_format($sale->remaining, 2, '.', ',') }}</td>
                            <td class="status px-4 py-3">
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


        </div>
        @endif

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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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

            function loadSaleDetails(id) {
                const modalContent = document.getElementById('creditModalContent');

                modalContent.innerHTML = `
        <div class="flex flex-col items-center justify-center py-10 text-gray-500">
            <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mb-4"></div>
            <p class="text-sm">Actualizando...</p>
        </div>
    `;

                fetch(`/creditos/${id}`)
                    .then(res => res.text())
                    .then(html => {
                        modalContent.innerHTML = html;
                    })
                    .catch(() => {
                        modalContent.innerHTML = `
                <div class="text-center text-red-500 py-10">
                    <i class="fas fa-exclamation-triangle text-2xl mb-2"></i>
                    <p>Error al cargar la información</p>
                </div>
            `;
                    });
            }
           // ============================
//  AJAX PARA REGISTRAR PAGO
// ============================
$(document).on('click', '#submitPaymentButton', function(e) {
    e.preventDefault();

    // OJO: El formulario está dentro del modal dinámico
    let form = document
        .getElementById('creditModalContent')
        .querySelector('#paymentForm');

    if (!form) {
        console.error("No se encontró #paymentForm dentro del modal.");
        return;
    }

    let saleId = form.querySelector('input[name="sale_id"]').value;

    $.ajax({
        url: `/creditos/${saleId}/pagar`,
        method: 'POST',
        data: $(form).serialize(),

        success: function(res) {
            Swal.fire({
                icon: 'success',
                title: 'Pago registrado',
                text: res.message,
                timer: 1600,
                showConfirmButton: false
            });

            let row = document.querySelector(`#sale-${saleId}`);

        // 🔄 Actualizar saldo en cualquier tabla INDEX (si existe)
let indexRemaining = document.querySelector(`td.remaining[data-sale-id="${res.sale_id}"]`);
if (indexRemaining) {
    indexRemaining.textContent = `$${res.remaining_formatted}`;
}

let indexPaid = document.querySelector(`td.paid[data-sale-id="${res.sale_id}"]`);
if (indexPaid) {
    indexPaid.textContent = `$${res.total_paid_formatted}`;
}

            const statusCell = row.querySelector('.status');
            if (res.remaining <= 0) {
                statusCell.innerHTML = `
                    <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                        Pagado
                    </span>`;
            } else {
                statusCell.innerHTML = `
                    <span class="px-3 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full animate-pulse">
                        Pendiente
                    </span>`;
            }

            loadSaleDetails(saleId);
        },

        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: xhr.responseJSON?.message ?? 'No se pudo registrar el pago.'
            });
        }
    });
});

        </script>
      
</x-app-layout>