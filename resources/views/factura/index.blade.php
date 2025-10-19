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

 <body class="font-sans font-semibold p-8">
    <div class="mb-1 text-sx leading-tight flex flex-col md:flex-row justify-between gap-6 w-full max-w-6xl mx-auto">
    <!-- Div izquierdo - 60% más grande -->
    <div class="flex-[3] my-2 border p-8 border-gray-800 rounded-lg">                 <img src= "{{ asset('image/marisol.jpg') }}" alt="Logo Agripac" class="mx-auto mb-2 w-20">
                 <h1 class="text-sm font-semibold uppercase text-center">Agripac S.A.</h1>
                 <p class="text-xs font-semibold p-1">MATRIZ: General Córdova No. 623 y Padre Solano, Guayaquil</p>
                 <p class="text-xs font-semibold p-1">SUCURSAL: 19 de Julio y primero de mayo, Pedro Carbo, GUAYAS</p>
                 <p class="text-xs font-semibold p-1">Teléfonos: (593 -4) 3703870 - 2560400</p>
                  <p class="text-xs font-semibold p-1">Correo: info@agripac.com.ec</p>
                 <p class="text-xs p-1 font-semibold flex justify-between">
                    <span>Obligado a Llevar Contabilidad: SI</span>
                     <span>Guayaquil - Ecuador</span>
                 </p>

                 <p class="text-xs text-center font-semibold p-5">RÉGIMEN GENERAL</p>
                 <p class="text-xs text-center font-semibold">Agente de Retención Resolución No. 10</p>
             </div>

             <div class="flex-[2] my-2 font-semibold border border-gray-800 rounded-lg p-6 text-sm">  <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">R.U.C.:</span>
                     <span class="font-semibold">0990006649601</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">COMPROBANTE DE</span>
                     <span class="font-semibold">001-003-000023390</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FACTURA DE VENTA No.:</span>
                     <span></span>
                 </div>
                 <div class="mb-1">
                     <span class="font-semibold">NÚMERO AUTORIZACIÓN:</span>
                     <p class="text-xs font-semibold overflow-x-auto whitespace-nowrap py-1">0207202501096533662100120010030000130550001300987</p>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FECHA Y HORA DE AUTORIZACIÓN</span>
                     <span>02/07/2025 14:50 p.m.</span>
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
                         0207202501096533662100120010030000130550009091234
                     </p>
                 </div>
                 
                 
                </div>
            </div>
            
            <!-- Información del cliente -->
            <div class="font-semibold border rounded-lg border-gray-800 p-4 mb-1 text-sm">
                <div>
                 <span class="font-semibold">Razón Social/Nombres y Apellidos: LEON RIVADENEIRA SARA ALEXANDRA</span>

             </div>
             <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                 <div>
                     <span class="font-semibold">Fecha Emisión:</span>
                     <span>02/07/2025</span>
                 </div>
                 <div>
                     <span class="font-semibold">Identificación:</span>
                     <span>0923421051</span>
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
                    <tr class="border border-gray-200 bg-gray-200 ">
  <th class="px-2 py-1 text-left">CODIGO</th>
  <th class="px-2 py-1 text-center">CANTIDAD</th>
  <th class="px-2 py-1 text-left">DESCRIPCION</th>
  <th class="px-2 py-1 text-center">U/MED</th>
  <th class="px-2 py-1 text-right">V. UNITARIO</th>
  <th class="px-2 py-1 text-center">V/OSCTO</th>
  <th class="px-2 py-1 text-right">TOTAL</th>
</tr>

<tr>
  <td class="px-2 py-1">SEM-9139</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Semilla certificada ADV 9139 (20 kg)</td>
  <td class="px-2 py-1 text-center">SACO</td>
  <td class="px-2 py-1 text-right">278.00</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">278.00</td>
</tr>

<tr>
  <td class="px-2 py-1">SEM-3383</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Semilla certificada DAS 3383 (20 kg)</td>
  <td class="px-2 py-1 text-center">SACO</td>
  <td class="px-2 py-1 text-right">220.00</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">220.00</td>
</tr>

<tr>
  <td class="px-2 py-1">FERT-DAP</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Fertilizante DAP 18-46-0 (50 kg)</td>
  <td class="px-2 py-1 text-center">SACO</td>
  <td class="px-2 py-1 text-right">36</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">39</td>
</tr>

<tr>
  <td class="px-2 py-1">FERT-UREA</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Urea granulada (50 kg)</td>
  <td class="px-2 py-1 text-center">SACO</td>
  <td class="px-2 py-1 text-right">33</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">33</td>
</tr>

<tr>
  <td class="px-2 py-1">FOL-K</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Fertilizante foliar Full K (1 kg)</td>
  <td class="px-2 py-1 text-center">KG</td>
  <td class="px-2 py-1 text-right">5.70</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">5.70</td>
</tr>

<tr>
  <td class="px-2 py-1">BIO-BACTHON</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Inoculante Bacthon SC (1 L)</td>
  <td class="px-2 py-1 text-center">LITRO</td>
  <td class="px-2 py-1 text-right">49.50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">49.50</td>
