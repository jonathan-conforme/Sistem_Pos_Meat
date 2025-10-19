<?php

namespace App\Http\Controllers;

use App\Models\CashClosure;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashClosureController extends Controller
{
    public function index()
    {
        $closures = CashClosure::with('user')
            ->latest()
            ->paginate(20);

        return view('cash-closures.index', compact('closures'));
    }

    public function create()
    {
        $userId = Auth::id();

        // Verificar si ya hay apertura pendiente o cierre completado
        $todayClosure = CashClosure::whereDate('closure_date', today())
            ->where('user_id', $userId)
            ->first();

        if ($todayClosure && $todayClosure->status === 'completed') {
            return redirect()->route('cash-closures.show', $todayClosure)
                ->with('warning', 'Ya existe un cierre de caja para hoy.');
        }

        // Resumen de ventas
        $salesData = Sale::whereDate('created_at', today())
            ->where('created_by', $userId)
            ->selectRaw('
                COALESCE(SUM(CASE WHEN payment_type = "cash" THEN total ELSE 0 END), 0) as cash,
                COALESCE(SUM(CASE WHEN payment_type = "card" THEN total ELSE 0 END), 0) as card,
                COALESCE(SUM(CASE WHEN payment_type = "transfer" THEN total ELSE 0 END), 0) as transfer,
                COALESCE(SUM(CASE WHEN payment_type = "credit" THEN total ELSE 0 END), 0) as credit,
                COALESCE(SUM(total), 0) as total,
                COUNT(*) as count
            ')
            ->first();

        $salesSummary = [
            'cash' => $salesData->cash,
            'card' => $salesData->card,
            'transfer' => $salesData->transfer,
            'credit' => $salesData->credit,
            'total' => $salesData->total,
            'count' => $salesData->count
        ];

        return view('cash-closures.create', compact('salesSummary'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([

            'physical_cash' => 'required|numeric|min:0',
            'observations' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();

            $salesData = Sale::whereDate('created_at', today())
                ->where('created_by', $userId)
                ->selectRaw('
                    COALESCE(SUM(CASE WHEN payment_type = "cash" THEN total ELSE 0 END), 0) as cash_sales,
                    COALESCE(SUM(CASE WHEN payment_type = "card" THEN total ELSE 0 END), 0) as card_sales,
                    COALESCE(SUM(CASE WHEN payment_type = "transfer" THEN total ELSE 0 END), 0) as transfer_sales,
                    COALESCE(SUM(CASE WHEN payment_type = "credit" THEN total ELSE 0 END), 0) as credit_sales,
                    COALESCE(SUM(total), 0) as total_sales,
                    COUNT(*) as sales_count
                ')
                ->first();

            $initialCash = $request->initial_cash;
            $physicalCash = $request->physical_cash;
            $cashSales = $salesData->cash_sales;
            $totalCash = $initialCash + $cashSales;
            $difference = $physicalCash - $totalCash;

            // Si existe apertura pendiente, la actualizamos
            $closure = CashClosure::whereDate('closure_date', today())
                ->where('user_id', $userId)
                ->where('status', 'pending')
                ->first();

            if ($closure) {
                $closure->update([
                    'closure_time' => now(),
                    'physical_cash' => $physicalCash,
                    'cash_sales' => $cashSales,
                    'card_sales' => $salesData->card_sales,
                    'transfer_sales' => $salesData->transfer_sales,
                    'credit_sales' => $salesData->credit_sales,
                    'total_sales' => $salesData->total_sales,
                    'total_cash' => $totalCash,
                    'expected_cash' => $totalCash,
                    'difference' => $difference,
                    'sales_count' => $salesData->sales_count,
                    'average_ticket' => $salesData->sales_count > 0 ? $salesData->total_sales / $salesData->sales_count : 0,
                    'observations' => $request->observations,
                    'status' => 'completed'
                ]);
            } else {
                // Si no hay apertura pendiente, crear cierre normal
                $closure = CashClosure::create([
                    'closure_date' => today(),
                    'closure_time' => now(),
                    'initial_cash' => $initialCash,
                    'physical_cash' => $physicalCash,
                    'cash_sales' => $cashSales,
                    'card_sales' => $salesData->card_sales,
                    'transfer_sales' => $salesData->transfer_sales,
                    'credit_sales' => $salesData->credit_sales,
                    'total_sales' => $salesData->total_sales,
                    'total_cash' => $totalCash,
                    'expected_cash' => $totalCash,
                    'difference' => $difference,
                    'sales_count' => $salesData->sales_count,
                    'average_ticket' => $salesData->sales_count > 0 ? $salesData->total_sales / $salesData->sales_count : 0,
                    'observations' => $request->observations,
                    'user_id' => $userId,
                    'status' => 'completed'
                ]);
            }

            DB::commit();

            return redirect()->route('cash-closures.show', $closure)
                ->with('success', 'Cierre de caja registrado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en cierre de caja: ' . $e->getMessage());
            return back()->with('error', 'Error al registrar el cierre: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(CashClosure $cashClosure)
    {
        $sales = Sale::where('created_by', $cashClosure->user_id)
            ->whereDate('created_at', $cashClosure->closure_date)
            ->with('items')
            ->get();

        return view('cash-closures.show', compact('cashClosure', 'sales'));
    }

    public function getTodaySummary()
    {
        $userId = Auth::id();

        $salesData = Sale::whereDate('created_at', today())
            ->where('created_by', $userId)
            ->selectRaw('
            COALESCE(SUM(CASE WHEN payment_type = "cash" THEN total ELSE 0 END), 0) as cash,
            COALESCE(SUM(CASE WHEN payment_type = "card" THEN total ELSE 0 END), 0) as card,
            COALESCE(SUM(CASE WHEN payment_type = "transfer" THEN total ELSE 0 END), 0) as transfer,
            COALESCE(SUM(CASE WHEN payment_type = "credit" THEN total ELSE 0 END), 0) as credit,
            COALESCE(SUM(total), 0) as total,
            COUNT(*) as count
        ')
            ->first();

        // Verificar si hay caja abierta (pending) O cerrada (completed) hoy
        $todayClosure = CashClosure::whereDate('closure_date', today())
            ->where('user_id', $userId)
            ->first();

        $summary = [
            'cash' => $salesData->cash,
            'card' => $salesData->card,
            'transfer' => $salesData->transfer,
            'credit' => $salesData->credit,
            'total' => $salesData->total,
            'count' => $salesData->count,
            'has_closure' => $todayClosure ? true : false,
            'closure_status' => $todayClosure ? $todayClosure->status : null
        ];

        return response()->json($summary);
    }
    // ----------- APERTURA DE CAJA ------------

    public function open()
    {
        $userId = Auth::id();

        $todayClosure = CashClosure::whereDate('closure_date', today())
            ->where('user_id', $userId)
            ->first();

        if ($todayClosure) {
            if ($todayClosure->status === 'pending') {
                return redirect()->route('pos.index')
                    ->with('warning', 'Ya tienes una caja abierta hoy.');
            } elseif ($todayClosure->status === 'completed') {
                return redirect()->route('pos.index')
                    ->with('info', 'Ya se realizó el cierre de caja para hoy.');
            }
        }

        return view('cash-closures.open');
    }
    public function storeOpen(Request $request)
    {
        $request->validate([
            'initial_cash' => 'required|numeric|min:0',
            'observations' => 'nullable|string|max:500'
        ]);

        CashClosure::create([
            'closure_date' => today(),
            'initial_cash' => $request->initial_cash,
            'user_id' => Auth::id(),
            'status' => 'pending',
            'observations' => $request->observations
        ]);

        return redirect()->route('pos.index')
            ->with('success', 'Apertura de caja registrada correctamente.');
    }
}
