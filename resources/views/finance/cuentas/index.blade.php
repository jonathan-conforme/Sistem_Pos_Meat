<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- ENCABEZADO --}}
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        {{-- Icono principal (Heroicon: building-library) --}}
                        <div class="p-3 bg-indigo-100 rounded-lg text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                Cuentas Financieras
                            </h2>
                            <p class="text-sm text-gray-500 mt-1 flex items-center gap-1.5">
                                {{-- Icono pequeño de información --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-gray-400">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                </svg>
                                Saldos actuales de caja y bancos
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLA --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Inicial</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Actual</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($cuentas as $cuenta)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $cuenta->nombre }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{-- Badge para el tipo con icono --}}
                                            @if($cuenta->tipo == 'banco')
                                                <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">
                                                    {{-- Icono: Building (Banco) --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                                        <path d="M2.879 7.121A3 3 0 001.5 9.732a10.198 10.198 0 001.5 6.018V17a1 1 0 001 1h12a1 1 0 001-1v-1.25a10.198 10.198 0 001.5-6.018 3 3 0 00-1.379-2.611l-4.5-3a3 3 0 00-3.242 0l-4.5 3zM10 11a1 1 0 100-2 1 1 0 000 2z" />
                                                    </svg>
                                                    {{ $cuenta->tipo }}
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800 capitalize">
                                                    {{-- Icono: Wallet (Caja) --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                                        <path d="M2.25 2.25a.75.75 0 000 1.5h1.35l2.237 9.461a.75.75 0 00.73.589h9.183a.75.75 0 00.732-.604l1.353-5.313a1.875 1.875 0 00-1.841-2.233H6.28l-.327-1.383a.75.75 0 00-.73-.589H2.25z" />
                                                        <path d="M6.58 18a1.3 1.3 0 102.6 0 1.3 1.3 0 00-2.6 0zm9.2 0a1.3 1.3 0 102.6 0 1.3 1.3 0 00-2.6 0z" />
                                                    </svg>
                                                    {{ $cuenta->tipo }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500 font-mono">
                                            ${{ number_format($cuenta->saldo_inicial, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-gray-900 font-mono">
                                            ${{ number_format($cuenta->saldo_actual, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{-- Badge para el estado con icono --}}
                                            @if($cuenta->activa)
                                                <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{-- Icono: Check-circle --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                                    </svg>
                                                    Activa
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 inline-flex items-center gap-1.5 text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    {{-- Icono: X-circle --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                                    </svg>
                                                    Inactiva
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <x-toast/>
</x-app-layout>