</tr>

<tr>
  <td class="px-2 py-1">BIO-FOSFO</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Inoculante FOSFOLIP SC (1 L)</td>
  <td class="px-2 py-1 text-center">LITRO</td>
  <td class="px-2 py-1 text-right">48.93</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">48.93</td>
</tr>

<tr>
  <td class="px-2 py-1">FITOSAN</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Control fitosanitario </td>
  <td class="px-2 py-1 text-center">SACO</td>
  <td class="px-2 py-1 text-right">1</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">20</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOSATO</td>
  <td class="px-2 py-1 text-center">26</td>
  <td class="px-2 py-1">Venenos en frasco para fumigar GLIFOSATO X 20 LT MEZFER	</td>
  <td class="px-2 py-1 text-center">FRASCO 2LT</td>
  <td class="px-2 py-1 text-right">387,50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">387,50</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOPAC</td>
  <td class="px-2 py-1 text-center">24</td>
  <td class="px-2 py-1">Caja con venenos para fumigar</td>
  <td class="px-2 py-1 text-center">FRASCO 1LT</td>
  <td class="px-2 py-1 text-right">350.30</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">350.30</td>
</tr>

<tr>
  <td class="px-2 py-1">HERR-AGRIC</td>
  <td class="px-2 py-1 text-center">3</td>
  <td class="px-2 py-1">Herramientas agrícolas</td>
  <td class="px-2 py-1 text-center">Machete Bellota</td>
  <td class="px-2 py-1 text-right">5.50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">5.50</td>
</tr>

<!-- TOTAL GENERAL -->
<tr class="bg-gray-200 font-bold">
  <td colspan="6" class="px-2 py-1 text-right">TOTAL GENERAL</td>
  <td class="px-2 py-1 text-right">$1.125,50</td>
</tr>

                 </tbody>
             </table>
         </div>

         <!-- Información adicional y totales -->
         <div class="flex flex-col md:flex-row gap-4">
             <div class="flex-1 border border-gray-800 rounded-lg p-3 text-xs font-semibold space-y-2">
                 <h3 class="font-semibold mb-2 text-center">Información Adicional</h3>
                 <p><span class="font-semibold">Dirección:</span> Av. 9 de Octubre callejon s/n Sector Brisas del Rio Sl. 2</p>
                 <p><span class="font-semibold">Teléfono:</span> 0994524187</p>
                 <p><span class="font-semibold">E-mail:</span> saraleon234@gmail.com</p>
                 <p><span class="font-semibold">Otros:</span> FACTURA ELECTRÓNICA # 11398</p>
                   <div class="mt-4">
                     <!-- Línea superior -->
                     <hr class="border-t border-gray-800 mb-2">

                     <!-- Título centrado -->
                     <h3 class="font-semibold text-center mb-2">Formas de pago</h3>

                     <!-- Línea inferior -->
                     <hr class="border-t border-gray-800 mb-3">

                     <!-- Fila de pago -->
                     <div class="flex justify-between text-xs px-1">
                         <span>UTILIZACION DEL SISTEMA FINANCIERO</span>
                         <span>$ 1.125,50 - 0 días</span>
                     </div>
                 </div>
             </div>


             <div class="font-semibold flex-1 border rounded-lg border-gray-800 p-3 text-xs">

                 <div class="mt-4 space-y-1">
                     <div class="flex justify-between">
                         <span>Subtotal 15%:</span>
                         <span>$168.82</span>
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
                         <span>978.26</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Descuentos:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>IVA 15%:</span>
                         <span>$168.82</span>
                     </div>
                     <div class=" bg-gray-200 flex justify-between font-bold border-t border-gray-300 pt-1 mt-1">
                         <span>Valor Total:</span>
                         <span>$1.125,50</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>




   <div class="max-w-4xl mx-auto my-1 p-2">
         <!-- Encabezado con información de la empresa -->
         <div class="mb-1 flex flex-col md:flex-row justify-between gap-4">
             <div class="flex-1 border p-5 border-gray-800 rounded-lg">
                 <img src= "{{ asset('image/agripac.png') }}" alt="Logo Agripac" class="mx-auto mb-2 w-24">
                 <h1 class="text-sm font-semibold uppercase text-center">Agripac S.A.</h1>
                 <p class="text-xs font-semibold p-1">MATRIZ: General Córdova No. 623 y Padre Solano, Guayaquil</p>
                 <p class="text-xs font-semibold p-1">SUCURSAL: 19 de Julio y primero de mayo, Pedro Carbo, GUAYAS</p>
                 <p class="text-xs font-semibold p-1">Teléfonos: (593 -4) 3703870 - 2560400</p>
                  <p class="text-xs font-semibold p-1">Correo: info@agripac.com.ec</p>
                 <p class="text-xs p-1 font-semibold flex justify-between">
                    <span>Obligado a Llevar Contabilidad: SI</span>
                     <span>Guayaquil - Ecuador</span>
                 </p>

                 <p class="text-xs text-center font-semibold p-5">RÉGIMEN GENERAL</p>
                 <p class="text-xs text-center font-semibold">Agente de Retención Resolución No. 10</p>
             </div>

             <div class="font-semibold flex-1 border border-gray-800 rounded-lg p-3 text-xs">
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">R.U.C.:</span>
                     <span class="font-semibold">0990006649601</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">COMPROBANTE DE</span>
                     <span class="font-semibold">001-003-000023517</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FACTURA DE VENTA No.:</span>
                     <span></span>
                 </div>
                 <div class="mb-1">
                     <span class="font-semibold">NÚMERO AUTORIZACIÓN:</span>
                     <p class="text-xs font-semibold overflow-x-auto whitespace-nowrap py-1">0207202501096533662100120010030000130550001300987</p>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FECHA Y HORA DE AUTORIZACIÓN</span>
                     <span>09/08/2025 11:20 p.m.</span>
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
                         090820250109653366210012001003000013055000903423
                     </p>
                 </div>
                 
                 
                </div>
            </div>
            
            <!-- Información del cliente -->
            <div class="font-semibold border rounded-lg border-gray-800 p-4 mb-1 text-sm">
                <div>
                 <span class="font-semibold">Razón Social/Nombres y Apellidos: LEON RIVADENEIRA SARA ALEXANDRA</span>

             </div>
             <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                 <div>
                     <span class="font-semibold">Fecha Emisión:</span>
                     <span>09/08/2025</span>
                 </div>
                 <div>
                     <span class="font-semibold">Identificación:</span>
                     <span>0923421051</span>
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
                    <tr class="border border-gray-200 bg-gray-200 ">
  <th class="px-2 py-1 text-left">CODIGO</th>
  <th class="px-2 py-1 text-center">CANTIDAD</th>
  <th class="px-2 py-1 text-left">DESCRIPCION</th>
  <th class="px-2 py-1 text-center">U/MED</th>
  <th class="px-2 py-1 text-right">V. UNITARIO</th>
  <th class="px-2 py-1 text-center">V/OSCTO</th>
  <th class="px-2 py-1 text-right">TOTAL</th>
