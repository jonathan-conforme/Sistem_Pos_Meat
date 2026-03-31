<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;
use Illuminate\Http\Request;

class InventoryMovementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
      
        // 2. Usamos el modelo en singular (InventoryMovement)
        // Y llamamos a la variable $movements (para que la vista la reconozca)
        $movements = InventoryMovement::with(['product', 'user'])
            ->latest()
            ->paginate(15);

        // 3. Pasamos exactamente el mismo nombre de la variable al compact
        return view('inventory.movements', compact('movements'));
    
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
    public function show(inventory_movements $inventory_movements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventory_movements $inventory_movements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inventory_movements $inventory_movements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventory_movements $inventory_movements)
    {
        //
    }
}
