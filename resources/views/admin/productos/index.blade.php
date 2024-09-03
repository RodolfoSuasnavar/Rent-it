@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <!-- Botón para regresar -->
        <a href="{{ route('admin.index') }}" class="btn btn-primary btn-sm mb-4" style="background-color: #002366;">Regresar</a>

        <!-- Tarjeta principal para la sección de productos -->
        <div class="card border-light">
            <div class="card-body">
                <!-- Encabezado dentro de la tarjeta -->
                <h5 class="text-center mb-4">Productos Relacionados en la categoría: {{ $categoria->nombre }}</h5>

                <!-- Contenedor de productos -->
                <div class="row">
                    @foreach($productos as $producto)
                        <div class="col-md-4 mb-4">
                            <div class="card border-light">
                                <img src="{{ asset('/imagen/' . $producto->foto) }}" class="card-img-top" alt="{{ $producto->nombre }}" style="object-fit: cover; height: 200px;">
                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $producto->nombre }}</h6>
                                    <p class="card-text">{{ Str::limit($producto->descripcion, 75) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
