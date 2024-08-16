@extends('layouts.form')
@section('content')
<h1>Crear Producto</h1>
<form method="POST" action="{{ route('producto.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Registro de Productos</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del producto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="off" onkeydown="return soloLetras(event)">
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoria:</label>
                            <select name="categoria_id" id="categoria_id" class="form-control">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required autocomplete="off" ></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="precio_por_dia" class="form-label">Precio por día:</label>
                            <input type="number" class="form-control" id="precio_por_dia" name="precio_por_dia" step="0.01" required autocomplete="off" onkeydown="return soloNumeros(event)">
                        </div>
                        <div class="mb-3">
                            <label for="certificado_confiabilidad" class="form-label">Certificado de confiabilidad:</label>
                            <input type="file" class="form-control" id="certificado_confiabilidad" name="certificado_confiabilidad" accept=".pdf,.doc,.docx" required>
                        </div>
                        <button type="submit" style="background-color: #002366;" class="btn btn-primary mb-3" class="btn btn-primary btn-block">Registrar Producto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function soloLetras(event) {
    var key = event.key;
    var isLetter = /^[A-Za-z]$/;
    var isControlKey = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(event.key);

    // Permite las teclas de control
    if (isControlKey || key.length > 1) {
        return true;
    }

    // Bloquea la entrada si no es una letra
    if (!isLetter.test(key)) {
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
