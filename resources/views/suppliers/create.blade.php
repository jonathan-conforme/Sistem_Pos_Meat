<x-app-layout>
    @if (session('error'))
    <div
        x-data="{ open: true }"
        x-show="open"
        class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-lg font-bold text-red-600 mb-2">Error</h2>
            <p>{{ session('error') }}</p>
            <div class="text-right mt-4">
                <button @click="open = false" class="bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
            </div>
        </div>
    </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Proveedores</h1>
            <p class="text-gray-600">Administración de proveedores</p>
        </div>
        <button data-modal-target="form-modal" data-modal-toggle="form-modal" class="group text-sm border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-medium py-2.5 px-5 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 btn-hover-effect flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 text-green-500 hover:scale-110 hover:text-white transition duration-75 dark:text-white group-hover:text-white dark:group-hover:text-white mr-2" aria-hidden="true" fill="currentColor" viewBox="0 0 25 25">
                <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
            </svg> Registrar Proveedor
        </button>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total proveedores</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $supplier->total() }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Principal de Proveedores -->
    <div id="form-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full bg-black/50 backdrop-blur-sm">
        <div class="modal-content relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[95vh] overflow-y-auto animate-fadeIn">
            <!-- Encabezado del modal -->
            <div class="sticky top-0 z-10 flex items-center justify-between p-6 border-b bg-gradient-to-r from-blue-50 to-white rounded-t-2xl">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900" id="modal-title">Registrar Nuevo Proveedor</h3>
                        <p class="text-sm text-gray-500 mt-1">Complete la información del proveedor</p>
                    </div>
                </div>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition p-2 rounded-full hover:bg-gray-100" data-modal-hide="form-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>

            <!-- Formulario -->
            <form id="suppliers-form" x-data="suppliersForm()" @submit.prevent="submitForm" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="id" id="supplier_id">

                <!-- Primera fila de campos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nombre del Proveedor -->
                    <div class="space-y-2">
                        <label for="suppliers_name" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Nombre del Proveedor *
                        </label>
                        <div class="relative">
                            <input
                                name="name"
                                id="suppliers_name"
                                type="text"
                                placeholder="Ingrese el nombre del proveedor"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                        </div>
                    </div>

                    <!-- RUC -->
                    <div class="space-y-2">
                        <label for="suppliers_ruc" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            CI/RUC
                        </label>
                        <div class="relative">
                            <input
                                name="ruc"
                                id="suppliers_ruc"
                                type="text"
                                pattern="[0-9]*"
                                inputmode="numeric"
                                placeholder="0999999999001"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                        </div>
                    </div>
                </div>

                <!-- Segunda fila de campos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Celular de Contacto -->
                    <div class="space-y-2">
                        <label for="suppliers_contact" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Celular de Contacto *
                        </label>
                        <div class="relative">
                            <input
                                name="contact_name"
                                id="suppliers_contact"
                                type="text"
                                pattern="[0-9]*"
                                inputmode="numeric"
                                placeholder="0999999999"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div class="space-y-2">
                        <label for="suppliers_phone" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Teléfono
                        </label>
                        <div class="relative">
                            <input
                                name="phone"
                                id="suppliers_phone"
                                type="text"
                                pattern="[0-9]*"
                                inputmode="numeric"
                                placeholder="041234567"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                        </div>
                    </div>
                </div>

                <!-- Tercera fila de campos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="suppliers_email" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Correo Electrónico
                        </label>
                        <div class="relative">
                            <input
                                name="email"
                                id="suppliers_email"
                                type="email"
                                placeholder="ejemplo@correo.com"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="space-y-2">
                        <label for="suppliers_address" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Dirección
                        </label>
                        <div class="relative">
                            <input
                                name="address"
                                id="suppliers_address"
                                type="text"
                                placeholder="Ingrese la dirección completa"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                        </div>
                    </div>
                </div>

                <!-- Notas -->
                <div class="space-y-2">
                    <label for="suppliers_notes" class="block text-sm font-medium text-gray-700 flex items-center">
                        <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Notas Adicionales
                    </label>
                    <textarea
                        name="notes"
                        id="suppliers_notes"
                        rows="4"
                        placeholder="Información adicional sobre el proveedor (opcional)"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 resize-none"></textarea>
                </div>

                <!-- Pie del modal con botones -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button"
                        data-modal-hide="form-modal"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        Cancelar
                    </button>
                    <button id="submit-btn" type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-500 transition flex items-center shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span x-text="mode === 'create' ? 'Guardar Proveedor' : 'Actualizar Proveedor'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 overflow-x-auto">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">Lista de Proveedores</h2>
        </div>
        <div class="w-full overflow-x-auto sm:overflow-x-visible">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr class="text-gray-600">
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Celular</th>
                        <th class="px-4 py-3">Teléfono</th>
                        <th class="px-4 py-3">Correo</th>
                        <th class="px-4 py-3">Dirección</th>
                        <th class="px-4 py-3">RUC</th>
                        <th class="px-4 py-3">Notas</th>
                        <th class="px-4 py-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($supplier as $suppliers)
                    <tr class="border-t border-gray-200 hover:bg-gray-50 text-xs" data-id="{{ $suppliers->id }}">
                        <td class="px-4 py-3">{{ $suppliers->name}}</td>
                        <td class="px-4 py-3">{{ $suppliers->contact_name}}</td>
                        <td class="px-4 py-3">{{ $suppliers->phone}}</td>
                        <td class="px-4 py-3">{{ $suppliers->email}}</td>
                        <td class="px-4 py-3">{{ $suppliers->address}}</td>
                        <td class="px-4 py-3">{{ $suppliers->ruc}}</td>
                        <td class="px-4 py-3">{{ $suppliers->notes}}</td>
                        <td class="px-6 py-3 text-center">
                            <div class="flex justify-center items-center gap-2 px-6 py-4">
                                <!-- Botón Editar -->
                                <div class="relative group">
                                    <button
                                        data-modal-target="form-modal"
                                        data-modal-toggle="form-modal"
                                        onclick="openEditModal({{ $suppliers->toJson() }})"
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
                                            Editar proveedor
                                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Botón Eliminar -->
                                <form id="delete-form-{{ $suppliers->id }}" action="{{ route('suppliers.destroy', $suppliers->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')

                                    <!-- Botón eliminar -->
                                    <div class="relative group">
                                        <button
                                            data-modal-target="popup-modal-{{ $suppliers->id }}"
                                            data-modal-toggle="popup-modal-{{ $suppliers->id }}"
                                            type="button"
                                            class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-all duration-200 hover:scale-110 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>

                                        <!-- Tooltip -->
                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block">
                                            <div class="bg-gray-900 text-white text-xs rounded py-1 px-2 whitespace-nowrap">
                                                Eliminar proveedor
                                                <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal de confirmación -->

                                    <div id="popup-modal-{{ $suppliers->id }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
        justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                                <!-- Botón cerrar -->
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                    hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex 
                    justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="popup-modal-{{ $suppliers->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Cerrar</span>
                                                </button>

                                                <!-- Contenido -->
                                                <div class="p-4 md:p-5 text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                        ¿Seguro desea borrar el proveedor <b>{{ $suppliers->name }}</b>?
                                                    </h3>

                                                    <!-- Confirmar -->
                                                    <button type="button"
                                                        onclick="document.getElementById('delete-form-{{ $suppliers->id }}').submit();"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none 
                        focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg 
                        text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Sí, estoy seguro
                                                    </button>

                                                    <!-- Cancelar -->
                                                    <button data-modal-hide="popup-modal-{{ $suppliers->id }}" type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none 
                        bg-white rounded-lg border border-gray-200 hover:bg-gray-100 
                        hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 
                        dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 
                        dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                        No, cancelar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </td>
        </div>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="px-6 py-4 text-center text-gray-600">No hay proveedores registrados.</td>
        </tr>
        @endforelse
        </tbody>

        </table>
        <div class="p-4">{{ $supplier->links() }}</div>
    </div>
    </div>
    <div id="notification-container"
        class="fixed top-4 right-4 z-50 space-y-3"></div>
    <style>
        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out forwards;
        }
    </style>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("suppliersForm", () => ({
                mode: "create",
                supplierId: null,
                fields: {},

                init() {
                    this.setupValidation();

                    // Escuchar evento personalizado para modo edición
                    window.addEventListener("edit-supplier", (event) => {
                        const supplier = event.detail;
                        this.mode = "edit";
                        this.supplierId = supplier.id;
                        console.log("🔥 Alpine recibió proveedor:", supplier.id);
                    });
                },


                setupValidation() {
                    this.fields = {
                        name: {
                            el: document.getElementById("suppliers_name"),
                            validate: (v) => v.trim().length >= 3,
                            msg: "El nombre debe tener al menos 3 caracteres."
                        },
                        ruc: {
                            el: document.getElementById("suppliers_ruc"),
                            validate: (v) => v === "" || /^[0-9]{10,13}$/.test(v),
                            msg: "El RUC debe tener entre 10 y 13 dígitos."
                        },
                        contact_name: {
                            el: document.getElementById("suppliers_contact"),
                            validate: (v) => /^[0-9]{7,15}$/.test(v),
                            msg: "El celular debe tener entre 7 y 15 dígitos numéricos."
                        },
                        phone: {
                            el: document.getElementById("suppliers_phone"),
                            validate: (v) => v === "" || /^[0-9]{7,15}$/.test(v),
                            msg: "El teléfono debe tener entre 7 y 15 dígitos numéricos."
                        },
                        email: {
                            el: document.getElementById("suppliers_email"),
                            validate: (v) => v === "" || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
                            msg: "Ingrese un correo electrónico válido."
                        },
                        address: {
                            el: document.getElementById("suppliers_address"),
                            validate: (v) => v === "" || v.trim().length >= 5,
                            msg: "La dirección debe tener al menos 5 caracteres."
                        }
                    };

                    // Validación en tiempo real
                    Object.values(this.fields).forEach(field => {
                        const input = field.el;
                        if (!input) return;
                        const errorEl = input.nextElementSibling;
                        if (!errorEl) return;

                        input.addEventListener("input", () => {
                            if (!field.validate(input.value)) {
                                errorEl.textContent = field.msg;
                                errorEl.classList.remove("hidden");
                                input.classList.add("border-red-500", "focus:ring-red-500");
                            } else {
                                errorEl.textContent = "";
                                errorEl.classList.add("hidden");
                                input.classList.remove("border-red-500", "focus:ring-red-500");
                            }
                        });
                    });
                },

                validateForm() {
                    let valid = true;
                    Object.values(this.fields).forEach(field => {
                        const input = field.el;
                        if (!input) return;
                        const errorEl = input.nextElementSibling;
                        if (!errorEl) return;

                        if (!field.validate(input.value)) {
                            errorEl.textContent = field.msg;
                            errorEl.classList.remove("hidden");
                            input.classList.add("border-red-500", "focus:ring-red-500");
                            valid = false;
                        }
                    });
                    return valid;
                },

                async submitForm(e) {
                    e.preventDefault();
                    console.log("Modo actual:", this.mode);
                    console.log("Supplier ID:", this.supplierId);
                    if (!this.validateForm()) {
                        const firstInvalid = document.querySelector(".border-red-500");
                        firstInvalid?.scrollIntoView({
                            behavior: "smooth",
                            block: "center"
                        });
                        return;
                    }

                    const form = e.target;
                    const formData = new FormData(form);
                    const id = this.supplierId;

                    const url = this.mode === "create" ?
                        "{{ route('suppliers.store') }}" :
                        `/suppliers/${id}`;

                    // Laravel necesita POST + _method=PUT
                    if (this.mode === "edit") {
                        formData.append('_method', 'PUT');
                    }

                    try {
                        const response = await fetch(url, {
                            method: "POST", // 🔥 SIEMPRE POST, Laravel detecta _method=PUT
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            },
                            body: formData
                        });

                        if (!response.ok) {
                            const errorData = await response.json();
                            console.error('Error del servidor:', errorData);
                            showNotification(errorData.message || "No se pudo guardar el proveedor", 'error');
                            return;
                        }

                        const result = await response.json();

                        // Cerrar modal de Flowbite
                        const modal = document.getElementById('form-modal');
                        const closeButton = modal?.querySelector('[data-modal-hide="form-modal"]');
                        closeButton?.click();

                        // Mostrar notificación tipo toast
                        // Mostrar notificación tipo toast
                        showNotification(
                            this.mode === "create" ?
                            "Proveedor creado correctamente" :
                            "Proveedor actualizado correctamente",
                            this.mode === "create" ? "success" : "info"
                        );


                        // Resetear formulario y recargar
                        form.reset();
                        this.mode = "create";
                        this.supplierId = null;

                        setTimeout(() => window.location.reload(), 1200);

                    } catch (error) {
                        console.error("Error de red:", error);
                        showNotification("Error de conexión: " + error.message, "error");
                    }
                }
            }));
        });

        // Función para abrir modal de edición
        function openEditModal(supplier) {
            console.log("Editando proveedor:", supplier);

            // Llenar los inputs
            document.getElementById("suppliers_name").value = supplier.name || "";
            document.getElementById("suppliers_ruc").value = supplier.ruc || "";
            document.getElementById("suppliers_contact").value = supplier.contact_name || "";
            document.getElementById("suppliers_phone").value = supplier.phone || "";
            document.getElementById("suppliers_email").value = supplier.email || "";
            document.getElementById("suppliers_address").value = supplier.address || "";
            document.getElementById("suppliers_notes").value = supplier.notes || "";

            // Enviar evento a Alpine
            window.dispatchEvent(new CustomEvent("edit-supplier", {
                detail: supplier
            }));

            // Cambiar el título del modal
            const title = document.querySelector("#form-modal h3");
            if (title) title.textContent = "Editar Proveedor";
        }


        // Toast con Tailwind + Alpine animado
        function showNotification(message, type = 'info') {
            const container = document.getElementById('notification-container');
            if (!container) return;

            const notification = document.createElement('div');
            const colors = {
                success: 'bg-green-600 border-green-800',
                error: 'bg-red-600 border-red-800',
                info: 'bg-blue-600 border-blue-800',
                warning: 'bg-yellow-500 border-yellow-700'
            };

            notification.className = `
        fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white 
        border-l-4 ${colors[type] || colors.info}
        transform translate-x-full opacity-0 transition-all duration-300 ease-out
    `;

            notification.innerHTML = `
        <div class="flex items-center space-x-3">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="text-white hover:opacity-80">&times;</button>
        </div>
    `;

            container.appendChild(notification);

            // Animar entrada
            setTimeout(() => {
                notification.classList.remove('translate-x-full', 'opacity-0');
            }, 10);

            // Auto cerrar
            setTimeout(() => {
                notification.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }
    </script>

</x-app-layout>