<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reporte Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-indigo-600">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto" />
            </a>
            <div class="flex items-center gap-2">
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-2">Agendamiento</a>
                <a href="{{ route('reporte.usuario', ['id' => $usuario->id]) }}" class="text-gray-600 hover:text-indigo-600 mx-2">Reporte Cliente</a>
                <a href="#" class="text-gray-600 hover:text-indigo-600 mx-2">Puntos</a>

                <a href="{{ route('logout') }}"
                    class="text-gray-600 hover:text-indigo-600 mx-2"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Header Usuario -->
    <header class="bg-lime-100 p-6">
        <div class="max-w-7xl mx-auto flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
                    <div>
                        <h1 class="font-bold text-xl">{{ $usuario->nombre ?? $usuario->name ?? 'Usuario' }}</h1>
                        <span class="text-sm text-gray-600">Puntos disponibles: {{ $puntosAcumulados }}</span>
                    </div>
                </div>
                <a href="#historialModal" onclick="openModal('historialModal')" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Ver Resultados</a>
            </div>

            <!-- Navegación por ID de usuario -->
            @php
            $prevId = ($usuario->id ?? 1) > 1 ? ($usuario->id - 1) : 1;
            $nextId = ($usuario->id ?? 1) + 1;
            @endphp
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('reporte.usuario', ['id' => $prevId]) }}" class="px-3 py-1 rounded bg-white border hover:bg-gray-50">◀ Anterior</a>
                <span class="text-sm text-gray-700">Cliente actual: <strong>#{{ $usuario->id }}</strong></span>
                <a href="{{ route('reporte.usuario', ['id' => $nextId]) }}" class="px-3 py-1 rounded bg-white border hover:bg-gray-50">Siguiente ▶</a>

                <div class="flex items-center gap-2 ml-2">
                    <label for="jumpUserId" class="text-sm text-gray-600">Ir al ID:</label>
                    <input id="jumpUserId" type="number" min="1" value="{{ $usuario->id }}" class="w-24 border rounded px-2 py-1">
                    <button type="button" onclick="goToUser()" class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">Ir</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Detalles de Asignación de Peso -->
    <section class="max-w-6xl mx-auto mt-8 p-4 bg-white rounded shadow">
        <h2 class="text-xl font-bold text-center text-green-700 mb-4">Detalles de Asignación de Peso</h2>
        <div class="text-center mb-6">
            <a href="#historialModal" onclick="openModal('historialModal')" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Ver Detalles</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
            <div class="border p-4 rounded">
                <p class="text-2xl font-bold">{{ $pesoRecolectado }} kg</p>
                <span class="text-green-600">+50</span>
                <p class="text-sm text-gray-600 mt-1">Peso Recolectado (kg)</p>
            </div>
            <div class="border p-4 rounded">
                <p class="text-2xl font-bold">{{ $puntosAdquiridos }}</p>
                <span class="text-green-600">+30</span>
                <p class="text-sm text-gray-600 mt-1">Puntos Adquiridos</p>
            </div>
        </div>
    </section>

    <!-- Métricas -->
    <section class="max-w-6xl mx-auto mt-8 p-4 bg-white rounded shadow">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Tus Métricas</h2>
            <a href="#metricasModal" onclick="openModal('metricasModal')" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mt-4 md:mt-0">Ver Detalles</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="border p-4 rounded">
                <p class="text-2xl font-bold">{{ $pesoRegistrado }} kg</p>
                <span class="text-green-600">+2 kg</span>
                <p class="text-sm text-gray-600 mt-1">Peso Registrado</p>
            </div>
            <div class="border p-4 rounded">
                <p class="text-2xl font-bold">{{ $puntosAcumulados }}</p>
                <span class="text-green-600">+30</span>
                <p class="text-sm text-gray-600 mt-1">Puntos Acumulados</p>
            </div>
            <div class="border p-4 rounded">
                <p class="text-sm text-gray-600 mb-2">Progreso de Peso</p>
                <div class="h-32 bg-green-200 rounded flex items-end justify-around space-x-2">
                    @foreach ($bars as $h)
                    <div class="w-4 bg-green-700 rounded-t" style="height: {{ $altura ?? 0 }}%"></div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- Modal Historial -->
    <div id="historialModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-4xl w-full">
            <h2 class="text-xl font-bold mb-4">Historial de Recolección</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-green-700 text-white">
                        <tr>
                            <th class="py-2 px-4">ID</th>
                            <th class="py-2 px-4">Cód. Residuo</th>
                            <th class="py-2 px-4">Fecha Solicitud</th>
                            <th class="py-2 px-4">Peso</th>
                            <th class="py-2 px-4">Fecha Recolección</th>
                            <th class="py-2 px-4">Hora Prevista</th>
                            <th class="py-2 px-4">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($reportes as $reporte)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $reporte->id }}</td>
                            <td class="py-2 px-4">{{ $reporte->cod_residuo ?? '—' }}</td>
                            <td class="py-2 px-4">{{ $reporte->fecha_solicitud ?? '—' }}</td>
                            <td class="py-2 px-4">{{ $reporte->peso ?? '—' }}</td>
                            <td class="py-2 px-4">{{ $reporte->fecha_recoleccion ?? '—' }}</td>
                            <td class="py-2 px-4">{{ $reporte->hora_prevista ?? '—' }}</td>
                            <td class="py-2 px-4">{{ $reporte->estado ?? '—' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500">No hay reportes disponibles.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-right mt-4">
                <button onclick="closeModal('historialModal')" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Modal Métricas -->
    <div id="metricasModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg max-w-2xl w-full">
            <h2 class="text-xl font-bold mb-4">Historial de Métricas</h2>
            <ul class="list-disc ml-6 space-y-1">
                <li>Peso inicial: {{ $pesoRegistrado }} kg</li>
                <li>Puntos acumulados: {{ $puntosAcumulados }}</li>
                <li>Peso recolectado total: {{ $pesoRecolectado }} kg</li>
            </ul>
            <div class="text-right mt-4">
                <button onclick="closeModal('metricasModal')" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            const el = document.getElementById(id);
            el.classList.remove('hidden');
            el.classList.add('flex');
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            el.classList.add('hidden');
            el.classList.remove('flex');
        }

        function goToUser() {
            const input = document.getElementById('jumpUserId');
            const id = parseInt(input.value, 10);
            if (!isNaN(id) && id > 0) {
                window.location.href = "{{ url('/reporte') }}/" + id;
            }
        }
    </script>

</body>

</html>