</tr>
<tr>
  <td class="px-2 py-1">FITOSAN</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Control fitosanitario </td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1 text-right">SACO</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">20</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOSATO</td>
  <td class="px-2 py-1 text-center">26</td>
  <td class="px-2 py-1">Venenos en frasco para fumigar GLIFOSATO X 20 LT MEZFER	</td>
  <td class="px-2 py-1 text-center">FRASCO 2LT</td>
  <td class="px-2 py-1 text-right">387,50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">387,50</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOPAC</td>
  <td class="px-2 py-1 text-center">24</td>
  <td class="px-2 py-1">Caja con venenos para fumigar</td>
  <td class="px-2 py-1 text-center">FRASCO 1LT</td>
  <td class="px-2 py-1 text-right">350.30</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">350.30</td>
</tr>

<tr>
  <td class="px-2 py-1">HERR-AGRIC</td>
  <td class="px-2 py-1 text-center">3</td>
  <td class="px-2 py-1">Herramientas agrícolas</td>
  <td class="px-2 py-1 text-center">Machete Bellota</td>
  <td class="px-2 py-1 text-right">5.50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">5.50</td>
</tr>   

<tr>
    <td class="px-2 py-1">UREA-50KG</td>
    <td class="px-2 py-1 text-center">30</td>
    <td class="px-2 py-1">Urea Granulada 50 kg</td>
    <td class="px-2 py-1 text-center">SACO</td>
    <td class="px-2 py-1 text-right">20.00</td>
    <td class="px-2 py-1 text-right"></td>
    <td class="px-2 py-1 text-right">600.00</td>
 
    
</tr>

<tr>
    <td class="px-2 py-1">DAP-50KG</td>
    <td class="px-2 py-1 text-center">20</td>
    <td class="px-2 py-1">Abono DAP 18-46-0 50 kg</td>
    <td class="px-2 py-1 text-center">SACO</td>
    <td class="px-2 py-1 text-right">20.00</td>
    <td class="px-2 py-1 text-right"></td>
    <td class="px-2 py-1 text-right">400.00</td>
</tr>

<!-- TOTAL GENERAL -->
<tr class="bg-gray-200 font-bold">
  <td colspan="6" class="px-2 py-1 text-right">TOTAL GENERAL</td>
  <td class="px-2 py-1 text-right">$2.125,50</td>
