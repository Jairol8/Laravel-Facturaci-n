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

/* Categoría móvil */
.category-card{
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
    📂 Gestión de Categorías
</h3>


{{-- ================= MENSAJE ================= --}}

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif



<!-- ================= NUEVA CATEGORÍA ================= -->

<div class="card">

    <div class="card-header header-dark">
        ➕ Nueva Categoría
    </div>

    <div class="card-body">

        <form action="{{ route('categories.store') }}" method="POST">
        @csrf


        <div class="mb-3">

            <label class="fw-bold mb-1">
                Nombre de Categoría
            </label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="📂 Ej: Bebidas, Dulces..."
                   required>

        </div>


        <button class="btn btn-main w-100">
            💾 Guardar Categoría
        </button>

        </form>

    </div>
</div>



<!-- ================= LISTA ================= -->

<div class="card">

    <div class="card-header header-dark">

        📋 Lista de Categorías

        <input type="text"
               id="searchInput"
               class="form-control mt-2"
               placeholder="🔍 Buscar categoría...">

    </div>


    <div class="card-body p-2">


        <!-- ================= MOVIL ================= -->

        <div class="mobile-list">

            @foreach($categories as $cat)

            <div class="category-card">

                <div class="fw-bold mb-1">
                    {{ $cat->name }}
                </div>

                <div class="text-muted mb-2">
                    ID: {{ $cat->id }}
                </div>

                <form action="{{ route('categories.destroy',$cat->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outline-danger w-100">
                        🗑 Eliminar
                    </button>

                </form>

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
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($categories as $cat)

                    <tr>

                        <td>{{ $cat->id }}</td>

                        <td>{{ $cat->name }}</td>

                        <td>

                            <form action="{{ route('categories.destroy',$cat->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Eliminar esta categoría?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">
                                    Eliminar
                                </button>

                            </form>

                        </td>

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

    document.querySelectorAll(".category-card").forEach(card=>{

        card.style.display =
            card.textContent.toLowerCase().includes(value)
            ? ""
            : "none";

    });

});

</script>

@endsection
