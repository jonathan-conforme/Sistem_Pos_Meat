<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="max-w-7xl mx-auto">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Panel de Control</h1>
                    <p class="text-gray-600 mt-2">Administra todos los aspectos de tu sistema</p>
                </div>
                <div class="text-sm text-gray-500">
                    {{ now()->format('d/m/Y H:i') }}
                </div>
            </div>

            <!-- ==================== ESTADÍSTICAS DE VENTAS ==================== -->
            <!-- ==================== CIERRE DE CAJA POR USUARIO ==================== -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Mi Cierre de Caja</h2>
        @if(!$cashClosureStats['has_today_closure'])
            <a href="{{ route('cash-closures.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                <i class="fas fa-cash-register mr-2"></i>Realizar Mi Cierre
            </a>
        @else
            <div class="flex space-x-2">
                <a href="{{ route('cash-closures.index', $cashClosureStats['my_today_closure']) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-eye mr-2"></i>Ver Cierres de caja
                </a>
                @if(Auth::user()->hasRole('admin'))
                <a href="{{ route('cash-closures.index') }}" 
                   class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    <i class="fas fa-list mr-2"></i>Todos los Cierres
                </a>
                @endif
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Mi Estado del Cierre -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Mi Estado</h3>
                <div class="p-2 rounded-full {{ $cashClosureStats['has_today_closure'] ? 'bg-green-100' : 'bg-yellow-100' }}">
                    <i class="fas {{ $cashClosureStats['has_today_closure'] ? 'fa-check text-green-600' : 'fa-clock text-yellow-600' }}"></i>
                </div>
            </div>
            <p class="text-2xl font-bold {{ $cashClosureStats['has_today_closure'] ? 'text-green-600' : 'text-yellow-600' }} mb-2">
                {{ $cashClosureStats['has_today_closure'] ? 'Cerrado' : 'Pendiente' }}
            </p>
            <p class="text-xs text-gray-600">
                @if($cashClosureStats['has_today_closure'])
                    Cierre realizado: {{ $cashClosureStats['my_today_closure']->created_at->format('H:i') }}
                    @if($cashClosureStats['my_today_closure']->is_verified)
                        <span class="text-green-600 font-semibold">✓ Verificado</span>
                    @endif
                @else
                    Esperando mi cierre del día
                @endif
            </p>
        </div>

        <!-- Mis Ventas Efectivo -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Mis Ventas Efectivo</h3>
                <div class="p-2 bg-green-100 rounded-full">
                    <i class="fas fa-money-bill-wave text-green-600"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mb-2">
                ${{ number_format($cashClosureStats['my_cash_sales'], 2) }}
            </p>
            <p class="text-xs text-gray-600">Ventas en efectivo hoy</p>
        </div>

        <!-- Mis Ventas Totales -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Mis Ventas Totales</h3>
                <div class="p-2 bg-blue-100 rounded-full">
                    <i class="fas fa-chart-line text-blue-600"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mb-2">
                ${{ number_format($cashClosureStats['my_total_sales'], 2) }}
            </p>
            <p class="text-xs text-gray-600">{{ $cashClosureStats['my_sales_count'] }} ventas hoy</p>
        </div>

        <!-- Mi Ganancia -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Mi Ganancia</h3>
                <div class="p-2 bg-orange-100 rounded-full">
                    <i class="fas fa-coins text-orange-600"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-green-600 mb-2">
                ${{ number_format($cashClosureStats['my_profit'], 2) }}
            </p>
            <p class="text-xs text-gray-600">Ganancia generada hoy</p>
        </div>
    </div>

    <!-- Resumen de Mis Métodos de Pago -->
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Mis Ventas por Método - Hoy</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                <p class="text-sm font-medium text-green-700">Efectivo</p>
                <p class="text-xl font-bold text-green-800">${{ number_format($cashClosureStats['my_cash_sales'], 2) }}</p>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm font-medium text-blue-700">Tarjeta</p>
                <p class="text-xl font-bold text-blue-800">${{ number_format($cashClosureStats['my_card_sales'], 2) }}</p>
            </div>
            <div class="text-center p-4 bg-purple-50 rounded-lg border border-purple-200">
                <p class="text-sm font-medium text-purple-700">Transferencia</p>
                <p class="text-xl font-bold text-purple-800">${{ number_format($cashClosureStats['my_transfer_sales'], 2) }}</p>
            </div>
            <div class="text-center p-4 bg-orange-50 rounded-lg border border-orange-200">
                <p class="text-sm font-medium text-orange-700">Crédito</p>
                <p class="text-xl font-bold text-orange-800">${{ number_format($cashClosureStats['my_credit_sales'], 2) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Para Administradores: Resumen General -->
@if(Auth::user()->hasRole('admin'))
<div class="mb-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Resumen General de Cierres</h2>
        <a href="{{ route('cash-closures.index') }}" 
           class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
            <i class="fas fa-list mr-2"></i>Gestionar Cierres
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Cierres Hoy</h3>
                <div class="p-2 bg-blue-100 rounded-full">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mb-2">{{ $cashClosureStats['today_closures_count'] }}</p>
            <p class="text-sm text-gray-600">de {{ $cashClosureStats['active_users_count'] }} usuarios</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Ventas Totales</h3>
                <div class="p-2 bg-green-100 rounded-full">
                    <i class="fas fa-chart-bar text-green-600"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900 mb-2">${{ number_format($cashClosureStats['total_sales_today'], 2) }}</p>
            <p class="text-sm text-gray-600">Todos los vendedores</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Ganancia Total</h3>
                <div class="p-2 bg-orange-100 rounded-full">
                    <i class="fas fa-piggy-bank text-orange-600"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-green-600 mb-2">${{ number_format($cashClosureStats['total_profit_today'], 2) }}</p>
            <p class="text-sm text-gray-600">Ganancia del día</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Pendientes</h3>
                <div class="p-2 bg-yellow-100 rounded-full">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
            </div>
            <p class="text-2xl font-bold text-yellow-600 mb-2">{{ $cashClosureStats['pending_closures_count'] }}</p>
            <p class="text-sm text-gray-600">Cierres por verificar</p>
        </div>
    </div>
</div>
@endif
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Estadísticas de Ventas</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Ventas del Día -->
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">Ventas Hoy</h3>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold mb-2">{{ $salesToday }}</p>
                        <p class="text-green-100 text-sm">${{ number_format($salesTodayAmount, 2) }}</p>
                    </div>

                    <!-- Ventas de la Semana -->
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">Ventas Semana</h3>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold mb-2">{{ $salesThisWeek }}</p>
                        <p class="text-blue-100 text-sm">${{ number_format($salesThisWeekAmount, 2) }}</p>
                    </div>

                    <!-- Ventas del Mes -->
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">Ventas Mes</h3>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold mb-2">{{ $salesThisMonth }}</p>
                        <p class="text-purple-100 text-sm">${{ number_format($salesThisMonthAmount, 2) }}</p>
                        @if($salesGrowth != 0)
                        <p class="text-xs mt-1">
                            @if($salesGrowth > 0)
                                <span class="text-green-300">↑ {{ number_format($salesGrowth, 1) }}%</span>
                            @else
                                <span class="text-red-300">↓ {{ number_format(abs($salesGrowth), 1) }}%</span>
                            @endif
                            vs mes anterior
                        </p>
                        @endif
                    </div>

                    <!-- Ventas Totales -->
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-lg p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold">Ventas Totales</h3>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold mb-2">{{ $totalSales }}</p>
                        <p class="text-orange-100 text-sm">${{ number_format($totalSalesAmount, 2) }}</p>
                    </div>
                </div>

                <!-- Métodos de Pago -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Métodos de Pago</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($paymentMethods as $method)
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm font-medium text-gray-600 capitalize">{{ $method->payment_type }}</p>
                            <p class="text-xl font-bold text-gray-900">{{ $method->count }}</p>
                            <p class="text-xs text-gray-500">${{ number_format($method->amount, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ==================== ESTADÍSTICAS GENERALES ==================== -->
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Estadísticas Generales</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Clientes -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Clientes</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCustomers }}</p>
                            <p class="text-xs text-green-600 mt-1">Registrados</p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Productos -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Productos</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProducts }}</p>
                            <p class="text-xs text-orange-600 mt-1">En inventario</p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-xl">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Categorías -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Categorías</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCategories }}</p>
                            <p class="text-xs text-purple-600 mt-1">Creadas</p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-xl">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>
                <!-- Empresas -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Empresas</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCompanies }}</p>
                            <p class="text-xs text-blue-600 mt-1">Activas</p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-xl">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>

            
                <!-- Proveedores -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Proveedores</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalSuppliers }}</p>
                            <p class="text-xs text-indigo-600 mt-1">Registrados</p>
                        </div>
                        <div class="p-3 bg-indigo-100 rounded-xl">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

