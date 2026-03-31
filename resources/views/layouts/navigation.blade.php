<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

</head>
<style>
    #sidebar-scroll {
        visibility: hidden;
    }
</style>

<body class="bg-gray-50 dark:bg-gray-900"
      x-data="{ loading: false }"
      x-init="
        window.addEventListener('beforeunload', () => loading = true);
        window.addEventListener('pageshow', () => loading = false);
      ">
<!-- LOADER ONDAS -->
<div
    x-show="loading"
    x-transition.opacity
    class="fixed inset-0 z-[99999] flex items-center justify-center bg-[rgba(51,51,51,0.8)] z-[99999]">

    <div class="relative flex items-center justify-center">
        <!-- Centro -->
        <div class="w-6 h-6 bg-white rounded-full"></div>

        <!-- Ondas -->
        <div class="absolute w-6 h-6 border-4 border-white rounded-full animate-ping"></div>
        <div class="absolute w-10 h-10 border-4 border-white rounded-full animate-ping delay-150"></div>
        <div class="absolute w-14 h-14 border-4 border-white rounded-full animate-ping delay-300"></div>
    </div>
</div>


    <!-- Botón para abrir/cerrar sidebar en móviles -->
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>
    <!-- Sidebar -->
    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
      <div id="sidebar-scroll"
     class="h-full px-2 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

       <!-- Usuario arriba -->
            <!-- Perfil usuario arriba del sidebar -->
            <div class="flex items-center  px-1 gap-1 p-3 border-b border-gray-200 dark:border-gray-700">
                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 dark:bg-gray-600 text-white">
                    <!-- Iniciales del usuario -->
                    <span class="text-sm font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-semibold text-gray-900 dark:text-white truncate w-32">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate w-32">
                        {{ Auth::user()->email }}
                    </p>
                    <p class="text-[9px] text-gray-500 dark:text-gray-400 truncate w-32">
                        {{ Auth::user()->roles->pluck('name')->first() }}
                    </p>

                </div>
            </div>


            <ul class="mt-2 space-y-2 font-medium border-gray-200 dark:border-gray-700">

                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('dashboard') ? 'active-sidebar' : '' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <!-- Punto de Venta -->
                @role('administrador|vendedor|contador|inventario')
                <li>
                    <a href="{{ route('pos.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('pos.index') ? 'active-sidebar' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                            <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Punto de Venta</span>
                    </a>
                </li>
                @endrole
                    @role('administrador|contador|vendedor')
                <li>
                    <a href="{{ route('cash-closures.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('cash-closures.*') ? 'active-sidebar' : '' }}">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                        </svg>
                        <span class="ms-3">Cierres de Caja</span>
                    </a>
                </li>
                @endrole

                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                <!-- Clientes -->
                @role('administrador|vendedor|contador|inventario')
                <li>
                    <a href="{{ route('customer.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('customer.create') ? 'active-sidebar' : '' }}">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Clientes</span>
                    </a>
                </li>
                @endrole
  <!-- FACTURAS -->
                @role('administrador|contador|vendedor')
                <li>
                    <a href="{{ route('invoices.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('invoices.*') ? 'active-sidebar' : '' }}">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m8-2h3m-3 3h3m-4 3v6m4-3H8M19 4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 12v6h8v-6H8Z" />
                        </svg>
                        <span class="ms-3">Facturas</span>
                    </a>
                </li>
                @endrole
            </ul>
 
                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                <!-- Proveedores -->
                @role('administrador|inventario|contador|vendedor')
                <li>
                    <a href="{{ route('suppliers.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('suppliers.*') ? 'active-sidebar' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                            <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25ZM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.375a3 3 0 1 1 6 0h3a.75.75 0 0 0 .75-.75V15Z" />
                            <path d="M8.25 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0ZM15.75 6.75a.75.75 0 0 0-.75.75v11.25c0 .087.015.17.042.248a3 3 0 0 1 5.958.464c.853-.175 1.522-.935 1.464-1.883a18.659 18.659 0 0 0-3.732-10.104 1.837 1.837 0 0 0-1.47-.725H15.75Z" />
                            <path d="M19.5 19.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Proveedores</span>
                    </a>
                </li>
                @endrole
            
                <!-- Compras -->
                @role('administrador|inventario|contador|vendedor')
                <li>
                    <a href="{{ route('admin.purchases.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.purchases.*') ? 'active-sidebar' : '' }}">
                        
                 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    <path fill-rule="evenodd" d="M7.5 6v.75H5.513c-.96 0-1.764.724-1.865 1.679l-1.263 12A1.875 1.875 0 0 0 4.25 22.5h15.5a1.875 1.875 0 0 0 1.865-2.071l-1.263-12a1.875 1.875 0 0 0-1.865-1.679H16.5V6a4.5 4.5 0 1 0-9 0ZM12 3a3 3 0 0 0-3 3v.75h6V6a3 3 0 0 0-3-3Zm-3 8.25a3 3 0 1 0 6 0v-.75a.75.75 0 0 1 1.5 0v.75a4.5 4.5 0 1 1-9 0v-.75a.75.75 0 0 1 1.5 0v.75Z" clip-rule="evenodd" />
                    </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Compras provedores</span>
                    </a>
                </li>
                @endrole
            </ul>

 <!-- Productos -->
                @role('administrador|inventario|contador|vendedor')
                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                <li>
                    <a href="{{ route('admin.products.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.products.*') ? 'active-sidebar' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                            <path d="M12.378 1.602a.75.75 0 0 0-.756 0L3 6.632l9 5.25 9-5.25-8.622-5.03ZM21.75 7.93l-9 5.25v9l8.628-5.032a.75.75 0 0 0 .372-.648V7.93ZM11.25 22.18v-9l-9-5.25v8.57a.75.75 0 0 0 .372.648l8.628 5.033Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Productos</span>
                    </a>
                </li>
                @endrole
                <!-- Inventario -->
                @role('administrador|inventario|contador|vendedor')
                <li>
                    <a href="{{ route('admin.inventory.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.inventory.*') ? 'active-sidebar' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
  <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
  <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
</svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Inventario</span>
                    </a>
                </li>
                @endrole <!-- Categorias -->
                @role('administrador|inventario|contador|vendedor')
                <li>
                    <a href="{{ route('categories.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('categories.*') ? 'active-sidebar' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 22 22">
                            <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z" clip-rule="evenodd" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Categorias</span>
                    </a>
                </li>
                @endrole

                 <!-- Unidades -->
                @role('administrador|inventario|contador|vendedor')
                <li>
                    <a href="{{ route('admin.units.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.units.*') ? 'active-sidebar' : '' }}">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                    <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v.756a49.106 49.106 0 0 1 9.152 1 .75.75 0 0 1-.152 1.485h-1.918l2.474 10.124a.75.75 0 0 1-.375.84A6.723 6.723 0 0 1 18.75 18a6.723 6.723 0 0 1-3.181-.795.75.75 0 0 1-.375-.84l2.474-10.124H12.75v13.28c1.293.076 2.534.343 3.697.776a.75.75 0 0 1-.262 1.453h-8.37a.75.75 0 0 1-.262-1.453c1.162-.433 2.404-.7 3.697-.775V6.24H6.332l2.474 10.124a.75.75 0 0 1-.375.84A6.723 6.723 0 0 1 5.25 18a6.723 6.723 0 0 1-3.181-.795.75.75 0 0 1-.375-.84L4.168 6.241H2.25a.75.75 0 0 1-.152-1.485 49.105 49.105 0 0 1 9.152-1V3a.75.75 0 0 1 .75-.75Zm4.878 13.543 1.872-7.662 1.872 7.662h-3.744Zm-9.756 0L5.25 8.131l-1.872 7.662h3.744Z" clip-rule="evenodd" />
                    </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Unidades</span>
                    </a>
                </li>
                @endrole

            </ul>
        
            @php
            $finanzasOpen = request()->routeIs(
            'admin.income.*',
            'admin.expenses.*',
            'admin.movimientos.*',
            'admin.cuentas.*',
            'credit.*'
            );
            @endphp

            <li class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                    aria-controls="dropdown-finanzas"
                    aria-expanded="{{ $finanzasOpen ? 'true' : 'false' }}"
                    data-collapse-toggle="dropdown-finanzas">


                    <!-- Icono -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0 2c-4.418 0-8 2.239-8 5v3h16v-3c0-2.761-3.582-5-8-5Z" />
                    </svg>

                    <span class="flex-1 ms-3 text-left whitespace-nowrap">Finanzas</span>

                    <!-- Flecha -->
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 10 6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l4 4 4-4" />
                    </svg>
                </button>

                <!-- Submenú -->
                <ul id="dropdown-finanzas"
                    class="py-2 space-y-2 {{ $finanzasOpen ? '' : 'hidden' }}">

                    <li>
                        <a href="{{ route('admin.resumen.index') }}"
                            class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.resumen.*') ? 'active-sidebar' : '' }}">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                                <path fill-rule="evenodd" d="M2.25 2.25a.75.75 0 0 0 0 1.5H3v10.5a3 3 0 0 0 3 3h1.21l-1.172 3.513a.75.75 0 0 0 1.424.474l.329-.987h8.418l.33.987a.75.75 0 0 0 1.422-.474l-1.17-3.513H18a3 3 0 0 0 3-3V3.75h.75a.75.75 0 0 0 0-1.5H2.25Zm6.54 15h6.42l.5 1.5H8.29l.5-1.5Zm8.085-8.995a.75.75 0 1 0-.75-1.299 12.81 12.81
                            <span class="flex-1 ms-3 whitespace-nowrap">Resumen</span>
                        </a>
                    </li>
                    @role('administrador|contador|vendedor')
                    <li>
                        <a href="{{ route('credit.index') }}" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('credit.*') ? 'active-sidebar' : '' }}">
                            <!-- Lucide -->
                            <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm2-2a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm0 3a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2h-3Zm-6 4a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-6Zm8 1v1h-2v-1h2Zm0 3h-2v1h2v-1Zm-4-3v1H9v-1h2Zm0 3H9v1h2v-1Z" clip-rule="evenodd" />
                            </svg>

                            <span class="flex-1 ms-3 whitespace-nowrap">Cuentas por cobrar</span>
                        </a>
                    </li>
                    @endrole
                    <li>
                        <a href="{{ route('admin.income.index') }}"
                            class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.income.*') ? 'active-sidebar' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                                <path fill-rule="evenodd" d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z" clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Ingresos</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.expenses.index') }}" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.expenses.*') ? 'active-sidebar' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                                <path fill-rule="evenodd" d="M1.72 5.47a.75.75 0 0 1 1.06 0L9 11.69l3.756-3.756a.75.75 0 0 1 .985-.066 12.698 12.698 0 0 1 4.575 6.832l.308 1.149 2.277-3.943a.75.75 0 1 1 1.299.75l-3.182 5.51a.75.75 0 0 1-1.025.275l-5.511-3.181a.75.75 0 0 1 .75-1.3l3.943 2.277-.308-1.149a11.194 11.194 0 0 0-3.528-5.617l-3.809 3.81a.75.75 0 0 1-1.06 0L1.72 6.53a.75.75 0 0 1 0-1.061Z" clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Egresos</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.movimientos.index') }}" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.movimientos.*') ? 'active-sidebar' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                                <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75> 0 0 1-7.5 0ZM3.375 18a1.875 1.875 0 0 0-1.875 1.875v1.125C1.5 22.161 2.34 23 3.375 23h17.25c1.035 0 1.875-.84 1.875-1.875v-1.125a1.875 1.875 0 0 0-1.875-1.875H3.375Z" clip-rule="evenodd" />

                                <span class="flex-1 ms-3 whitespace-nowrap">Movimiento</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.cuentas.index') }}" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.cuentas.*') ? 'active-sidebar' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                                <path d="M11.584 2.376a.75.75 0 0 1 .832 0l9 6a.75.75 0 1 1-.832 1.248L12 3.901 3.416 9.624a.75.75 0 0 1-.832-1.248l9-6Z" />
                                <path fill-rule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 0 1 0 1.5H3a.75.75 0 0 1 0-1.5h.75v-9.918a.75.75 0 0 1 .634-.74A49.109 49.109 0 0 1 12 9c2.59 0 5.134.202 7.616.592a.75.75 0 0 1 .634.74Zm-1.5 1.5a47.61 47.61 0 0 0-13.5 0v8.418h13.5v-8.418Z" clip-rule="evenodd" />

                                <span class="flex-1 ms-3 whitespace-nowrap">Cuenta</span>
                        </a>
                    </li>
                </ul>
            </li>


               

               


            <!-- Sección administrativa - SOLO para administradores -->
            @role('administrador|contador|vendedor|inventario')
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                 <!-- Empresa -->
                @role('administrador|contador|inventario|vendedor')
                <li>
                    <a href="{{ route('admin.empresa.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.empresa.index') ? 'active-sidebar' : '' }}">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Empresa</span>
                    </a>
                </li>
                @endrole
                <li>
                    <a href="{{ route('admin.roles.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.roles.*') ? 'active-sidebar' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                            <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 0 1 3-3h3a3 3 0 0 1 3 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0 1 12 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 0 1 7.5 5.455V5.25Zm7.5 0v.09a49.488 49.488 0 0 0-6 0v-.09a1.5 1.5 0 0 1 1.5-1.5h3a1.5 1.5 0 0 1 1.5 1.5Zm-3 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            <path d="M3 18.4v-2.796a4.3 4.3 0 0 0 .713.31A26.226 26.226 0 0 0 12 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 0 1-6.477-.427C4.047 21.128 3 19.852 3 18.4Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Roles</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item {{ request()->routeIs('admin.users.*') ? 'active-sidebar' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Usuarios</span>
                    </a>
                </li>
            </ul>
            @endrole

            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                <!-- Perfil -->
                <li>
                    <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item sidebar-item {{ request()->routeIs('profile.*') ? 'active-sidebar' : '' }}">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Perfil</span>
                    </a>
                </li>

                <!-- Cerrar sesión -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group sidebar-item">
                            <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h11M4 8l4-4m-4 4l4 4m-5-3v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1Z" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap text-left">Cerrar Sesión</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Contenido principal -->
    <div class="p-4 sm:ml-64 pt-5">
        <div class="p-4 border-2 border-solid rounded-lg dark:border-gray-800 mt-2">
            {{ $slot }}
        </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('[data-drawer-toggle]');
        const sidebar = document.getElementById('default-sidebar');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
        });
    });
</script>
<script>
    (function () {
        const sidebar = document.getElementById('sidebar-scroll');
        if (!sidebar) return;

        const key = 'sidebar-scroll-position';
        const saved = localStorage.getItem(key);

        if (saved !== null) {
            sidebar.scrollTop = parseInt(saved, 10);
        }

        // Mostrar cuando ya está listo
        sidebar.style.visibility = 'visible';

        // Guardar posición
        sidebar.addEventListener('scroll', () => {
            localStorage.setItem(key, sidebar.scrollTop);
        });
    })();
</script>


</html>