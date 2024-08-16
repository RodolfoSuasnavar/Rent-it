@extends('layouts.base')
@section('content')
<br>
<br>
<br>

<div class="card mx-auto" style="width: 80%;">
    <h5 class="card-header">Eliminar el producto</h5>
    <div class="card-body">
        <p class="card-text">
            <div class="alert alert-danger mx-auto" role="alert" style="width: 80%;">
                ¿Estás seguro de eliminar este registro?

                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" style="background-color: white;">
                        <thead>
                            <tr>
                                {{-- <th>id</th> --}}
                                <th scope="col">Nombre</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio por Día</th>
                                <th scope="col">Nombre del Rentador</th>
                                <th scope="col">Certificado de Confiabilidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $productos->nombre }}</td>
                                <td><img src="{{ asset('/imagen/' . $productos->foto) }}" alt="Foto del producto" class="img-fluid" width="50"></td>
                                <td>{{ $productos->categoria->nombre }}</td>
                                <td class="text-wrap" style="max-width: 200px;">{{ $productos->descripcion }}</td>
                                <td>{{ $productos->precio_por_dia }}</td>
                                <td>{{ $productos->nombre_rentador }}</td>
                                <td>{{ $productos->certificado_confiabilidad }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <form action="{{ route('producto.destroy', $productos->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('producto.index') }}" class="btn btn-info">Regresar</a>
                    <button class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </p>
    </div>
</div>
@endsection
