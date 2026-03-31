<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class PurchaseItem extends Model
{
    protected $fillable =[
        'purchase_id',
        'product_id',
        'cost_per_unit',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'reference_id',
        'reference_type',
        'created_by',
        'notes',
        'subtotal'
        

    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}
}
