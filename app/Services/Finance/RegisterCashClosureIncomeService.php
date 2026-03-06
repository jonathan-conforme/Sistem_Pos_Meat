<?php

namespace App\Services\Finance;

use App\Models\CashClosure;
use App\Models\Finance\Movimiento;
use App\Models\Finance\Cuenta;
use Exception;

class RegisterCashClosureIncomeService
{
    public function execute(CashClosure $cashClosure): void
    {
        $reference = 'cash_closure_' . $cashClosure->id;

    if (Movimiento::where('referencia', $reference)->exists()) {
        return;
        }

        $this->registerIncome(
            config('finance.accounts.cash'),
            $cashClosure->cash_sales,
            'Ventas en efectivo',
            'cash',
            $cashClosure,
            $reference
        );

        $this->registerIncome(
            config('finance.accounts.bank'),
            $cashClosure->card_sales,
            'Ventas con tarjeta',
            'card',
            $cashClosure,
            $reference
        );

        $this->registerIncome(
            config('finance.accounts.bank'),
            $cashClosure->transfer_sales,
            'Ventas por transferencia',
            'transfer',
            $cashClosure,
            $reference
        );

      
    }

   private function registerIncome($accountId, $amount, $label, $metodoPago,  CashClosure $cashClosure, $reference): void
{
    if ($amount <= 0) {
        return;
    }

    $cuenta = \App\Models\Finance\Cuenta::find($accountId);

    if (!$cuenta) {
        return;
    }

    Movimiento::create([
        'tipo' => 'ingreso',
        'cuenta_id' => $cuenta->id,
        'fecha' => $cashClosure->closure_date,
        'monto' => $amount,
        'metodo_pago' => $metodoPago,
        'descripcion' => $label . ' cierre #' . $cashClosure->id,
        'referencia' => $reference,
        'created_by' => $cashClosure->user_id,
    ]);

    $cuenta->increment('saldo_actual', $amount);
}

}
