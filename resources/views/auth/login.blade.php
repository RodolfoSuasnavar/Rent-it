<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Rent-It</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="img/rent-it.ico" type="image/x-icon">
</head>
<body>
    <section class="vh-100" style="background-color: #ededed;">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-12 col-lg-10 col-xl-9">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 d-flex align-items-center justify-content-center position-relative">
                                <img src="img/rentit.png" alt="Rent-It" class="img-fluid h-100 w-100">
                                <h1 class="position-absolute text-white text-center rent-it-text">Rent-It</h1>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="card-body p-4 text-center">
                                    <h3 class="fw-bold mb-4 text-start">Iniciar Sesión</h3>
                                    <form method="POST" action="">
                                        @csrf
                                        <div class="form-outline mb-4 text-start">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Introduce tu Correo" autofocus autocomplete="off" required />
                                        </div>
                                        <div class="form-outline mb-4 text-start">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Introduce tu Contraseña" autocomplete="off" required/>
                                        </div>
                                        <div class="form-outline mb-4 text-start">
                                            <label for="remember">
                                                <input id="remember" type="checkbox" name="remember">
                                                <span class="">Recuerdame</span>
                                            </label>
                                        </div>
                                        @error('message')
                                        <p class="alert alert-danger" role="alert"> {{ $message }}</p>
                                        @enderror
                                        <p><a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a></p>

                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Acceder</button>
                                        <br><br>
                                        <p>No tienes una cuenta? <a href="{{ route('register.index') }}"> Registrate aquí</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
