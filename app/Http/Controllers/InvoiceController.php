<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Empresa;
use App\Models\sale_items;
use App\Models\Customer;  // ← Cambiado de 'customer' a 'Customer'
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;  // ← Cambiado de 'barryvdh' a 'Barryvdh'

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['customer', 'items.product', 'createdBy'])
                    ->latest()
                    ->paginate(20);
        
        return view('invoices.index', compact('sales'));
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
    public function show(string $id)
    {
        $sales = Sale::with(['customer', 'items.product', 'createdBy'])
                    ->findOrFail($id);

        $empresa = Empresa::first(); // ← Cambiado de 'empresas' a 'empresa'

        return view('invoices.show', compact('sales', 'empresa')); // ← Y aquí también
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Generate PDF invoice
     */
    public function generatePDF($id)
    {
        $sales = Sale::with(['customer', 'items.product', 'createdBy'])
                    ->findOrFail($id);

        $empresa = Empresa::first(); // ← Cambiado de 'empresas' a 'empresa'

        $pdf = Pdf::loadView('invoices.pdf', compact('sales', 'empresa')); // ← Y aquí también

        return $pdf->download("factura-{$sales->sale_number}.pdf");
    }

    /**
     * Print invoice view
     */
    public function print($id)
    {
        $sales = Sale::with(['customer', 'items.product', 'createdBy'])
                    ->findOrFail($id);

        $empresa = Empresa::first(); // ← Cambiado de 'empresas' a 'empresa'

        return view('invoices.print', compact('sales', 'empresa')); // ← Y aquí también
    }
}