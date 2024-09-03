@extends('layouts.form')
@section('content')
<h2 class="text-center mt-4">Editar Producto</h2>
<form method="POST" action="{{ route('producto.update', $producto->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center mt-4">Actualización del Productos</h2>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del producto:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                            required autocomplete="off" onkeydown="return soloLetras(event)"
                            value="{{ $producto->nombre }}">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto"
                            required autocomplete="off"
                            value="{{ $producto->foto }}">
                            <img src="{{ asset('imagen/' . $producto->foto) }}" alt="Imagen del producto" style="max-width: 200px;">
                        </div> --}}
                          <!-- Mostrar la imagen actual -->
                          @if($producto->foto)
                          <div class="mb-3">
                              <label for="foto_actual" class="form-label">Imagen actual:</label><br>
                              <img src="{{ asset('imagen/' . $producto->foto) }}" alt="Imagen del producto" style="max-width: 200px;">
                          </div>
                      @endif

                      <div class="mb-3">
                          <label for="foto" class="form-label">Subir nueva foto:</label>
                          <input type="file" class="form-control" id="foto" name="foto"
                          autocomplete="off">
                      </div>
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoria:</label>
                            <select name="categoria_id" id="categoria_id" class="form-control">
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" hidden selected>{{ $categoria->nombre }}</option>
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required autocomplete="off"
                            >{{ $producto->descripcion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="precio_por_dia" class="form-label">Precio por día:</label>
                            <input type="number" class="form-control" id="precio_por_dia" name="precio_por_dia" step="0.01" required autocomplete="off" onkeydown="return soloNumeros(event)"
                            value="{{ $producto->precio_por_dia }}">
                        </div>
                        <!-- Mostrar el documento actual -->
                        @if($producto->certificado_confiabilidad)
                            <div class="mb-3">
                                <label for="certificado_confiabilidad_actual" class="form-label">Certificado de confiabilidad actual:</label><br>
                                <a href="{{ asset('storage/' . $producto->certificado_confiabilidad) }}" target="_blank">Ver documento</a>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="certificado_confiabilidad" class="form-label">Subir nuevo certificado de confiabilidad:</label>
                            <input type="file" class="form-control" id="certificado_confiabilidad" name="certificado_confiabilidad" accept=".pdf,.doc,.docx">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="certificado_confiabilidad" class="form-label">Certificado de confiabilidad:</label>
                            <input type="file" class="form-control" id="certificado_confiabilidad" name="certificado_confiabilidad" accept=".pdf,.doc,.docx"
                            value="{{ $producto->certificado_confiabilidad }}">
                            <a href="{{ asset('documento/' . $producto->certificado_confiabilidad) }}" target="_blank">Ver documento</a>
                        </div> --}}
                        <div class="d-flex justify-content-between">

                        <a href="{{ route('producto.index') }}" type="submit" style="background-color: #053b9e;" class="btn btn-primary mb-3" class="btn btn-primary btn-block">Regresar</a>
                        <button type="submit" style="background-color: #002366;" class="btn btn-primary mb-3" class="btn btn-primary btn-block">Actualizar Producto</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

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

