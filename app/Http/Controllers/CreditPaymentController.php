<?php

namespace App\Http\Controllers;

use App\Models\CreditPayment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditPaymentController extends Controller
{
    public function index()
    {
        $sales = Sale::where('payment_type', 'credit')
            ->where('status', 'pending')
            ->with('customer')
            ->get();

        return view('credit.index', compact('sales'));
    }

    public function show(Sale $sale)
    {
        $sale->load('customer', 'payments');
        return view('credit.show', compact('sale'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

        $sale = Sale::findOrFail($request->sale_id);

        // Crear abono
        CreditPayment::create([
            'sale_id' => $sale->id,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'received_by' => Auth::id(),
        ]);

        // Recalcular saldo
        $paid = $sale->payments()->sum('amount');

        if ($paid >= $sale->total) {
            $sale->status = 'completed';
            $sale->completed_at = now();
            $sale->save();
        }

        return response()->json(['message' => 'Pago registrado con éxito']);
    }
}
