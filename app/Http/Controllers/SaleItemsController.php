<?php

namespace App\Http\Controllers;

use App\Models\sale_items;
use Illuminate\Http\Request;

class SaleItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = sale_items::with('sale', 'product')->latest()->paginate(20);
        return view('sales.items.index', compact('items'));
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
    public function show(sale_items $sale_items)
    {
        return response()->json($sale_items->load('sale', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sale_items $sale_items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sale_items $sale_items)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sale_items $sale_items)
    {
        //
    }
}
