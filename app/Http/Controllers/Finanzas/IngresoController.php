<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use App\Models\Finance\Movimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index(Request $request)
    {
        $query = Movimiento::with('cuenta')
            ->where('tipo', 'ingreso')
            ->orderBy('updated_at', 'desc');

        // FILTROS DE FECHA
        if ($request->filled('from')) {
            $query->whereDate('fecha', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('fecha', '<=', $request->to);
        }

        // FILTRO POR TIPO (ingreso / egreso / transferencia)
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        // RANGOS RÁPIDOS
        if ($request->range === 'hoy') {
            $query->whereDate('fecha', Carbon::today());
        }

        if ($request->range === 'semana') {
            $query->whereBetween('fecha', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
        }

        $movimientos = $query->get()
    ->groupBy(function ($mov) {
        return Carbon::parse($mov->fecha)->format('Y-m-d');
    });


        return view('finance.income.index', compact('movimientos'));
    }
}
