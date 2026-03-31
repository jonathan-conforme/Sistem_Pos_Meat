<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Factura {{ $sales->sale_number }}</title>

<style>
body{
    font-family: DejaVu Sans, sans-serif;
    font-size: 11px;
    margin:0;
    padding:0;
}

table{
    border-collapse: collapse;
}

.box{
    border:1px solid #000;
    border-radius:6px;
    padding:6px;
}

.products{
    width:100%;
    margin-top:5px;
}

.products th,
.products td{
    border:1px solid #000;
    padding:5px;
}

.products th{
    background:#f2f2f2;
    font-size:10px;
}

.text-right{
    text-align:right;
}

.bold{
    font-weight:bold;
}
</style>
</head>

<body>

<table width="100%">
<tr>
<td width="55%" valign="top">
    @if($empresa && $empresa->logo)
        <img src="{{ public_path('storage/' . $empresa->logo) }}" width="220">
    @endif
</td>

<td width="45%" valign="top">
    <table width="100%">
    <tr>
        <td class="box">
            <strong>R.U.C.:</strong> {{ $empresa->ruc }}<br>
            <strong>FACTURA</strong><br>
            <strong>N°:</strong> {{ $sales->sale_number }}<br>
            <strong>Fecha:</strong> {{ $sales->created_at->format('d/m/Y H:i') }}
        </td>
    </tr>
    </table>
</td>
</tr>

<tr>
<td colspan="2" height="5"></td>
</tr>

<tr>
<td colspan="2" class="box">
<strong>{{ $empresa->razon_social }}</strong><br>
Dirección Matriz: {{ $empresa->matriz }}<br>
Teléfono: {{ $empresa->telefono }}<br>
Email: {{ $empresa->email }}
</td>
</tr>

<tr>
<td colspan="2" height="5"></td>
</tr>

<tr>
<td colspan="2" class="box">
<strong>Razón Social / Nombres:</strong> {{ $sales->customer->name ?? 'Consumidor Final' }}
&nbsp;&nbsp;&nbsp;
<strong>RUC/C.I.:</strong> {{ $sales->customer->cedula ?? '9999999999' }}
<br>
<strong>Fecha Emisión:</strong> {{ $sales->created_at->format('d/m/Y') }}
</td>
</tr>

<tr>
<td colspan="2">

<table class="products">
<thead>
<tr>
<th width="10%">CÓD.</th>
<th width="40%">DESCRIPCIÓN</th>
<th width="10%">CANT.</th>
<th width="15%">P. UNIT</th>
<th width="10%">DESC.</th>
<th width="15%">TOTAL</th>
</tr>
</thead>
<tbody>
@foreach($sales->items as $item)
<tr>
<td>{{ $item->product->code ?? '' }}</td>
<td>{{ $item->product->name ?? '' }}</td>
<td class="text-right">{{ $item->quantity }}</td>
<td class="text-right">{{ number_format($item->price_per_unit,2) }}</td>
<td class="text-right">0.00</td>
<td class="text-right">{{ number_format($item->subtotal,2) }}</td>
</tr>
@endforeach
</tbody>
</table>

</td>
</tr>

<tr>
<td width="60%"></td>
<td width="40%">

<table width="100%">
<tr>
<td class="box">

<table width="100%">
<tr>
<td>SUBTOTAL 15%</td>
<td class="text-right">{{ number_format($sales->subtotal,2) }}</td>
</tr>
<tr>
<td>IVA 15%</td>
<td class="text-right">{{ number_format($sales->tax ?? 0,2) }}</td>
</tr>
<tr>
<td class="bold">TOTAL</td>
<td class="text-right bold">
{{ number_format($sales->subtotal,2) }}
</td>
</tr>
</table>

</td>
</tr>
</table>

</td>
</tr>

</table>

</body>
</html>
