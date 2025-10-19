<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sale;
use App\Models\Empresa;
use App\Models\sale_items;

class PdfController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        //        
    }

  public function generar()
    {
        // Tu código existente...
        $usuario = Auth::user();
        $pdf = Pdf::loadView('pdf.ticket')
            ->setPaper([0, 0, 164, 600], 'portrait');
        return $pdf->stream('pdf.ticket');
    }

    /**
     * Generar ticket de venta
     */
    public function generarTicket($saleId)
    {
        // Obtener la venta con todos los datos
        $sale = Sale::with(['customer', 'items.product', 'createdBy'])
            ->findOrFail($saleId);

        // Obtener datos de la empresa
        $empresa = Empresa::first();

        $pdf = Pdf::loadView('pdf.ticket', compact('sale', 'empresa'))
            ->setPaper([0, 0, 164, 600], 'portrait'); // Tamaño ticket

        return $pdf->stream("ticket-{$sale->sale_number}.pdf");
    }
    /**
     * Descargar ticket PDF
     */
    public function descargarTicket($saleId)
    {
        $sale = Sale::with(['customer', 'items.product', 'createdBy'])
            ->findOrFail($saleId);

        $empresa = Empresa::first();

        $pdf = Pdf::loadView('pdf.ticket', compact('sale', 'empresa'))
            ->setPaper([0, 0, 164, 600], 'portrait');

        return $pdf->download("ticket-{$sale->sale_number}.pdf");
    }
}
