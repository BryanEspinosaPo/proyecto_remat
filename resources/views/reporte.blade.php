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
                @if(isset($usuario->id))
                <a href="{{ route('reporte.usuario', ['id' => $usuario->id]) }}" class="text-gray-600 hover:text-indigo-600 mx-2">Reporte Cliente</a>
                @endif
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
    <header class="bg-lime-100 p-12">
        <div class="max-w-2xl mx-auto flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gray-300 rounded-full"><img src="{{ asset('images/avatar.png') }}" alt="Logo" class="h-23 w-auto" /> </div>
                    <div>
                        <h1 class="font-bold text-xl">{{ $usuario->nombre ?? $usuario->name ?? 'Usuario' }}</h1>
                        <span class="text-sm text-gray-600">Puntos disponibles: {{ $puntosAcumulados ?? 0 }}</span>
                    </div>
                </div>
            </div>

            @php
            $uid = $usuario->id ?? 1;
            $prevId = $uid > 1 ? ($uid - 1) : 1;
            $nextId = $uid + 1;
            @endphp
            <!--    <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('reporte.usuario', ['id' => $prevId]) }}" class="px-3 py-1 rounded bg-white border hover:bg-gray-50">◀ Anterior</a>
                <span class="text-sm text-gray-700">Cliente actual: <strong>#{{ $uid }}</strong></span>
                <a href="{{ route('reporte.usuario', ['id' => $nextId]) }}" class="px-3 py-1 rounded bg-white border hover:bg-gray-50">Siguiente ▶</a>
-->
            <div class="flex items-center gap-2 ml-2">
                <label for="jumpUserId" class="text-sm text-gray-600">Ir al ID:</label>
                <input id="jumpUserId" type="number" min="1" value="{{ $uid }}" class="w-24 border rounded px-2 py-1">
                <button type="button" onclick="goToUser()" class="px-3 py-1 rounded bg-green-600 text-white hover:bg-green-700">Ir</button>
            </div>
        </div>
        </div>
    </header>


    <section class="max-w-6xl mx-auto mt-8 p-4 bg-white rounded shadow">
        <h2 class="text-xl font-bold text-center text-green-700 mb-4">Detalles de Asignación de Peso</h2>
        <div class="text-center mb-6">
            <a href="#historialModal" onclick="openModal('historialModal')" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Ver Detalles</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
            <div class="border p-4 rounded">
                <p class="text-2xl font-bold">{{ $pesoRecolectado ?? 0 }} kg</p>
                <span class="text-green-600">+50</span>
                <p class="text-sm text-gray-600 mt-1">Peso Recolectado (kg)</p>
            </div>
            <div class="border p-4 rounded">
                <p class="text-2xl font-bold">{{ $puntosAdquiridos ?? 0 }}</p>
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
                <p class="text-2xl font-bold">{{ $pesoRegistrado ?? 0 }} kg</p>
                <span class="text-green-600">+2 kg</span>
                <p class="text-sm text-gray-600 mt-1">Peso Registrado</p>
            </div>
            <div class="border p-4 rounded">
                <p class="text-2xl font-bold">{{ $puntosAcumulados ?? 0 }}</p>
                <span class="text-green-600">+30</span>
                <p class="text-sm text-gray-600 mt-1">Puntos Acumulados</p>
            </div>

            <!-- Progreso diagrama barras seguras (Método JavaScript) -->
            <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center min-h-[320px]">
                <h2 class="text-xl font-semibold text-gray-800">Progreso de Peso</h2>
                <p class="text-sm text-gray-500 mb-4">Peso total recolectado por mes (kg)</p>

                <!-- Contenedor del Gráfico  -->
                <div class="w-full h-56 flex items-end justify-around border-b border-gray-200 px-2">

                    @forelse ($serie ?? [] as $item)
                    <!-- Contenedor para la columna (suma + barra) -->
                    <div class="flex flex-col items-center text-center w-12">
                        <!-- Etiqueta de la suma -->
                        <span class="text-sm font-semibold text-gray-700">{{ round($item['total_peso'] ?? 0, 1) }}</span>

                        <!-- La Barra. -->
                        <div class="mt-1 w-8 bg-green-600 hover:bg-green-500 rounded-t-md transition-all duration-500 ease-out"
                            data-height="{{ $item['height_percentage'] ?? 0 }}"
                            title="{{ round($item['total_peso'] ?? 0, 1) }} kg">
                        </div>
                    </div>
                    @empty
                    <div class="flex items-center justify-center h-full w-full">
                        <p class="text-gray-500">No hay datos de peso para mostrar.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Contenedor para las etiquetas de los meses -->
                <div class="w-full h-8 flex items-start justify-around px-2 pt-1">
                    @foreach ($serie ?? [] as $item)
                    <div class="w-12 text-center">
                        <span class="text-xs font-medium text-gray-500 uppercase">
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $item['ym'])->translatedFormat('M') }}
                        </span>
                    </div>
                    @endforeach
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
                        @forelse ($reportes ?? [] as $reporte)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $reporte->id ?? '—' }}</td>
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
                <li>Peso inicial: {{ $pesoRegistrado ?? 0 }} kg</li>
                <li>Puntos acumulados: {{ $puntosAcumulados ?? 0 }}</li>
                <li>Peso recolectado total: {{ $pesoRecolectado ?? 0 }} kg</li>
            </ul>
            <div class="text-right mt-4">
                <button onclick="closeModal('metricasModal')" class="bg-red-500 text-white px-4 py-2 rounded">Cerrar</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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
        document.addEventListener('DOMContentLoaded', () => {

            const bars = document.querySelectorAll('[data-height]');


            setTimeout(() => {
                bars.forEach(bar => {

                    let heightPercentage = parseFloat(bar.dataset.height) || 0;


                    heightPercentage = Math.max(0, Math.min(100, heightPercentage));


                    bar.style.height = heightPercentage + '%';
                });
            }, 100);
        });
    </script>

</body>

</html>