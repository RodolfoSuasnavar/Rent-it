@extends('layouts.base')

@section('content')

{{-- <h1>Aquí van las rentas</h1> --}}

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('/imagen/' . $producto->foto) }}" class="img-fluid rounded-start" alt="{{ $producto->nombre }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $producto->nombre }}</h4>
                            <p class="card-text mb-2">{{ $producto->descripcion }}</p>
                            <p class="card-text mb-4"><strong>Certificado de Confiabilidad:</strong> {{ $producto->certificado }}</p>
                            {{-- <form action="{{ route('rentar.procesar', $producto->id) }}" method="POST"> --}}
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="start_date" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_date" class="form-label">Fecha Final</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" style="background-color: #002366;">Confirmar Renta</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Revise la información antes de confirmar.</small>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection
