<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi sitio')</title>

    <link rel="stylesheet" href="{{ asset('css/home/home.css') }}">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @include('partials.nav') {{-- Aquí incluyes el nav --}}

    <main>
        @yield('content') {{-- Aquí va el contenido específico de cada landing --}}
    </main>

    @include('partials.footer') {{-- Aquí el footer --}}
</body>

</html>
