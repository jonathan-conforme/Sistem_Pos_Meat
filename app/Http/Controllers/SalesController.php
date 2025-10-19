<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\sale_items;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id', 'code', 'name', 'default_price')->get();
        return view('pos.index', compact('products')); // tu vista se llama 'sales.pos'

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('pos.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|integer|exists:customers,id',
            'payment_type' => 'required|in:cash,credit,card,transfer',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $subtotal = collect($request->items)->sum(fn($item) => $item['qty'] * $item['price']);
            $iva = $subtotal * 0.15;
            $total = $subtotal + $iva;

            $sale = Sale::create([
                'sale_number' => 'VTA-' . now()->format('YmdHis'),
                'subtotal' => $subtotal,
                'tax' => $iva,
                'discount' => 0,
                'total' => $total,
                'payment_type' => $request->payment_type,
                'status' => $request->payment_type === 'credit' ? 'pending' : 'completed',
                'comments' => $request->comments,
                'customer_id' => $request->customer_id,
                'created_by' => Auth::id(),  // ← CORRECTO según migración
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                $subtotalItem = $item['price'] * $item['qty'];

                sale_items::create([
                    'sale_mode' => 'unit',
                    'quantity' => $item['qty'],
                    'price_per_unit' => $item['price'],
                    'cost_per_unit' => $product->cost ?? 0,
                    'subtotal' => $subtotalItem,
                    'profit' => $subtotalItem - (($product->cost ?? 0) * $item['qty']),
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                ]);

                // Actualizar inventario
                if ($product->stock !== null) {
                    $product->stock -= $item['qty'];
                    $product->save();
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Venta registrada con éxito',
                'sale_id' => $sale->id,
                'total_without_iva' => $sale->subtotal, // TOTAL SIN IVA
                'total_with_iva' => $sale->total       // TOTAL CON IVA (opcional)
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Sale $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sales)
    {
        $sales->delete();
        return response()->json(['message' => 'Item eliminado correctamente']);
    }
}
