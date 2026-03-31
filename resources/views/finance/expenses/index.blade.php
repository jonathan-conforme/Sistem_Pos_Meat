@php
    // Mapeo amigable para los métodos de pago
    $metodos = [
        'cash'     => ['label' => 'Efectivo', 'color' => 'bg-emerald-100 text-emerald-700 border-emerald-200'],
        'transfer' => ['label' => 'Transferencia', 'color' => 'bg-blue-100 text-blue-700 border-blue-200'],
        'card'     => ['label' => 'Tarjeta', 'color' => 'bg-purple-100 text-purple-700 border-purple-200'],
    ];
@endphp

<x-app-layout>
   
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                        
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total Egresos Filtrados</p>
                            <p class="text-3xl font-bold text-gray-900">
                                ${{ number_format($total, 2) }}
                            </p>
                        </div>

                        <form method="GET" class="flex flex-col sm:flex-row gap-4 items-end w-full md:w-auto">
                            <div>
                                <label for="from" class="block text-sm font-medium text-gray-700">Desde</label>
                                <input type="date" name="from" id="from" value="{{ $from }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="to" class="block text-sm font-medium text-gray-700">Hasta</label>
                                <input type="date" name="to" id="to" value="{{ $to }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <div class="flex gap-2">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition">
                                    Filtrar
                                </button>
                                <a href="{{ route('admin.expenses.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition">
                                    Limpiar
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
 <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg ">
        
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Egresos') }}
            </h2>
            <button onclick="document.getElementById('expenseModal').classList.remove('hidden')" 
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                + Nuevo Egreso
            </button>
        </div>
        
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ref / Factura</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Método</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($expenses as $expense)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $expense->created_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $expense->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $expense->description }}</div>
                                        <div class="text-xs text-gray-500 capitalize">{{ $expense->type ?? 'Gasto General' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $expense->reference ?? 'S/N' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
    @php 
        $infoMetodo = $metodos[$expense->payment_method] ?? ['label' => $expense->payment_method, 'color' => 'bg-gray-100 text-gray-800']; 
    @endphp
    
    <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-xs leading-5 font-semibold rounded-full {{ $infoMetodo['color'] }}">
        
        @if($expense->payment_method == 'cash')
            {{-- Icono: Billetes (Efectivo) --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                <path fill-rule="evenodd" d="M1 4.25a.75.75 0 01.75-.75h16.5a.75.75 0 01.75.75v11.5a.75.75 0 01-.75.75H1.75a.75.75 0 01-.75-.75V4.25zM3.25 5v9.5h13.5V5H3.25z" clip-rule="evenodd" />
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
        @elseif($expense->payment_method == 'transfer')
            {{-- Icono: Flechas (Transferencia) --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                <path fill-rule="evenodd" d="M17.03 5.72a.75.75 0 010 1.06l-3 3a.75.75 0 11-1.06-1.06l1.72-1.72H2.75a.75.75 0 010-1.5h11.94l-1.72-1.72a.75.75 0 111.06-1.06l3 3zM2.97 14.28a.75.75 0 010-1.06l3-3a.75.75 0 111.06 1.06l-1.72 1.72h11.94a.75.75 0 010 1.5H5.31l1.72 1.72a.75.75 0 11-1.06 1.06l-3-3z" clip-rule="evenodd" />
            </svg>
        @elseif($expense->payment_method == 'card')
            {{-- Icono: Tarjeta de Crédito --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 001 5.5V6h18v-.5A1.5 1.5 0 0017.5 4h-15zM19 8.5H1v6A1.5 1.5 0 002.5 16h15a1.5 1.5 0 001.5-1.5v-6zM3 13.25a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm4.75-.75a.75.75 0 000 1.5h3.5a.75.75 0 000-1.5h-3.5z" clip-rule="evenodd" />
            </svg>
        @else
            {{-- Icono por defecto (Círculo) por si hay un método no reconocido --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                <circle cx="10" cy="10" r="4" />
            </svg>
        @endif

        {{ $infoMetodo['label'] }}
    </span>
</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-900">
                                        ${{ number_format($expense->amount, 2) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No se encontraron registros de egresos.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL (Ajustado al estilo clásico) --}}
    <div id="expenseModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden flex items-center justify-center z-50 p-4 transition-opacity">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Registrar Nuevo Egreso
                        </h3>
                        <div class="mt-4">
                            
                            <form action="{{ route('admin.expenses.store') }}" method="POST" class="space-y-4 text-left">
                                @csrf

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Fecha</label>
                                        <input type="date" name="expense_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ now()->toDateString() }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Monto ($)</label>
                                        <input type="number" step="0.01" name="amount" placeholder="0.00" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <input type="text" name="description" placeholder="Detalle del gasto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nº Factura / Ref</label>
                                        <input type="text" name="reference" placeholder="Opcional" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Método de Pago</label>
                                        <select name="payment_method" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="cash">Efectivo</option>
                                            <option value="transfer">Transferencia</option>
                                            <option value="card">Tarjeta</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Cuenta de Origen</label>
                                        <select name="cuenta_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            @foreach($cuentas as $cuenta)
                                                <option value="{{ $cuenta->id }}">{{ $cuenta->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Categoría</label>
                                        <select name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="gasto">Gasto</option>
                                            <option value="mercaderia">Mercadería</option>
                                            <option value="mantenimiento">Mantenimiento</option>
                                            <option value="servicio">Servicio</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse -mx-4 -mb-4 mt-6">
                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Guardar Egreso
                                    </button>
                                    <button type="button" onclick="document.getElementById('expenseModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancelar
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <x-toast />
</x-app-layout>