<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Supplier;
class Purchase extends Model
{
    protected $fillable =[
        'purchase_number',
        'supplier_id',
        'purchase_date',
        'notes',
        'crated_by',
        'updated_by',
        'total',


    ];
    protected static function booted()
{
    static::creating(function ($purchase) {
        $purchase->created_by = auth()->id();
    });
}
public function supplier()
{
    return $this->belongsTo(Supplier::class);
}
public function items()
{
    return $this->hasMany(PurchaseItem::class);

}


}