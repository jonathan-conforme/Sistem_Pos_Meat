<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
        protected $fillable = [
            'product_id',
            'available_quantity',
            'min_stock',
            'max_stock',
            'created_by',
            'updated_by'
        ];
    public function product()
{
    return $this->BelongsTo(Product::class);
}

}