</tr>

                 </tbody>
             </table>
         </div>

         <!-- Información adicional y totales -->
         <div class="flex flex-col md:flex-row gap-4">
             <div class="flex-1 border border-gray-800 rounded-lg p-3 text-xs font-semibold space-y-2">
                 <h3 class="font-semibold mb-2 text-center">Información Adicional</h3>
                 <p><span class="font-semibold">Dirección:</span> Av. 9 de Octubre callejon s/n Sector Brisas del Rio Sl. 2</p>
                 <p><span class="font-semibold">Teléfono:</span> 0994524187</p>
                 <p><span class="font-semibold">E-mail:</span> saraleon234@gmail.com</p>
                 <p><span class="font-semibold">Otros:</span> FACTURA ELECTRÓNICA # 28391</p>
                   <div class="mt-4">
                     <!-- Línea superior -->
                     <hr class="border-t border-gray-800 mb-2">

                     <!-- Título centrado -->
                     <h3 class="font-semibold text-center mb-2">Formas de pago</h3>

                     <!-- Línea inferior -->
                     <hr class="border-t border-gray-800 mb-3">

                     <!-- Fila de pago -->
                     <div class="flex justify-between text-xs px-1">
                         <span>UTILIZACION DEL SISTEMA FINANCIERO</span>
                         <span>$2.125,50 - 0 días</span>
                     </div>
                 </div>
             </div>


             <div class="font-semibold flex-1 border rounded-lg border-gray-800 p-3 text-xs">

                 <div class="mt-4 space-y-1">
                     <div class="flex justify-between">
                         <span>Subtotal 15%:</span>
                         <span>$268.82</span>
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
                         <span>1.978,26</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Descuentos:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>IVA 15%:</span>
                         <span>$168.82</span>
                     </div>
                     <div class=" bg-gray-200 flex justify-between font-bold border-t border-gray-300 pt-1 mt-1">
                         <span>Valor Total:</span>
                         <span>$2.125,50</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>



     <br><br><br>

   <div class="max-w-4xl mx-auto my-1 p-2">
         <!-- Encabezado con información de la empresa -->
         <div class="mb-1 flex flex-col md:flex-row justify-between gap-4">
             <div class="flex-1 border p-5 border-gray-800 rounded-lg">
                 <img src= "{{ asset('image/agripac.png') }}" alt="Logo Agripac" class="mx-auto mb-2 w-24">
                 <h1 class="text-sm font-semibold uppercase text-center">Agripac S.A.</h1>
                 <p class="text-xs font-semibold p-1">MATRIZ: General Córdova No. 623 y Padre Solano, Guayaquil</p>
                 <p class="text-xs font-semibold p-1">SUCURSAL: 19 de Julio y primero de mayo, Pedro Carbo, GUAYAS</p>
                 <p class="text-xs font-semibold p-1">Teléfonos: (593 -4) 3703870 - 2560400</p>
                  <p class="text-xs font-semibold p-1">Correo: info@agripac.com.ec</p>
                 <p class="text-xs p-1 font-semibold flex justify-between">
                    <span>Obligado a Llevar Contabilidad: SI</span>
                     <span>Guayaquil - Ecuador</span>
                 </p>

                 <p class="text-xs text-center font-semibold p-5">RÉGIMEN GENERAL</p>
                 <p class="text-xs text-center font-semibold">Agente de Retención Resolución No. 10</p>
             </div>

             <div class="font-semibold flex-1 border border-gray-800 rounded-lg p-3 text-xs">
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">R.U.C.:</span>
                     <span class="font-semibold">0990006649601</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">COMPROBANTE DE</span>
                     <span class="font-semibold">001-003-000023789</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FACTURA DE VENTA No.:</span>
                     <span></span>
                 </div>
                 <div class="mb-1">
                     <span class="font-semibold">NÚMERO AUTORIZACIÓN:</span>
                     <p class="text-xs font-semibold overflow-x-auto whitespace-nowrap py-1">0108920250109653366210012001003000130550001317654</p>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FECHA Y HORA DE AUTORIZACIÓN</span>
                     <span>02/09/2025 11:50 p.m.</span>
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
                         0108920250109653366210012001003000130550001317654
                     </p>
                 </div>
                 
                 
                </div>
            </div>
            
            <!-- Información del cliente -->
            <div class="font-semibold border rounded-lg border-gray-800 p-4 mb-1 text-sm">
                <div>
                 <span class="font-semibold">Razón Social/Nombres y Apellidos: LEON RIVADENEIRA SARA ALEXANDRA</span>

             </div>
             <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                 <div>
                     <span class="font-semibold">Fecha Emisión:</span>
                     <span>01/09/2025</span>
                 </div>
                 <div>
                     <span class="font-semibold">Identificación:</span>
                     <span>0923421051</span>
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
                    <tr class="border border-gray-200 bg-gray-200 ">
  <th class="px-2 py-1 text-left">CODIGO</th>
  <th class="px-2 py-1 text-center">CANTIDAD</th>
  <th class="px-2 py-1 text-left">DESCRIPCION</th>
  <th class="px-2 py-1 text-center">U/MED</th>
  <th class="px-2 py-1 text-right">V. UNITARIO</th>
  <th class="px-2 py-1 text-center">V/OSCTO</th>
  <th class="px-2 py-1 text-right">TOTAL</th>
</tr>
<tr>
    <td class="px-2 py-1">AMINAMONT-600</td>
    <td class="px-2 py-1 text-center">15</td>
    <td class="px-2 py-1">Herbicida Aminamont 600 – 1 L</td>
    <td class="px-2 py-1 text-center">LITRO</td>
    <td class="px-2 py-1 text-right">$2.50</td>
    <td class="px-2 py-1 text-center"></td>
    <td class="px-2 py-1 text-right">$37.50</td>
