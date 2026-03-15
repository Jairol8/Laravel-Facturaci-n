@extends('layouts.app')

@section('content')

<!-- ================= META MOVIL ================= -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<style>

/* ================= OPTIMIZADO MOVIL ================= */

html{
    font-size:18px;
}

body{
    background:#f3f4f6;
    font-family:system-ui, sans-serif;
}

/* Contenedor */
.container-fluid{
    padding:12px!important;
}

/* Card */
.card{
    border-radius:18px;
    margin-bottom:18px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

/* Header */
.header-dark{
    background:#020617;
    color:white;
    font-size:1.2rem;
    padding:14px 16px;
}

/* Datos */
.info-box{
    background:white;
    border-radius:12px;
    padding:14px;
    margin-bottom:14px;
    box-shadow:0 1px 4px rgba(0,0,0,.08);
}

/* Producto */
.product-row{
    background:white;
    border-radius:12px;
    padding:12px;
    margin-bottom:10px;
    box-shadow:0 1px 3px rgba(0,0,0,.08);
}

/* Texto */
.fw-bold{
    font-size:1.05rem;
}

/* Botón */
.btn-main{
    background:#064e3b;
    color:white;
    font-weight:600;
    min-height:48px;
}

.btn-main:hover{
    background:#065f46;
}

/* Botón regresar */
.btn-back{
    background:#1e293b;
    color:white;
    font-weight:600;
    min-height:48px;
    margin-bottom:10px;
}

.btn-back:hover{
    background:#0f172a;
}

/* Ocultar desktop */
.desktop-table{
    display:none;
}

/* ================= DESKTOP ================= */

@media(min-width:900px){

    html{
        font-size:14px;
    }

    .mobile-list{
        display:none;
    }

    .desktop-table{
        display:block;
    }

}

</style>



<div class="container-fluid px-2">

<h3 class="fw-bold mb-3">
    🧾 Factura {{ $sale->folio }}
</h3>


<!-- ================= DATOS ================= -->

<div class="card">

    <div class="card-header header-dark">
        📋 Información
    </div>

    <div class="card-body">


        <div class="info-box">

            <div class="fw-bold mb-1">
                Cliente:
            </div>

            <div class="mb-2">
                {{ $sale->client->name }}
            </div>

            <div class="fw-bold mb-1">
                Fecha:
            </div>

            <div class="mb-2">

                {{ \Carbon\Carbon::parse($sale->created_at)
                    ->timezone('America/Mexico_City')
                    ->format('d/m/Y H:i') }}

            </div>

            <div class="fw-bold mb-1">
                Estado:
            </div>

            <div>
                {{ ucfirst($sale->status ?? 'Completada') }}
            </div>

        </div>

    </div>
</div>



<!-- ================= PRODUCTOS ================= -->

<div class="card">

    <div class="card-header header-dark">
        📦 Productos
    </div>

    <div class="card-body">


        <!-- ================= MOVIL ================= -->

        <div class="mobile-list">

            @foreach($sale->details as $d)

            <div class="product-row">

                <div class="fw-bold mb-1">
                    {{ $d->product->name }}

                    @if($d->product->grams)
                        <small class="text-muted">
                            ({{ $d->product->grams }} g)
                        </small>
                    @endif
                </div>

                <div>
                    Cantidad: {{ $d->quantity }}
                </div>

                <div>
                    Precio: ${{ number_format($d->price,2) }}
                </div>

            </div>

            @endforeach

        </div>


        <!-- ================= DESKTOP ================= -->

        <div class="desktop-table table-responsive">

            <table class="table table-hover">

                <thead class="table-secondary">

                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($sale->details as $d)

                    <tr>

                        <td>
                            {{ $d->product->name }}

                            @if($d->product->grams)
                                <small class="text-muted">
                                    ({{ $d->product->grams }} g)
                                </small>
                            @endif
                        </td>

                        <td>{{ $d->quantity }}</td>

                        <td>${{ number_format($d->price,2) }}</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


    </div>
</div>



<!-- ================= BOTONES ================= -->

<div class="card">

    <div class="card-body text-center">


        <!-- REGRESAR -->
        <a href="{{ url()->previous() }}"
           class="btn btn-back w-100">

            ⬅️ Regresar

        </a>


        <!-- PDF -->
        <a href="{{ route('sales.pdf',$sale->id) }}"
           class="btn btn-main w-100">

            📄 Descargar PDF

        </a>

    </div>

</div>

</div>

@endsection
