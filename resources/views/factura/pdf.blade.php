<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Electrónica</title>
    <style>
        /* Estilos optimizados para PDF - DomPDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 15px;
            line-height: 1.2;
        }
        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            gap: 15px;
        }
        .border-box {
            border: 1px solid #000;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-bold {
            font-weight: bold;
        }
        .text-xs {
            font-size: 10px;
        }
        .text-sm {
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        .flex {
            display: flex;
        }
        .justify-between {
            justify-content: space-between;
        }
        .grid {
            display: grid;
        }
        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }
        .grid-cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }
        .gap-3 {
            gap: 12px;
        }
        .space-y-2 > * + * {
            margin-top: 8px;
        }
        .space-y-1 > * + * {
            margin-top: 4px;
        }
        hr {
            border: 0;
            border-top: 1px solid #000;
            margin: 8px 0;
        }
        .barcode {
            height: 30px;
            margin: 5px 0;
            width: 100%;
        }
        .mb-1 {
            margin-bottom: 5px;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        .uppercase {
            text-transform: uppercase;
        }
        .overflow-auto {
            overflow: auto;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Encabezado con información de la empresa -->
        <div class="flex-container">
            <div class="border-box" style="flex: 1;">
                <h1 class="text-sm text-bold text-center uppercase">HUANG YING</h1>
                <h1 class="text-sm text-bold text-center uppercase">HUANG YING</h1>
                <p class="text-xs text-bold">Dir: Matriz : CORONEL 119 Y AVACUCHO F.DAVILA</p>
                <p class="text-xs text-bold">Dir. Sucursal: CORONEL 119 Y AVACUCHO F.DAVILA</p>
                <p class="text-xs text-bold">Teléfonos: 0991966788</p>
                <p class="text-xs text-bold flex justify-between">
                    <span>Obligado a Llevar Contabilidad: NO</span>
                    <span>Guayaquil - Ecuador</span>
                </p>
                <p class="text-xs text-center text-bold" style="padding: 15px 0;">RÉGIMEN GENERAL</p>
                <p class="text-xs text-center text-bold">Agente de Retención Resolución No. 10</p>
            </div>

            <div class="border-box" style="flex: 1;">
                <div class="flex justify-between mb-1">
                    <span class="text-bold">R.U.C.:</span>
                    <span class="text-bold">0965336621001</span>
                </div>
                <div class="flex justify-between mb-1">
                    <span class="text-bold">COMPROBANTE DE</span>
                    <span class="text-bold">001-003-000013055</span>
                </div>
                <div class="flex justify-between mb-1">
                    <span class="text-bold">FACTURA DE VENTA No.:</span>
                    <span></span>
                </div>
                <div class="mb-1">
                    <span class="text-bold">NÚMERO AUTORIZACIÓN:</span>
                    <p class="text-xs text-bold">2507202501096533662100120010030000130550001305513</p>
                </div>
                <div class="flex justify-between mb-1">
                    <span class="text-bold">FECHA Y HORA DE AUTORIZACIÓN</span>
                    <span>25/07/2025 1:42 p.m.</span>
                </div>
                <div class="flex justify-between mb-1">
                    <span class="text-bold">AMBIENTE:</span>
                    <span>PRODUCCION</span>
                </div>
                <div class="flex justify-between mb-1">
                    <span class="text-bold">EMISIÓN:</span>
                    <span>NORMAL</span>
                </div>
                <div style="margin-top: 8px; padding-top: 5px; border-top: 1px solid #ccc;">
                    <span class="text-bold">CLAVE ACCESO:</span>

                    <!-- Código de barras generado en PHP -->
                    <div class="text-center">
                        <img src="data:image/png;base64,{{ $barcode }}" alt="Código de barras" class="barcode">
                    </div>

                    <!-- Número abajo -->
                    <p class="text-xs text-center" style="font-family: monospace;">
                        2507202501096533662100120010030000130550001305513
                    </p>
                </div>
            </div>
        </div>

        <!-- Información del cliente -->
        <div class="border-box">
            <div class="mb-1">
                <span class="text-bold">Razón Social/Nombres y Apellidos: VICENTE STALIN LOZANO ZAMBRANO</span>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <span class="text-bold">Fecha Emisión:</span>
                    <span>25/07/2025</span>
                </div>
                <div>
                    <span class="text-bold">Identificación:</span>
                    <span>0927297796</span>
                </div>
                <div>
                    <span class="text-bold">Guía Remisión:</span>
                    <span></span>
                </div>
            </div>
        </div>

        <!-- Tabla de productos -->
        <table>
            <thead>
                <tr>
                    <th>CODIGO</th>
                    <th class="text-center">CANTIDAD</th>
                    <th>DESCRIPCION</th>
                    <th class="text-center">U/MED</th>
                    <th class="text-right">V. UNITARIO</th>
                    <th class="text-center">V/OSCTO</th>
                    <th class="text-right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <!-- Productos (solo algunos como ejemplo) -->
                <tr>
                    <td>10088</td>
                    <td class="text-center">300.00</td>
                    <td>CORTINAS CUADRO G NORMAL 0-55</td>
                    <td class="text-center">UNI</td>
                    <td class="text-right">0.2174</td>
                    <td class="text-center"></td>
                    <td class="text-right">65.22</td>
                </tr>
                <tr>
                    <td>10127</td>
                    <td class="text-center">100.00</td>
                    <td>GLOBO</td>
                    <td class="text-center">UNI</td>
                    <td class="text-right">0.8696</td>
                    <td class="text-center"></td>
                    <td class="text-right">86.96</td>
                </tr>
                <!-- Agrega más productos según sea necesario -->
            </tbody>
        </table>

        <!-- Información adicional y totales -->
        <div class="flex-container">
            <div class="border-box" style="flex: 1;">
                <h3 class="text-bold text-center mb-2">Información Adicional</h3>
                <div class="space-y-2">
                    <p><span class="text-bold">Dirección:</span> pedro carbo padre adrian y 2 de agosto</p>
                    <p><span class="text-bold">Teléfono:</span> 0985807991</p>
                    <p><span class="text-bold">E-mail:</span> lozanozambranostaling@gmail.com</p>
                    <p><span class="text-bold">Otros:</span> FACTURA ELECTRÓNICA # 13054</p>
                    <p><span class="text-bold">Son:</span> SETECIENTOS 95'100 DOLARES</p>
                </div>
                
                <div style="margin-top: 15px;">
                    <hr>
                    <h3 class="text-bold text-center mb-2">Formas de pago</h3>
                    <hr>
                    
                    <div class="flex justify-between text-xs">
                        <span>SIN UTILIZACION DEL SISTEMA FINANCIERO</span>
                        <span>$ 700.95 - 0 días</span>
                    </div>
                </div>
            </div>

            <div class="border-box" style="flex: 1;">
                <div class="space-y-1">
                    <div class="flex justify-between">
                        <span>Subtotal 15%:</span>
                        <span>609.52</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Subtotal 0%:</span>
                        <span>0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Subtotal No Objeto IVA:</span>
                        <span>0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Subtotal Exento de IVA:</span>
                        <span>0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Subtotal Sin Impuestos:</span>
                        <span>609.52</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Descuentos:</span>
                        <span>0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>IVA 15%:</span>
                        <span>91.43</span>
                    </div>
                    <div class="flex justify-between text-bold" style="border-top: 1px solid #ccc; padding-top: 5px; margin-top: 5px;">
                        <span>Valor Total:</span>
                        <span>700.95</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
 <!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Factura Electrónica</title>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
     <script src="https://cdn.tailwindcss.com"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet">
     <script>
         tailwind.config = {
             theme: {
                 extend: {
                     colors: {
                         primary: {
                             50: '#eff6ff',
                             100: '#dbeafe',
                             500: '#3b82f6',
                             900: '#1e3a8a',
                         }
                     }
                 }
             }
         }
     </script>
    
 </head>

 <body class="font-sans font-semibold">
     <div class="max-w-4xl mx-auto my-1 p-2">
         <!-- Encabezado con información de la empresa -->
         <div class="mb-1 flex flex-col md:flex-row justify-between gap-4">
             <div class="flex-1 border p-5 border-gray-800 rounded-lg">
                 <h1 class="text-sm font-semibold uppercase text-center">HUANG YING</h1>
                 <h1 class="text-sm font-semibold uppercase text-center">HUANG YING</h1>
                 <p class="text-xs font-semibold p-1">Dir: Matriz : CORONEL 119 Y AVACUCHO F.DAVILA</p>
                 <p class="text-xs font-semibold p-1">Dir. Sucursal: CORONEL 119 Y AVACUCHO F.DAVILA</p>
                 <p class="text-xs font-semibold p-1">Teléfonos: 0991966788</p>
                 <p class="text-xs p-1 font-semibold flex justify-between">
                     Obligado a Llevar Contabilidad: NO
                     <span>Guayaquil - Ecuador</span>
                 </p>

                 <p class="text-xs text-center font-semibold p-5">RÉGIMEN GENERAL</p>
                 <p class="text-xs text-center font-semibold">Agente de Retención Resolución No. 10</p>
             </div>

             <div class="font-semibold flex-1 border border-gray-800 rounded-lg p-3 text-xs">
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">R.U.C.:</span>
                     <span class="font-semibold">0965336621001</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">COMPROBANTE DE</span>
                     <span class="font-semibold">001-003-000011398</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FACTURA DE VENTA No.:</span>
                     <span></span>
                 </div>
                 <div class="mb-1">
                     <span class="font-semibold">NÚMERO AUTORIZACIÓN:</span>
                     <p class="text-xs font-semibold overflow-x-auto whitespace-nowrap py-1">0308202501096533662100120010030000130550001300987</p>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FECHA Y HORA DE AUTORIZACIÓN</span>
                     <span>18/08/2025 14:50 p.m.</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">AMBIENTE:</span>
                     <span>PRODUCCION</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">EMISIÓN:</span>
                     <span>NORMAL</span>
                 </div>
                 <div class="mt-2 pt-1 border-t border-gray-200">
                     <span class="font-semibold">CLAVE ACCESO:</span>

                     <!-- Código de barras arriba -->
                     <div class="flex justify-center">
                         <svg id="barcode" class="w-140 h-12"></svg>
                     </div>

                     <!-- Número abajo -->
                     <p class="text-xs overflow-x-auto whitespace-nowrap py-1 font-mono text-center">
                         1808202501096533662100120010030000130550009091234
                     </p>
                 </div>
                 
                 
                </div>
            </div>
            
            <!-- Información del cliente -->
            <div class="font-semibold border rounded-lg border-gray-800 p-4 mb-1 text-sm">
                <div>
                 <span class="font-semibold">Razón Social/Nombres y Apellidos: VICENTE STALIN LOZANO ZAMBRANO</span>

             </div>
             <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                 <div>
                     <span class="font-semibold">Fecha Emisión:</span>
                     <span>18/08/2025</span>
                 </div>
                 <div>
                     <span class="font-semibold">Identificación:</span>
                     <span>0927297796</span>
                    </div>
                    <div>
                     <span class="font-semibold">Guía Remisión:</span>
                     <span></span>
                 </div>
             </div>
         </div>
         
         <!-- Tabla de productos -->
         <div class="overflow-x-auto mb-4">
             <table class="w-full text-xs">
                 <thead>
                     <tr class="border border-gray-800 ">
                         <th class="px-2 py-1 text-left">CODIGO</th>
                         <th class="px-2 py-1 text-center">CANTIDAD</th>
                         <th class="px-2 py-1 text-left">DESCRIPCION</th>
                         <th class="px-2 py-1 text-center">U/MED</th>
                         <th class="px-2 py-1 text-right">V. UNITARIO</th>
                         <th class="px-2 py-1 text-center">V/OSCTO</th>
                         <th class="px-2 py-1 text-right">TOTAL</th>
                        </tr>
                        <tr>
                         <td class="px-2 py-1">10326</td>
                         <td class="px-2 py-1 text-center">24.00</td>
                         <td class="px-2 py-1">CORONAS 3-00</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.8696</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">20.87</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">10123</td>
                         <td class="px-2 py-1 text-center">20.00</td>
                         <td class="px-2 py-1">GLOBO NUMERO</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">1.3044</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">26.09</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">10105</td>
                         <td class="px-2 py-1 text-center">36.00</td>
                         <td class="px-2 py-1">MIN BUQUE FELIZ CUMPLE</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.8696</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">31.30</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">10293</td>
                         <td class="px-2 py-1 text-center">50.00</td>
                         <td class="px-2 py-1">BANDERIN BRILLOSO</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.4348</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">21.74</td>
                     </tr>
                          <tr>
                         <td class="px-2 py-1">10204</td>
                         <td class="px-2 py-1 text-center">45.00</td>
                         <td class="px-2 py-1">TOPER FELIZ CUMPLE</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.2174</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">9.78</td>
                     </tr>
                     
                     <tr>
                         <td class="px-2 py-1">10088</td>
                         <td class="px-2 py-1 text-center">300.00</td>
                         <td class="px-2 py-1">CORTINAS CUADRO G NORMAL 0-55</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.2174</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">65.22</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">10127</td>
                         <td class="px-2 py-1 text-center">100.00</td>
                         <td class="px-2 py-1">GLOBO</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.8696</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">86.96</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">10108</td>
                         <td class="px-2 py-1 text-center">45.00</td>
                         <td class="px-2 py-1">BUQUE</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">2.1739</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">97.83</td>
                     </tr>
                        <tr>
                         <td class="px-2 py-1">2406AMY18-10</td>
                         <td class="px-2 py-1 text-center">24.00</td>
                         <td class="px-2 py-1">CINTA 18-10</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.6957</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">16.70</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">2402AMY23-6</td>
                         <td class="px-2 py-1 text-center">36.00</td>
                         <td class="px-2 py-1">Letra Feliz Cumpleaños</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.2174</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">7.83</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">2402AMY23-7</td>
                         <td class="px-2 py-1 text-center">36.00</td>
                         <td class="px-2 py-1">Letra Mi Bautizo</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.4348</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">15.65</td>
                     </tr>
                        <tr>
                            <td class="px-2 py-1">10111</td>
                            <td class="px-2 py-1 text-center">100.00</td>
                            <td class="px-2 py-1">GLOBO R5</td>
                            <td class="px-2 py-1 text-center">UNI</td>
                            <td class="px-2 py-1 text-right">0.4348</td>
                            <td class="px-2 py-1 text-center"></td>
                            <td class="px-2 py-1 text-right">43.48</td>
                        </tr>
                        <tr>
                            <td class="px-2 py-1">10091</td>
                            <td class="px-2 py-1 text-center">100.00</td>
                            <td class="px-2 py-1">CORTINAS TIRA NORMAL 0-45</td>
                            <td class="px-2 py-1 text-center">UNI</td>
                            <td class="px-2 py-1 text-right">0.4261</td>
                            <td class="px-2 py-1 text-center"></td>
                            <td class="px-2 py-1 text-right">42.61</td>
                        </tr>
                    </thead>
                    <tbody class="font-semibold">
                     </tr>
                     <td class="px-2 py-1">10323</td>
                     <td class="px-2 py-1 text-center">36.00</td>
                     <td class="px-2 py-1">MANTEL ECONOMICO</td>
                     <td class="px-2 py-1 text-center">UNI</td>
                     <td class="px-2 py-1 text-right">0.2174</td>
                     <td class="px-2 py-1 text-center"></td>
                     <td class="px-2 py-1 text-right">7.83</td>
                     </tr>
                     
                     <tr>
                         <td class="px-2 py-1">2402AMY9-4</td>
                         <td class="px-2 py-1 text-center">3.00</td>
                         <td class="px-2 py-1">GORRO 25-12</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">2.6087</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">7.83</td>
                     </tr>
                     <tr>
                         <td class="px-2 py-1">10322</td>
                         <td class="px-2 py-1 text-center">36.00</td>
                         <td class="px-2 py-1">MANTEL METALIZAD</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.2174</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">7.83</td>
                         <tr>
                         <td class="px-2 py-1">10113</td>
                         <td class="px-2 py-1 text-center">100.00</td>
                         <td class="px-2 py-1">GLOBO R10</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">0.8696</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">86.96</td>
                     </tr>
                   
                     <tr>
                         <td class="px-2 py-1">10294</td>
                         <td class="px-2 py-1 text-center">5.00</td>
                         <td class="px-2 py-1">BANDERIN ESCARCHADO</td>
                         <td class="px-2 py-1 text-center">UNI</td>
                         <td class="px-2 py-1 text-right">2.6087</td>
                         <td class="px-2 py-1 text-center"></td>
                         <td class="px-2 py-1 text-right">13.04</td>
                     </tr>
                 
                 </tbody>
             </table>
         </div>

         <!-- Información adicional y totales -->
         <div class="flex flex-col md:flex-row gap-4">
             <div class="flex-1 border border-gray-800 rounded-lg p-3 text-xs font-semibold space-y-2">
                 <h3 class="font-semibold mb-2 text-center">Información Adicional</h3>
                 <p><span class="font-semibold">Dirección:</span> pedro carbo padre adrian y 2 de agosto</p>
                 <p><span class="font-semibold">Teléfono:</span> 0985807991</p>
                 <p><span class="font-semibold">E-mail:</span> lozanozambranostaling@gmail.com</p>
                 <p><span class="font-semibold">Otros:</span> FACTURA ELECTRÓNICA # 11398</p>
                 <p><span class="font-semibold">Son:</span> SETECIENTOS TREINTA Y SEIS DÓLARES CON 00/100 DÓLARES</p>
                 <div class="mt-4">
                     <!-- Línea superior -->
                     <hr class="border-t border-gray-800 mb-2">

                     <!-- Título centrado -->
                     <h3 class="font-semibold text-center mb-2">Formas de pago</h3>

                     <!-- Línea inferior -->
                     <hr class="border-t border-gray-800 mb-3">

                     <!-- Fila de pago -->
                     <div class="flex justify-between text-xs px-1">
                         <span>SIN UTILIZACION DEL SISTEMA FINANCIERO</span>
                         <span>$ 736.00 - 0 días</span>
                     </div>
                 </div>
             </div>


             <div class="font-semibold flex-1 border rounded-lg border-gray-800 p-3 text-xs">

                 <div class="mt-4 space-y-1">
                     <div class="flex justify-between">
                         <span>Subtotal 15%:</span>
                         <span>640.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Subtotal 0%:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Subtotal No Objeto IVA:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Subtotal Exento de IVA:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Subtotal Sin Impuestos:</span>
                         <span>640.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Descuentos:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>IVA 15%:</span>
                         <span>96.00</span>
                     </div>
                     <div class="flex justify-between font-bold border-t border-gray-300 pt-1 mt-1">
                         <span>Valor Total:</span>
                         <span>736.00</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
     <script>
         JsBarcode("#barcode", "2507202501096533662100120010030000130550001305513", {
             format: "CODE128", // Formato recomendado
             lineColor: "#000000",
             width: 1,
             height: 20,
             displayValue: false // Ocultar texto debajo del código de barras
         });
     </script>
 </body>

 </html>
 