</tr>

<tr>
    <td class="px-2 py-1">GLIFOPAC-1L</td>
    <td class="px-2 py-1 text-center">15</td>
    <td class="px-2 py-1">Herbicida Glifopac – 1 L</td>
    <td class="px-2 py-1 text-center">LITRO</td>
    <td class="px-2 py-1 text-right">$8.40</td>
    <td class="px-2 py-1 text-center"></td>
    <td class="px-2 py-1 text-right">$126.00</td>
</tr>

<tr>
    <td class="px-2 py-1">TOUCHDOWN-IQ</td>
    <td class="px-2 py-1 text-center">15</td>
    <td class="px-2 py-1">Herbicida Touchdown-IQ – 1 L</td>
    <td class="px-2 py-1 text-center">LITRO</td>
    <td class="px-2 py-1 text-right">$17.26</td>
    <td class="px-2 py-1 text-center"></td>
    <td class="px-2 py-1 text-right">$258.90</td>
</tr>

<tr>
    <td class="px-2 py-1">REY-QUEMANTE</td>
    <td class="px-2 py-1 text-center">15</td>
    <td class="px-2 py-1">Herbicida Rey Quemante – 1 L</td>
    <td class="px-2 py-1 text-center">LITRO</td>
    <td class="px-2 py-1 text-right">$10.00</td>
    <td class="px-2 py-1 text-center"></td>
    <td class="px-2 py-1 text-right">$150.00</td>
</tr>

<tr>
    <td class="px-2 py-1">GUADAÑA-1L</td>
    <td class="px-2 py-1 text-center">15</td>
    <td class="px-2 py-1">Herbicida Guadaña – 1 L</td>
    <td class="px-2 py-1 text-center">LITRO</td>
    <td class="px-2 py-1 text-right">$7.50</td>
    <td class="px-2 py-1 text-center"></td>
    <td class="px-2 py-1 text-right">$112.50</td>
</tr>

<!-- TOTAL GENERAL -->
<tr class="bg-gray-200 font-bold">
  <td colspan="6" class="px-2 py-1 text-right">TOTAL GENERAL</td>
  <td class="px-2 py-1 text-right">$684.90</td>
</tr>

                 </tbody>
             </table>
         </div>

         <!-- Información adicional y totales -->
         <div class="flex flex-col md:flex-row gap-4">
             <div class="flex-1 border border-gray-800 rounded-lg p-3 text-xs font-semibold space-y-2">
                 <h3 class="font-semibold mb-2 text-center">Información Adicional</h3>
                 <p><span class="font-semibold">Dirección:</span> Av. 9 de Octubre callejon s/n Sector Brisas del Rio Sl. 2</p>
                 <p><span class="font-semibold">Teléfono:</span> 0994524187</p>
                 <p><span class="font-semibold">E-mail:</span> saraleon234@gmail.com</p>
                 <p><span class="font-semibold">Otros:</span> FACTURA ELECTRÓNICA # 27291</p>
                   <div class="mt-4">
                     <!-- Línea superior -->
                     <hr class="border-t border-gray-800 mb-2">

                     <!-- Título centrado -->
                     <h3 class="font-semibold text-center mb-2">Formas de pago</h3>

                     <!-- Línea inferior -->
                     <hr class="border-t border-gray-800 mb-3">

                     <!-- Fila de pago -->
                     <div class="flex justify-between text-xs px-1">
                         <span>UTILIZACION DEL SISTEMA FINANCIERO</span>
                         <span>$684.90 - 0 días</span>
                     </div>
                 </div>
             </div>


             <div class="font-semibold flex-1 border rounded-lg border-gray-800 p-3 text-xs">

                 <div class="mt-4 space-y-1">
                     <div class="flex justify-between">
                         <span>Subtotal 15%:</span>
                         <span>$102.74</span>
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
                         <span>$684.90</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Descuentos:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>IVA 15%:</span>
                         <span>$102.74</span>
                     </div>
                     <div class=" bg-gray-200 flex justify-between font-bold border-t border-gray-300 pt-1 mt-1">
                         <span>Valor Total:</span>
                         <span>$787.64</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>




