<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">

    <!-- ================= META MOVIL ================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>@yield('title','Sistema de Facturación')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


<style>

/* ================= OPTIMIZADO MOVIL ================= */

body{
    background:#f3f4f6;
    font-family:system-ui, sans-serif;
}

/* Navbar */
.navbar{
    padding:12px 14px;
}

/* Logo */
.navbar-brand{
    font-weight:700;
    font-size:1.3rem;
}

/* Links */
.nav-link{
    font-size:1.1rem;
    padding:10px 14px!important;
}

/* Botón logout */
.nav-link button{
    font-size:1.1rem;
}

/* Contenido */
main.container{
    padding-bottom:40px;
}

/* ================= DESKTOP ================= */

@media(min-width:900px){

    .navbar-brand{
        font-size:1.1rem;
    }

    .nav-link{
        font-size:1rem;
    }

}

</style>

</head>


<body>


<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

    <div class="container-fluid">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            🧾 Facturación
        </a>


        <!-- Botón hamburguesa -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- Menú -->
        <div class="collapse navbar-collapse" id="mainNavbar">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


                @auth

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        📊 Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sales.index') }}">
                        💰 Ventas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}">
                        👥 Clientes
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/products">
                        📦 Productos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/categories">
                        📂 Categorías
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        ⚙️ Perfil
                    </a>
                </li>


                <!-- Logout -->
                <li class="nav-item">

                    <form method="POST"
                          action="{{ route('logout') }}"
                          class="d-flex">

                        @csrf

                        <button type="submit"
                                class="btn btn-link nav-link text-danger">
                            🚪 Cerrar sesión
                        </button>

                    </form>

                </li>

                @endauth



                @guest

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        🔑 Iniciar sesión
                    </a>
                </li>

                @endguest


            </ul>

        </div>

    </div>

</nav>



<!-- ================= CONTENIDO ================= -->

<main class="container-fluid mt-5 pt-4 px-2">

    @yield('content')

</main>



<!-- ================= SCRIPTS ================= -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
