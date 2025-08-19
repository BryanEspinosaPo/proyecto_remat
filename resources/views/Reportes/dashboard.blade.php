<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand text-indigo-600 fw-bold" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 32px;">
                Proyecto
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Agendamiento</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Reporte Cliente</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Puntos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Ingresar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <header class="bg-success bg-opacity-10 rounded p-3 d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0">{{ $usuario->nombre }}</h5>
                <small class="text-success">Mis Asignaciones | {{ $puntosAcumulados }} Puntos disponibles</small>
                <p class="mb-0 text-muted small">Visualiza tus resultados de asignación y recolección.</p>
            </div>
            <a href="#" class="btn btn-success">Ver Resultados</a>
        </header>

        <h3 class="text-center mb-3">Detalles de Asignación de Peso</h3>
        <p class="text-center text-muted">Revisa el peso asignado y el total recolectado.</p>
        <div class="text-center mb-4">
            <a href="{{ route('reporte.usuario', $usuario->id) }}" class="btn btn-success">Ver Detalles</a>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-4 border rounded p-3 mx-2 text-center">
                <h6>Peso Recolectado (kg)</h6>
                <h3>{{ number_format($pesoRecoleccion, 2) }}</h3>
                <small class="text-success">+50</small>
            </div>
            <div class="col-md-4 border rounded p-3 mx-2 text-center">
                <h6>Puntos Adquiridos</h6>
                <h3>{{ $puntosCanjeados }}</h3>
                <small class="text-success">+30</small>
            </div>
        </div>

        <h4 class="mb-3">Tus Métricas</h4>
        <p>Revisa tu progreso y los puntos acumulados.</p>
        <a href="{{ route('reporte.usuario', $usuario->id) }}" class="btn btn-success mb-3">Ver Detalles</a>

        <div class="row justify-content-center mb-5">
            <div class="col-md-3 border rounded p-3 mx-2 text-center">
                <h6>Peso Registrado</h6>
                <h4>70 kg</h4>
                <small class="text-success">+2 kg</small>
            </div>
            <div class="col-md-3 border rounded p-3 mx-2 text-center">
                <h6>Puntos Acumulados</h6>
                <h4>{{ $puntosAcumulados }}</h4>
                <small class="text-success">+30</small>
            </div>

            <div class="col-md-6 border rounded p-3">
                <h6>Progreso de Peso (kg)</h6>
                <canvas id="progresoPesoChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('progresoPesoChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Peso (kg)',
                    data: @json($pesosMeses),
                    backgroundColor: 'rgba(60, 120, 50, 0.7)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>