<br><br><br>
<br><br><br>
<br><br><br>

 <div class="max-w-4xl mx-auto my-1 p-2">
         <!-- Encabezado con información de la empresa -->
         <div class="mb-1 flex flex-col md:flex-row justify-between gap-4">
             <div class="flex-1 border p-5 border-gray-800 rounded-lg">
                 <img src= "{{ asset('image/agripac.png') }}" alt="Logo Agripac" class="mx-auto mb-2 w-24">
                 <h1 class="text-sm font-semibold uppercase text-center">Agripac S.A.</h1>
                 <p class="text-xs font-semibold p-1">MATRIZ: General Córdova No. 623 y Padre Solano, Guayaquil</p>
                 <p class="text-xs font-semibold p-1">SUCURSAL: 19 de Julio y primero de mayo, Pedro Carbo, GUAYAS</p>
                 <p class="text-xs font-semibold p-1">Teléfonos: (593 -4) 3703870 - 2560400</p>
                  <p class="text-xs font-semibold p-1">Correo: info@agripac.com.ec</p>
                 <p class="text-xs p-1 font-semibold flex justify-between">
                    <span>Obligado a Llevar Contabilidad: SI</span>
                     <span>Guayaquil - Ecuador</span>
                 </p>

                 <p class="text-xs text-center font-semibold p-5">RÉGIMEN GENERAL</p>
                 <p class="text-xs text-center font-semibold">Agente de Retención Resolución No. 10</p>
             </div>

             <div class="font-semibold flex-1 border border-gray-800 rounded-lg p-3 text-xs">
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">R.U.C.:</span>
                     <span class="font-semibold">0990006649601</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">COMPROBANTE DE</span>
                     <span class="font-semibold">001-003-000023517</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FACTURA DE VENTA No.:</span>
                     <span></span>
                 </div>
                 <div class="mb-1">
                     <span class="font-semibold">NÚMERO AUTORIZACIÓN:</span>
                     <p class="text-xs font-semibold overflow-x-auto whitespace-nowrap py-1">0207202501096533662100120010030000130550001300987</p>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FECHA Y HORA DE AUTORIZACIÓN</span>
                     <span>02/08/2025 15:20 p.m.</span>
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
                         020820250109653366210012001003000013055000903423
                     </p>
                 </div>
                 
                 
                </div>
            </div>
            
            <!-- Información del cliente -->
            <div class="font-semibold border rounded-lg border-gray-800 p-4 mb-1 text-sm">
                <div>
                 <span class="font-semibold">Razón Social/Nombres y Apellidos: LEON RIVADENEIRA SARA ALEXANDRA</span>

             </div>
             <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                 <div>
                     <span class="font-semibold">Fecha Emisión:</span>
                     <span>02/08/2025</span>
                 </div>
                 <div>
                     <span class="font-semibold">Identificación:</span>
                     <span>0923421051</span>
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
                    <tr class="border border-gray-200 bg-gray-200 ">
  <th class="px-2 py-1 text-left">CODIGO</th>
  <th class="px-2 py-1 text-center">CANTIDAD</th>
  <th class="px-2 py-1 text-left">DESCRIPCION</th>
  <th class="px-2 py-1 text-center">U/MED</th>
  <th class="px-2 py-1 text-right">V. UNITARIO</th>
  <th class="px-2 py-1 text-center">V/OSCTO</th>
  <th class="px-2 py-1 text-right">TOTAL</th>
</tr>
<tr>
  <td class="px-2 py-1">FITOSAN</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Control fitosanitario </td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1 text-right">20</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">20</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOSATO</td>
  <td class="px-2 py-1 text-center">26</td>
  <td class="px-2 py-1">Venenos en frasco para fumigar GLIFOSATO X 20 LT MEZFER	</td>
  <td class="px-2 py-1 text-center">FRASCO 2LT</td>
  <td class="px-2 py-1 text-right">387,50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">187,50</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOPAC</td>
  <td class="px-2 py-1 text-center">24</td>
  <td class="px-2 py-1">Caja con venenos para fumigar</td>
  <td class="px-2 py-1 text-center">FRASCO 1LT</td>
  <td class="px-2 py-1 text-right">350.30</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">150.30</td>
</tr>

<tr>
  <td class="px-2 py-1">HERR-AGRIC</td>
  <td class="px-2 py-1 text-center">3</td>
  <td class="px-2 py-1">Herramientas agrícolas</td>
  <td class="px-2 py-1 text-center">Machete Bellota</td>
  <td class="px-2 py-1 text-right">5.50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">5.50</td>
</tr>   

<tr>
    <td class="px-2 py-1">UREA-50KG</td>
    <td class="px-2 py-1 text-center">30</td>
    <td class="px-2 py-1">Urea Granulada 50 kg</td>
    <td class="px-2 py-1 text-center">SACO</td>
    <td class="px-2 py-1 text-right">20.00</td>
    <td class="px-2 py-1 text-right"></td>
    <td class="px-2 py-1 text-right">400.00</td>
 
    
</tr>

<tr>
    <td class="px-2 py-1">DAP-50KG</td>
    <td class="px-2 py-1 text-center">20</td>
    <td class="px-2 py-1">Abono DAP 18-46-0 50 kg</td>
    <td class="px-2 py-1 text-center">SACO</td>
    <td class="px-2 py-1 text-right">20.00</td>
    <td class="px-2 py-1 text-right"></td>
    <td class="px-2 py-1 text-right">300.00</td>
</tr>

<!-- TOTAL GENERAL -->
<tr class="bg-gray-200 font-bold">
  <td colspan="6" class="px-2 py-1 text-right">TOTAL GENERAL</td>
  <td class="px-2 py-1 text-right">$1.168,13</td>
