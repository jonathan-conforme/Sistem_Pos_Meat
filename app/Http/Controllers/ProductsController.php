<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'unit', 'creator', 'updater']);
        
        // Filtro por búsqueda (nombre, sku, código)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }
        
        // Filtro por estado (activo/inactivo)
        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }
        
        // Filtro por categoría (nuevo)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        // Filtro por unidad (nuevo)
        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }
        
        // Ordenamiento
        $query->latest();
        
        $products = $query->paginate(25)->withQueryString();
        
        // Estadísticas
        $stats = [
            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('active', true)->count(),
            'inactiveProducts' => Product::where('active', false)->count(),
        ];
        
        // Datos para los filtros
        $units = Unit::where('is_active', true)->orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('products.create', compact('products', 'stats', 'units', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
       $units = Unit::where('is_active', true) //  Solo unidades activas
            ->orderBy('name')
            ->get();
        
        $products = Product::with(['category', 'unit']) //  Cargar relaciones
            ->latest()
            ->paginate(50);

        $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        $stats = $this->getProductStats();

        return view('products.create', compact('products', 'categories', 'stats', 'units'));
    }

    private function getProductStats(): array
    {
        return [
            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('active', true)->count(),
            'inactiveProducts' => Product::where('active', false)->count(),

        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100|unique:products,code',
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'nullable|exists:categories,id',
            'default_cost' => 'required|numeric|min:0',
            'default_price' => 'required|numeric|min:0',
            'min_stock' => 'nullable|numeric|min:0',
            'max_stock' => 'nullable|numeric|min:0',
            'active' => 'required|boolean',

        ], [
            // Mensajes personalizados SOLO para este controller
            'code.unique' => 'Este código ya existe en el inventario. Por favor ingresa uno diferente.',

        ]);
        try {
            $sku = Product::generateSKU($validated['name']);

            $product = Product::create($validated + [
                'sku' => $sku,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),

            ]);
            $product->inventory()->create([
                'available_quantity' => 0,
                'min_stock' => $validated['min_stock'] ?? 0,
                'max_stock' => $validated['max_stock'] ?? null,
                'created_by' => auth()->id(),
            ]);

            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto creado correctamente.',
                    'product' => $product->load('category', 'unit'),
                    'stats' => $this->getProductStats(),
                ]);
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Producto creado correctamente.');

        } catch (\Exception $e) {
            \Log::error('Error al crear producto: '.$e->getMessage());

            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el producto: '.$e->getMessage(),
                ], 500);
            }

            return back()->withErrors(['error' => 'Error al crear el producto: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $product->load(['category', 'unit', 'inventory', 'creator', 'updater']); 
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {
        // Si la petición viene de AJAX, devolvemos JSON
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'product' => $product->load('category', 'unit', 'inventory'),
            ]);
        }


       $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        
        $units = Unit::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('products.edit', compact('product', 'categories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            // Validación
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'sku' => 'required|string|max:100|unique:products,sku,'.$product->id,
                'code' => 'nullable|string|max:100|unique:products,code,'.$product->id,
                'unit_id' => 'required|exists:units,id',
                'category_id' => 'nullable|exists:categories,id',
                'default_cost' => 'required|numeric|min:0',
                'default_price' => 'required|numeric|min:0',
                'active' => 'required|boolean',
                'min_stock' => 'nullable|numeric|min:0',
                'max_stock' => 'nullable|numeric|min:0',
            ], [
                'sku.unique' => 'Este SKU ya existe en el inventario. Por favor ingresa uno diferente.',
                'code.unique' => 'Este código ya existe en otro producto. Por favor ingresa uno diferente.',

            ]);
            // 1. Separar los datos del Producto (quitamos min_stock y max_stock)
            $productData = collect($validated)->except(['min_stock', 'max_stock'])->toArray();

            // 2. Actualizar el producto con los datos principales
            $product->update($validated + [
                'updated_by' => auth()->id(),
            ]);
            // 3. Preparar los datos del Inventario
            $inventoryData = [
                'min_stock' => $validated['min_stock'] ?? 0,
                'max_stock' => $validated['max_stock'] ?? null,
            ];

            // 4. Actualizar o crear el Inventario
            if ($product->inventory) {
                $product->inventory()->update($inventoryData);
            } else {
                // Por si acaso estás editando un producto viejo que no tenía inventario
                $product->inventory()->create($inventoryData + [
                    'available_quantity' => 0,
                    'created_by' => auth()->id(),
                ]);
            }
            //  Respuesta JSON (para fetch)
            if ($request->ajax() || $request->expectsJson()) {
                $product->load('inventory');
                return response()->json([
                    'success' => true,
                    'message' => 'Producto actualizado correctamente.',
                    'product' => $product,
                ]);
            }

            // Respuesta normal (form tradicional)
            return redirect()->route('admin.products.create')
                ->with('success', 'Producto actualizado correctamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Devolver errores de validación correctamente
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                    'message' => 'Errores de validación.',
                ], 422);
            }

            throw $e;
        } catch (\Throwable $th) {
            \Log::error('Error al actualizar producto: '.$th->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el producto: '.$th->getMessage(),
                ], 500);
            }

            return back()->withErrors(['error' => 'Error al actualizar el producto: '.$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.create')
            ->with('success', 'Producto eliminado correctamente.');
    }

    /**
     * Cambia el estado activo/inactivo del producto (AJAX).
     */
    public function toggle(Product $product)
    {
        try {
            // Cambiar el estado actual
            $product->active = ! $product->active;
            $product->updated_by = auth()->id();
            $product->save();

            // Recalcular estadísticas
            $stats = [
                'totalProducts' => Product::count(),
                'activeProducts' => Product::where('active', true)->count(),
                'inactiveProducts' => Product::where('active', false)->count(),
            ];

            return response()->json([
                'success' => true,
                'message' => $product->active ? 'Producto activado correctamente.' : 'Producto desactivado correctamente.',
                'product' => [ // Incluimos el producto con el estado actual
                    'id' => $product->id,
                    'active' => $product->active,
                ],
                'stats' => $stats,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error interno: '.$th->getMessage(),
            ], 500);
        }
    }
}
