<!-- resources/views/renta/misRentados.blade.php -->
@extends('layouts.base')

@section('title', 'Mis Productos Rentados')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Mis Productos Rentados</h1>
            @if ($productosRentados->isEmpty())
                <div class="alert alert-info">
                    No has rentado ningún producto.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre del Producto</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentas as $renta)
                                @php
                                    $producto = $productosRentados->firstWhere('id', $renta->producto_id);
                                @endphp
                                @if ($producto)
                                    <tr>
                                        <td>
                                            @if ($producto->foto)
                                                <img src="{{ asset('imagen/' . $producto->foto) }}" alt="{{ $producto->nombre }}" class="img-thumbnail" style="width: 100px; height: auto;">
                                            @else
                                                <img src="{{ asset('img/default.png') }}" alt="Imagen no disponible" class="img-thumbnail" style="width: 100px; height: auto;">
                                            @endif
                                        </td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>{{ $renta->fecha_inicio->format('d/m/Y') }}</td>
                                        <td>{{ $renta->fecha_final->format('d/m/Y') }}</td>
                                        <td>${{ $renta->precio_total }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
