<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - Creaciones Abraham</title>
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
            page-break-inside: avoid; /* Evita dividir tickets entre páginas */
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
        
        th, td {
            padding: 2px 1px;
            vertical-align: top;
            line-height: 1.2;
        }
        
        .col-producto {
            width: 30%;
            overflow: hidden;
            text-overflow: ellipsis;
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
            width: 15%;
            text-align: left;
        }
        
        .header {
            margin-bottom: 5px;
            text-align: center;
            margin:0; 
            padding:0;
        }
        
        .footer {
            margin-top: 5px;
            text-align: center;
        }
        
        .empresa {
            font-size: 14px;
            margin-bottom: 3px;
        }
        
        /* Optimización para impresión */
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
                page-break-after: always; /* Fuerza salto de página después de cada ticket */
            }
            
            /* Elimina el margen superior en la primera página */
            @page :first {
                margin-top: 0;
            }
            
            /* Elimina márgenes por defecto */
            @page {
                margin: 0;
                size: 58mm auto; /* Define el tamaño exacto del ticket */
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
            <img class="mx-auto mb-25" src="{{ public_path('image/marisol.jpg') }}" 
     alt="Logo" style="width:220px; display:block; margin:0 auto; height:auto;">

           
                <div class="divider"></div>      
                <div>GUAYAS / PEDRO CARBO / PEDRO CARBO / 9 DE OCTUBRE SOLAR 04 Y QUITO</div>
                <div class="text-left">RUC:0921831798001</div>
                <div class="text-left">AMBIENTE:PRODUCCIÓN</div>
                <div class="text-left">EMISION: NORMAL</div>
                <div class="divider"></div>
                <div class="text-left">
                    
                    
                    <div>FACTURA: 00540100006373</div>
                    <div class="text-left">CLIENTE: MOREIRA TIGUA LUIS FERNANDO</div>
                    <div class="text-left">RUC/CI: 0921854972</div>
                    <div class="text-left">FECHA: 22-07-2025  Hora: 11:24</div>
                    <div class="text-left">CORREO: <span>luismore1989@gmail.com</span></div>
                    <div>DIRECCIÓN: Dos de agosto y via valle de la virgen</div>
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
      
</thead>
<tbody>
     <tr>
                    <th class="text-left col-producto">Producto</th>
                    <th class="text-left col-cantidad">Cant</th>
                    <th class="text-left col-punit">P.Unit</th>
                    <th class="text-left col-total">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-producto">Arroz Flor</td>
                    <td class="text-left col-cantidad">5</td>
                    <td class="text-left col-punit">20</td>
                    <td class="text-left col-total">$100</td>
                </tr>
                <tr>
                    <td class="col-producto">Arroz Conejo</td>
                    <td class="text-left col-cantidad">10</td>
                    <td class="text-left col-punit">30</td>
                    <td class="text-left col-total">$300</td>
                </tr>
                <tr>
                    <td class="col-producto">Arroz Oso</td>
                    <td class="text-left col-cantidad">10</td>
                    <td class="text-left col-punit">20</td>
                    <td class="text-left col-total">$200</td>
                </tr>
                <tr>
                    <td class="col-producto">Arroz Rendido</td>
                    <td class="text-left col-cantidad">2</td>
                    <td class="text-left col-punit">10</td>
                    <td class="text-left col-total">$20</td>
                </tr>
                <tr>
                    <td class="col-producto">Arroz Integral</td>
                    <td class="text-left col-cantidad">2</td>
                    <td class="text-left col-punit">20</td>
                    <td class="text-left col-total">$40</td>
                </tr>
                <tr>
                    <td class="col-producto">Arroz San Isidro</td>
                    <td class="text-left col-cantidad">2</td>
                    <td class="text-left col-punit">20</td>
                    <td class="text-left col-total">$40</td>
                </tr>
                <tr>
                    <td class="col-producto">Leche entera UHT 1L (Caja x12)</td>
                    <td class="text-left col-cantidad">1</td>
                    <td class="text-left col-punit">10.20</td>
                    <td class="text-left col-total">$10.20</td>
                </tr>
                <tr>
                    <td class="col-producto">Huevos de granja</td>
                    <td class="text-left col-cantidad">1</td>
                    <td class="text-left col-punit">2.55</td>
                    <td class="text-left col-total">$2.55</td>
                </tr>
            </tbody>
        </table>

        <div class="divider"></div>

        <!-- Totales -->
        <table>
            <tr>
                <td class="text-left">Subtotal IVA</td>
                <td class="text-right">00</td>
            </tr>
            <tr>
                <td class="text-left">Subtotal 0%</td>
                <td class="text-right">$672.75</td>
            </tr>
            <tr>
                <td class="text-left">Impuesto (15%)</td>
                <td class="text-right">$100.91</td>
            </tr>
            <tr class="bold">
                <td class="text-left">TOTAL</td>
                <td class="text-right">$773.66</td>
            </tr>
        </table>

        <div class="divider"></div>

        <!-- Pie -->
      <div class="footer">
    <div>***Gracias por tu compra***</div>
    <div>Clave de Acceso:</div>
    
<img src="https://barcodeapi.org/api/code128/2806025143069116483965087897.svg" 
     alt="Barcode" style="width:200px; height:50px;">

        </div>
    </div>
</body>
</html>