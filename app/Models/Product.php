<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'code',
        'unit_type',
        'default_cost',
        'default_price',
        'quantity',
        'min_stock',
        'max_stock',
        'creation_date',
        'entry_date',
        'expiration_date',
        'manufacture_date',
        'active',
        'track_expiration',
        'track_quantity',
        'created_by',
        'updated_by',
        'category_id'

    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function (Builder $query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        })
            ->when($filters['unit_type'] ?? null, function (Builder $query, $unitType) {
                $query->where('unit_type', $unitType);
            })
            ->when(isset($filters['active']), function (Builder $query) use ($filters) {
                $query->where('active', $filters['active']);
            });
    }

    /**
     * Generar SKU automático secuencial (001, 002, 003, etc.)
     */
    public static function generateSKU($name)
    {
        // 1. Generar iniciales
        $words = preg_split('/\s+/', trim($name));
        $initials = '';
        foreach ($words as $word) {
            if ($word && strlen($initials) < 3) {
                $initials .= strtoupper($word[0]);
            }
        }
        $initials = str_pad($initials, 3, 'X');

        // 2. Buscar el número máximo usado para este prefijo
        $lastSkuNumber = self::where('sku', 'like', "{$initials}-%")
            ->get()
            ->map(function ($item) use ($initials) {
                $parts = explode('-', $item->sku);
                return isset($parts[1]) ? intval($parts[1]) : 0;
            })
            ->max();

        $nextNumber = $lastSkuNumber ? $lastSkuNumber + 1 : 1;

        // 3. Formatear a 3 dígitos
        $number = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return "{$initials}-{$number}";
    }
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
