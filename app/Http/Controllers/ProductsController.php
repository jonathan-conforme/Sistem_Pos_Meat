<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\categories;

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
        $categories = categories::active()
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
        ]);

        try {
            $sku = Product::generateSKU($validated['name']);

            $product = Product::create($validated + [
                'sku' => $sku,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto creado correctamente.',
                    'product' => $product,
                     'stats' => $this->getProductStats() // ← Enviar stats actualizadas
                ]);
            }

            return redirect()->route('admin.products.index')
                ->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            \Log::error('Error al crear producto: ' . $e->getMessage());

            if ($request->ajax()) {
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
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'code' => 'nullable|string|max:100|unique:products,code,' . $product->id,
            'unit_type' => 'required|in:lb,unit,package',
            'default_cost' => 'required|numeric|min:0',
            'default_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'active' => 'required|boolean',
        ]);

        $product->update($validated + [
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('admin.products.create')
            ->with('success', 'Producto actualizado correctamente.');
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
}
