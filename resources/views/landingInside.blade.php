<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="{{ asset('js/preguntas.js') }}"></script>

</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    @extends('layouts.app')

    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
            </a>
            <div class="hidden md:flex  space-x-6 text-sm font-medium">
                {{-- <a href="{{ route('landing') }}" class="text-gray-600 hover:text-green-700 transition">Inicio</a> --}}
                <a href="{{ route('agendamiento') }}"  class="text-gray-600 hover:text-green-700 transition">Programación</a>
                <a href="{{ route('reporte.usuario', ['id' => 1]) }}" class="text-gray-600 hover:text-green-700 transition">Reporte</a>
                <a href="{{ route('puntos') }}" class="text-gray-600 hover:text-green-700 transition">Puntos</a>
                {{-- <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-700 transition">Inicio de
                    sesión</a>
                <a href="{{ route('registro') }}" class="text-gray-600 hover:text-green-700 transition">Registrar</a> --}}

            </div>
        </div>
    </nav>


    @section('content')
        @include('components.home.banner')
        @include('components.home.porqueReciclar')
        @include('components.home.pasos')
        <x-accordion :single="true">
            <x-accordion.item title="¿Qué tipo de residuos puedo entregar a través del servicio?">
                <p>Reciclables limpios: papel, cartón, botellas plásticas, envases de vidrio, latas de aluminio.
                    <br>
                    Residuos electrónicos: computadores, celulares, cables, electrodomésticos pequeños (si el programa lo
                    cubre).
                    <br>

                    Residuos peligrosos domésticos: pilas, bombillos, aceites usados, medicamentos vencidos (solo en puntos
                    habilitados).
                    <br>

                    Residuos voluminosos: muebles, colchones, maderas (según programación).
                </p>
            </x-accordion.item>

            <x-accordion.item title="¿Cómo funciona el sistema de puntos y recompensas?">
                <p>Por cada recolección realizada correctamente, acumulas puntos según el tipo y peso del residuo entregado.
                    Estos puntos pueden canjearse por descuentos en tiendas aliadas. ¡Reciclar también es recompensado!</p>
            </x-accordion.item>

            <x-accordion.item title="¿Con qué frecuencia se realiza la recolección?">
                <p>Residuos domiciliarios comunes → suele ser 2 a 3 veces por semana.
                    <br>

                    Reciclaje (papel, cartón, plástico, vidrio) → puede ser una vez por semana o quincenal.
                    <br>

                    Residuos especiales (electrónicos, voluminosos, peligrosos) → generalmente requieren programar una cita
                    específica.
                </p>
            </x-accordion.item>

            <x-accordion.item title="¿Tiene algún costo registrarse o usar el servicio?">
                <p>No. El registro y el uso regular del servicio son completamente gratuitos. Solo podrían generarse cobros
                    si solicitas recolecciones especiales, fuera de la programación habitual o de residuos que requieran
                    manejo especial.</p>
            </x-accordion.item>
        </x-accordion>
        @include('components.home.final')
    @endsection

    <footer class=" fixed bottom-0 w-full bg-green-900 text-white p-6 mt-12 z-50">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} ReMat. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>

</html>
