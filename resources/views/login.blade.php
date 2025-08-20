<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Landing Page Avanzada</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        padding: 2rem;
    }

    .login-content-block {
        display: flex;
        max-width: 900px;
        width: 100%;
        background-color: var(--color-white);
        border-radius: 1.5rem;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .image-panel {
        width: 50%;
        flex-shrink: 0;
    }

    .image-panel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .form-panel {
        width: 55%;
        padding: 2.5rem 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-card {
        width: 100%;
        text-align: center;
    }

    .login-card h1 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .login-card p {
        color: var(--color-text-light);
        margin-bottom: 2rem;
        font-size: 0.9rem;
    }

    .tabs {
        display: flex;
        background-color: #E8F797;
        border-radius: 0.75rem;
        margin-bottom: 2rem;
        padding: 5px;
    }

    .tabs a {
        flex: 1;
        padding: 0.75rem 1rem;
        text-decoration: none;
        color: var(--color-text-light);
        font-weight: 500;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .tabs a.active {
        background-color: #D3EA54;
        color: var(--color-text-dark);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .login-form {
        text-align: left;
    }

    .input-group {
        margin-bottom: 1.25rem;
    }

    .input-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper svg {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1.25rem;
        height: 1.25rem;
        color: var(--color-text-light);
        pointer-events: none;
    }

    .input-field {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 3rem;
        border: 1px solid var(--color-border);
        border-radius: 0.5rem;
        font-size: 1rem;
        font-family: var(--font-family-main);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .input-field:focus {
        outline: none;
        border-color: var(--color-primary-blue);
        box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.2);
    }

    .forgot-password {
        display: block;
        text-align: right;
        margin-top: -0.75rem;
        margin-bottom: 1.5rem;
        font-size: 0.85rem;
        color: var(--color-primary-blue);
        text-decoration: none;
        font-weight: 500;
    }

    .submit-button {
        width: 100%;
        padding: 0.9rem;
        border: none;
        border-radius: 0.75rem;
        background-color: var(--color-primary-blue);
        color: var(--color-white);
        font-size: 1rem;
        font-weight: 600;
        font-family: var(--font-family-main);
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        display: flex;
        justify-content: center;
    }

    .submit-button:hover {
        background-color: #029ab5;
        transform: translateY(-2px);
    }

    .error-message {
        background-color: #fee2e2;
        color: #b91c1c;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #fca5a5;
        font-size: 0.9rem;
        text-align: center;
    }

    @media (max-width: 768px) {
        header {
            padding: 0.75rem 1rem;
        }

        .header-container nav {
            display: none;
        }

        main {
            align-items: flex-start;
            padding: 1rem;
        }

        .login-content-block {
            flex-direction: column;
        }

        .image-panel,
        .form-panel {
            width: 100%;
        }

        .image-panel {
            max-height: 200px;
        }

        .form-panel {
            padding: 2rem;
        }
    }
</style>

<body class="bg-gray-100 text-gray-800 font-sans">

    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
            </a>
            <div class="hidden md:flex  space-x-6 text-sm font-medium">
                <a href="{{ route('landing') }}" class="text-gray-600 hover:text-green-700 transition">Inicio</a>
            </div>
        </div>
    </nav>



    <main>
        <div class="login-content-block">
            <div class="image-panel">
                <img src="{{ asset('images/login.jpg') }}" alt="Personas reciclando de forma sostenible">
            </div>

            <div class="form-panel">
                <div class="login-card">
                    <h1>👋 ¡Bienvenido!</h1>
                    <p>Accede a tu cuenta para gestionar tus residuos.</p>

                    <nav class="tabs">
                        <a href="ingreso.html" class="active">Iniciar sesión</a>
                        <a href="{{ route('registro') }}">Registrarse</a>
                    </nav>

                    <!-- Mostrar error -->

                    <form class="login-form" action="login_process.php" method="POST">
                        <div class="input-group">
                            <label for="email">Correo Electrónico</label>
                            <div class="input-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                    <path
                                        d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                </svg>
                                <input type="email" id="email" name="email" class="input-field"
                                    placeholder="tu@gmail.com" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="password">Contraseña</label>
                            <div class="input-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <input type="password" id="password" name="password" class="input-field"
                                    placeholder="··········" required>
                            </div>
                        </div>

                        <a href="#" class="forgot-password">Olvidaste tu contraseña</a>
                        <a href="{{ route('landingInside') }}" class="submit-button">Iniciar sesión
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="  bottom-0 w-full bg-green-900 text-white p-6 mt-12 z-50">
        <div class="container mx-auto text-center">
            <p class="text-sm">&copy; {{ date('Y') }} ReMat. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>

</html>
