<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sale;
use App\Models\Empresa;
use App\Models\Sale_items;

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
        $pdf = Pdf::loadView('pdf.ticket', [
            'sale' => null,
            'empresa' => null,
            'totalPaid' => 0,
            'remaining' => 0,
        ])->setPaper([0, 0, 164, 600], 'portrait');

        return $pdf->stream('pdf.ticket');
    }

    /**
     * Generar ticket de venta
     */
    public function generarTicket($saleId)
    {
        // Obtener la venta con todos los datos
        $sale = Sale::with(['customer', 'items.product', 'createdBy','payments'])
            ->findOrFail($saleId);

        // Obtener datos de la empresa
        $empresa = Empresa::first();
        
                $totalPaid = $sale->payments->sum('amount');
                $remaining = $sale->subtotal - $totalPaid;

        $pdf = Pdf::loadView('pdf.ticket', compact('sale', 'empresa', 'totalPaid', 'remaining'))
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

        $pdf = Pdf::loadView('pdf.ticket', compact('sale', 'empresa', 'totalPaid', 'remaining'))
            ->setPaper([0, 0, 164, 400], 'portrait');

        return $pdf->download("ticket-{$sale->sale_number}.pdf");
    }
    public function generarFacturaCredito($saleId)
{
    $sale = \App\Models\Sale::with([
        'customer',
        'items.product',
        'createdBy',
        'payments'
    ])->findOrFail($saleId);

    $empresa = \App\Models\Empresa::first();

    // Calcular totales
    $totalPaid = $sale->payments->sum('amount');
    $remaining = $sale->subtotal - $totalPaid;

    // Usamos la misma vista del ticket, pero con abonos
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.ticket', compact('sale', 'empresa', 'totalPaid', 'remaining'))
        ->setPaper([0, 0, 164, 600], 'portrait');

    return $pdf->stream("credito-{$sale->sale_number}.pdf");
}


}
