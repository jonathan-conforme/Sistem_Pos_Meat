<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Services\SalesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('active', true)
            ->select('id', 'code', 'name', 'default_price')
            ->get();

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
    public function store(Request $request, SalesService $salesService)
    {
        $request->validate([
            'customer_id' => 'nullable|integer|exists:customers,id',
            'payment_type' => 'required|in:cash,credit,card,transfer',
            'amount_paid' => 'nullable|numeric|min:0',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        try {
            $sale = $salesService->createSale(
                $request->all(),
                Auth::id()
            );

            return response()->json([
                'success' => true,
                'sale_id' => $sale->id,
                'sale_number' => $sale->sale_number,
                'total_without_iva' => $sale->subtotal, // subtotal sin IVA
                'total' => $sale->total,               // total con IVA
                'change' => $sale->change,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
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
        if (! $lastSale) {
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
