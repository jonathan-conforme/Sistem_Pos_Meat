<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket - {{ $empresa->nombre ?? 'Mi Empresa' }}</title>
    <style>
        /* Reset completo para impresión */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            font-family: 'Courier New', monospace;
        }

        body {
            width: 58mm;
            margin: 0 auto;
            padding: 1mm;
            font-size: 12px;
            line-height: 1.2;
            color: #000;
            background: #fff;
            font-weight: bold;
        }

        .ticket {
            width: 100%;
            max-width: 56mm;
            margin: 0 auto;
            padding: 0;
            page-break-inside: avoid;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 4px 0;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th,
        td {
            padding: 2px 1px;
            vertical-align: top;
            line-height: 1.2;
        }

        .col-producto {
            width: 40%;
            overflow: hidden;
        }

        .col-cantidad {
            width: 15%;
            text-align: left;
        }

        .col-punit {
            width: 20%;
            text-align: left;
        }

        .col-total {
            width: 25%;
            text-align: left;
        }

        .header {
            margin-bottom: 5px;
            text-align: center;
        }

        .footer {
            margin-top: 5px;
            text-align: center;
        }

        @media print {
            body {
                width: 58mm;
                margin: 0;
                padding: 0;
                font-size: 12px;
            }

            .ticket {
                width: 56mm;
                padding: 0;
                page-break-after: always;
            }

            @page {
                margin: 0;
                size: 58mm auto;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <!-- Encabezado -->
        <div class="header">
            @if($empresa && $empresa->logo)
            <img src="{{ public_path('storage/' . $empresa->logo) }}"
                alt="Logo" style="width:220px; display:block; margin:0 auto; height:auto;">
            @endif
            <div class="divider"></div>
            <div>{{ $empresa->matriz ?? 'Dirección no especificada' }}</div>
            <div class="text-left">RUC: {{ $empresa->ruc ?? '0000000000001' }}</div>
            <div class="text-left">Telf: {{ $empresa->telefono ?? 'N/A' }}</div>
            <div class="divider"></div>

            <!-- Información de la venta -->
            <div class="text-left">
                <div class="bold">FACTURA: {{ $sale->sale_number }}</div>
                <div><strong>Cliente:</strong> {{ $sale->customer->name ?? 'Consumidor Final' }}</div>
                <div><strong>RUC/CI:</strong> {{ $sale->customer->cedula ?? '9999999999' }}</div>
                <div><strong>Fecha:</strong> {{ $sale->created_at->format('d-m-Y') }}</div>
                <div><strong>Hora:</strong> {{ $sale->created_at->format('H:i') }}</div>
                <div><strong>Vendedor:</strong> {{ $sale->createdBy->name ?? 'Sistema' }}</div>
            </div>
        </div>

        <div class="divider"></div>

        <!-- Tabla de productos -->
        <table>
            <thead>
                <tr>
                    <th class="text-left col-producto">Producto</th>
                    <th class="text-left col-cantidad">Cant</th>
                    <th class="text-left col-punit">P.Unit</th>
                    <th class="text-left col-total">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                <tr>
                    <td class="col-producto">{{ $item->product->name ?? 'Producto' }}</td>
                    <td class="text-left col-cantidad">{{ $item->quantity }}</td>
                    <td class="text-left col-punit">${{ number_format($item->price_per_unit, 2) }}</td>
                    <td class="text-left col-total">${{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="divider"></div>

        <!-- Totales -->
        <table>
            <tr>
                <td class="text-left">Subtotal:</td>
                <td class="text-right">${{ number_format($sale->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td class="text-left">IVA (15%):</td>
                <td class="text-right">${{ number_format($sale->tax, 2) }}</td>
            </tr>
            @if($sale->discount > 0)
            <tr>
                <td class="text-left">Descuento:</td>
                <td class="text-right">-${{ number_format($sale->discount, 2) }}</td>
            </tr>
            @endif
            <tr class="bold">
                <td class="text-left">TOTAL:</td>
                <td class="text-right">${{ number_format($sale->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td class="text-left">Método Pago:</td>
                <td class="text-right">
                    @if($sale->payment_type === 'cash') EFECTIVO
                    @elseif($sale->payment_type === 'credit') CRÉDITO
                    @elseif($sale->payment_type === 'transfer') TRANSFERENCIA
                    @else TARJETA @endif
                </td>
            </tr>
        </table>

        <div class="divider"></div>

        <!-- Pie -->
        <div class="footer">
            <div>**Gracias por su compra**</div>
            <div>¡Vuelva pronto!</div>
            <!-- Código de barras con número de venta -->
            <img src="https://barcodeapi.org/api/code128/{{ $sale->sale_number }}"
                alt="Barcode" style="width:200px; height:50px;">
        </div>
    </div>

   
   
</body>

</html>