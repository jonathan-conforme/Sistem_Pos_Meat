<?php

namespace App\Http\Controllers\Finanzas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Finance\Movimiento;
use App\Models\Finance\Cuenta;
use Illuminate\Support\Facades\DB;

class ResumenController extends Controller
{
   
public function index()
{
    // 📊 Egresos por día
    $egresosPorDia = Movimiento::select(
            DB::raw('DATE(fecha) as fecha'),
            DB::raw('SUM(monto) as total')
        )
        ->where('tipo', 'egreso')
        ->groupBy('fecha')
        ->orderBy('fecha')
        ->get();

    $chartDiasLabels = $egresosPorDia->pluck('fecha')->toArray();
    $chartDiasData   = $egresosPorDia->pluck('total')->toArray();

    // 🥧 Tipos de egresos
    $tipos = DB::table('expenses')
        ->select('type', DB::raw('SUM(amount) as total'))
        ->groupBy('type')
        ->get();

    $chartTiposLabels = $tipos->pluck('type')->toArray();
    $chartTiposData   = $tipos->pluck('total')->toArray();

    // 💰 Totales
    $totales = Movimiento::select(
        DB::raw("SUM(CASE WHEN tipo = 'ingreso' THEN monto ELSE 0 END) as total_ingresos"),
        DB::raw("SUM(CASE WHEN tipo = 'egreso' THEN monto ELSE 0 END) as total_egresos")
    )->first();

    return view('finance.resumen.index', compact(
        'chartDiasLabels',
        'chartDiasData',
        'chartTiposLabels',
        'chartTiposData',
        'totales'
    ));
}
}
