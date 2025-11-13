<?php

namespace App\Http\Controllers;

use App\Models\suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $supplier = suppliers::paginate(10);
        return view('suppliers.create', compact('supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
         $request->validate([
        'name' => 'required|string|max:255', 
        'contact_name' => 'required|digits_between:7,15',
        'phone' => 'required|digits_between:7,15', 
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'ruc' => 'required|max:15|unique:suppliers,ruc',
        'notes' => 'required|nullable|string|max:1000'

        ]);
        suppliers::create($request->all());
        return redirect()->route('suppliers.create')->with('success', 'Proveedor registrado');
return redirect()->back()->with('success', 'Registro guardado correctamente');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Ocurrió un error al guardar el registro');
    }
}
    /**
     * Display the specified resource.
     */
    public function show(suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(suppliers $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, suppliers $suppliers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(suppliers $suppliers)
    {
        //
    }
}
