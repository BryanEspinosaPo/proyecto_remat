<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamiento</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="min-h-screen w-full bg-gray-50 text-gray-800 font-sans">
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
            </a>
            <div class="hidden md:flex  space-x-6 text-sm font-medium">
                <a href="{{ route('landingInside') }}" class="text-gray-600 hover:text-green-700 transition">Inicio</a>
                <a href="{{ route('reporte.usuario', ['id' => 1]) }}"
                    class="text-gray-600 hover:text-green-700 transition">Reporte</a>
                <a href="{{ route('puntos') }}" class="text-gray-600 hover:text-green-700 transition">Puntos</a>
            </div>
        </div>
    </nav>
    <div class="bg-lime-100 from-green-200 via-green-100 to-green-50 py-10 shadow-inner">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-green-900">Solicitar Recolección</h1>
            <p class="text-gray-700 mt-3 max-w-2xl mx-auto">
                Complete el formulario para agendar la recolección de residuos de manera rápida y sencilla.
            </p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
            <h2 class="text-xl font-bold text-green-900 mb-6">Programación de Recolección</h2>

            <form method="POST" action="{{ route('appointment.store') }}" class="space-y-6" x-data="{}">
                @csrf
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre"
                            class="border @error('nombre') border-red-500 @enderror  p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full"
                            placeholder="Ej: Juan" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellido</label>
                        <input type="text" name="apellido"
                            class="border @error('apellido') border-red-500 @enderror  p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full"
                            placeholder="Ej: Pérez" value="{{ old('apellido') }}" required>
                        @error('apellido')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ciudad</label>
                        <input type="text" name="ciudad"
                            class="border @error('ciudad') border-red-500 @enderror  p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full"
                            placeholder="Ej: Bogotá" value="{{ old('ciudad') }}" required>
                        @error('ciudad')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Zona</label>
                        <input type="text" name="zona"
                            class="border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full"
                            placeholder="Ej: Norte" value="{{ old('zona') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Código Postal</label>
                        <input type="text" name="codigo"
                            class="border  border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full"
                            placeholder="Ej: 110111" value="{{ old('codigo') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Celular</label>
                        <input type="number" name="celular"
                            class="border @error('celular') border-red-500 @enderror  p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full"
                            placeholder="Ej: 3001234567" value="{{ old('celular') }}" required>
                        @error('celular')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1"> Dirección de Recolección</label>
                        <input type="text" name="direccion"
                            class="border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full"
                            placeholder="Ej: Calle 12 # 34 - 56">
                    </div>
                    <!-- Peso -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Peso</label>
                        <div class="flex">
                            <input type="number" name="peso" placeholder="Ej: 1"
                                class="border border-gray-300 p-3 rounded-l-lg focus:ring-2 focus:ring-green-400 w-full">
                            <select name="unidad_peso"
                                class="border border-gray-300 p-3 rounded-r-lg focus:ring-2 focus:ring-green-400 bg-white">
                                <option value="kg">kg</option>
                                <option value="g">g</option>
                                <option value="lb">lb</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Tamaño Aproximado:
                        </label>
                        <div class="flex">
                            <input type="number" name="tamano" placeholder="Ej: 100"
                                class="border border-gray-300 p-3 rounded-l-lg focus:ring-2 focus:ring-green-400 w-full">
                            <select name="unidad_tamano"
                                class="border border-gray-300 p-3 rounded-r-lg focus:ring-2 focus:ring-green-400 bg-white">
                                <option value="cm2">cm²</option>
                                <option value="m2">m²</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Recolección</label>
                    <select name="tipo_residuo"
                        class="border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-green-400 w-full">
                        <option value="">Seleccione tipo de residuo</option>
                        <option>Residuos organicos</option>
                        <option>Residuos Inorganicos</option>
                        <option>Residuos Peligrosos</option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition">
                    Solicitar Recolección
                </button>
            </form>
        </div>


        <div class=" bg-white p-8 rounded-xl shadow-md border border-gray-100">
            <div>
                <h2 class="text-xl font-bold text-green-900 mb-6">Programación de Recolección</h2>
                <p class="text text-green-900 mb-6">Seleccione la fecha y el rango horario para la recolección:</p>
            </div>
            @include('components.calendar')
        </div>

    </div>
    <footer class=" bottom-0 w-full bg-green-900 text-white p-6 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} ReMat. Todos los derechos reservados.</p>
        </div>
    </footer>

    @if (session('alert'))
        <script>
            alert("{{ session('alert') }}");
        </script>
    @endif

</body>

</html>
