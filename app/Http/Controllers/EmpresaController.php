<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresa.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
       $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'ruc' => 'required|string|max:13',
            'matriz' => 'required|string|max:255',
            'sucursal' => 'required|string|max:255',
            'telefono' => 'required|string|max:13',
            'email' => 'required|email|max:255',
            'obligado_contabilidad' => 'required|string|in:si,no',
            'tipo_ruc' => 'required|string|max:255',
            'contribuyente_especial' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
        ]);
         if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Empresa::create($validated);

        return redirect()->route('admin.empresa.index')->with('success', 'Empresa agregada con éxito');
    }
    catch (\Illuminate\Validation\ValidationException $e) {
        // Si falla la validación
        return redirect()->back()->withErrors($e->errors())->withInput();

    } catch (\Exception $e) {
        // Si ocurre cualquier otro error
        return redirect()->back()->with('error', 'Error al guardar la empresa: ' . $e->getMessage())->withInput();
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
