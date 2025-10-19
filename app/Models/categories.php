<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class categories extends Model
{
     use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'color',
        'is_active',
        'sort_order',
        'parent_id',

    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Relación: Una categoría puede tener muchos productos
     */
    public function products(): HasMany
{
    return $this->hasMany(Product::class, 'category_id');
}

    /**
     * Relación: Una categoría puede tener subcategorías
     */
    public function children(): HasMany
    {
        return $this->hasMany(categories::class, 'parent_id');
    }

    /**
     * Relación: Una categoría puede tener una categoría padre
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    /**
     * Scope: Categorías activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Categorías principales (sin padre)
     */
    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope: Buscar por nombre o código
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
    }

    /**
     * Generar código automático
     */
    public static function generateCode($name): string
    {
        $words = explode(' ', $name);
        $code = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $code .= strtoupper(substr($word, 0, 1));
            }
        }
        
        $code .= date('Y');
        
        // Verificar si el código ya existe
        $counter = 1;
        $originalCode = $code;
        
        while (self::where('code', $code)->exists()) {
            $code = $originalCode . '_' . $counter;
            $counter++;
        }
        
        return $code;
    }

    /**
     * Verificar si la categoría tiene productos
     */
    public function hasProducts(): bool
    {
        return $this->products()->exists();
    }

    /**
     * Obtener la ruta completa de la categoría
     */
    public function getFullPathAttribute(): string
    {
        $path = [$this->name];
        $parent = $this->parent;
        
        while ($parent) {
            array_unshift($path, $parent->name);
            $parent = $parent->parent;
        }
        
        return implode(' → ', $path);
    }
}
