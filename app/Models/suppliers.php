<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
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
