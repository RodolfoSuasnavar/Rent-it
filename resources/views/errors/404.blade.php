<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada - 404</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/rent-it.ico') }}" type="image/x-icon">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('https://source.unsplash.com/random/1920x1080') no-repeat center center fixed;
            background-size: cover;
        }
        .error-content {
            background: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .fade-in-out {
            animation: fadeInOut 3s ease-in-out infinite; /* Aplicar animación de desvanecimiento en bucle */
        }
        @keyframes fadeInOut {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
        .error-content h1 {
            font-size: 10rem;
            margin-bottom: 1rem;
            color: #dc3545;
        }
        .error-content h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #343a40;
        }
        .error-content p {
            font-size: 1rem;
            margin-bottom: 2rem;
            color: #6c757d;
        }
        .error-content a {
            font-size: 1.25rem;
            text-decoration: none;
            color: #ffffff;
            background-color: #007bff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
        }
        .error-content a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <h1 class="display-1 fade-in-out">404</h1>
            <h2 class="display-4">Página no encontrada</h2>
            <p class="lead">Lo sentimos, no podemos encontrar la página que estás buscando. Verifica la URL o regresa al inicio.</p>
            <a id="redirect-button" href="#" class="btn btn-primary">Volver al inicio</a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Obtener el rol del usuario desde la variable de Blade
            const userRole = @json($userRole); // Pasar el rol desde el controlador

            const redirectButton = document.getElementById('redirect-button');

            // Redirigir según el rol del usuario
            if (userRole === 'admin') {
                redirectButton.href = '{{ route('admin.index') }}'; // Redirige a la vista de administración
            } else {
                redirectButton.href = '{{route('welcome')}}'; // Redirige al inicio para usuarios normales
            }
        });
    </script>
</body>
</html>
