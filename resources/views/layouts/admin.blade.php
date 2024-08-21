<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rent-It</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
  <link href="template/css/styles.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/pestañas.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="shortcut icon" href="img/rent-it.ico" type="image/x-icon">

  {{-- <link rel="stylesheet" href="css/bootstrap.min.css"> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .info-box {
        background-color: #f8f9fa;
        font-family: Arial, sans-serif;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

</style>
{{-- <style>

    .bg-navy {
        background-color: #001f3f !important;
    }
    .navbar-dark .navbar-nav .nav-link {
        color: white !important;
        opacity: 1;
    }
    .navbar-dark .navbar-brand {
        color: white !important;
        opacity: 1;
    }
    .navbar-dark .dropdown-menu {
        background-color: #001f3f;
        color: white;
    }

    .navbar-dark .dropdown-item {
        color: white !important;
    }

    .navbar-dark .dropdown-item:hover, .navbar-dark .dropdown-item:focus {
        background-color: #001f3f;
        color: white !important;
    }
  </style> --}}
<body >
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">Rent-it</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto d-flex align-items-center">
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('producto.index') }}">Mis Productos</a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="#">Rentar</a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('contacto.crear') }}">Contacto</a> --}}
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            {{-- <li><a class="dropdown-item" href="">Perfil</a></li> --}}
                            <li><a class="dropdown-item" href="{{ route('login.destroy') }}">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@yield('content')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>
