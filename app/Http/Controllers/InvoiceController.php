<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Empresa;
use App\Models\Sale_items;
use App\Models\Customer;  
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;  
use Illuminate\Support\Facades\Storage;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $query = Sale::with(['customer', 'items.product', 'createdBy'])
                 ->latest();

    // 🔹 Filtro de búsqueda opcional
    if ($search = $request->query('search')) {
        $query->where(function($q) use ($search) {
            $q->where('sale_number', 'like', "%{$search}%")
              ->orWhereHas('customer', function($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%")
                     ->orWhere('cedula', 'like', "%{$search}%");
              });
        });
    }

    // 🔹 Clonar la consulta para obtener total antes de paginar
    $totalSales = (clone $query)->count();

    // 🔹 Obtener resultados paginados
    $sales = $query->paginate(20)->withQueryString(); // Mantiene parámetros de búsqueda en la paginación

    return view('invoices.index', compact('sales', 'totalSales'));
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
     * Print invoice view
     */
    public function print($id)
    {
        $sales = Sale::with(['customer', 'items.product', 'createdBy'])
                    ->findOrFail($id);

        $empresa = Empresa::first(); // ← Cambiado de 'empresas' a 'empresa'

        return view('invoices.print', compact('sales', 'empresa')); // ← Y aquí también
    }
    public function sendWhatsAppPDF($id)
{
    $sale = Sale::with(['customer', 'items.product', 'createdBy'])->findOrFail($id);

    $empresa = Empresa::first();

    // Validar que el cliente tenga teléfono
    if (!$sale->customer || !$sale->customer->phone) {
        return back()->with('error', 'El cliente no tiene número de WhatsApp registrado.');
    }

    // Generar PDF usando tu vista actual de ticket
    $pdf = Pdf::loadView('pdf.ticket', compact('sale', 'empresa'));

    // Nombre y ruta del archivo temporal
    $fileName = 'ticket_' . $sale->sale_number . '.pdf';
    $filePath = 'tickets/' . $fileName;

    // Guardar en storage público
    Storage::disk('public')->put($filePath, $pdf->output());

    // Generar URL pública
    $publicUrl = asset('storage/' . $filePath);

    // Crear mensaje prellenado de WhatsApp (puedes agregar total, fecha, etc.)
    $message = urlencode(
        "Hola {$sale->customer->name}, gracias por tu compra.\n" .
        "Factura N°: {$sale->sale_number}\n" .
        "Total: $" . number_format($sale->subtotal, 2) . "\n" .
        "Fecha: " . $sale->created_at->format('d/m/Y') . "\n\n" .
        "Aquí tienes tu ticket en PDF: {$publicUrl}"
    );

    // Redirigir a WhatsApp Web/App
    return redirect("https://wa.me/{$sale->customer->phone}?text={$message}");
}
public function pdf(Sale $invoice)
{
    $invoice->load([
        'customer',
        'items.product',
        'createdBy'
    ]);

    $empresa = Empresa::first();

    $pdf = Pdf::loadView('invoices.pdf', [
        'sales' => $invoice,
        'empresa' => $empresa
    ])->setPaper('A4', 'portrait');

    return $pdf->download('Factura_'.$invoice->sale_number.'.pdf');
}

}