<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
     protected $fillable = [
        'nombre',
        'tipo',
        'saldo_inicial',
        'saldo_actual',
        'activa',
    ];

    // Relación: una cuenta tiene muchos movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
