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

/* Tarjeta cliente móvil */
.client-card{
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
    👥 Gestión de Clientes
</h3>


<!-- ================= NUEVO CLIENTE ================= -->

<div class="card">

    <div class="card-header header-dark">
        ➕ Nuevo Cliente
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('clients.store') }}">
        @csrf

        <!-- Nombre -->
        <div class="mb-3">

            <label class="fw-bold mb-1">
                Nombre
            </label>

            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="👤 Nombre del cliente"
                   required>

        </div>


        <!-- Teléfono -->
        <div class="mb-3">

            <label class="fw-bold mb-1">
                Teléfono
            </label>

            <input type="text"
                   name="phone"
                   class="form-control"
                   placeholder="📞 Teléfono">

        </div>


        <!-- Botón -->
        <button class="btn btn-main w-100 mt-2">
            💾 Guardar Cliente
        </button>

        </form>

    </div>
</div>



<!-- ================= LISTA CLIENTES ================= -->

<div class="card">

    <div class="card-header header-dark">

        📋 Lista de Clientes

        <input type="text"
               id="searchInput"
               class="form-control mt-2"
               placeholder="🔍 Buscar cliente...">

    </div>


    <div class="card-body p-2">


        <!-- ================= MOVIL ================= -->

        <div class="mobile-list">

            @foreach($clients as $c)

            <div class="client-card">

                <div class="fw-bold mb-1">
                    {{ $c->name }}
                </div>

                <div class="mb-2">
                    📞 {{ $c->phone ?? 'Sin teléfono' }}
                </div>


                <form method="POST"
                      action="{{ route('clients.destroy',$c->id) }}">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger w-100">
                    🗑️ Eliminar
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
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Acción</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($clients as $c)

                    <tr>

                        <td>{{ $c->name }}</td>

                        <td>{{ $c->phone }}</td>

                        <td>

                            <form method="POST"
                                  action="{{ route('clients.destroy',$c->id) }}">
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

    document.querySelectorAll(".client-card").forEach(card=>{

        card.style.display =
            card.textContent.toLowerCase().includes(value)
            ? ""
            : "none";

    });

});

</script>

@endsection
