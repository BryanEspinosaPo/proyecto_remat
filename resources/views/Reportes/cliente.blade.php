<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reporte Cliente</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-4">
        <h1>Reporte Cliente: {{ $usuario->nombre ?? 'Sin Nombre' }}</h1>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cód. Residuo</th>
                    <th>Fecha Solicitud</th>
                    <th>Peso</th>
                    <th>Fecha Recolección</th>
                    <th>Hora Prevista</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reportes as $reporte)
                <tr>
                    <td>{{ $reporte->id }}</td>
                    <td>{{ $reporte->cod_residuo }}</td>
                    <td>{{ $reporte->fecha_solicitud }}</td>
                    <td>{{ $reporte->peso }}</td>
                    <td>{{ $reporte->fecha_recoleccion }}</td>
                    <td>{{ $reporte->hora_prevista }}</td>
                    <td>{{ $reporte->estado }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No hay reportes para mostrar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>