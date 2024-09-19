<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Rent-it - Servicios de Alquiler Profesional" />
    <meta name="author" content="" />
    <title>Rent-it</title>
    {{-- <link rel="icon" type="image/x-icon" href="template/assets/favicon.ico" /> --}}
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="{{asset('template/css/styles.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/pestañas.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/contenedor.css')}}">
    <link rel="shortcut icon" href="{{asset('img/rent-it.ico')}}" type="image/x-icon">

    {{-- <link rel="stylesheet" href="css/footer.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMyRB+8F1gfOHhP/6mK7E4p1owmRtF3k0E5b4Zw" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body id="page-top">
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">Rent-it</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                        <!-- Mostrar solo si el usuario está autenticado -->
                        <li class="nav-item me-2">
                            <form class="d-flex" method="GET" action="{{ route('welcome') }}">
                                <select class="form-select" aria-label="Categoría" name="categoria" onchange="this.form.submit()">
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('producto.index') }}">Mis Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('renta.misRentados') }}">Rentar</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacto.crear') }}">Contacto</a>
                    </li>
                    @endauth

                </ul>
                <ul class="navbar-nav">
                    @guest
                        <!-- Mostrar solo si el usuario no está autenticado -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login.index') }}">Iniciar Sesión</a>
                        </li>
                    @else

                        <!-- Mostrar solo si el usuario está autenticado -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                {{-- <li><a class="dropdown-item" href="">Perfil</a></li> --}}
                                <li><a class="dropdown-item" href="{{ route('login.destroy') }}">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <header class="custom-header text-center py-5" style="background-image: url('{{ asset('img/header.jpg') }}');">
        <div class="header-content">
            <h1 class="display-4">Bienvenido a Rent-it</h1>
            <p class="lead">Encuentra todos los productos que puedes rentar.</p>
        </div>
    </header>




    <!-- Sección de Productos -->
    <section class="page-section" id="portfolio">
        <div class="container">
            <h2 class="text-center text-secondary mb-4">Nuestros Productos</h2>
            <div class="row">
                @yield('content')
            </div>
        </div>
    </section>



    <!-- Pie de Página -->
    <footer class="footer text-center py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Redes sociales -->
            <div>
                <a href="https://facebook.com" class="me-3" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com" class="me-3" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>

            <!-- Información de la empresa -->
            <div class="text-end">
                <p class="mb-0">Empresa: Code Master</p>
                <p class="mb-0">Correo: codemastermx98@gmail.com</p>
                <p class="mb-0">Teléfono: 9191523317</p>
                <p class="mb-0">
                    <a href="{{ asset('docs/Política de privacidad_RENTIT.pdf') }}" style="text-decoration: none; color: inherit;">Políticas de Privacidad</a>
                </p>

            <p class="mb-0">&copy; Code Master</p>

            </div>
        </div>

    </footer>


    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
