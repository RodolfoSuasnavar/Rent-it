@extends('layouts.admin-form')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Editar Categoría</h1>

    <!-- Mensaje de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para editar una categoría -->
    <form action="{{ route('categoria.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre de la categoría" autocomplete="off" autofocus onkeydown="return soloLetras(event)" value="{{ old('nombre', $categoria->nombre) }}" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.index') }}" style="background-color: #053b9e;" class="btn btn-secondary">Regresar</a>
            <button type="submit"  style="background-color: #002366;" class="btn btn-primary">Actualizar Categoría</button>
        </div>
    </form>
</div>
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

</script>
@endsection
