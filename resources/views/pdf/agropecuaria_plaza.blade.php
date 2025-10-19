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
            <div class="bold empresa">ASISTENCIA AGROPECUARIA PLAZA</div>
             <div>PEDRO CARBO</div>
            <div>ARBO / 9 DE OCTUBRE SNY CHILE Y B</div>
            <div>TELF:052350085</div>
            <div>RUC:1305779538001</div>
            <div>Contribuyente Especial Nro.:00011</div>
            <div class="divider"></div>
            <div class="text-left">
                <div class="text-left">COMPROBANTE DE VENTA #3805</div> 
                <div class="text-left">FACTURA: 003201000003805</div><!--en uso-->
                <div class="text-left">FECHA: 17-06-2025 11:44 PEDRO CARBO</div>
                <div class="text-left">CLIENTE: JUSTO DANIEL MERCHAN SOLIS</div>
            <div class="text-left">RUC/CI: .091723250-6</div>
            <div class="text-left">CORREO: <span>merchansolis2025@outlook.es</span></div>
            <div>DIRECCIÓN:RECINTO LAS CAÑITAS.</div>
            <div>CLAVE: 1508025143069116483965092632</div>
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
                <tr>
                    <td class="col-producto">BALANCEADO INICIAL</td>
                    <td class="text-left col-cantidad">10</td>
                    <td class="text-left col-punit">26.50</td>
                    <td class="text-left col-total">265</td>
                </tr>
                <tr>
                    <td class="col-producto">BALANCEADO CRECIMIENTO</td>
                    <td class="text-left col-cantidad">12</td>
                    <td class="text-left col-punit">29</td>
                    <td class="text-left col-total">348</td>
                </tr>
                <tr>
                    <td class="col-producto">BALANCEADO ENGORDE</td>
                    <td class="text-left col-cantidad">14</td>
                    <td class="text-left col-punit">31,50</td>
                    <td class="text-left col-total">441</td>
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
                <td class="text-right">$1.054</td>
            </tr>
            <tr>
                <td class="text-left">Impuesto (15%)</td>
                <td class="text-right">00</td>
            </tr>
            <tr class="bold">
                <td class="text-left">TOTAL</td>
                <td class="text-right">$1.054</td>
            </tr>
        </table>

        <div class="divider"></div>

        <!-- Pie -->
        <div class="footer">
            <div>Gracias por tu compra</div>
            
        </div>
    </div>

  
</body>
</html>