<!-- Facturas -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Facturas</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalInvoices }}</p>
                            <p class="text-xs text-red-600 mt-1">Este mes</p>
                        </div>
                        <div class="p-3 bg-red-100 rounded-xl">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Usuarios -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Usuarios</p>
                            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                            <p class="text-xs text-pink-600 mt-1">Activos</p>
                        </div>
                        <div class="p-3 bg-pink-100 rounded-xl">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== VENTAS RECIENTES ==================== -->
            @if($recentSales->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Ventas Recientes</h3>
                    <a href="{{ route('invoices.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Ver todas →
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 text-sm font-medium text-gray-600">N° Venta</th>
                                <th class="text-left py-2 text-sm font-medium text-gray-600">Cliente</th>
                                <th class="text-left py-2 text-sm font-medium text-gray-600">Fecha</th>
                                <th class="text-left py-2 text-sm font-medium text-gray-600">Método Pago</th>
                                <th class="text-right py-2 text-sm font-medium text-gray-600">Total</th>
                                <th class="text-center py-2 text-sm font-medium text-gray-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSales as $sale)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 text-sm font-medium text-gray-900">
                                    {{ $sale->sale_number }}
                                </td>
                                <td class="py-3 text-sm text-gray-600">
                                    {{ $sale->customer->name ?? 'Cliente General' }}
                                </td>
                                <td class="py-3 text-sm text-gray-600">
                                    {{ $sale->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-3 text-sm text-gray-600 capitalize">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $sale->payment_type == 'cash' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $sale->payment_type == 'card' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $sale->payment_type == 'transfer' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $sale->payment_type == 'credit' ? 'bg-orange-100 text-orange-800' : '' }}">
                                        {{ $sale->payment_type }}
                                    </span>
                                </td>
                                <td class="py-3 text-sm text-gray-900 text-right">
                                    ${{ number_format($sale->total, 2) }}
                                </td>
                                <td class="py-3 text-sm text-center">
                                    <a href="{{ route('invoices.show', $sale->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 mx-1">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- ==================== PRODUCTOS MÁS VENDIDOS ==================== -->
            @if($topProducts->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Productos Más Vendidos</h3>
                <div class="space-y-3">
                    @foreach($topProducts as $item)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <span class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs mr-3">
                                {{ $loop->iteration }}
                            </span>
                            <span class="text-sm font-medium text-gray-900">
                                {{ $item->product->name ?? 'Producto no disponible' }}
                            </span>
                        </div>
                        <span class="text-sm text-gray-600 bg-white px-2 py-1 rounded">
                            {{ $item->total_sold }} vendidos
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

    <script>
        // Actualizar la hora cada minuto
        function updateTime() {
            const now = new Date();
            const day = now.getDate().toString().padStart(2, '0');
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const year = now.getFullYear();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            
            const formattedTime = `${day}/${month}/${year} ${hours}:${minutes}`;
            document.querySelector('.text-gray-500.text-sm').textContent = formattedTime;
        }

        updateTime();
        setInterval(updateTime, 60000);

        // Actualizar estadísticas de ventas cada 2 minutos
        function updateSalesStats() {
            fetch('{{ route("dashboard.stats") }}')
                .then(response => response.json())
                .then(data => {
                    // Aquí puedes actualizar los contadores de ventas si los necesitas
                    console.log('Stats actualizados:', data);
                })
                .catch(error => console.error('Error actualizando stats:', error));
        }

        // Descomenta si quieres actualización automática
        // setInterval(updateSalesStats, 120000);
    </script>
</x-app-layout>