@extends('layouts.form')
@section('content')
<div class="container">
    <h1>Deja tu comentario</h1>
    <form action="{{ route('contacto.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Nombre:</label>
            <input type="text" id="user_id" name="user_id" value="{{ $user->nombre }}" readonly>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>
        </div>
        <div class="form-group">
            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario"
            placeholder="Colocar mensage" required autocomplete="off" onkeydown="return soloLetras(event)"></textarea>
        </div>
        <button type="submit">Enviar comentario</button>
    </form>
</div>


<script>
function soloLetras(event) {
    var key = event.key;
    var isLetterSpaceOrComma = /^[A-Za-z\s,]$/; // Permite letras, espacios y comas
    var isControlKey = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(event.key);

    // Permite las teclas de control
    if (isControlKey || key.length > 1) {
        return true;
    }

    // Bloquea la entrada si no es una letra, un espacio o una coma
    if (!isLetterSpaceOrComma.test(key)) {
        event.preventDefault();
        return false;
    }
    return true;
}
</script>
@endsection

