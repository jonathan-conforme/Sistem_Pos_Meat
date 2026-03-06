@php
    // Mapeo amigable para los métodos de pago
    $metodos = [
        'cash'     => ['label' => 'Efectivo', 'color' => 'bg-emerald-100 text-emerald-700 border-emerald-200'],
        'transfer' => ['label' => 'Transferencia', 'color' => 'bg-blue-100 text-blue-700 border-blue-200'],
        'card'     => ['label' => 'Tarjeta', 'color' => 'bg-purple-100 text-purple-700 border-purple-200'],
    ];
@endphp

<x-app-layout>
    <div class="max-w-6xl mx-auto space-y-8 pb-10">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div>
    <h1 class="text-3xl  text-gray-900 tracking-tight flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8 text-red-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
        </svg>
        <span>Egresos</span>
    </h1>
    <p class="text-sm text-gray-500 mt-1 ml-10">Control y registro de gastos y salidas de dinero</p>
</div>
              

            <button
                onclick="document.getElementById('expenseModal').classList.remove('hidden')"
                class="mt-4 md:mt-0 bg-red-600 hover:bg-red-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-red-200 transition-all active:scale-95 flex items-center gap-2">
                <span>+</span> Nuevo egreso
            </button>
        </div>

        {{-- FILTROS + TOTAL --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Card Total --}}
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm flex flex-col justify-center">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total egresos</p>
                <p class="text-4xl text-red-500">
                    <span class="text-4xl">$</span>{{ number_format($total, 2) }}
                </p>
            </div>

            {{-- Filtros Mejorados --}}
            <div class="md:col-span-2 bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <form method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-1 w-full">
                        <label class="block text-xs text-gray-500 mb-1 uppercase text-[10px]">Desde</label>
                        <input type="date" name="from" value="{{ $from }}"
                            class="bg-gray-50 border-gray-200 rounded-xl px-3 py-2.5 w-full focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>

                    <div class="flex-1 w-full">
                        <label class="block text-xs text-gray-500 mb-1 uppercase text-[10px]">Hasta</label>
                        <input type="date" name="to" value="{{ $to }}"
                            class="bg-gray-50 border-gray-200 rounded-xl px-3 py-2.5 w-full focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-none bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl transition-all shadow-md">
                            Filtrar
                        </button>
                        <a href="{{ route('admin.expenses.index') }}"
                            class="flex-1 md:flex-none bg-gray-100 hover:bg-gray-200 px-6 py-2.5 rounded-xl text-gray-600  text-center transition-all">
                            Limpiar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- TABLA DE EGRESOS --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all hover:shadow-md">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] text-gray-400 uppercase tracking-widest">Fecha</th>
                            <th class="px-6 py-4 text-left text-[10px] text-gray-400 uppercase tracking-widest">Descripción</th>
                            <th class="px-6 py-4 text-left text-[10px] text-gray-400 uppercase tracking-widest">Ref / Factura</th>
                            <th class="px-6 py-4 text-left text-[10px] text-gray-400 uppercase tracking-widest">Método</th>
                            <th class="px-6 py-4 text-right text-[10px] text-gray-400 uppercase tracking-widest">Monto</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($expenses as $expense)
                        <tr class="hover:bg-gray-50/80 transition-colors group">
                            {{-- FECHA --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-800">
                                    {{ $expense->created_at->format('d M, Y') }}
                                </div>
                                <div class="text-[11px] text-gray-400 capitalize">
                                    {{ $expense->created_at->translatedFormat('l H:i') }}
                                </div>
                            </td>

                            {{-- DESCRIPCIÓN --}}
                            <td class="px-6 py-4">
                                <div class=" text-gray-800 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                    {{ $expense->description }}
                                </div>
                                <div class="text-[11px] text-gray-400 ml-3 uppercase">
                                    {{ $expense->type ?? 'Gasto General' }}
                                </div>
                            </td>

                            {{-- FACTURA --}}
                            <td class="px-6 py-4">
                                <span class="text-xs font-mono bg-gray-100 px-2 py-1 rounded text-gray-500">
                                    {{ $expense->reference ?? 'S/N' }}
                                </span>
                            </td>

                            {{-- MÉTODO --}}
                            <td class="px-6 py-4">
                                @php $infoMetodo = $metodos[$expense->payment_method] ?? ['label' => $expense->payment_method, 'color' => 'bg-gray-100 text-gray-600 border-gray-200']; @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-medium uppercase border {{ $infoMetodo['color'] }}">
                                    {{ $infoMetodo['label'] }}
                                </span>
                            </td>

                            {{-- MONTO --}}
                            <td class="px-6 py-4 text-right">
                                <span class=" font-medium text-red-600">
                                    - ${{ number_format($expense->amount, 2) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl mb-4">🍃</span>
                                    <p class="text-gray-400 font-medium">No hay registros de egresos en este periodo.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL MEJORADO --}}
    <div id="expenseModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl w-full max-w-lg overflow-hidden shadow-2xl animate-in fade-in zoom-in duration-200">
            <div class="bg-red-600 p-6">
                <h2 class="text-xl text-white">Nuevo Egreso</h2>
                <p class="text-red-100 text-xs">Completa los datos para registrar la salida de dinero</p>
            </div>

            <form action="{{ route('admin.expenses.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Fecha</label>
                        <input type="date" name="expense_date" class="w-full border-gray-200 rounded-xl bg-gray-50 px-3 py-2 text-sm" value="{{ now()->toDateString() }}">
                    </div>
                    <div class="col-span-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Monto ($)</label>
                        <input type="number" step="0.01" name="amount" placeholder="0.00" class="w-full border-gray-200 rounded-xl bg-gray-50 px-3 py-2 text-sm font-bold text-red-600" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Descripción</label>
                    <input type="text" name="description" placeholder="¿En qué se gastó?" class="w-full border-gray-200 rounded-xl bg-gray-50 px-3 py-2 text-sm" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nº Factura / Ref</label>
                        <input type="text" name="reference" placeholder="Opcional" class="w-full border-gray-200 rounded-xl bg-gray-50 px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Método de Pago</label>
                        <select name="payment_method" class="w-full border-gray-200 rounded-xl bg-gray-50 px-3 py-2 text-sm font-semibold">
                            <option value="cash">Efectivo</option>
                            <option value="transfer">Transferencia</option>
                            <option value="card">Tarjeta</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Cuenta de Origen</label>
                        <select name="cuenta_id" class="w-full border-gray-200 rounded-xl bg-gray-50 px-3 py-2 text-sm" required>
                            @foreach($cuentas as $cuenta)
                                <option value="{{ $cuenta->id }}">{{ $cuenta->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 uppercase mb-1">Categoría</label>
                        <select name="type" class="w-full border-gray-200 rounded-xl bg-gray-50 px-3 py-2 text-sm">
                            <option value="gasto">Gasto</option>
                            <option value="mercaderia">Mercadería</option>
                            <option value="mantenimiento">Mantenimiento</option>
                            <option value="servicio">Servicio</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" onclick="document.getElementById('expenseModal').classList.add('hidden')"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-500  hover:bg-gray-50 transition-all text-sm">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-2.5 rounded-xl shadow-lg shadow-red-100 transition-all active:scale-95 text-sm">
                        Registrar Egreso
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <x-toast />
</x-app-layout>