<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\fac_electroniva;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;

class FacElectronivaController extends Controller
{
    /**
     * Generar PDF de la factura eléctrica
     */
    public function generarFactura()
    {
        // Generar código de barras para el PDF
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode(
            '2507202501096533662100120010030000130550001305513', 
            $generator::TYPE_CODE_128,
            2, // Ancho
            30, // Alto
            [0, 0, 0] // Color RGB (negro)
        ));

        // Cargar la vista con el código de barras
        $pdf = Pdf::loadView('factura.index', ['barcode' => $barcode]);
        
        // Configurar papel - tamaño carta en orientación vertical
        $pdf->setPaper('letter', 'portrait');
        
        // Devolver PDF para descarga
        return $pdf->download('factura-electronica.pdf');
    }

    // ... (otros métodos del controlador)

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
    public function show(fac_electroniva $fac_electroniva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fac_electroniva $fac_electroniva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fac_electroniva $fac_electroniva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fac_electroniva $fac_electroniva)
    {
        //
    }
}
