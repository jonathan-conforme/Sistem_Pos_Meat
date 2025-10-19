<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre',
        'razon_social',
        'ruc',
        'matriz',
        'sucursal',
        'telefono',
        'email',
        'obligado_contabilidad',
        'tipo_ruc',
        'contribuyente_especial',
        'logo',
    ];
}
