<?php

namespace App\Http\Controllers\Finanzas;

use App\Models\Finance\Movimiento;
use App\Http\Controllers\Controller;
use App\Models\Finance\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Finance\Cuenta;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //



    public function index(Request $request)
    {
        $from = $request->get('from');
        $to   = $request->get('to');

        $expenses = Expense::query()
            ->when(
                $from,
                fn($q) =>
                $q->whereDate('expense_date', '>=', $from)
            )
            ->when(
                $to,
                fn($q) =>
                $q->whereDate('expense_date', '<=', $to)
            )
            ->orderBy('expense_date', 'desc')
            ->get();

        $total = $expenses->sum('amount');
        $cuentas = Cuenta::orderBy('nombre')->get();

        return view('finance.expenses.index', compact(
            'expenses',
            'from',
            'to',
            'total',
            'cuentas'

        ));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'cuenta_id'      => 'required|exists:cuentas,id',
        'expense_date'   => 'required|date',
        'amount'         => 'required|numeric|min:0.01',
        'description'    => 'required|string|max:255',
        'payment_method' => 'required|string',
    ]);

    $cuenta = Cuenta::findOrFail($request->cuenta_id);

    if ($cuenta->saldo_actual < $request->amount) {
        return back()
            ->with('error', 'Saldo insuficiente en la cuenta seleccionada.')
            ->withInput();
    }

    try {

        DB::transaction(function () use ($request) {

            $movimiento = Movimiento::create([
                'tipo' => 'egreso',
                'cuenta_id' => $request->cuenta_id,
                'fecha' => $request->expense_date,
                'monto' => $request->amount,
                'metodo_pago' => $request->payment_method,
                'descripcion' => $request->description,
                'referencia' => $request->reference,
                'created_by' => auth()->id(),
            ]);

            Expense::create([
                'expense_date' => $request->expense_date,
                'amount' => $request->amount,
                'description' => $request->description,
                'comment' => $request->comment,
                'payment_method' => $request->payment_method,
                'reference' => $request->reference,
                'type' => $request->type,
                'created_by' => auth()->id(),
                'movimiento_id' => $movimiento->id,
            ]);
        });

    } catch (\Throwable $e) {

        Log::error('Error registrando egreso: ' . $e->getMessage());

        return back()
            ->with('error', 'Ocurrió un error al registrar el egreso.')
            ->withInput();
    }

    return redirect()
        ->route('admin.expenses.index')
        ->with('success', 'Egreso registrado correctamente');
}
    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
