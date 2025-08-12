<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-indigo-600">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
            </a>
            <div>
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-2">Agendamiento</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-2">Reporte Cliente</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-2">Puntos</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-2">Ingresar</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-gray-800 text-white p-8 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Mi Landing Page. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>