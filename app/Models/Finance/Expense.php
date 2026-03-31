<?php

namespace App\Models\Finance;

use App\Models\Finance\Movimiento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    /**
     * Campos asignables
     */
    protected $fillable = [
        'expense_date',
        'amount',
        'description',
        'comment',
        'payment_method',
        'reference',
        'type',
        'created_by',
        'movimiento_id',

    ];

    /**
     * Casts
     */
    protected $casts = [
        'expense_date' => 'date',
        'amount'       => 'decimal:2',
    ];

    /**
     * Usuario que registró el egreso
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scopes útiles (opcional pero recomendado)
     */
    public function scopeBetweenDates($query, $from = null, $to = null)
    {
        return $query
            ->when($from, fn($q) => $q->whereDate('expense_date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('expense_date', '<=', $to));
    }

    public function movimiento()
    {
        return $this->belongsTo(Movimiento::class);
    }
    public function cuenta()
    {
        return $this->belongsTo(Movimiento::class, 'movimiento_id')->with('cuenta');
    }
}
