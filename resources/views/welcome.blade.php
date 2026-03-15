<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mi Sistema</title>

    <!-- Fuente -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 antialiased">

<div class="min-h-screen flex flex-col justify-center items-center px-4">

    <!-- Header -->
    <div class="w-full max-w-md text-center mb-8">

        <div class="flex justify-center mb-4">
            <svg viewBox="0 0 62 65" class="h-16 text-red-600">
                <path fill="#FF2D20"
                d="M61.8548 14.6253C61.8778...Z"/>
            </svg>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
            Sistema Laravel
        </h1>

        <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">
            Panel principal
        </p>

    </div>

    <!-- Login / Dashboard -->
    <div class="w-full max-w-md mb-6 text-center">

        @if (Route::has('login'))

            @auth

                <a href="{{ url('/dashboard') }}"
                   class="block w-full bg-red-600 text-white py-3 rounded-lg text-lg font-semibold shadow hover:bg-red-700 transition">

                    Ir al Dashboard

                </a>

            @else

                <a href="{{ route('login') }}"
                   class="block w-full bg-red-600 text-white py-3 rounded-lg text-lg font-semibold shadow hover:bg-red-700 transition mb-3">

                    Iniciar Sesión

                </a>

                @if (Route::has('register'))

                    <a href="{{ route('register') }}"
                       class="block w-full border border-red-600 text-red-600 py-3 rounded-lg text-lg font-semibold hover:bg-red-50 transition">

                        Registrarse

                    </a>

                @endif

            @endauth

        @endif

    </div>

    <!-- Footer -->
    <div class="mt-10 text-sm text-gray-500 dark:text-gray-400 text-center">

       
    </div>

</div>

</body>
</html>
