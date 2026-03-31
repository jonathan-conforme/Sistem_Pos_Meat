<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Inventory::with('product');
        
        // Determinar filtro actual
        $filtroActual = $request->get('filtro', 'todos');
        
        // Aplicar filtros
        switch ($filtroActual) {
            case 'critico':
                $query->whereRaw('available_quantity <= min_stock AND min_stock > 0');
                break;
            case 'agotado':
                $query->where('available_quantity', '<=', 0);
                break;
            case 'normal':
                $query->where('available_quantity', '>', 'min_stock')
                      ->orWhere('min_stock', '<=', 0);
                break;
            case 'todos':
            default:
                // Sin filtro adicional
                break;
        }
        
        // Ordenar: críticos primero, luego por nombre
        $query->orderByRaw('CASE WHEN available_quantity <= min_stock AND min_stock > 0 THEN 0 ELSE 1 END')
              ->orderBy('available_quantity', 'asc');
        
        $inventory = $query->paginate(50);
        
        // Estadísticas para tarjetas
        $totalProductos = Inventory::count();
        $productosCriticos = Inventory::whereRaw('available_quantity <= min_stock AND min_stock > 0')->count();
        $productosAgotados = Inventory::where('available_quantity', '<=', 0)->count();
        $stockPromedio = Inventory::avg('available_quantity') ?? 0;
        
        return view('inventory.index', compact(
            'inventory', 
            'totalProductos', 
            'productosCriticos', 
            'productosAgotados', 
            'stockPromedio',
            'filtroActual'
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(inventory $inventory)
    {
        //
    }
}
