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
            <div class="col-md-6 col-lg-4 mb-3 custom-column">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1{{ $item->id }}">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <div class="img-container">
                        <img class="portfolio-img" src="{{ asset('/imagen/' . $item->foto) }}" alt="..." />
                    </div>
                </div>
            </div>

            <div class="portfolio-modal modal fade" id="portfolioModal1{{ $item->id }}" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
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
                                                    <img class="portfolio-img" src="{{ asset('/imagen/' . $item->foto) }}" alt="..." />
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-start">
                                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">{{ $item->nombre }}</h2>
                                                <div class="divider-custom"></div>
                                                <p class="mb-4">Descripción: {{ $item->descripcion }}</p>
                                                <p class="mb-4">Precio por dia: {{ $item->precio_por_dia }}</p>
                                                <p class="mb-4">Categoria: {{ $item->categoria->nombre }}</p>

                                                @if(Auth::check())
                                                <!-- Si el usuario está autenticado, redirige a la vista de rentar -->
                                                <a href="{{ route('renta.index', $item->id) }}" class="btn btn-navy mt-2">
                                                    Rentar
                                                </a>
                                            @else

                                                {{-- <button class="btn btn-navy mt-2" data-bs-dismiss="modal">
                                                    Rentar
                                                </button> --}}
                                                <!-- Si el usuario no está autenticado, redirige al login -->
                                                <a href="{{ route('login.index') }}" class="btn btn-navy mt-2">
                                                    Rentar
                                                </a>
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
