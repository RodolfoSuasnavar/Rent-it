@extends('layouts.admin')

@section('content')
<br>
<div class="container mt-4">
    <div class="row">
        <!-- Sección de Usuarios -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showUsuarios" style="text-decoration: none; color: inherit;">
                <div class="info-box">
                    <h4>Usuarios</h4>
                    <p>Total de usuarios: <strong>{{ $userCount }}</strong></p>
                </div>
            </a>
        </div>

        <!-- Sección de Productos -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showProductos" style="text-decoration: none; color: inherit;">
                <div class="info-box">
                    <h4>Productos</h4>
                    <p>Total de productos: <strong>{{ $productoCount }}</strong></p>
                </div>
            </a>
        </div>

        <!-- Sección de Rentas -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showRentas" style="text-decoration: none; color: inherit;">
                <div class="info-box">
                    <h4>Rentas</h4>
                    <p>Total de rentas: <strong>{{ $rentaCount }}</strong></p>
                </div>
            </a>
        </div>

        <!-- Sección de Contactos (Comentarios) -->
        <div class="col-md-6 col-lg-3">
            <a href="#" id="showContactos" style="text-decoration: none; color: inherit;">
                <div class="info-box">
                    <h4>Comentarios</h4>
                    <p>Total de Comentarios: <strong>{{ $comentarioCount }}</strong></p>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="#" id="showCategorias" style="text-decoration: none; color: inherit;">
                <div class="info-box">
                    <h4>Categoria</h4>
                    <p>Total de Categoria: <strong>{{ $categoriaCount }}</strong></p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Contenedor de la Tabla de Usuarios -->
<div id="tableUsuarios" class="table-container" style="display:none;">
    <h5 class="text-center">Tabla de Usuarios</h5>
    <table class="table table-striped table-bordered table-hover text-center" style="width: auto; margin: 0 auto;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">Correo</th>
                <th scope="col">Dirección</th>
                <th scope="col">Telefono</th>
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

<!-- Contenedor de la Tabla de Productos -->
<div id="tableProductos" class="table-container" style="display:none;">
    <h5 class="text-center">Tabla de Productos</h5>
    <table class="table table-striped table-bordered table-hover text-center" style="width: auto; margin: 0 auto;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del producto</th>
                <th scope="col">Foto</th>
                <th scope="col">Categoria</th>
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
                        <img src="{{ asset('/imagen/' . $item->foto) }}" style="width: 80px; height: auto;">
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

<!-- Contenedor de la Tabla de Rentas -->
<div id="tableRentas" class="table-container" style="display:none;">
    <h5 class="text-center">Tabla de Rentas</h5>
    <table class="table table-striped table-bordered table-hover text-center" style="width: auto; margin: 0 auto;">
        <thead>
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

<!-- Contenedor de la Tabla de Contactos (Comentarios) -->
<div id="tableContactos" class="table-container" style="display:none;">
    <h5 class="text-center">Tabla de Comentarios</h5>
    <table class="table table-striped table-bordered table-hover text-center" style="width: auto; margin: 0 auto;">
        <thead>
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

<div id="tableCategoria" class="table-container" style="display:none;">
    <h5 class="text-center">Tabla de Categoria</h5>
    <table class="table table-striped table-bordered table-hover text-center" style="width: auto; margin: 0 auto;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Categoria</th>
                {{-- <th scope="col">Fecha</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td class="text-wrap" style="max-width: 150px;">{{ $categoria->nombre }}</td>
                    {{-- <td>{{ $categoria->created_at }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
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
        mostrarTabla('tableCategoria');
    });

    function mostrarTabla(idTabla) {
        // Oculta todas las tablas
        const tablas = document.querySelectorAll('.table-container');
        tablas.forEach(function(tabla) {
            tabla.style.display = 'none';
        });

        // Muestra la tabla seleccionada
        document.getElementById(idTabla).style.display = 'block';
    }
</script>


@endsection
