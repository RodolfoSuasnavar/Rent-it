@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="text-center mb-4">Productos</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <a href="{{ route('producto.crear') }}" style="background-color: #002366;" class="btn btn-primary">
                    Agregar Producto
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Nombre del Producto</th>
                            <th>Foto</th>
                            <th>Categoría</th>
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
                            <td>{{ $item->nombre }}</td>
                            <td>
                                <img src="{{ asset('/imagen/' . $item->foto) }}" alt="Foto del Producto" style="width: 120px; height: auto;">
                            </td>
                            <td>{{ $item->categoria->nombre }}</td>
                            <td class="text-wrap" style="max-width: 200px;">{{ $item->descripcion }}</td>
                            <td>{{ $item->precio_por_dia }}</td>
                            <td>{{ $item->user->nombre }}</td>
                            <td>
                                <a href="{{ asset('/documento/' . $item->certificado_confiabilidad) }}" class="btn btn-info btn-sm" target="_blank">
                                    Ver Certificado
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('producto.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('producto.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
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
    </div>
</div>
@endsection
