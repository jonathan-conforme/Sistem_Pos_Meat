<x-app-layout>

<div class="flex justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">💼 Cuentas</h1>
        <p class="text-sm text-gray-500">Caja y bancos</p>
    </div>

    <button onclick="document.getElementById('modal').classList.remove('hidden')"
        class="bg-blue-600 text-white px-4 py-2 rounded">
        + Nueva cuenta
    </button>
</div>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Nombre</th>
                <th class="p-3">Tipo</th>
                <th class="p-3 text-right">Saldo Inicial</th>
                <th class ="p-3 text-right">Saldo Actual</th>
                <th class="p-3">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuentas as $cuenta)
                <tr class="border-t text-center">
                    <td class="text-left p-3">{{ $cuenta->nombre }}</td>
                    <td class="p-3 capitalize">{{ $cuenta->tipo }}</td>
                    <td class="p-3 text-right font-semibold">
                        ${{ number_format($cuenta->saldo_inicial, 2) }}
                    </td>
                    <td class="p-3 text-right font-semibold">
                        ${{ number_format($cuenta->saldo_actual, 2) }}
                    </td>
                    <td class="p-3">
                        @if($cuenta->activa)
                            <span class="text-green-600">Activa</span>
                        @else
                            <span class="text-red-600">Inactiva</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL --}}
<div id="modal" class="fixed inset-0 bg-black/40 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded w-full max-w-md">
        <h2 class="font-semibold mb-4">Nueva cuenta</h2>

        <form method="POST" action="{{ route('admin.cuentas.store') }}">
            @csrf

            <div class="mb-3">
                <label>Nombre</label>
                <input name="nombre" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label>Tipo</label>
                <select name="tipo" class="w-full border rounded px-3 py-2">
                    <option value="caja">Caja</option>
                    <option value="banco">Banco</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Saldo inicial</label>
                <input type="number" step="0.01" name="saldo_inicial"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button"
                    onclick="document.getElementById('modal').classList.add('hidden')">
                    Cancelar
                </button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
<x-toast/>
</x-app-layout>
