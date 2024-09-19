<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Rent-It</title>
    <link rel="stylesheet" href="{{asset('css/registro.css')}}">
    <link rel="shortcut icon" href="{{asset('img/rent-it.ico')}}" type="image/x-icon">
</head>
<style>

</style>
<body style="background-color: #ededed;">


    <div class="container">
    <br><br><br><br><br><br><br>

        <h2>Regístrate en Rent-It</h2>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Coloca tu Nombre" autofocus autocomplete="off" required value="{{ old('nombre') }}" onkeydown="return soloLetras(event)">
                @if ($errors->has('nombre'))
                    <span class="text-danger">{{ $errors->first('nombre') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="aPaterno">Apellido Paterno</label>
                <input type="text" id="aPaterno" name="aPaterno" placeholder="Coloca tu Apellido Paterno" required autocomplete="off" value="{{ old('aPaterno') }}" onkeydown="return soloLetras(event)">
                @if ($errors->has('aPaterno'))
                    <span class="text-danger">{{ $errors->first('aPaterno') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="aMaterno">Apellido Materno</label>
                <input type="text" id="aMaterno" name="aMaterno" placeholder="Coloca tu Apellido Materno" required autocomplete="off" value="{{ old('aMaterno') }}" onkeydown="return soloLetras(event)">
                @if ($errors->has('aMaterno'))
                    <span class="text-danger">{{ $errors->first('aMaterno') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Coloca tu Correo Electrónico" required autocomplete="off" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" placeholder="Coloca tu Dirección" required autocomplete="off" value="{{ old('direccion') }}">
                @if ($errors->has('direccion'))
                    <span class="text-danger">{{ $errors->first('direccion') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="telefono">Número de Teléfono</label>
                <input type="text" id="telefono" name="telefono" placeholder="Coloca tu Número de Teléfono" required autocomplete="off" value="{{ old('telefono') }}" onkeydown="return soloNumeros(event)">
                @if ($errors->has('telefono'))
                    <span class="text-danger">{{ $errors->first('telefono') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Coloca tu Contraseña" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirma tu Contraseña" required>
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <div class="form-outline mb-4 text-start">
                <label for="terminos">
                    <input id="terminos" type="checkbox" name="terminos" required {{ old('terminos') ? 'checked' : '' }}>
                    <span class="">Acepto los <a href="{{asset('docs/términos y condiciones_RENTIT.pdf')}}" target="_blank">Términos y Condiciones</a></span>
                </label>

                @if ($errors->has('terminos'))
                    <span class="text-danger">{{ $errors->first('terminos') }}</span>
                @endif
            </div>

<br>
            <div class="form-group">
                <button type="submit" class="btn-primary">Registrarse</button>
            </div>

            <p>¿Ya tienes una cuenta? <a href="{{ route('login.index') }}">Inicia sesión aquí</a></p>
        </form>
    </div>
</body>
<script>
function soloLetras(event) {
    var key = event.key;
    var isLetterOrSpace = /^[A-Za-z\s]$/; // Permite letras y espacios
    var isControlKey = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(event.key);

    // Permite las teclas de control
    if (isControlKey || key.length > 1) {
        return true;
    }

    // Bloquea la entrada si no es una letra o un espacio
    if (!isLetterOrSpace.test(key)) {
        event.preventDefault();
        return false;
    }
    return true;
}
function soloNumeros(event) {
        var key = event.key;
        var isNumber = /^[0-9]$/;

        // Permite las teclas de control (como backspace, delete, tab, etc.)
        if (event.key.length > 1) {
            return true;
        }

        if (!isNumber.test(key)) {
            event.preventDefault(); // Evita que se ingrese un carácter no permitido
            return false;
        }
        return true;
    }
</script>
</html>