</tr>

                 </tbody>
             </table>
         </div>

         <!-- Información adicional y totales -->
         <div class="flex flex-col md:flex-row gap-4">
             <div class="flex-1 border border-gray-800 rounded-lg p-3 text-xs font-semibold space-y-2">
                 <h3 class="font-semibold mb-2 text-center">Información Adicional</h3>
                 <p><span class="font-semibold">Dirección:</span> Av. 9 de Octubre callejon s/n Sector Brisas del Rio Sl. 2</p>
                 <p><span class="font-semibold">Teléfono:</span> 0994524187</p>
                 <p><span class="font-semibold">E-mail:</span> saraleon234@gmail.com</p>
                 <p><span class="font-semibold">Otros:</span> FACTURA ELECTRÓNICA # 27123</p>
                   <div class="mt-4">
                     <!-- Línea superior -->
                     <hr class="border-t border-gray-800 mb-2">

                     <!-- Título centrado -->
                     <h3 class="font-semibold text-center mb-2">Formas de pago</h3>

                     <!-- Línea inferior -->
                     <hr class="border-t border-gray-800 mb-3">

                     <!-- Fila de pago -->
                     <div class="flex justify-between text-xs px-1">
                         <span>UTILIZACION DEL SISTEMA FINANCIERO</span>
                         <span>$1.200,13 - 0 días</span>
                     </div>
                 </div>
             </div>


             <div class="font-semibold flex-1 border rounded-lg border-gray-800 p-3 text-xs">

                 <div class="mt-4 space-y-1">
                     <div class="flex justify-between">
                         <span>Subtotal 15%:</span>
                         <span>$168.82</span>
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
                         <span>1.168,13</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Descuentos:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>IVA 15%:</span>
                         <span>$168.82</span>
                     </div>
                     <div class=" bg-gray-200 flex justify-between font-bold border-t border-gray-300 pt-1 mt-1">
                         <span>Valor Total:</span>
                         <span>$1.200,13</span>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     




 <div class="max-w-4xl mx-auto my-1 p-2">
         <!-- Encabezado con información de la empresa -->
         <div class="mb-1 flex flex-col md:flex-row justify-between gap-4">
             <div class="flex-1 border p-5 border-gray-800 rounded-lg">
                 <img src= "{{ asset('image/agripac.png') }}" alt="Logo Agripac" class="mx-auto mb-2 w-24">
                 <h1 class="text-sm font-semibold uppercase text-center">Agripac S.A.</h1>
                 <p class="text-xs font-semibold p-1">MATRIZ: General Córdova No. 623 y Padre Solano, Guayaquil</p>
                 <p class="text-xs font-semibold p-1">SUCURSAL: 19 de Julio y primero de mayo, Pedro Carbo, GUAYAS</p>
                 <p class="text-xs font-semibold p-1">Teléfonos: (593 -4) 3703870 - 2560400</p>
                  <p class="text-xs font-semibold p-1">Correo: info@agripac.com.ec</p>
                 <p class="text-xs p-1 font-semibold flex justify-between">
                    <span>Obligado a Llevar Contabilidad: SI</span>
                     <span>Guayaquil - Ecuador</span>
                 </p>

                 <p class="text-xs text-center font-semibold p-5">RÉGIMEN GENERAL</p>
                 <p class="text-xs text-center font-semibold">Agente de Retención Resolución No. 10</p>
             </div>

             <div class="font-semibold flex-1 border border-gray-800 rounded-lg p-3 text-xs">
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">R.U.C.:</span>
                     <span class="font-semibold">0990006649601</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">COMPROBANTE DE</span>
                     <span class="font-semibold">001-003-000029313</span>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FACTURA DE VENTA No.:</span>
                     <span></span>
                 </div>
                 <div class="mb-1">
                     <span class="font-semibold">NÚMERO AUTORIZACIÓN:</span>
                     <p class="text-xs font-semibold overflow-x-auto whitespace-nowrap py-1">2708202501096533662100120010030000130550001300987</p>
                 </div>
                 <div class="flex justify-between items-start mb-1">
                     <span class="font-semibold">FECHA Y HORA DE AUTORIZACIÓN</span>
                     <span>27/08/2025 11:23 a.m.</span>
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
                         270820250109653366210012001003000013055000903423
                     </p>
                 </div>
                 
                 
                </div>
            </div>
            
            <!-- Información del cliente -->
            <div class="font-semibold border rounded-lg border-gray-800 p-4 mb-1 text-sm">
                <div>
                 <span class="font-semibold">Razón Social/Nombres y Apellidos: LEON RIVADENEIRA SARA ALEXANDRA</span>

             </div>
             <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                 <div>
                     <span class="font-semibold">Fecha Emisión:</span>
                     <span>27/08/2025</span>
                 </div>
                 <div>
                     <span class="font-semibold">Identificación:</span>
                     <span>0923421051</span>
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
                    <tr class="border border-gray-200 bg-gray-200 ">
  <th class="px-2 py-1 text-left">CODIGO</th>
  <th class="px-2 py-1 text-center">CANTIDAD</th>
  <th class="px-2 py-1 text-left">DESCRIPCION</th>
  <th class="px-2 py-1 text-center">U/MED</th>
  <th class="px-2 py-1 text-right">V. UNITARIO</th>
  <th class="px-2 py-1 text-center">V/OSCTO</th>
  <th class="px-2 py-1 text-right">TOTAL</th>
