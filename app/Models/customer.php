<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'name',
        'cedula',
        'email',
        'phone',
        'address',
        'comments',
        'created_by',
        'updated_by',
    ];
}
