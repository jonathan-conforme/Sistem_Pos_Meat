<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\sale_items;
use App\Models\Product;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::select('id', 'code', 'name', 'default_price')->get();
        return view('pos.index', compact('products')); 
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

            // Generar número de venta en el nuevo formato
            $saleNumber = $this->generateSaleNumber();

            $sale = Sale::create([
                'sale_number' => $saleNumber, // Usamos el nuevo formato
                'subtotal' => $subtotal,
                'tax' => $iva,
                'discount' => 0,
                'total' => $total,
                'payment_type' => $request->payment_type,
                'status' => $request->payment_type === 'credit' ? 'pending' : 'completed',
                'comments' => $request->comments,
                'customer_id' => $request->customer_id,
                'created_by' => Auth::id(),  
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
                'sale_number' => $saleNumber,
                'total_without_iva' => $sale->subtotal,
                'total_with_iva' => $sale->total       
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Generar número de venta en formato 001-001-000000012
     */
    private function generateSaleNumber()
    {
        // Obtener el último número de venta
        $lastSale = Sale::orderBy('id', 'desc')->first();
        
        // Si no hay ventas, empezar desde 1
        if (!$lastSale) {
            $nextNumber = 1;
        } else {
            // Extraer el número secuencial del último sale_number
            $lastNumber = $this->extractSequentialNumber($lastSale->sale_number);
            $nextNumber = $lastNumber + 1;
        }
        
        // Formatear el número (9 dígitos)
        $sequential = str_pad($nextNumber, 9, '0', STR_PAD_LEFT);
        
        // Retornar en formato 001-001-000000012
        return "001-001-{$sequential}";
    }

    /**
     * Extraer el número secuencial del sale_number
     */
    private function extractSequentialNumber($saleNumber)
    {
        // Si el formato es el nuevo (001-001-000000012)
        if (preg_match('/\d{3}-\d{3}-(\d{9})/', $saleNumber, $matches)) {
            return (int) $matches[1];
        }
        
        // Si el formato es el antiguo (VTA-20251026233650)
        // Buscar venta más reciente con nuevo formato
        $lastNewFormatSale = Sale::where('sale_number', 'like', '001-001-%')
                                ->orderBy('id', 'desc')
                                ->first();
        
        if ($lastNewFormatSale) {
            return $this->extractSequentialNumber($lastNewFormatSale->sale_number) + 1;
        }
        
        // Si no hay ventas con nuevo formato, empezar desde el ID actual
        $lastSale = Sale::orderBy('id', 'desc')->first();
        return $lastSale ? $lastSale->id : 1;
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