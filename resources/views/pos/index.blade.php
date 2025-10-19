<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Punto de Venta') }}
        </h2>
    </x-slot>

    <div class="p-2 lg:p-4">
        <!-- CONTENEDOR PRINCIPAL RESPONSIVE -->
        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-4 lg:gap-6">

            <!-- PANEL IZQUIERDO: PRODUCTOS Y TABLA -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-4 lg:p-6">

                <!-- BÚSQUEDA DE CLIENTE - RESPONSIVE -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                    <!-- FORMULARIO DE BÚSQUEDA -->
                    <div class="flex-1 min-w-0">
                        <div class="relative">
                            <label for="cliente-search" class="text-sm font-medium text-gray-600">Cédula / RUC</label>
                            <input type="search" id="cliente-search"
                                class="block w-full pl-10 pr-24 py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-green-400 focus:border-green-500"
                                placeholder="Ej: 0912345678" />
                            <i class="fas fa-id-card absolute left-3 top-9 text-gray-400"></i>
                            <button id="buscarClienteBtn" type="button"
                                class="absolute right-2 top-8 bottom-2 px-3 sm:px-4 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700">
                                Buscar
                            </button>
                        </div>
                    </div>

                    <!-- CHECKBOX -->
                    <div class="flex items-center space-x-2 sm:mt-6">
                        <input id="final-checkbox" type="checkbox"
                            class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="final-checkbox" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                            Consumidor Final
                        </label>
                    </div>
                </div>

                <!-- INFORMACIÓN DEL CLIENTE -->
                <div id="cliente-info" class="hidden mt-4 bg-white border rounded-xl p-4 text-sm text-gray-700 shadow-md">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-2 gap-x-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user text-blue-600"></i>
                            <p><strong>Nombre:</strong> <span id="cliente-nombre">—</span></p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-home text-green-600"></i>
                            <p><strong>Dirección:</strong> <span id="cliente-direccion">—</span></p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-phone-alt text-yellow-600"></i>
                            <p><strong>Teléfono:</strong> <span id="cliente-telefono">—</span></p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-red-600"></i>
                            <p><strong>Correo:</strong> <span id="cliente-correo">—</span></p>
                        </div>
                    </div>
                </div>

                <hr class="my-4 lg:my-6">

                <!-- AGREGAR PRODUCTOS - RESPONSIVE -->
                <div class="flex flex-col sm:flex-row gap-3 mb-4 items-end">
                    <div class="w-full sm:w-1/2 lg:w-1/3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seleccionar producto</label>
                        <select id="productSelect"
                            class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-sm">
                            <option value="">Seleccione un producto</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                data-code="{{ $product->code }}"
                                data-name="{{ $product->name }}"
                                data-default_price="{{ $product->default_price }}">
                                {{ $product->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full sm:w-1/4 lg:w-1/6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                        <input type="number" id="qtyInput" value="1" min="1"
                            class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-sm">
                    </div>

                    <div class="w-full sm:w-1/4 lg:w-1/6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                        <input type="number" id="priceInput" step="0.01" min="0"
                            placeholder="Auto"
                            class="w-full border-gray-300 rounded-lg focus:ring focus:ring-blue-200 text-sm">
                    </div>

                    <button id="addProductBtn"
                        class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-white font-semibold py-2.5 px-4 rounded-lg text-sm">
                        + Agregar
                    </button>
                </div>

                <!-- TABLA DE PRODUCTOS - RESPONSIVE -->
                <div class="overflow-x-auto border rounded-lg">
                    <table class="w-full text-sm text-gray-700 border-collapse min-w-[600px]" id="cartTable">
                        <thead class="bg-gray-100 text-gray-800">
                            <tr>
                                <th class="py-2 px-2 sm:px-3 text-left">Código</th>
                                <th class="py-2 px-2 sm:px-3 text-left">Nombre</th>
                                <th class="py-2 px-2 sm:px-3 text-right">Precio</th>
                                <th class="py-2 px-2 sm:px-3 text-right">Cantidad</th>
                                <th class="py-2 px-2 sm:px-3 text-right">Subtotal</th>
                                <th class="py-2 px-2 sm:px-3 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="cartBody">
                            <!-- filas dinámicas -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PANEL DERECHO: TOTALES Y PAGOS -->
            <div class="lg:col-span-1 bg-white rounded-xl shadow-md p-4 lg:p-6 sticky top-4">
                <div class="border-b pb-3 mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Resumen</h3>
                </div>

                <div class="space-y-2 text-sm text-gray-700">
                    <div class="flex justify-between">
                        <span>Subtotal:</span>
                        <span id="subtotal">$0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Descuento (%):</span>
                        <span id="discount">$0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Iva (15%):</span>
                        <span id="iva">$0.00</span>
                    </div>
                    <div class="flex justify-between text-lg font-semibold border-t pt-2 mt-2">
                        <span>Total:</span>
                        <span id="total" class="text-green-600">$0.00</span>
                    </div>
                </div>

                <!-- MÉTODOS DE PAGO - RESPONSIVE -->
                <div class="border-b pb-3 mb-4 mt-6">
                    <h3 class="text-lg font-semibold text-gray-700">Método de Pago</h3>
                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <button type="button"
                            data-payment="cash"
                            data-tooltip-target="tooltip-cash"
                            data-tooltip-placement="top"
                            class="payment-method flex items-center justify-center gap-1 sm:gap-2 px-2 sm:px-4 py-2 bg-green-100 text-green-700 border border-green-300 rounded-lg hover:bg-green-200 transition-colors text-xs sm:text-sm">
                            <i class="fas fa-money-bill-wave text-xs sm:text-sm"></i>
                            <span class="hidden xs:inline">Efectivo</span>
                            <!-- Tooltip -->
                            <div id="tooltip-cash" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Pago inmediato en efectivo
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </button>
                        <button type="button"
                            data-payment="credit"
                            data-tooltip-target="tooltip-credit"
                            data-tooltip-placement="top"
                            class="payment-method flex items-center justify-center gap-1 sm:gap-2 px-2 sm:px-4 py-2 bg-yellow-100 text-yellow-700 border border-yellow-300 rounded-lg hover:bg-yellow-200 transition-colors text-xs sm:text-sm">
                            <i class="fas fa-credit-card text-xs sm:text-sm"></i>
                            <span class="hidden xs:inline">Crédito</span>
                            <!-- Tooltip Simple -->
                            <div id="tooltip-credit" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Pago a crédito (30 días)
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </button>
                        <button type="button"
                            data-payment="transfer"
                            data-tooltip-target="tooltip-transfer"
                            data-tooltip-placement="top"
                            class="payment-method flex items-center justify-center gap-1 sm:gap-2 px-2 sm:px-4 py-2 bg-blue-100 text-blue-700 border border-blue-300 rounded-lg hover:bg-blue-200 transition-colors text-xs sm:text-sm col-span-2">
                            <i class="fas fa-exchange-alt text-xs sm:text-sm"></i>
                            <span>Transferencia</span>

                            <div id="tooltip-transfer" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Transferencia bancaria - solicitar comprobante
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </button>
                    </div>
                </div>
                <!-- BOTÓN FINALIZAR -->
                <button id="finalizarBtn" class="mt-4 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg text-sm sm:text-base">
                    Finalizar Venta
                </button>
                <!-- Nuevo: Botón de Cierre de Caja -->
                <a href="{{ route('cash-closures.create') }}"
                    class="mt-3 w-full block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg text-sm sm:text-base transition-colors">
                    <i class="fas fa-cash-register mr-2"></i> Cerrar Caja
                </a>
                
            </div>

        </div>
    </div>
<!-- Modal de apertura -->
<!-- Modal de apertura -->
<div id="openCashModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Apertura de Caja - {{ now()->format('d/m/Y') }}</h2>
    <form action="{{ route('cash-closures.store-open') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Efectivo inicial *</label>
        <input type="number" name="initial_cash" step="0.01" min="0" required
               class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
               placeholder="Ejemplo: 100.00"
               autofocus>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones (opcional)</label>
        <textarea name="observations" rows="2" class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"></textarea>
      </div>
      <div class="flex justify-end space-x-3">
        <!-- <button type="button" onclick="closeCashModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
          Cancelar
        </button> -->
        <button type="button" onclick="location.href='{{ route('dashboard') }}'" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
          Dashboard
        </button>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
          Confirmar Apertura
        </button>
      </div>
    </form>
  </div>
</div>


    <!-- Modal de éxito -->
    <div id="successModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Icono de éxito -->
                <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                    <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Success</span>
                </div>

                <!-- Mensaje -->
                <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">¡Venta registrada exitosamente!</p>

                <!-- Detalles -->
                <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                    <p><strong>Número de venta:</strong> <span id="modalSaleNumber"></span></p>
                    <p><strong>Total:</strong> <span id="modalTotal"></span></p>
                    <p><strong>Método de pago:</strong> <span id="modalPayment"></span></p>
                </div>

                <!-- Botones -->
                <div class="flex justify-center items-center space-x-4">
                    <button id="printReceipt" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        <i class="fas fa-print mr-2"></i>Imprimir
                    </button>
                    <button id="newSale" type="button" class="py-2 px-3 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-900">
                        <i class="fas fa-plus mr-2"></i>Nueva Venta
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Script de lógica -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
<script>
$(document).ready(function() {
    // Verificar estado de caja al cargar la página
    checkCashStatus();
});

function checkCashStatus() {
    $.get("{{ route('cash-closures.get-today-summary') }}", function(data) {
        console.log('Estado de caja:', data);
        
        if (!data.has_closure) {
            // No hay caja hoy - mostrar modal de apertura
            $('#openCashModal').removeClass('hidden');
        } else if (data.closure_status === 'completed') {
            // Caja ya cerrada hoy - mostrar mensaje informativo
            Swal.fire({
                title: 'Caja Cerrada',
                text: 'Ya se realizó el cierre de caja para hoy.',
                icon: 'info',
                confirmButtonText: 'Aceptar'
            });
        } else if (data.closure_status === 'pending') {
            // Caja abierta - continuar normalmente
            console.log('Caja abierta - continuar operaciones');
        }
    }).fail(function(error) {
        console.error('Error al verificar estado de caja:', error);
        // En caso de error, permitir continuar
    });
}

// Cerrar modal manualmente (opcional)
function closeCashModal() {
    $('#openCashModal').addClass('hidden');
}
</script>


   <script>
        let cart = [];
        let currentCustomer = null;
        let selectedPayment = null;

        //BÚSQUEDA DE CLIENTE
        $('#buscarClienteBtn').click(function() {
            const cedula = $('#cliente-search').val().trim();

            if (!cedula) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Ingrese una cédula o RUC para buscar.',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                return;
            }

            // Limpia antes de buscar
            $('#cliente-info').removeClass('hidden');
            $('#cliente-nombre').text('Buscando...');
            $('#cliente-direccion').text('—');
            $('#cliente-telefono').text('—');
            $('#cliente-correo').text('—');

            // Llamada AJAX real al backend Laravel
            $.get(`/clientes/buscar/${cedula}`, function(cliente) {
                currentCustomer = cliente; // ← GUARDAR CLIENTE
                $('#cliente-nombre').text(cliente.name);
                $('#cliente-direccion').text(cliente.address ?? '—');
                $('#cliente-telefono').text(cliente.phone ?? '—');
                $('#cliente-correo').text(cliente.email ?? '—');
            }).fail(function() {
                $('#cliente-nombre').text('Cliente no registrado');
                $('#cliente-direccion').text('N/A');
                $('#cliente-telefono').text('N/A');
                $('#cliente-correo').text('N/A');
                currentCustomer = null;
            });
        });

        // Checkbox "Consumidor Final"
        $('#final-checkbox').change(function() {
            if ($(this).is(':checked')) {
                // Bloquear campos de búsqueda
                $('#cliente-search').val('').prop('disabled', true);
                $('#buscarClienteBtn')
                    .prop('disabled', true)
                    .addClass('bg-gray-400 cursor-not-allowed')
                    .removeClass('bg-green-600 hover:bg-green-700');

                // Mostrar datos de consumidor final
                $('#cliente-info').removeClass('hidden');
                $('#cliente-nombre').text('Consumidor Final');
                $('#cliente-direccion').text('N/A');
                $('#cliente-telefono').text('N/A');
                $('#cliente-correo').text('consumidorfinal@local.com');

                // Asignar el cliente por defecto al carrito
                currentCustomer = {
                    id: 1, // ID real del cliente "Consumidor Final" en la BD
                    name: 'Consumidor Final',
                    cedula: '9999999999',
                    address: 'N/A',
                    phone: 'N/A',
                    email: 'consumidorfinal@local.com'
                };
            } else {
                // Desbloquear búsqueda
                $('#cliente-search').prop('disabled', false);
                $('#buscarClienteBtn')
                    .prop('disabled', false)
                    .removeClass('bg-gray-400 cursor-not-allowed')
                    .addClass('bg-green-600 hover:bg-green-700');

                // Ocultar datos de cliente
                $('#cliente-info').addClass('hidden');
                currentCustomer = null;
            }
        });

        // SELECCIÓN DE MÉTODO DE PAGO

        $('.payment-method').click(function() {
            // Remover estilos activos de todos los botones
            $('.payment-method').removeClass('ring-2 ring-offset-2 ring-blue-500 border-2');

            // Agregar estilos al botón seleccionado
            $(this).addClass('ring-2 ring-offset-2 ring-blue-500 border-2');

            // Obtener el método de pago del data attribute
            selectedPayment = $(this).data('payment');

            console.log('Método de pago seleccionado:', selectedPayment);
        });

        // LÓGICA DE PRODUCTOS
        $('#addProductBtn').click(function() {
            const selected = $('#productSelect option:selected');
            const id = selected.val();
            const name = selected.data('name');
            const code = selected.data('code');
            let price = parseFloat(selected.data('default_price'));
            const customPrice = parseFloat($('#priceInput').val());
            const qty = parseInt($('#qtyInput').val());

            if (!id) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Seleccione un producto válido.',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });
                return;
            }
            if (!isNaN(customPrice) && customPrice > 0) {
                price = customPrice;
            }

            const existing = cart.find(p => p.id == id);
            if (existing) {
                existing.qty += qty;
            } else {
                cart.push({
                    id,
                    code,
                    name,
                    price,
                    qty
                });
            }

            renderCart();
            $('#priceInput').val('');
            $('#qtyInput').val(1);
        });

        function renderCart() {
            let html = '';
            let subtotal = 0;

            cart.forEach((item, index) => {
                const lineTotal = item.price * item.qty;
                subtotal += lineTotal;

                html += `
            <tr class="border-b hover:bg-gray-50 transition">
                <td class="py-2 px-3">${item.code ?? ''}</td>
                <td class="py-2 px-3">${item.name}</td>
                <td class="py-2 px-3 text-right">
                    <input type="number" step="0.01" value="${item.price}"
                        class="w-20 text-right border rounded focus:ring focus:ring-green-200"
                        onchange="updatePrice(${index}, this.value)">
                </td>
                <td class="py-2 px-3 text-right">
                    <input type="number" min="1" value="${item.qty}"
                        class="w-16 text-right border rounded focus:ring focus:ring-green-200"
                        onchange="updateQty(${index}, this.value)">
                </td>
                <td class="py-2 px-3 text-right">$${lineTotal.toFixed(2)}</td>
                <td class="py-2 px-3 text-center">
                    <button onclick="removeItem(${index})" type="button">
                        <i class="fas fa-trash-alt text-lg text-red-500 hover:text-red-700"></i>
                    </button>
                </td>
            </tr>`;
            });

            $('#cartBody').html(html);

            const iva = subtotal * 0.00;
            const discount = 0;
            const total = subtotal + iva;

            $('#subtotal').text(`$${subtotal.toFixed(2)}`);
            $('#iva').text(`$${iva.toFixed(2)}`);
            $('#discount').text(`-$${discount.toFixed(2)}`);
            $('#total').text(`$${total.toFixed(2)}`);
        }

        function updateQty(index, value) {
            const newQty = parseInt(value);
            if (newQty > 0) {
                cart[index].qty = newQty;
                renderCart();
            }
        }

        function removeItem(index) {
            Swal.fire({
                title: '¿Eliminar producto?',
                text: 'Esta acción eliminará el producto del carrito.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    cart.splice(index, 1);
                    renderCart();

                    // Toast de confirmación
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto eliminado del carrito',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                }
            });
        }


        function updatePrice(index, value) {
            const newPrice = parseFloat(value);
            if (newPrice >= 0) {
                cart[index].price = newPrice;
                renderCart();
            }
        }


        // ✅ FINALIZAR VENTA - CON VALIDACIÓN MEJORADA
        // ======================
        $('#finalizarBtn').click(function() {
            console.log('Botón finalizar clickeado');

            // VALIDACIÓN 1: Carrito vacío
            if (cart.length === 0) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Agregue productos al carrito antes de finalizar',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                return;
            }

            // VALIDACIÓN 2: Método de pago
            if (!selectedPayment) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Seleccione un método de pago',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
                return;
            }

            // VALIDACIÓN 3: Cliente no seleccionado
            if (!currentCustomer) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Seleccione un tipo de cliente',
                    text: 'Busque por cédula/RUC o active "Consumidor Final"',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true
                });
                return;
            }

            const data = {
                customer_id: currentCustomer ? currentCustomer.id : null,
                payment_type: selectedPayment,
                items: cart,
                _token: '{{ csrf_token() }}'
            };

            console.log('Datos a enviar:', data);

            // Mostrar loading mejorado
            const finalizarBtn = $(this);
            finalizarBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...').prop('disabled', true).addClass('opacity-75');

            $.ajax({
                url: '{{ route("pos.store") }}',
                method: 'POST',
                data: data,
                success: function(res) {
                    // Mostrar modal de éxito
                    showSuccessModal(res);

                    // Limpiar todo
                    resetPOS();

                    // Toast de confirmación
                    //Swal.fire({
                    //  toast: true,
                    //position: 'top-end',
                    //icon: 'success',
                    //title: 'Venta registrada exitosamente',
                    //showConfirmButton: false,
                    //timer: 3000,
                    //timerProgressBar: true
                    //});
                },
                error: function(err) {
                    console.error('Error completo:', err);
                    const errorMessage = err.responseJSON?.error || 'Error al procesar la venta';

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: errorMessage,
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true
                    });

                    // Restaurar botón
                    finalizarBtn.html('Finalizar Venta').prop('disabled', false);
                }
            });
        });

        // FUNCIONES DEL MODAL
        function showSuccessModal(response) {
            // Llenar datos del modal
            $('#modalSaleNumber').text(response.sale_number || response.sale_id);
            $('#modalTotal').text('$' + (response.total_without_iva).toFixed(2));

            $('#modalPayment').text(getPaymentMethodText(selectedPayment));

            // Mostrar modal
            const successModal = new Modal(document.getElementById('successModal'));
            successModal.show();

            // Configurar botones del modal
            $('#printReceipt').off('click').on('click', function() {
                printReceipt(response.sale_id);
                successModal.hide();
            });

            $('#newSale').off('click').on('click', function() {
                successModal.hide();
            });
        }

        function showErrorModal(message) {
            // Crear modal de error temporal (puedes hacer uno permanente como el de éxito)
            const errorHtml = `
        <div class="fixed top-4 right-4 z-50">
            <div class="flex items-center p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-lg"></i>
                </div>
                <div class="ms-3 text-sm font-medium">
                    ${message}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" onclick="this.parentElement.remove()">
                    <span class="sr-only">Close</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;

            $('body').append(errorHtml);

            // Auto-remover después de 5 segundos
            setTimeout(() => {
                $('.fixed.top-4.right-4').remove();
            }, 5000);
        }

        function getPaymentMethodText(paymentType) {
            const methods = {
                'cash': 'Efectivo',
                'credit': 'Crédito',
                'card': 'Tarjeta',
                'transfer': 'Transferencia'
            };
            return methods[paymentType] || paymentType;
        }

        function calculateTotal() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            return subtotal * 1.15; // + IVA
        }

        function resetPOS() {
            cart = [];
            currentCustomer = null;
            selectedPayment = null;
            renderCart();
            $('#cliente-info').addClass('hidden');
            $('#cliente-search').val('').prop('disabled', false);
            $('#buscarClienteBtn').prop('disabled', false)
                .removeClass('bg-gray-400 cursor-not-allowed')
                .addClass('bg-green-600 hover:bg-green-700');
            $('#final-checkbox').prop('checked', false);
            $('.bg-green-100, .bg-yellow-100').removeClass('ring-2 ring-offset-2 ring-green-500');
            $('#productSelect').val('');
            $('#qtyInput').val(1);
            $('#priceInput').val('');

            // Restaurar botón finalizar
            $('button.bg-green-500').last().html('Finalizar Venta').prop('disabled', false);
        }

        function printReceipt(saleId) {
            // Aquí puedes implementar la impresión del recibo
            window.open(`/pdf/ticket/${saleId}`, '_blank');
            // O mostrar alerta temporal
            showErrorModal('Función de impresión en desarrollo');
        }
    </script>

</x-app-layout>