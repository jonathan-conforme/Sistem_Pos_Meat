<?php

namespace App\Services\Finance;

class ChartService
{
    /**
     * Procesa una colección de movimientos y devuelve la data formateada para las gráficas.
     */
    public function getIncomeChartData($movimientos)
    {
        // 1. Gráfica de Tendencia (Días)
        $ingresosPorDia = $movimientos->sortBy('fecha')->groupBy('fecha')->map(function ($row) {
            return $row->sum('monto');
        });

        // 2. Gráfica de Métodos de Pago
        $ingresosPorMetodo = $movimientos->groupBy('metodo_pago')->map(function ($row) {
            return $row->sum('monto');
        });

        $nombresMetodos = [
            'cash' => 'Efectivo',
            'transfer' => 'Transferencia',
            'card' => 'Tarjeta'
        ];

        return [
            'chartDiasLabels'    => $ingresosPorDia->keys()->toArray(),
            'chartDiasData'      => $ingresosPorDia->values()->toArray(),
            'chartMetodosLabels' => $ingresosPorMetodo->keys()->map(fn($m) => $nombresMetodos[$m] ?? ucfirst($m))->toArray(),
            'chartMetodosData'   => $ingresosPorMetodo->values()->toArray(),
        ];
    }
}