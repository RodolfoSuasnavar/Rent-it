@extends('layouts.admin')

@section('content')
<br>
<div class="container mt-4">
    <div class="row">
        <!-- Sección de Usuarios -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showUsuarios" class="text-decoration-none text-dark">
                <div class="info-box bg-light p-3 rounded border shadow-sm">
                    <h4 class="mb-2">Usuarios</h4>
                    <p>Total de usuarios: <strong>{{ $userCount }}</strong></p>
                </div>
            </a>
        </div>

        <!-- Sección de Productos -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showProductos" class="text-decoration-none text-dark">
                <div class="info-box bg-light p-3 rounded border shadow-sm">
                    <h4 class="mb-2">Productos</h4>
                    <p>Total de productos: <strong>{{ $productoCount }}</strong></p>
                </div>
            </a>
        </div>

        <!-- Sección de Rentas -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showRentas" class="text-decoration-none text-dark">
                <div class="info-box bg-light p-3 rounded border shadow-sm">
                    <h4 class="mb-2">Rentas</h4>
                    <p>Total de rentas: <strong>{{ $rentaCount }}</strong></p>
                </div>
            </a>
        </div>

        <!-- Sección de Contactos (Comentarios) -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showContactos" class="text-decoration-none text-dark">
                <div class="info-box bg-light p-3 rounded border shadow-sm">
                    <h4 class="mb-2">Comentarios</h4>
                    <p>Total de Comentarios: <strong>{{ $comentarioCount }}</strong></p>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="#" id="showCategorias" class="text-decoration-none text-dark">
                <div class="info-box bg-light p-3 rounded border shadow-sm">
                    <h4 class="mb-2">Categorías</h4>
                    <p>Total de Categorías: <strong>{{ $categoriaCount }}</strong></p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Contenedor de la Tabla de Usuarios -->
<div id="tableUsuarios" class="table-container container mt-4" style="display:none;">
    <h5 class="text-center mb-4">Tabla de Usuarios</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido Paterno</th>
                    <th scope="col">Apellido Materno</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->aPaterno }}</td>
                        <td>{{ $usuario->aMaterno }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->direccion }}</td>
                        <td>{{ $usuario->telefono }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Contenedor de la Tabla de Productos -->
<div id="tableProductos" class="table-container container mt-4" style="display:none;">
    <h5 class="text-center mb-4">Tabla de Productos</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del Producto</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio por Día</th>
                    <th scope="col">Nombre del Rentador</th>
                    <th scope="col">Certificado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>
                            <img src="{{ asset('/imagen/' . $item->foto) }}" alt="Foto del Producto" style="width: 80px; height: auto;">
                        </td>
                        <td>{{ $item->categoria->nombre }}</td>
                        <td class="text-wrap" style="max-width: 150px;">{{ $item->descripcion }}</td>
                        <td>{{ $item->precio_por_dia }}</td>
                        <td>{{ $item->user->nombre }}</td>
                        <td>
                            <a href="{{ asset('/documento/' . $item->certificado_confiabilidad) }}" class="btn btn-info btn-sm" target="_blank">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Contenedor de la Tabla de Rentas -->
<div id="tableRentas" class="table-container container mt-4" style="display:none;">
    <h5 class="text-center mb-4">Tabla de Rentas</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Final</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentas as $renta)
                    <tr>
                        <td>{{ $renta->id }}</td>
                        <td>{{ $renta->user->nombre }}</td>
                        <td>{{ $renta->producto->nombre }}</td>
                        <td>{{ $renta->fecha_inicio }}</td>
                        <td>{{ $renta->fecha_final }}</td>
                        <td>{{ $renta->precio_total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Contenedor de la Tabla de Contactos (Comentarios) -->
<div id="tableContactos" class="table-container container mt-4" style="display:none;">
    <h5 class="text-center mb-4">Tabla de Comentarios</h5>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contactos as $contacto)
                    <tr>
                        <td>{{ $contacto->user->email }}</td>
                        <td class="text-wrap" style="max-width: 150px;">{{ $contacto->comentario }}</td>
                        <td>{{ $contacto->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Contenedor de la Tabla de Categorías -->
<div id="tableCategorias" class="table-container container mt-4" style="display:none;">
    <div class="d-flex justify-content-between mb-3">
        <h5>Tabla de Categorías</h5>
        <a href="{{ route('categoria.crear') }}"style="background-color: #002366;" class="btn btn-primary">Agregar</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead class="bg-dark text-white">
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Categoría</th>
                    <th scope="col">Ver producto</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        {{-- <td>{{ $categoria->id }}</td> --}}
                        <td class="text-wrap" style="max-width: 150px;">{{ $categoria->nombre }}</td>
                        <td>
                            <a href="{{ route('admin.productos.ver', $categoria->id) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Ver productos
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('categoria.edit', $categoria->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('showUsuarios').addEventListener('click', function(event) {
        event.preventDefault();
        mostrarTabla('tableUsuarios');
    });

    document.getElementById('showProductos').addEventListener('click', function(event) {
        event.preventDefault();
        mostrarTabla('tableProductos');
    });

    document.getElementById('showRentas').addEventListener('click', function(event) {
        event.preventDefault();
        mostrarTabla('tableRentas');
    });

    document.getElementById('showContactos').addEventListener('click', function(event) {
        event.preventDefault();
        mostrarTabla('tableContactos');
    });

    document.getElementById('showCategorias').addEventListener('click', function(event) {
        event.preventDefault();
        mostrarTabla('tableCategorias');
    });

    function mostrarTabla(tablaId) {
        const tablas = document.querySelectorAll('.table-container');
        tablas.forEach(tabla => {
            tabla.style.display = 'none';
        });
        document.getElementById(tablaId).style.display = 'block';
    }
</script>
@endsection
