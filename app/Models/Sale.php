<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'sale_number',
        'customer_id',
        'created_by',
        'subtotal',
        'tax.00',
        'discount',
        'total',
        'payment_type',
        'status',
        'notes',
    ];

    public function items()
    {
        return $this->hasMany(sale_items::class, 'sale_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function payments()
{
    return $this->hasMany(CreditPayment::class);
}

public function getTotalPaidAttribute()
{
    return $this->payments->sum('amount');
}

public function getRemainingAttribute()
{
    return $this->total - $this->total_paid;
}

}
