<?php

namespace App\Http\Controllers\Finanzas;

use App\Http\Controllers\Controller;
use App\Models\Finance\cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuentas = Cuenta::orderBy('nombre')->get();
        return view('finance.cuentas.index', compact('cuentas'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
   
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:caja,banco',
            'saldo_inicial' => 'required|numeric|min:0',
        ]);

        Cuenta::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'saldo_inicial' => $request->saldo_inicial,
            'saldo_actual' => $request->saldo_inicial,
        ]);

        return back()->with('success', 'Cuenta creada correctamente');
    }

    public function update(Request $request, Cuenta $cuenta)
    {
        $cuenta->update($request->only('nombre', 'activa'));

        return back()->with('success', 'Cuenta actualizada');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(cuenta $cuenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cuenta $cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cuenta $cuenta)
    {
        //
    }
}
