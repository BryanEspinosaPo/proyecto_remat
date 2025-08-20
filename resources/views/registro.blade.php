<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Landing Page Avanzada</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    .contenedor {
        display: flex;
        min-height: calc(100vh - 60px);
    }

    .contenedor {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 60px);
        padding: 0 15%;
    }

    .columna-izquierda {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .columna-izquierda img {
        width: 90%;
        height: auto;
    }

    .columna-derecha {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .formulario {
        max-width: 400px;
        width: 100%;
    }

    .formulario h1 {
        font-size: 32px;
        font-weight: 700
    }

    .formulario h2 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .formulario p {
        color: #666;
        margin-bottom: 20px;
    }

    .formulario input,
    .formulario button {
        width: 100%;
        padding: 12px;
        margin: 18px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .formulario button {
        background: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    .formulario button:hover {
        background: #45a049;
    }



    .botones {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        /* Espacio entre botones */
    }

    .botones a {
        width: 100%;
        padding: 12px;
        margin: 18px 0;
        border-radius: 6px;
        border: 1px solid #ccc;
        text-align: center
    }

    .botones button {
        flex: 1;
        /* Cada botón ocupa el mismo espacio */
        padding: 12px;
        border-radius: 6px;
        border: none;
        font-weight: bold;
        cursor: pointer;
    }

    .botones button:first-child {
        background: #4CAF50;
        color: white;
    }

    .botones button:first-child:hover {
        background: #45a049;
    }

    .btn-cancelar {
        background: white;
        border: 1px solid #333;
        color: #333;
    }
</style>

<body class="bg-gray-100 text-gray-800 font-sans">



    <!-- Contenido -->
    <div class="contenedor">
        <!-- Columna izquierda con la imagen -->
        <div class="columna-izquierda">
            <img src="{{ asset('images/imgRegistro.jpg') }}" alt="Imagen Registro">
        </div>


        <!-- Columna derecha con formulario -->
        <div class="columna-derecha">
            <div class="formulario">

                <h1>Formulario de Registro</h1>
                <h2>Completa el siguiente formulario para crear tu cuenta.</h2>
                <form action="registro.php" method="POST">


                    <label for="tipo_doc">Tipo de documento:</label>
                    <select id="tipo_doc" name="tipo_doc" required>
                        <option value="cedula"> </option>
                        <option value="cedula">Cédula</option>
                        <option value="nit">NIT</option>
                    </select><br>

                    <input type="text" id="num_doc" name="num_doc" placeholder="Número de Documento:" required>

                    <input type="text" id="nombre" name="nombre" placeholder="Nombre Completo" required>

                    <input type="text" id="zona" name="zona" placeholder="Zona" required>

                    <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required>

                    <input type="text" id="direccion" name="direccion" placeholder="Dirección" required>

                    <input type="text" id="celular" name="celular" placeholder="Celular" required>

                    <input type="email" id="email" name="email" placeholder="Email" required>

                    <input type="password" id="password" name="password" placeholder="Password" required>

                    <label for="rol">Elige tu rol:</label>
                    <select id="rol" name="rol" required>
                        <option value="rol"> </option>
                        <option value="1">cliente</option>
                        <option value="2">recolector</option>
                        <option value="3">empleado</option>
                        <option value="4">administrador</option>
                    </select><br>
                    <div class="botones">
                        <a href="{{ route('login') }}">
                            Guardar
                        </a>
                        <input type="reset">
                    </div>
            </div>
            </form>


        </div>
    </div>





    <footer class="  bottom-0 w-full bg-green-900 text-white p-6 mt-12 z-50">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} ReMat. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>
