@extends('layouts.base')

@section('content')
<div class="card">

    <h5 class="card-header">Producto</h5>
    <div class="card-body">
        <div class="row">
        </div>
        <hr>
        <p class="card-text">
            <div class="table-responsive">
                <a type="button" style="background-color: #002366;" class="btn btn-primary mb-3" href="{{ route('producto.crear') }}">Agregar</a>
                <table class="table table-striped table-bordered table-hover text-center" style="width: auto; margin: 0 auto;">
                    <thead>
                        <tr>
                            {{-- <th>id</th> --}}
                            <th>Nombre del producto</th>
                            <th>Foto</th>
                            <th>Categoria</th>
                            <th>Descripción</th>
                            <th>Precio por Día</th>
                            <th>Nombre del Rentador</th>
                            <th>Certificado de Confiabilidad</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $item)
                        <tr>
                            {{-- <td>{{ $item->id }}</td> --}}
                            <td>{{ $item->nombre }}</td>
                            <td>
                                <img src="{{ asset('/imagen/' . $item->foto) }}" style="width: 120px; height: auto;">
                            </td>
                            <td>{{ $item->categoria->nombre }}</td>
                            <td class="text-wrap" style="max-width: 200px;">{{ $item->descripcion }}</td>
                            <td>{{ $item->precio_por_dia }}</td>
                            <td>{{ $item->user->nombre }}</td>
                            <td>
                                <a href="{{ asset('/documento/' . $item->certificado_confiabilidad) }}" class="btn btn-info btn-sm" target="_blank">Ver Certificado</a>
                            </td>
                            <td>
                                <form action="{{ route('producto.edit', $item->id) }}" method="GET">
                                    <button class="btn btn-warning btn-sm">
                                        <span class="bi bi-pencil-square">Actualizar</span>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('producto.show', $item->id) }}" method="GET">
                                    <button class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </p>
    </div>
</div>
@endsection
