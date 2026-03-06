<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
     protected $fillable = [
        'tipo',
        'cuenta_id',
        'cuenta_destino_id',
        'fecha',
        'monto',
        'metodo_pago',
        'descripcion',
        'referencia',
        'created_by',
    ];

 protected $casts = [
        'fecha' => 'date',      // convierte a Carbon
        'monto' => 'decimal:2',
    ];

    protected static function booted()
    {
        static::created(function ($movimiento) {
            $cuenta = Cuenta::find($movimiento->cuenta_id);

            if (!$cuenta) return;

            if ($movimiento->tipo === 'ingreso') {
                $cuenta->increment('saldo_actual', $movimiento->monto);
            }

            if ($movimiento->tipo === 'egreso') {
                $cuenta->decrement('saldo_actual', $movimiento->monto);
            }

            if ($movimiento->tipo === 'transferencia' && $movimiento->cuenta_destino_id) {
                $cuentaDestino = Cuenta::find($movimiento->cuenta_destino_id);

                if ($cuentaDestino) {
                    $cuenta->decrement('saldo_actual', $movimiento->monto);
                    $cuentaDestino->increment('saldo_actual', $movimiento->monto);
                }
            }
        });
    }
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }

    public function cuentaDestino()
    {
        return $this->belongsTo(Cuenta::class, 'cuenta_destino_id');
    }

    public function expense()
    {
        return $this->hasOne(Expense::class);
    }
}
