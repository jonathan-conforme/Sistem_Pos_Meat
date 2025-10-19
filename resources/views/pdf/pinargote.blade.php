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
            <div class="bold empresa">HERMANOS PINARGOTE</div>
            <div class="bold empresa">HERMANOS PINARGOTE</div> 
            <div>RUC:1305779538001</div>
            <div>Av.0 de octubre entre primero de Mayo y</div>
            <div>FACTURA: 00428100005573</div><!--en uso-->
            <div>Clave de Acceso: 1107025143069116483965094345</div>
            <div>AMBIENTE:PRODUCCIÓN</div>
            <div>EMISION: NORMAL</div>
            
     <br>
            <div class="text-left">
                <div class="text-left">COMPROBANTE DE VENTA #4473</div> 
                 <!--<div class="text-left">FACTURA: 003201000002234</div>
                  <div class="text-left">FACTURA: 003201000002234</div>
                   <div class="text-left">FACTURA: 003201000002234</div>
    --><div class="text-left">FECHA: 11-07-2025  Hora: 11:24</div>
                <div class="text-left">CLIENTE: SALASAR BRIONES JOSE BENEDICTO</div>
            <div class="text-left">RUC/CI: 0909293623</div>
            <div class="text-left">CORREO: <span>salazarbriones06@gmail.com</span></div>
            <div>DIRECCIÓN:  Con dirección 10 de Agosto y Juan Montalvo</div>
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
            <td class="col-producto">Arroz Flor</td>
            <td class="text-left col-cantidad">5</td>
            <td class="text-left col-punit">20</td>
            <td class="text-left col-total">$100</td>
        </tr>
        <tr>
            <td class="col-producto">Arroz tConejo</td>
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
                <td class="text-right">$600</td>
            </tr>
            <tr>
                <td class="text-left">Impuesto (15%)</td>
                <td class="text-right">000</td>
            </tr>
            <tr class="bold">
                <td class="text-left">TOTAL</td>
                <td class="text-right">$600</td>
            </tr>
        </table>

        <div class="divider"></div>

        <!-- Pie -->
        <div class="footer">
            <div>Gracias por tu compra</div>
            

        </div>
    </div>

  <div class="ticket">
        <!-- Encabezado -->
        <div class="header">
            <div class="bold empresa">HERMANOS PINARGOTE</div>
            <div class="bold empresa">HERMANOS PINARGOTE</div> 
            <div>RUC:1305779538001</div>
            <div>Av.0 de octubre entre primero de Mayo y</div>
            <div>FACTURA: 00320100007373</div><!--en uso-->
            <div>Clave de Acceso: 1809025143069116483965094345</div>
            <div>AMBIENTE:PRODUCCIÓN</div>
            <div>EMISION: NORMAL</div>
            
     <br>
            <div class="text-left">
                <div class="text-left">COMPROBANTE DE VENTA #4673</div> 
                 <!--<div class="text-left">FACTURA: 003201000002234</div>
                  <div class="text-left">FACTURA: 003201000002234</div>
                   <div class="text-left">FACTURA: 003201000002234</div>
    --><div class="text-left">FECHA: 18-08-2025  Hora: 10:20</div>
                <div class="text-left">CLIENTE: SALASAR BRIONES JOSE BENEDICTO</div>
            <div class="text-left">RUC/CI: 0909293623</div>
            <div class="text-left">CORREO: <span>salazarbriones06@gmail.com</span></div>
            <div>DIRECCIÓN:  Con dirección 10 de Agosto y Juan Montalvo</div>
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
                    <td class="col-producto">Arroz Oso</td>
                    <td class="text-left col-cantidad">6</td>
                    <td class="text-left col-punit">25</td>
                    <td class="text-left col-total">$150</td>
                </tr>
                <tr>
                    <td class="col-producto">Arroz tttConejo</td>
                    <td class="text-left col-cantidad">10</td>
                    <td class="text-left col-punit">20</td>
                    <td class="text-left col-total">$200</td>
                </tr>
                <tr>
              <td class="col-producto">Arroz Flor</td>
              <td class="text-left col-cantidad">5</td>
              <td class="text-left col-punit">30</td>
              <td class="text-left col-total">$150</td>
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
                <td class="text-right">$500</td>
            </tr>
            <tr>
                <td class="text-left">Impuesto (15%)</td>
                <td class="text-right">000</td>
            </tr>
            <tr class="bold">
                <td class="text-left">TOTAL</td>
                <td class="text-right">$500</td>
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