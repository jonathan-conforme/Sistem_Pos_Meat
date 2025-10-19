<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale_items extends Model
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'sale_mode',
        'quantity',
        'price_per_unit',
        'cost_per_unit',
        'subtotal',
        'profit',
        'inventory_id',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
