@extends('layouts.form')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Crear Producto</h2>
    <form method="POST" action="{{ route('producto.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Registro de Producto</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del producto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off" onkeydown="return soloLetras(event)">
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoría:</label>
                            <select name="categoria_id" id="categoria_id" class="form-select" required>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="precio_por_dia" class="form-label">Precio por día:</label>
                            <input type="number" class="form-control" id="precio_por_dia" name="precio_por_dia" step="0.01" required onkeydown="return soloNumeros(event)">
                        </div>
                        <div class="mb-3">
                            <label for="certificado_confiabilidad" class="form-label">Certificado de confiabilidad:</label>
                            <input type="file" class="form-control" id="certificado_confiabilidad" name="certificado_confiabilidad" accept=".pdf,.doc,.docx">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('producto.index') }}" style="background-color: #053b9e;" class="btn btn-secondary">Regresar</a>
                            <button type="submit"  style="background-color: #002366;" class="btn btn-primary">Registrar Producto</button>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection
