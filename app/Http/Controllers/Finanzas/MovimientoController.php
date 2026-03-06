<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use App\Models\Finance\Movimiento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
       $movimientos = Movimiento::with('cuenta')
        ->when($request->from, fn($q) =>
            $q->whereDate('fecha', '>=', $request->from))
        ->when($request->to, fn($q) =>
            $q->whereDate('fecha', '<=', $request->to))
        ->when($request->tipo, fn($q) =>
            $q->where('tipo', $request->tipo))
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function ($mov) {
            return Carbon::parse($mov->fecha)->format('Y-m-d');
        });

    return view('finance.movimientos.index', compact('movimientos'));
}

public function timeline(Request $request)
{
    $movimientos = Movimiento::with('cuenta')
        
        ->orderBy('created_at', 'desc')
        ->get();

    return view('finance.movimientos.timeline', compact('movimientos'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Movimiento $movimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movimiento $movimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movimiento $movimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movimiento $movimiento)
    {
        //
    }
}
