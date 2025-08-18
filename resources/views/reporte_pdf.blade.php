<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte - {{ $usuario->nombre ?? $usuario->name ?? 'Usuario' }}</title>
    {{-- Estilos básicos para el PDF --}}
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            font-size: 12px;
        }

        .header,
        .section {
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #4CAF50;
        }

        .header p {
            font-size: 14px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .metrics-grid {
            display: block;
        }

        .metric-box {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            margin-bottom: 10px;
        }

        .metric-box .value {
            font-size: 20px;
            font-weight: bold;
        }

        .metric-box .label {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Reporte de Cliente</h1>
        <p><strong>Nombre:</strong> {{ $usuario->nombre ?? $usuario->name ?? 'Usuario' }}</p>
        <p><strong>Puntos disponibles:</strong> {{ $puntosAcumulados ?? 0 }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">Resumen de Métricas</h2>
        <div class="metrics-grid">
            <div class="metric-box">
                <div class="value">{{ $pesoRegistrado ?? 0 }} kg</div>
                <div class="label">Peso Registrado</div>
            </div>
            <div class="metric-box">
                <div class="value">{{ $pesoRecolectado ?? 0 }} kg</div>
                <div class="label">Peso Recolectado (kg)</div>
            </div>
            <div class="metric-box">
                <div class="value">{{ $puntosAcumulados ?? 0 }}</div>
                <div class="label">Puntos Acumulados</div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Historial de Recolección</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cód. Residuo</th>
                    <th>Fecha Solicitud</th>
                    <th>Peso</th>
                    <th>Fecha Recolección</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reportes ?? [] as $reporte)
                <tr>
                    <td>{{ $reporte->id ?? '—' }}</td>
                    <td>{{ $reporte->cod_residuo ?? '—' }}</td>
                    <td>{{ $reporte->fecha_solicitud ?? '—' }}</td>
                    <td>{{ $reporte->peso ?? '—' }}</td>
                    <td>{{ $reporte->fecha_recoleccion ?? '—' }}</td>
                    <td>{{ $reporte->estado ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No hay reportes disponibles.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>