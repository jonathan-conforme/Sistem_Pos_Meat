<?php

namespace App\Http\Controllers;

use App\Models\CreditPayment;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class CreditPaymentController extends Controller
{

public function index(Request $request)
{
    $user = Auth::user();

    // Tomamos el término de búsqueda (trim para evitar espacios)
    $search = trim($request->input('search', ''));

    // Base de la query
    $query = Sale::query()
        ->where('payment_type', 'credit')
        ->where('status', 'pending')
        ->with('customer');

    // Si el usuario es vendedor, limitar a sus ventas
    if ($user->hasRole('vendedor')) {
        $query->where('created_by', $user->id);
    }

    // Si llega search, aplicamos filtros: invoice_number OR customer.name OR customer.cedula
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('sale_number', 'LIKE', "%{$search}%")
              ->orWhereHas('customer', function ($c) use ($search) {
                  $c->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('cedula', 'LIKE', "%{$search}%");
              });
        });
    }

    // Orden y paginación (mejor que ->get() para listados largos)
    $sales = $query->orderBy('created_at', 'desc')
                   ->paginate(15) // 15 por página; ajusta si quieres
                   ->appends($request->only('search')); // mantiene ?search= en links

    return view('credit.index', compact('sales', 'search'));
}


    public function show(Sale $sale)
    {
        $user = Auth::user();

        // 🔹 Si el usuario es vendedor, solo puede ver sus propios créditos
        if ($user->hasRole('vendedor') && $sale->created_by !== $user->id) {
            abort(403, 'No tienes permiso para ver este crédito.');
        }
  $sale->refresh();
        // 🔹 Otros roles (admin, contador, inventario) pueden ver todos
        $sale->load(['customer', 'createdBy', 'payments' => function ($query) {
            $query->orderBy('created_at', 'desc'); // 🔹 Último pago primero
        }]);

        return view('credit.show', compact('sale'));
    }

   public function store(Request $request, Sale $sale)
{
    $user = Auth::user();

    // Permiso para vendedores
    if ($user->hasRole('vendedor') && $sale->created_by !== $user->id) {
        return response()->json([
            'message' => 'No tienes permiso para registrar pagos en esta venta.'
        ], 403);
    }

    // Validación
    $request->validate([
        'amount' => 'required|numeric|min:0.01',
        'notes'  => 'nullable|string'
    ]);

    // Evitar pagos mayores al saldo
   $remainingCorrect = $sale->subtotal - $sale->payments()->sum('amount');

if ($request->amount > $remainingCorrect) {
    return response()->json([
        'message' => 'El monto excede el saldo pendiente.'
    ], 422);
}


    // Crear pago
    CreditPayment::create([
        'sale_id'     => $sale->id,
        'amount'      => $request->amount,
        'notes'       => $request->notes,
        'received_by' => Auth::id(),
    ]);

    $sale->refresh();
    // Recalcular totales
    $totalPaid = $sale->payments()->sum('amount');
    $remaining = $sale->subtotal - $totalPaid;

    $sale->update([
        'total_paid' => $totalPaid,
        'remaining'  => $remaining,
        'status'     => $remaining <= 0 ? 'completed' : 'pending',
        'completed_at' => $remaining <= 0 ? now() : null,
    ]);

    

    return response()->json([
        'message' => 'Pago registrado con éxito.',
        'sale_id' => $sale->id,
    'total_paid' => $totalPaid,
    'remaining' => $remaining,
    'status' => $sale->status,
    'total_paid_formatted' => number_format($totalPaid, 2),
    'remaining_formatted' => number_format($remaining, 2),
    ]);
}

}
