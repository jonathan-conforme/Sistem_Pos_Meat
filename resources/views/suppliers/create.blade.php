<x-app-layout>
@if (session('error'))
<div 
    x-data="{ open: true }"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50"
>
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-lg font-bold text-red-600 mb-2">Error</h2>
        <p>{{ session('error') }}</p>
        <div class="text-right mt-4">
            <button @click="open = false" class="bg-red-600 text-white px-4 py-2 rounded">Cerrar</button>
        </div>
    </div>
</div>
@endif


@if (session('success'))
<div 
    x-data="{ open: true }"
    x-show="open"
    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50"
>
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full border-l-4 border-green-600">
        <h2 class="text-lg font-bold text-green-600 mb-2">✅ Éxito</h2>
        <p class="text-gray-700">{{ session('success') }}</p>
        <div class="text-right mt-4">
            <button @click="open = false" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Cerrar
            </button>
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
                    <p class="text-sm font-medium text-gray-600">Total provedores</p>
                    <p class="text-2xl font-bold text-gray-900">5</p>
                </div>
            </div>

        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total provedores</p>
                <p class="text-2xl font-bold text-gray-900">numero total de provedores</p>
            </div>

        </div>
        <div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total provedores</p>
                    <p class="text-2xl font-bold text-gray-900">numero total de provedores</p>
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
                        <h3 class="text-xl font-bold text-gray-900">Registrar Nuevo Proveedor</h3>
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
            <form id="suppliers-form" method="POST" action="{{ route('suppliers.store')}}" class="p-6 space-y-6">
                @csrf

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
                            value="{{ old('name') }}"
                                name="name"
                                id="suppliers_name"
                                type="text"
                                placeholder="Ingrese el nombre del proveedor"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
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
                            value="{{ old('ruc') }}"
                                name="ruc"
                                id="suppliers_ruc"
                                 type="text"
                                attern="[0-9]*"
                                inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                placeholder="0999999999001"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Segunda fila de campos -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Persona de Contacto -->
                    <div class="space-y-2">
                        <label for="suppliers_contact" class="block text-sm font-medium text-gray-700 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Celular de Contacto *
                        </label>
                        <div class="relative">
                            <input
                                name="contact_name"
                                id="suppliers_contact"
                                type="text"
                                attern="[0-9]*"
                                inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                placeholder="0999999999"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
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
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                placeholder="041234567"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400">
                            <p class="error-message text-sm text-red-500 mt-1 hidden"></p>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
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
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
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
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
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
                        class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-500 focus:outline-none transition flex items-center shadow-md">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Guardar Proveedor
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Lista de Proveedores</h2>
        </div>
        <div class="w-full overflow-x-auto sm:overflow-x-visible">
            <table class="min-w-full text-sm text-left text-gray-500 aling-middle">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr class="text-gray-600">
                        <th class="px-4 py-3">nombre</th>
                        <th class="px-4 py-3 text-xs">telefono</th>
                        <th class="px-4 py-3 text-xs">contanctos</th>
                        <th class="px-4 py-3 text-xs">correo</th>
                        <th class="px-4 py-3 text-xs">direcion</th>
                        <th class="px-4 py-3 text-xs">ruc</th>
                        <th class="px-4 py-3 text-xs">notas</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($supplier as $suppliers)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $suppliers->name}}</td>
                        <td class="px-4 py-3">{{ $suppliers->contact_name}}</td>
                        <td class="px-4 py-3">{{ $suppliers->phone}}</td>
                        <td class="px-4 py-3 font-mono ">{{ $suppliers->email}}</td>
                        <td class="px-4 py-3 font-mono ">{{ $suppliers->address}}</td>
                        <td class="px-4 py-3 font-mono ">{{ $suppliers->ruc}}</td>
                        <td class="px-4 py-3 font-mono ">{{ $suppliers->notes}}</td>
                        <td class="px-6 py-3 text-center">
                                        <div class="flex justify-center items-center">
                                            <!-- Botón Editar -->
                                            <div class="relative group">
                                                <button data-modal-target="form-modal-{{ $suppliers->id }}" data-modal-toggle="form-modal-{{ $suppliers->id }}"
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
                                                        Editar Rol
                                                        <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-900"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                    </tr>
                    <tr>
                        @empty
                        <td colspan="7" class="px-6 py-4 text-center text-gray-600">No hay clientes registrados.</td>

                        @endforelse
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("suppliers-form");
            const fields = {
                name: {
                    el: document.getElementById("suppliers_name"),
                    validate: (v) => v.trim().length >= 3,
                    msg: "El nombre debe tener al menos 3 caracteres."
                },
                ruc: {
                    el: document.getElementById("suppliers_ruc"),
                    validate: (v) => v === "" || /^[0-9]{10,13}$/.test(v),
                    msg: "10 a 13 dígitos numéricos."
                },
                contact_name: {
                    el: document.getElementById("suppliers_contact"),
                    validate: (v) => v === "" || /^[0-9]{7,15}$/.test(v),
                    msg: "El numero de contacto debe tener entre 9 y 15 dígitos numéricos."
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

            // 🧩 Validación en tiempo real
            Object.values(fields).forEach(field => {
                const input = field.el;
                const errorEl = input.nextElementSibling;

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

            // 🚫 Evitar enviar si hay errores
            form.addEventListener("submit", (e) => {
                let valid = true;
                Object.values(fields).forEach(field => {
                    const input = field.el;
                    const errorEl = input.nextElementSibling;
                    if (!field.validate(input.value)) {
                        errorEl.textContent = field.msg;
                        errorEl.classList.remove("hidden");
                        input.classList.add("border-red-500", "focus:ring-red-500");
                        valid = false;
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    const firstInvalid = form.querySelector(".border-red-500");
                    firstInvalid?.scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });
                }
            });
        });
    </script>

</x-app-layout>