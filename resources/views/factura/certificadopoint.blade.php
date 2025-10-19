<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Certificado de Cancelación</title>
  <style>
 
  
    :root{
      --azul:#0072CE;
      --gris:#555;
      --borde:#9aa0a6;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family: Arial, Helvetica, sans-serif; color:#111; background:#f6f7fb;
    }
   .page {
  width: 800px;
  /* min-height: 1123px;  QUITADO para que no deje tanto espacio */
  margin: 8px auto; /* antes 24px → ahora más arriba */
  background: #fff;
  padding: 32px 56px; /* menos padding arriba */
  position: relative;
  box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

    .encabezado{
      display:flex; justify-content:space-between; align-items:flex-start; margin-bottom: 28px;
    }
    .lugar-fecha{
      font-size:14px; color:#000; font-weight:700; letter-spacing:.2px;
    }
    .titulo{
      text-align:left; font-size:14px; font-weight:700; margin: 24px 0 16px 0;
    }
    p{margin:10px 0; line-height:1.5}
    .negrita{font-weight:700}

    .tabla-wrap{margin:18px 0 14px}
    table{width:100%; border-collapse:collapse; font-size:13px}
    th, td{border:1px solid var(--borde); padding:8px 10px; vertical-align:top}
    th{background:#eef3ff; text-align:center; font-weight:700}
    td{background:#fff}
    .col-unidades{width:90px; text-align:center}
    .col-articulo{width:auto}
    .col-serial{width:220px}

    .firma{margin-top:64px}
    .firma p{margin:6px 0}
    .firmado{font-style:italic; color:#333}
    .empresa{font-weight:700; margin-top:8px}

    .footer{
      position:absolute; left:0; right:0; bottom:0; padding: 10px 56px 14px; font-size:12px;
    }
    .footer hr{border:none; border-top:3px solid var(--azul); margin:0 0 8px}
    .footer .fila{
      display:flex; justify-content:space-between; align-items:center; gap:10px; flex-wrap:wrap;
      color:#0b3d91; font-weight:700
    }
    .footer .web{color:#0b3d91; text-decoration:none}
    .footer .web-center {
  text-align: center;
  width: 100%;
  margin-top: 4px;
}
.footer hr {
  border: none;
  border-top: 2px solid #000; /* ahora negro */
  margin: 0 0 8px;
}

.footer .web-center a {
  color: #0b3d91;   /* Azul */
  font-weight: 700;
  text-decoration: none;
}


    @media print{
      body{background:#fff}
      .page{width:auto; min-height:auto; margin:0; box-shadow:none; padding:32mm 20mm}
      .footer{position:fixed; bottom:0; left:0; right:0; padding:4mm 20mm 6mm}
    }
  </style>
</head>
<body>
   


  <section class="page">


<div style="position: absolute; top: 20px; right: 20px;">
    <img src="{{ asset('image/point.jpg') }}" alt="Logo" class="w-24 h-auto">
</div>

   <h1 style="text-align:center; font-size:20px; font-weight:bold; margin:20px 0;">
  CERTIFICADO
</h1>

    <div class="encabezado">
      <div class="lugar-fecha">GUAYAQUIL, 24/08/2025</div>
    </div>

    <div class="titulo">A QUIEN CORRESPONDA</div>

    <p>Tenga a bien informar que el Señor(a) <span class="negrita">TOMALÁ LOOR JOHNNY ALEXANDER</span> con C.C. <span class="negrita">0928114453</span>, quien realizó la compra de los siguientes productos:</p>

    <div class="tabla-wrap">
      <table aria-label="Productos adquiridos">
        <thead>
          <tr>
            <th class="col-unidades">Unidades</th>
            <th class="col-articulo">Artículo</th>
            <th class="col-serial">Serial</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="col-unidades">1</td>
            <td class="col-articulo">18021533 TELEVISOR INDURAMA 50TIGZPGUHD 50 PUL G/UHD</td>
            <td class="col-serial">F07204000308301024</td>
          </tr>
        </tbody>
      </table>
    </div>

    <p>De acuerdo con la factura No. <span class="negrita">000006463</span> con fecha <span class="negrita">04/05/2024</span>.</p>

    <p>El cliente antes mencionado hizo la cancelación total del crédito el <span class="negrita">24/08/2025</span>, cartera Banco <span class="negrita">PICHINCHA</span> con Point Technology, con un saldo a la fecha de <span class="negrita">$0.00</span>.</p>

    <p>El cliente puede hacer uso del presente certificado para fines de carácter comercial.</p>

    <div class="firma">
      <p>Atentamente,</p>
      <p class="firmado">Documento Firmado Electrónicamente</p>
      <p class="empresa">SUPERMERCADO DE COMPUTADORAS COMPUBUSSINES CIA.LTDA.</p>
    </div>

    <div class="footer">
  <hr>
  <div class="fila">
    <div>LOCAL: PEDRO CARBO &nbsp;&nbsp;&nbsp; DIRECCIÓN: 9 DE OCTUBRE ENTRE QUITO Y SUCRE</div>
  </div>
  <div class="web-center">
    <a href="https://www.point.com.ec" target="_blank" rel="noreferrer">www.point.com.ec</a>
  </div>
</div>

  </section>
</body>
</html>
