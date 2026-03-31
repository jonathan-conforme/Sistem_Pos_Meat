<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class InventoryMovement extends Model
{
    //
    protected $fillable = [
    'product_id',
    'type',
    'quantity',
    'stock_before',
    'stock_after',
    'reference_id',
    'reference_type',
    'created_by',
    'notes'
];
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}