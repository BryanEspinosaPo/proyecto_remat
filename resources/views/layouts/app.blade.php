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
    {{-- @include('partials.nav')  --}}
    <main>
        @yield('content') 
    </main>

    {{-- @include('partials.footer')  --}}
</body>

</html>
