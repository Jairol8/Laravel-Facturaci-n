@extends('layouts.app')

@section('content')

<!-- ================= META PARA MOVIL ================= -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<style>

/* ================= OPTIMIZADO SAMSUNG S20 ULTRA ================= */

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

/* Cards */
.card{
    border-radius:18px;
    margin-bottom:18px;
    box-shadow:0 2px 8px rgba(0,0,0,.1);
}

/* Headers */
.header-dark{
    background:#020617;
    color:white;
    font-size:1.2rem;
    padding:14px 16px;
}

/* Inputs y botones táctiles */
input,
select,
button{
    font-size:1.1rem!important;
    min-height:48px;
}

/* Botón principal */
.btn-main{
    background:#064e3b;
    color:white;
    font-weight:600;
}

.btn-main:hover{
    background:#065f46;
}

/* Producto */
.product-item{
    background:white;
    border-radius:12px;
    padding:14px;
    margin-bottom:14px;
    box-shadow:0 1px 4px rgba(0,0,0,.08);
}

/* Historial móvil */
.mobile-card{
    background:white;
    padding:14px;
    border-radius:14px;
    margin-bottom:12px;
    box-shadow:0 1px 4px rgba(0,0,0,.08);
}

/* Texto */
.fw-bold{
    font-size:1.05rem;
}

/* Desktop oculto */
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
    📊 Gestión de Ventas
</h3>


<!-- ================= NUEVA VENTA ================= -->

<div class="card">

    <div class="card-header header-dark">
        🛒 Nueva Venta
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('sales.store') }}">
        @csrf


        <!-- ================= CLIENTE CON BUSCADOR ================= -->

        <div class="mb-3">

            <label class="fw-bold mb-1">
                Cliente
            </label>

            <input list="clientsList"
                   id="clientSearch"
                   class="form-control"
                   placeholder="🔍 Escriba el nombre..."
                   autocomplete="off"
                   required>

            <input type="hidden"
                   name="client_id"
                   id="clientId">


            <datalist id="clientsList">

                @foreach($clients as $c)

                    <option
                        value="{{ $c->name }}"
                        data-id="{{ $c->id }}">
                    </option>

                @endforeach

            </datalist>

        </div>


        <!-- ================= PRODUCTOS ================= -->

        <h6 class="fw-bold mt-3 mb-2">
            📦 Productos
        </h6>


        @foreach($products as $p)

        <div class="product-item">

            <div class="fw-bold mb-1">
                {{ $p->name }}
            </div>

            <div class="text-success mb-2">
                ${{ number_format($p->price,2) }}
            </div>

            <input type="number"
                   name="products[{{ $loop->index }}][quantity]"
                   class="form-control"
                   min="0"
                   placeholder="Cantidad">

            <input type="hidden"
                   name="products[{{ $loop->index }}][id]"
                   value="{{ $p->id }}">

            <input type="hidden"
                   name="products[{{ $loop->index }}][price]"
                   value="{{ $p->price }}">

        </div>

        @endforeach


        <button class="btn btn-main w-100 mt-4">
            💾 Guardar Venta
        </button>

        </form>

    </div>
</div>



<!-- ================= HISTORIAL ================= -->

<div class="card">

    <div class="card-header header-dark">

        📑 Historial de Ventas

        <input type="text"
               id="searchInput"
               class="form-control mt-2"
               placeholder="🔍 Buscar...">

    </div>


    <div class="card-body p-2">


        <!-- ================= MOVIL ================= -->

        <div class="mobile-list">

            @foreach($sales as $s)

            <div class="mobile-card">

                <div class="fw-bold">
                    {{ $s->folio }}
                </div>

                <div>
                    {{ $s->client->name }}
                </div>

                <div class="fw-bold text-success">
                    ${{ number_format($s->total,2) }}
                </div>

                <div class="text-muted small">

                    {{ \Carbon\Carbon::parse($s->created_at)
                        ->timezone('America/Mexico_City')
                        ->format('d/m/Y H:i') }}

                </div>


                <div class="d-flex gap-2 mt-3">

                    <a href="{{ route('sales.show',$s->id) }}"
                       class="btn btn-outline-primary w-50">
                       Ver
                    </a>

                    <a href="{{ route('sales.pdf',$s->id) }}"
                       target="_blank"
                       class="btn btn-outline-danger w-50">
                       PDF
                    </a>

                </div>

            </div>

            @endforeach

        </div>


        <!-- ================= DESKTOP ================= -->

        <div class="desktop-table table-responsive">

            <table class="table table-hover">

                <thead class="table-secondary">

                    <tr>
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($sales as $s)

                    <tr>

                        <td>{{ $s->folio }}</td>

                        <td>{{ $s->client->name }}</td>

                        <td class="fw-bold text-success">
                            ${{ number_format($s->total,2) }}
                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($s->created_at)
                                ->timezone('America/Mexico_City')
                                ->format('d/m/Y H:i') }}

                        </td>

                        <td>

                            <a href="{{ route('sales.show',$s->id) }}"
                               class="btn btn-sm btn-primary">
                               Ver
                            </a>

                            <a href="{{ route('sales.pdf',$s->id) }}"
                               target="_blank"
                               class="btn btn-sm btn-danger">
                               PDF
                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


    </div>
</div>

</div>



<!-- ================= SCRIPTS ================= -->

<script>

/* ================= BUSCADOR HISTORIAL ================= */

document.getElementById("searchInput").addEventListener("keyup", function() {

    let value = this.value.toLowerCase();

    document.querySelectorAll(".mobile-card").forEach(card=>{

        card.style.display =
            card.textContent.toLowerCase().includes(value)
            ? ""
            : "none";

    });

});


/* ================= BUSCADOR CLIENTE ================= */

const clientInput = document.getElementById("clientSearch");
const clientIdInput = document.getElementById("clientId");
const options = document.querySelectorAll("#clientsList option");


clientInput.addEventListener("input", function(){

    let value = this.value;

    let found = false;

    options.forEach(option => {

        if(option.value === value){

            clientIdInput.value = option.dataset.id;
            found = true;

        }

    });

    if(!found){
        clientIdInput.value = "";
    }

});

</script>

@endsection
