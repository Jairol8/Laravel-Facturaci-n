@extends('layouts.app')

@section('content')

<!-- ================= META MOVIL ================= -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<style>

/* ================= OPTIMIZADO SAMSUNG ================= */

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

/* Header */
.header-dark{
    background:#020617;
    color:white;
    font-size:1.2rem;
    padding:14px 16px;
}

/* Inputs y botones */
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

/* Producto móvil */
.product-card{
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
    📦 Gestión de Productos
</h3>


{{-- ================= MENSAJE ================= --}}

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif



<!-- ================= NUEVO PRODUCTO ================= -->

<div class="card">

    <div class="card-header header-dark">
        ➕ Nuevo Producto
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('products.store') }}">
        @csrf


        <!-- Nombre -->
        <div class="mb-3">

            <label class="fw-bold mb-1">
                Nombre
            </label>

            <input name="name"
                   class="form-control"
                   placeholder=" Nombre del producto"
                   required>

        </div>


        <!-- Precio -->
        <div class="mb-3">

            <label class="fw-bold mb-1">
                Precio
            </label>

            <input name="price"
                   type="number"
                   step="0.01"
                   class="form-control"
                   placeholder="💲 Precio"
                   required>

        </div>


        <!-- Gramos -->
        <div class="mb-3">

            <label class="fw-bold mb-1">
                Gramos
            </label>

            <input name="grams"
                   type="number"
                   class="form-control"
                   placeholder=" Gramos"
                   required>

        </div>


        <!-- Categoría -->
        <div class="mb-3">

            <label class="fw-bold mb-1">
                Categoría
            </label>

            <select name="category_id"
                    class="form-select"
                    required>

                <option value="">Seleccione categoría</option>

                @foreach($categories as $cat)

                    <option value="{{ $cat->id }}">
                        {{ $cat->name }}
                    </option>

                @endforeach

            </select>

        </div>


        <!-- Botón -->
        <button class="btn btn-main w-100 mt-2">
            💾 Guardar Producto
        </button>

        </form>

    </div>
</div>



<!-- ================= LISTA PRODUCTOS ================= -->

<div class="card">

    <div class="card-header header-dark">

        📋 Lista de Productos

        <input type="text"
               id="searchInput"
               class="form-control mt-2"
               placeholder="🔍 Buscar producto...">

    </div>


    <div class="card-body p-2">


        <!-- ================= MOVIL ================= -->

        <div class="mobile-list">

            @foreach($products as $p)

            <div class="product-card">

                <div class="fw-bold mb-1">
                    {{ $p->name }}
                </div>

                <div class="text-success mb-1">
                    💲 ${{ number_format($p->price,2) }}
                </div>

                <div class="mb-1">
                     {{ $p->grams }} g
                </div>

                <div class="mb-2">
                     {{ $p->category->name }}
                </div>

                <div class="text-muted small">
                    ID: {{ $p->id }}
                </div>

            </div>

            @endforeach

        </div>


        <!-- ================= DESKTOP ================= -->

        <div class="desktop-table table-responsive">

            <table class="table table-hover">

                <thead class="table-secondary">

                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Gramos</th>
                        <th>Categoría</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($products as $p)

                    <tr>

                        <td>{{ $p->id }}</td>

                        <td>{{ $p->name }}</td>

                        <td class="fw-bold text-success">
                            ${{ number_format($p->price,2) }}
                        </td>

                        <td>{{ $p->grams }} g</td>

                        <td>{{ $p->category->name }}</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


    </div>
</div>

</div>



<!-- ================= BUSCADOR ================= -->

<script>

document.getElementById("searchInput").addEventListener("keyup", function(){

    let value = this.value.toLowerCase();

    document.querySelectorAll(".product-card").forEach(card=>{

        card.style.display =
            card.textContent.toLowerCase().includes(value)
            ? ""
            : "none";

    });

});

</script>

@endsection
