<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<style>
body{
    font-family: Arial, sans-serif;
    font-size: 12px;
}

.header{
    text-align:center;
    border-bottom:1px solid #000;
    margin-bottom:10px;
}

table{
    width:100%;
    border-collapse: collapse;
}

th,td{
    border:1px solid #000;
    padding:5px;
    text-align:center;
}

.total{
    text-align:right;
    margin-top:10px;
}
</style>
</head>

<body>

<div class="header">
    <h2>MI NEGOCIO</h2>
    <p>Tel: 555-000-0000</p>
</div>

<p>
<b>Factura:</b> {{ $sale->folio }} <br>
<b>Fecha:</b> {{ $sale->created_at->format('d/m/Y') }} <br>
<b>Cliente:</b> {{ $sale->client->name }}
</p>

<table>
<tr>
<th>Producto</th>
<th>Gramos</th>
<th>Precio</th>
<th>Cantidad</th>
<th>Total</th>
</tr>

@foreach($sale->details as $d)
<tr>
<td>{{ $d->product->name }}</td>
<td>{{ $d->product->grams }} g</td>
<td>${{ $d->price }}</td>
<td>{{ $d->quantity }}</td>
<td>${{ $d->total }}</td>
</tr>
@endforeach
</table>

<div class="total">
<p><b>Subtotal:</b> ${{ $sale->subtotal }}</p>
<p><b>Total:</b> ${{ $sale->total }}</p>
</div>

<br><br>

<p>Firma: ____________________</p>

<p style="font-size:10px">
Documento sin validez fiscal
</p>

</body>
</html>
