<?php

namespace App\Http\Controllers\Finanzas;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use App\Models\Inventory;
use App\Models\InventoryMovement;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        
    $purchases = Purchase::all();
    $purchases->load('supplier', 'items.product');
            return view('purchases.index', compact('purchases'));       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::where('active', 1)->get();

        return view('purchases.create', compact(
            'suppliers',
            'products'
        ));

    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
   
    DB::beginTransaction();

    try {

        $validated = $request->validate([
            'purchase_number' => 'required|unique:purchases',
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'notes' => 'nullable|string',
            'products' => 'required|array',
        ]);

        $purchase = Purchase::create([
            'purchase_number' => $request->purchase_number,
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
            'total' => 0
        ]);

        $total = 0;

        foreach ($request->products as $item) {

    $subtotal = $item['quantity'] * $item['cost'];

    // ✅ guardar detalle compra
    PurchaseItem::create([
        'purchase_id' => $purchase->id,
        'product_id' => $item['product_id'],
        'quantity' => $item['quantity'],
        'cost_per_unit' => $item['cost'],
        'subtotal' => $subtotal
    ]);

    // 🔥 INVENTARIO
    $inventory = Inventory::firstOrCreate(
        ['product_id' => $item['product_id']],
        ['available_quantity' => 0]
    );

    $stockBefore = $inventory->available_quantity;

    $inventory->increment('available_quantity', $item['quantity']);

    $stockAfter = $inventory->available_quantity;

    // 🔥 MOVIMIENTO
    InventoryMovement::create([
        'product_id' => $item['product_id'],
        'type' => 'purchase',
        'quantity' => $item['quantity'],
        'stock_before' => $stockBefore,
        'stock_after' => $stockAfter,
        'reference_id' => $purchase->id,
        'reference_type' => 'purchase',
        'created_by' => auth()->id(),
        'notes' => 'Ingreso por compra'
    ]);

    $total += $subtotal;
}
$purchase->update(['total' => $total]);
        DB::commit();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Compra registrada correctamente');

    } catch (\Exception $e) {

        DB::rollBack();

        \Log::error('Error al registrar compra: '.$e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
{
    $purchase->load('items.product', 'supplier');
    
    // Aquí llamas a la carpeta "purchases" y al archivo "show"
    return view('purchases.show', compact('purchase'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
