<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestión de Empresas') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Mensajes de estado -->
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p class="font-bold mb-2">Por favor corrige los siguientes errores:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ session('error') }}</p>
            </div>
            @endif

            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                <p class="font-bold">Éxito</p>
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <!-- Botón para abrir modal -->
            <div class="mb-6 flex justify-end">
                <button type="button" data-modal-target="empresaModal"
                    data-modal-toggle="empresaModal"
                    class="flex items-center justify-center gap-2 text-white 
                    bg-gradient-to-r from-teal-400 to-teal-600 
                    hover:from-teal-500 hover:to-teal-700 
                    focus:ring-4 focus:outline-none focus:ring-teal-300 
                    font-medium rounded-lg text-sm px-5 py-3 text-center transition-colors duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Agregar Empresa
                </button>
            </div>

            <!-- Modal -->
            <div id="empresaModal" tabindex="-1"
                class="hidden fixed top-0 right-0 left-0 z-50 w-full h-full bg-black/40 backdrop-blur-sm flex justify-center items-center transition-opacity duration-300">

                <div class="relative p-4 w-full max-w-4xl h-full">

                    <!-- Contenido del Modal -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800
                        transition-all duration-300 transform
                        -translate-y-full opacity-0
                        md:scale-95 md:opacity-0 md:translate-y-0
                        flex flex-col max-h-full">

                        <!-- Header del Modal -->
                        <div class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-700 flex-shrink-0">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Agregar Nueva Empresa
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white transition-colors"
                                data-modal-hide="empresaModal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Body del Modal (scrollable) -->
                        <div class="px-6 py-6 lg:px-8 overflow-y-auto flex-grow">
                            <form class="space-y-6" action="{{ route('admin.empresa.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <!-- Nombre de la Empresa -->
                                    <div>
                                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Nombre de la Empresa
                                        </label>
                                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>

                                    <!-- Razón Social -->
                                    <div>
                                        <label for="razon_social" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Razón Social
                                        </label>
                                        <input type="text" id="razon_social" name="razon_social" value="{{ old('razon_social') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <!-- RUC -->
                                    <div>
                                        <label for="ruc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            RUC
                                        </label>
                                        <input type="text" id="ruc" name="ruc" value="{{ old('ruc') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <!-- Teléfono -->
                                    <div>
                                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Teléfono
                                        </label>
                                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Email
                                        </label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <!-- Matriz -->
                                    <div>
                                        <label for="matriz" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Matriz
                                        </label>
                                        <input type="text" id="matriz" name="matriz" value="{{ old('matriz') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <!-- Sucursal -->
                                    <div>
                                        <label for="sucursal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Sucursal
                                        </label>
                                        <input type="text" id="sucursal" name="sucursal" value="{{ old('sucursal') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <!-- Obligado a llevar contabilidad -->
                                    <div>
                                        <label for="obligado_contabilidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Obligado a llevar contabilidad
                                        </label>
                                        <select id="obligado_contabilidad" name="obligado_contabilidad" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <option value="">Seleccione una opción</option>
                                            <option value="si" {{ old('obligado_contabilidad') == 'si' ? 'selected' : '' }}>Sí</option>
                                            <option value="no" {{ old('obligado_contabilidad') == 'no' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>

                                    <!-- Tipo de RUC -->
                                    <div>
                                        <label for="tipo_ruc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Tipo de RUC
                                        </label>
                                        <select id="tipo_ruc" name="tipo_ruc" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <option value="">Seleccione un tipo</option>
                                            <option value="rimpe_popular" {{ old('tipo_ruc') == 'rimpe_popular' ? 'selected' : '' }}>RIMPE POPULAR</option>
                                            <option value="rimpe_emprendedor" {{ old('tipo_ruc') == 'rimpe_emprendedor' ? 'selected' : '' }}>RIMPE EMPRENDEDOR</option>
                                            <option value="regimen_general" {{ old('tipo_ruc') == 'regimen_general' ? 'selected' : '' }}>RÉGIMEN GENERAL</option>
                                        </select>
                                    </div>

                                    <!-- Contribuyente Especial -->
                                    <div>
                                        <label for="contribuyente_especial" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Contribuyente Especial Nro
                                        </label>
                                        <input type="text" id="contribuyente_especial" name="contribuyente_especial" 
                                            placeholder="000" value="{{ old('contribuyente_especial') }}" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                    </div>

                                    <!-- Logo -->
                                    <div>
                                        <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                            Logo
                                        </label>
                                        <input type="file" id="logo" name="logo" accept="image/*" required
                                            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                </div>

                                <!-- Botones de acción -->
                                <div class="flex justify-end pt-4 space-x-3">
                                    <button type="button" data-modal-hide="empresaModal"
                                        class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 transition-colors">
                                        Cancelar
                                    </button>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                                        Registrar Empresa
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Grid de Empresas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @forelse ($empresas as $empresa)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">

                        <!-- Header de la tarjeta -->
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white truncate">{{ $empresa->nombre }}</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">
                                {{ str_replace('_', ' ', $empresa->tipo_ruc) }}
                            </span>
                        </div>

                        <!-- Información de la empresa -->
                        <div class="space-y-3 mb-4">
                            <div class="flex items-start text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="break-words">{{ $empresa->razon_social }}</span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                                <span>{{ $empresa->ruc }}</span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span>{{ $empresa->telefono }}</span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span>Obligado: {{ $empresa->obligado_contabilidad == 'si' ? 'Sí' : 'No' }}</span>
                            </div>

                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Contribuyente: {{ $empresa->contribuyente_especial }}</span>
                            </div>
                        </div>

                    </div>
                </div>
                @empty
                <!-- Estado vacío -->
                <div class="col-span-full bg-white dark:bg-gray-800 rounded-lg shadow p-8 text-center border border-gray-200 dark:border-gray-700">
                    <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No hay empresas registradas</h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Comienza agregando tu primera empresa.</p>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- JavaScript mejorado para el modal -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("empresaModal");
            const modalContent = modal.querySelector('.bg-white, .dark\\:bg-gray-800');
            
            const openButtons = document.querySelectorAll("[data-modal-toggle='empresaModal']");
            const closeButtons = document.querySelectorAll("[data-modal-hide='empresaModal']");

            // Función para abrir el modal
            function openModal() {
                modal.classList.remove('hidden');
                
                // Forzar reflow para que la animación funcione
                modal.offsetHeight;
                
                // Aplicar clases para animación de entrada
                modalContent.classList.remove('-translate-y-full', 'opacity-0', 'md:scale-95', 'md:opacity-0', 'md:translate-y-0');
                modalContent.classList.add('translate-y-0', 'opacity-100', 'md:scale-100');
                
                // Bloquear scroll del body
                document.body.style.overflow = 'hidden';
            }

            // Función para cerrar el modal
            function closeModal() {
                // Aplicar clases para animación de salida
                modalContent.classList.remove('translate-y-0', 'opacity-100', 'md:scale-100');
                modalContent.classList.add('-translate-y-full', 'opacity-0', 'md:scale-95', 'md:opacity-0');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                    // Restaurar scroll del body
                    document.body.style.overflow = '';
                }, 300);
            }

            // Event listeners para abrir
            openButtons.forEach(button => {
                button.addEventListener('click', openModal);
            });

            // Event listeners para cerrar
            closeButtons.forEach(button => {
                button.addEventListener('click', closeModal);
            });

            // Cerrar al hacer clic fuera del modal
            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            // Cerrar con tecla Escape
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>

</x-app-layout>