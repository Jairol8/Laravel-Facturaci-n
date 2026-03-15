<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
@page {
    margin: 5px;
}

body {
    font-family: monospace;
    font-size: 11px;
}

.ticket {
    width: 230px; /* 58mm */
}

.center {
    text-align: center;
}

.bold {
    font-weight: bold;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 2px 0;
}

.line {
    border-top: 1px dashed #000;
    margin: 6px 0;
}
</style>

</head>

<body>

<div class="ticket">

    <!-- ENCABEZADO -->
    <div class="center bold">
        TRANSFERENCIA<br>
        {{ $sale->folio }}<br>
    </div>

    <div class="center">
        ------------------------
    </div>

    <!-- PROVEEDOR -->
    <p class="center bold">
        Proveedor: Jairo Santiago Rodríguez
    </p>

    <div class="line"></div>

    <!-- DATOS -->
    <p>
        <strong>Fecha:</strong>
{{ \Carbon\Carbon::parse($sale->created_at)
    ->timezone('America/Mexico_City')
    ->format('d/m/Y H:i') }}<br>


        <strong>Estado:</strong>
        {{ ucfirst($sale->status ?? 'Completada') }}<br>

        <strong>Cliente:</strong>
        {{ $sale->client->name }}<br>

        <strong>Contacto:</strong>
        {{ $sale->client->phone ?? 'N/A' }}
    </p>

    <div class="line"></div>

    <!-- PRODUCTOS -->
    <table>

        @foreach($sale->details as $d)

        <tr>
            <td colspan="2" class="bold">

                {{ strtoupper($d->product->name) }}

                @if(isset($d->product->grams))
                    ({{ $d->product->grams }}g)
                @endif

            </td>
        </tr>

        <tr>
            <td>
                {{ $d->quantity }} x ${{ number_format($d->price,2) }}
            </td>

            <td align="right">
                ${{ number_format($d->subtotal,2) }}
            </td>
        </tr>

        @endforeach

    </table>

    <div class="line"></div>

    <!-- TOTAL -->
    <p class="bold">
        TOTAL: ${{ number_format($sale->total,2) }}
    </p>

    <div class="line"></div>

    <!-- MENSAJE -->
    <div class="center">

        ¡Gracias por su compra!<br>
        Esperamos verlo pronto <br><br>

        Para aclaraciones:<br>
        Tel: 33-1234-5678<br>

    </div>

</div>

</body>
</html>
