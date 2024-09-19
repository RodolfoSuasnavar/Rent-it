@extends('layouts.template')

@section('content')
<!-- Productos -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row justify-content-center">
    @if ($productos->isEmpty())
        <p>No se encontraron productos.</p>
    @else
        @foreach ($productos as $item)
            <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                <div class="card shadow-sm border-0">
                    <div class="card-img-top img-container">
                        <img src="{{ asset('/imagen/' . $item->foto) }}" alt="{{ $item->nombre }}" class="img-fluid portfolio-img">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $item->nombre }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($item->descripcion, 100) }}</p>
                        <p class="mb-2">Precio: <strong>{{ $item->precio_por_dia }} MXN/día</strong></p>
                        <a href="#" class="btn btn-navy" data-bs-toggle="modal" data-bs-target="#portfolioModal1{{ $item->id }}">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal del Producto -->
            <div class="portfolio-modal modal fade" id="portfolioModal1{{ $item->id }}" tabindex="-1" aria-labelledby="portfolioModal1{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="img-container">
                                                    <img class="portfolio-img img-fluid" src="{{ asset('/imagen/' . $item->foto) }}" alt="{{ $item->nombre }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-start">
                                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">{{ $item->nombre }}</h2>
                                                <div class="divider-custom"></div>
                                                <p class="mb-4"><strong>Descripción:</strong> {{ $item->descripcion }}</p>
                                                <p class="mb-4"><strong>Precio por día:</strong> {{ $item->precio_por_dia }}</p>
                                                <p class="mb-4"><strong>Categoría:</strong> {{ $item->categoria->nombre }}</p>

                                                @if(Auth::check())
                                                    <a href="{{ route('renta.index', $item->id) }}" class="btn btn-navy mt-2">Rentar</a>
                                                @else
                                                    <a href="{{ route('login.index') }}" class="btn btn-navy mt-2">Iniciar sesión para rentar</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
