<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('units.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = Request()->validate([
            'name' => 'required|string|max:255|unique:units,name',
            'symbol' => 'required|string|max:10|unique:units,symbol',
        ]);
        Unit::create($validated);
        
        return redirect()->route('admin.units.index')->with('success', 'Unidad de medida agregada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
      if ($unit->products()->count() > 0) {
        return response()->json([
            'error' => false,
            'message' => 'No puedes eliminar esta unidad porque tiene productos asociados'
        ]);
    }

    $unit->delete();

    return response()->json([
        'success' => true
    ]);    }
   
    public function toggle(Unit $unit)
{
    $unit->is_active = !$unit->is_active;
    $unit->save();

    return response()->json([
        'success' => true,
        'error' => false,
        'is_active' => $unit->is_active,
        'message' => $unit->is_active ? 'Unidad activada' : 'Unidad desactivada'
    ]);
}
}
