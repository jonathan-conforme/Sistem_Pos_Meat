<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CashClosure extends Model
{
    protected $fillable = [
        'closure_date',
        'closure_time',
        'initial_cash',
        'physical_cash',
        'cash_sales',
        'card_sales',
        'transfer_sales',
        'credit_sales',
        'total_sales',
        'total_profit',
        'total_cash',
        'expected_cash',
        'difference',
        'sales_count',
        'average_ticket',
        'status',
        'observations',
        'user_id',
        'verified_by',
        'verified_at'
    ];

    protected $casts = [
        'closure_date' => 'date',
        'closure_time' => 'datetime',
        'initial_cash' => 'decimal:2',
        'physical_cash' => 'decimal:2',
        'cash_sales' => 'decimal:2',
        'card_sales' => 'decimal:2',
        'transfer_sales' => 'decimal:2',
        'credit_sales' => 'decimal:2',
        'total_sales' => 'decimal:2',
        'total_profit' => 'decimal:2',
        'total_cash' => 'decimal:2',
        'expected_cash' => 'decimal:2',
        'difference' => 'decimal:2',
        'average_ticket' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Scopes para filtros
    public function scopeToday($query)
    {
        return $query->whereDate('closure_date', today());
    }

    public function scopeUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('closure_date', now()->year)
                    ->whereMonth('closure_date', now()->month);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // CORREGIDO: Este scope estaba mal - usa 'status' en lugar de Auth::id()
    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    // NUEVO: Método para obtener las ventas asociadas (sin closure_id)
    public function getSalesAttribute()
    {
        return Sale::where('created_by', $this->user_id)
            ->whereDate('created_at', $this->closure_date)
            ->get();
    }

    // NUEVO: Relación con el usuario que creó las ventas (para eager loading)
    public function salesUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accesores
    public function getDifferenceFormattedAttribute()
    {
        return $this->difference >= 0 
            ? '<span class="text-green-600">+$' . number_format($this->difference, 2) . '</span>'
            : '<span class="text-red-600">-$' . number_format(abs($this->difference), 2) . '</span>';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'completed' => 'bg-blue-100 text-blue-800',
            'verified' => 'bg-green-100 text-green-800'
        ];

        $statuses = [
            'pending' => 'Pendiente',
            'completed' => 'Completado',
            'verified' => 'Verificado'
        ];

        return '<span class="px-2 py-1 text-xs font-medium rounded-full ' . 
               ($badges[$this->status] ?? 'bg-gray-100 text-gray-800') . '">' .
               ($statuses[$this->status] ?? $this->status) . '</span>';
    }

    public function getIsVerifiedAttribute()
    {
        return $this->status === 'verified';
    }

    // ELIMINADO: La relación que dependía de closure_id
    /*
    public function sales()
    {
        return $this->hasMany(Sale::class, 'closure_id');
    }
    */

    // NUEVO: Accesores útiles
    public function getCashTotalAttribute()
    {
        return $this->initial_cash + $this->cash_sales;
    }

    public function getIsBalancedAttribute()
    {
        return $this->difference == 0;
    }

    public function getFormattedTotalSalesAttribute()
    {
        return '$' . number_format($this->total_sales, 2);
    }
}