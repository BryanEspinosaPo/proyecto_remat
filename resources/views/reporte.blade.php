<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Cliente </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuario ID</th>
                    <th scope="col">Cód. Residuo</th>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Fecha Recolección</th>
                    <th scope="col">Hora Prevista</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reportes as $reporte)
                <tr>
                    <th scope="row">{{ $reporte->id }}</th>
                    <td>{{ $reporte->usuario_id }}</td>
                    <td>{{ $reporte->cod_residuo }}</td>
                    <td>{{ $reporte->fecha_solicitud }}</td>
                    <td>{{ $reporte->peso }}</td>
                    <td>{{ $reporte->fecha_recoleccion }}</td>
                    <td>{{ $reporte->hora_prevista }}</td>
                    <td>{{ $reporte->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>