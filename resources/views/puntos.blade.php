<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canjea Puntos</title>
    <!-- Carga de Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales del cuerpo y fuente */
        iframe {
        width: 100%;
        height: 400px;
        border: 0;
        }
        .header-bg {
            background-color: #d1fae5; /* Verde muy claro para el encabezado, similar al JPG */
        }
        /* Color de fondo para las secciones de contenido */
        .section-bg {
            background-color: #ffffff; /* Blanco para las secciones de contenido */
        }
        /* Estilo para el botón principal */
        .button-primary {
            background-color: #10B981; /* Verde brillante para botones, similar al JPG */
        }
        /* Borde para los campos de entrada (inputs) */
        .input-border {
            border-color: #e5e7eb; /* Borde gris claro para inputs */
        }
        /* Sombra personalizada para elementos */
        .shadow-custom {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        /* Contenedor del mapa para mantener el ratio de aspecto */
        .map-container {
            position: relative;
            padding-bottom: 75%; /* 4:3 Aspect Ratio para el mapa */
            height: 0;
            overflow: hidden;
            border-radius: 0.75rem; /* Bordes redondeados */
        }
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        /* Estilos personalizados para la barra de desplazamiento (scrollbar) para una mejor estética */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center">
    <!-- Contenedor principal para centrar y limitar el ancho del contenido -->
    <div class="w-full mx-auto">

        <!-- Encabezado / Barra de Navegación (Nav) -->
        <header>
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
        </header>

        <!-- Contenido principal dividido en dos columnas para pantallas grandes -->
        <main class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 py-6 px-4">

            <!-- Columna Izquierda: Perfil de Usuario y Tiendas Aliadas -->
            <section class="flex flex-col gap-6">
                <!-- Cuadro de perfil de usuario (similar al "Pepito Perez" del JPG adjunto) -->
                <div class="section-bg p-4 sm:p-6 rounded-xl shadow-custom">
                    <div class="flex items-center mb-4">
                        <!-- Imagen de perfil placeholder -->
                        <img src="https://placehold.co/60x60/d1fae5/10B981?text=PP" alt="Foto de perfil" class="w-16 h-16 rounded-full mr-4 border-2 border-green-400">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Pepito Pérez</h2>
                            <p class="text-gray-600 text-sm">Puntos: <span class="font-bold text-green-700">1500</span></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
                        <div>
                            <p><span class="font-medium">Identificación:</span> 123456789</p>
                            <p><span class="font-medium">Dirección:</span> Calle 123 #45-67</p>
                            <p><span class="font-medium">Teléfono:</span> (601) 987 6543</p>
                        </div>
                        <div>
                            <p><span class="font-medium">Ciudad:</span> Bogotá</p>
                            <p><span class="font-medium">Email:</span> pepito.perez@example.com</p>
                            <p><span class="font-medium">Último canje:</span> 10/08/2025</p>
                        </div>
                    </div>
                </div>

                <!-- Lista de Tiendas Asociadas con desplegable (select) -->
                <div class=" max-h-screen  section-bg p-4 sm:p-6 rounded-xl shadow-custom  ">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Tiendas Asociadas</h2>
                    <!-- Desplegable para seleccionar tiendas -->
                    <label for="storeSelect" class="block text-sm font-medium text-gray-700 mb-2">Selecciona una tienda:</label>
                    <select id="storeSelect" class="w-full p-3 mb-4 border input-border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Todas las tiendas</option>
                        <option value="esperanza">Tienda La Esperanza</option>
                        <option value="futuro">Reciclaje Futuro</option>
                        <option value="ecopuntos">EcoPuntos Bogotá</option>
                        <option value="sostenible">Verde Sostenible</option>
                        <option value="limpio">Punto Limpio Central</option>
                    </select>

                    <!-- Lista detallada de tiendas (puede ocultarse/filtrarse con JS al usar el desplegable) -->
                    <div class="space-y-4 max-h-screen overflow-y-auto">
                        <!-- Tienda 1: Datos ficticios -->
                        <div class="border-b pb-3 last:border-b-0">
                            <h3 class="font-medium text-gray-900">Tienda La Esperanza</h3>
                            <p class="text-sm text-gray-600">Dirección: Carrera 15 # 80-20, Bogotá</p>
                            <p class="text-sm text-gray-600">Teléfono: (601) 123 4567</p>
                            <a href="#" class="text-sm text-green-600 hover:underline">Ver en el mapa</a>
                        </div>
                        <!-- Tienda 2: Datos ficticios -->
                        <div class="border-b pb-3 last:border-b-0">
                            <h3 class="font-medium text-gray-900">Reciclaje Futuro</h3>
                            <p class="text-sm text-gray-600">Dirección: Calle 72 # 11-45, Bogotá</p>
                            <p class="text-sm text-gray-600">Teléfono: (601) 234 5678</p>
                            <a href="#" class="text-sm text-green-600 hover:underline">Ver en el mapa</a>
                        </div>
                        <!-- Tienda 3: Datos ficticios -->
                        <div class="border-b pb-3 last:border-b-0">
                            <h3 class="font-medium text-gray-900">EcoPuntos Bogotá</h3>
                            <p class="text-sm text-gray-600">Dirección: Avenida Suba # 100-50, Bogotá</p>
                            <p class="text-sm text-gray-600">Teléfono: (601) 345 6789</p>
                            <a href="#" class="text-sm text-green-600 hover:underline">Ver en el mapa</a>
                        </div>
                        <!-- Tienda 4: Datos ficticios -->
                        <div class="border-b pb-3 last:border-b-0">
                            <h3 class="font-medium text-gray-900">Verde Sostenible</h3>
                            <p class="text-sm text-gray-600">Dirección: Calle 26 # 68-90, Bogotá</p>
                            <p class="text-sm text-gray-600">Teléfono: (601) 456 7890</p>
                            <a href="#" class="text-sm text-green-600 hover:underline">Ver en el mapa</a>
                        </div>
                        <!-- Tienda 5: Datos ficticios -->
                        <div class="border-b pb-3 last:border-b-0">
                            <h3 class="font-medium text-gray-900">Punto Limpio Central</h3>
                            <p class="text-sm text-gray-600">Dirección: Carrera 7 # 15-30, Bogotá</p>
                            <p class="text-sm text-gray-600">Teléfono: (601) 567 8901</p>
                            <a href="#" class="text-sm text-green-600 hover:underline">Ver en el mapa</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Columna Derecha: Mapa y Formulario de Canje -->
            <section class="flex flex-col gap-6">
                <!-- Mapa de Georeferenciación de Bogotá -->
                <div class="section-bg p-4 sm:p-6 rounded-xl shadow-custom">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Ubicación de Tiendas en Bogotá</h2>
                    <div class="map-container">
                        <!-- Google Maps Embed API con marcadores de ejemplo.
                             ¡IMPORTANTE! Reemplaza 'TU_API_KEY_AQUI' con tu clave de API de Google Maps. -->
                         <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.9497482!2d-74.08175!3d4.60971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99c3f0%3A0x123456789abcdef!2sBogotá%2C%20Colombia!5e0!3m2!1ses!2sco!4v169341235"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Los marcadores A, B, C, D, E corresponden a las tiendas asociadas.</p>
                </div>

                <!-- Cuadro para canjear puntos con campo de código y botón de envío -->
                <div class="section-bg p-4 sm:p-6 rounded-xl shadow-custom">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Canjear Puntos</h2>
                    <p class="text-gray-600 mb-4">Introduce el código que te dio la tienda para canjear tus puntos:</p>
                    <input
                        type="text"
                        id="redemptionCode"
                        placeholder="Ingresa el código aquí"
                        class="w-full p-3 mb-4 border input-border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    />
                    <button
                        onclick="sendRedemptionCode()"
                        class="w-full py-3 px-4 rounded-md text-white font-semibold transition duration-300 button-primary hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                    >
                        Enviar Código
                    </button>
                    <!-- Área para mostrar mensajes al usuario (éxito, error, etc.) -->
                    <div id="messageBox" class="mt-4 p-3 bg-blue-100 text-blue-700 rounded-md hidden"></div>
                </div>
            </section>
        </main>
        @include('partials.footer')
    </div>

    <script>
        function sendRedemptionCode() {
            const codeInput = document.getElementById('redemptionCode');
            const messageBox = document.getElementById('messageBox');
            const code = codeInput.value.trim(); // Obtiene el valor del input y elimina espacios en blanco

            if (code) {
                // Prepara y muestra un mensaje de "Procesando..."
                messageBox.classList.remove('hidden', 'bg-red-100', 'text-red-700', 'bg-green-100', 'text-green-700');
                messageBox.classList.add('bg-blue-100', 'text-blue-700');
                messageBox.textContent = `Código "${code}" enviado. Procesando canje...`;
                codeInput.value = ''; // Limpia el campo de entrada después de enviar

                // Simula una operación asíncrona (como una llamada a un servidor) con un retardo
                setTimeout(() => {
                    // Simula un resultado aleatorio (éxito o fallo)
                    const isSuccess = Math.random() > 0.5; // 50% de probabilidad de éxito
                    if (isSuccess) {
                        // Muestra mensaje de éxito
                        messageBox.classList.remove('bg-blue-100', 'text-blue-700');
                        messageBox.classList.add('bg-green-100', 'text-green-700');
                        messageBox.textContent = '¡Canje exitoso! Tus puntos han sido actualizados.';
                    } else {
                        // Muestra mensaje de error
                        messageBox.classList.remove('bg-blue-100', 'text-blue-700');
                        messageBox.classList.add('bg-red-100', 'text-red-700');
                        messageBox.textContent = 'Error al canjear el código. Por favor, inténtalo de nuevo o verifica el código.';
                    }
                    hideMessageDelayed(); // Oculta el mensaje después de un tiempo
                }, 2000); // Muestra el resultado después de 2 segundos
            } else {
                // Muestra un mensaje si el campo de código está vacío
                messageBox.classList.remove('hidden', 'bg-blue-100', 'text-blue-700', 'bg-green-100', 'text-green-700');
                messageBox.classList.add('bg-red-100', 'text-red-700');
                messageBox.textContent = 'Por favor, introduce un código para canjear.';
                hideMessageDelayed(); // Oculta el mensaje de error después de un tiempo
            }
            messageBox.classList.remove('hidden'); // Asegura que la caja de mensaje esté visible
        }

        /**
         * Oculta el cuadro de mensajes después de un período de tiempo.
         * Útil para mensajes temporales de éxito/error.
         */
        function hideMessageDelayed() {
            const messageBox = document.getElementById('messageBox');
            if (!messageBox.classList.contains('hidden')) {
                setTimeout(() => {
                    messageBox.classList.add('hidden');
                }, 5000); // Ocultar después de 5 segundos
            }
        }
    </script>
</body>
</html>
