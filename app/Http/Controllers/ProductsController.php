<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::with(['creator', 'updater'])
            ->latest()
            ->filter(request(['search', 'unit_type', 'active']))
            ->paginate(25);
        $stats = $this->getProductStats();
        return view('products.create', compact('products', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $products = Product::latest()->paginate(25);
        $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
  $stats = $this->getProductStats();
        return view('products.create', compact('products', 'categories', 'stats'));
    }
 private function getProductStats(): array
    {
        return [
            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('active', true)->count(),
            'inactiveProducts' => Product::where('active', false)->count(),
            'lowStockProducts' => Product::where('quantity', '<', \DB::raw('min_stock'))->count(),
            'outOfStockProducts' => Product::where('quantity', '<=', 0)->count(),
            'totalInventoryValue' => Product::sum(\DB::raw('quantity * default_cost')),
            'totalPotentialRevenue' => Product::sum(\DB::raw('quantity * default_price')),
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
        'unit_type' => 'required|in:lb,unit,package',
        'default_cost' => 'required|numeric|min:0',
        'default_price' => 'required|numeric|min:0',
        'entry_date' => 'nullable|date',
        'expiration_date' => 'nullable|date|after_or_equal:entry_date',
        'quantity' => 'required|numeric|min:0',
        'min_stock' => 'nullable|numeric|min:0',
        'max_stock' => 'nullable|numeric|min:0',
        'active' => 'required|boolean',
        'track_quantity' => 'sometimes|boolean',
        'track_expiration' => 'sometimes|boolean',
    ], [
    // Mensajes personalizados SOLO para este controller
    'code.unique' => 'Este código ya existe en el inventario. Por favor ingresa uno diferente.',
    'expiration_date.after_or_equal' => 'La fecha de caducidad debe ser igual o posterior a la fecha de ingreso.',
]);
    try {
        $sku = Product::generateSKU($validated['name']);

        $product = Product::create($validated + [
            'sku' => $sku,
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto creado correctamente.',
                'product' => $product,
                'stats' => $this->getProductStats()
            ]);
        }

        
        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado correctamente.');

    } catch (\Exception $e) {
        \Log::error('Error al crear producto: ' . $e->getMessage());

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el producto: ' . $e->getMessage()
            ], 500);
        }

        return back()->withErrors(['error' => 'Error al crear el producto: ' . $e->getMessage()]);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
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
            'product' => $product
        ]);
    }

    // Si no, devolvemos la vista normalmente
    return view('products.edit', compact('product'));
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
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'code' => 'nullable|string|max:100|unique:products,code,' . $product->id,
            'unit_type' => 'required|in:lb,unit,package',
            'default_cost' => 'required|numeric|min:0',
            'default_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'entry_date' => 'nullable|date',
            'expiration_date' => 'nullable|date|after_or_equal:entry_date',
            'active' => 'required|boolean',
            'min_stock' => 'nullable|numeric|min:0',
            'max_stock' => 'nullable|numeric|min:0',    
            'track_quantity' => 'sometimes|boolean',
            'track_expiration' => 'sometimes|boolean',


        ], [
            'sku.unique' => 'Este SKU ya existe en el inventario. Por favor ingresa uno diferente.',
            'code.unique' => 'Este código ya existe en otro producto. Por favor ingresa uno diferente.',
            'expiration_date.after_or_equal' => 'La fecha de caducidad debe ser igual o posterior a la fecha de ingreso.',
  
        ]);

        // Actualizar
        $product->update($validated + [
            'updated_by' => auth()->id()
        ]);

        //  Respuesta JSON (para fetch)
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto actualizado correctamente.',
                'product' => $product
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
                'message' => 'Errores de validación.'
            ], 422);
        }

        throw $e; 
    } catch (\Throwable $th) {
        \Log::error('Error al actualizar producto: ' . $th->getMessage());

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el producto: ' . $th->getMessage()
            ], 500);
        }

        return back()->withErrors(['error' => 'Error al actualizar el producto: ' . $th->getMessage()]);
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
        $product->active = !$product->active;
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
                'active' => $product->active
            ],
            'stats' => $stats
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'success' => false,
            'message' => 'Error interno: ' . $th->getMessage()
        ], 500);
    }
}

}
