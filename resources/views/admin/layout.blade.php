<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Facturación</span>

    <div class="text-white">
        {{ auth()->user()->name }}

        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout').submit();"
           class="ms-3 text-white">Salir</a>
    </div>

    <form id="logout" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
