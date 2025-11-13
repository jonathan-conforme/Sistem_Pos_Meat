<?php

namespace App\Http\Controllers;

use App\Models\CreditPayment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class CreditPaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = Sale::where('payment_type', 'credit')
            ->where('status', 'pending')
            ->with('customer');

        // 🔹 Si el usuario es vendedor, mostrar solo sus ventas
        if ($user->hasRole('vendedor')) {
            $query->where('created_by', $user->id);
        }

        // 🔹 Si el usuario es administrador, contador o inventario, mostrar todas
        // (no hace falta else porque ya se aplica por defecto)

         $sales = $query->orderBy('created_at', 'desc')->get();

        return view('credit.index', compact('sales'));
    }

    public function show(Sale $sale)
    {
        $user = Auth::user();

        // 🔹 Si el usuario es vendedor, solo puede ver sus propios créditos
        if ($user->hasRole('vendedor') && $sale->created_by !== $user->id) {
            abort(403, 'No tienes permiso para ver este crédito.');
        }

        // 🔹 Otros roles (admin, contador, inventario) pueden ver todos
        $sale->load(['customer', 'createdBy', 'payments' => function ($query) {
            $query->orderBy('created_at', 'desc'); // 🔹 Último pago primero
        }]);

        return view('credit.show', compact('sale'));
    }

    public function store(Request $request, Sale $sale)
    {
        $user = Auth::user();
        // 🔹 Verificar permisos para vendedor
        if ($user->hasRole('vendedor') && $sale->created_by !== $user->id) {
            return response()->json([
                'error' => 'No tienes permiso para registrar pagos en esta venta'
            ], 403);
        }
        $request->validate([

            'amount' => 'required|numeric|min:0.01',
            'notes' => 'nullable|string',
        ]);

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
