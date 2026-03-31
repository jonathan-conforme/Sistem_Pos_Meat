<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'contact_name',
        'email',
        'address',
        'ruc',
        'notes'
    ];
}