</tr>
<tr>


<tr>
  <td class="px-2 py-1">HERR-AGRIC</td>
  <td class="px-2 py-1 text-center">3</td>
  <td class="px-2 py-1">Herramientas agrícolas</td>
  <td class="px-2 py-1 text-center">Machete Bellota</td>
  <td class="px-2 py-1 text-right">5.50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">5.50</td>
</tr>   

<tr>
    <td class="px-2 py-1">UREA-50KG</td>
    <td class="px-2 py-1 text-center">30</td>
    <td class="px-2 py-1">Urea Granulada 50 kg</td>
    <td class="px-2 py-1 text-center">SACO</td>
    <td class="px-2 py-1 text-right">20.00</td>
    <td class="px-2 py-1 text-right"></td>
    <td class="px-2 py-1 text-right">400.00</td>
 
    
</tr>

<tr>
    <td class="px-2 py-1">DAP-50KG</td>
    <td class="px-2 py-1 text-center">20</td>
    <td class="px-2 py-1">Abono DAP 18-46-0 50 kg</td>
    <td class="px-2 py-1 text-center">SACO</td>
    <td class="px-2 py-1 text-right">20.00</td>
    <td class="px-2 py-1 text-right"></td>
    <td class="px-2 py-1 text-right">300.00</td>
</tr>
  <td class="px-2 py-1">FITOSAN</td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1">Control fitosanitario </td>
  <td class="px-2 py-1 text-center">1</td>
  <td class="px-2 py-1 text-right">20</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">20</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOSATO</td>
  <td class="px-2 py-1 text-center">26</td>
  <td class="px-2 py-1">Venenos en frasco para fumigar GLIFOSATO X 20 LT MEZFER	</td>
  <td class="px-2 py-1 text-center">FRASCO 2LT</td>
  <td class="px-2 py-1 text-right">387,50</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">187,50</td>
</tr>

<tr>
  <td class="px-2 py-1">GLIFOPAC</td>
  <td class="px-2 py-1 text-center">24</td>
  <td class="px-2 py-1">Caja con venenos para fumigar</td>
  <td class="px-2 py-1 text-center">FRASCO 1LT</td>
  <td class="px-2 py-1 text-right">350.30</td>
  <td class="px-2 py-1 text-center"></td>
  <td class="px-2 py-1 text-right">150.30</td>
</tr>
<!-- TOTAL GENERAL -->
<tr class="bg-gray-200 font-bold">
  <td colspan="6" class="px-2 py-1 text-right">TOTAL GENERAL</td>
  <td class="px-2 py-1 text-right">$1.168,13</td>
</tr>

                 </tbody>
             </table>
         </div>

         <!-- Información adicional y totales -->
         <div class="flex flex-col md:flex-row gap-4">
             <div class="flex-1 border border-gray-800 rounded-lg p-3 text-xs font-semibold space-y-2">
                 <h3 class="font-semibold mb-2 text-center">Información Adicional</h3>
                 <p><span class="font-semibold">Dirección:</span> Av. 9 de Octubre callejon s/n Sector Brisas del Rio Sl. 2</p>
                 <p><span class="font-semibold">Teléfono:</span> 0994524187</p>
                 <p><span class="font-semibold">E-mail:</span> saraleon234@gmail.com</p>
                 <p><span class="font-semibold">Otros:</span> FACTURA ELECTRÓNICA # 29323</p>
                   <div class="mt-4">
                     <!-- Línea superior -->
                     <hr class="border-t border-gray-800 mb-2">

                     <!-- Título centrado -->
                     <h3 class="font-semibold text-center mb-2">Formas de pago</h3>

                     <!-- Línea inferior -->
                     <hr class="border-t border-gray-800 mb-3">

                     <!-- Fila de pago -->
                     <div class="flex justify-between text-xs px-1">
                         <span>UTILIZACION DEL SISTEMA FINANCIERO</span>
                         <span>$1.362,43 - 0 días</span>
                     </div>
                 </div>
             </div>


             <div class="font-semibold flex-1 border rounded-lg border-gray-800 p-3 text-xs">

                 <div class="mt-4 space-y-1">
                     <div class="flex justify-between">
                         <span>Subtotal 15%:</span>
                         <span>$168.82</span>
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
                         <span>1.168,13</span>
                     </div>
                     <div class="flex justify-between">
                         <span>Descuentos:</span>
                         <span>0.00</span>
                     </div>
                     <div class="flex justify-between">
                         <span>IVA 15%:</span>
                         <span>$168.82</span>
                     </div>
                     <div class=" bg-gray-200 flex justify-between font-bold border-t border-gray-300 pt-1 mt-1">
                         <span>Valor Total:</span>
                         <span>$1.362,43</span>
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
 