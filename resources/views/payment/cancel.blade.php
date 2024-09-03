@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="alert alert-warning">
        <h1>Pago Cancelado</h1>
        <p>El pago ha sido cancelado. Puedes intentarlo de nuevo.</p>
        <a href="{{ route('welcome') }}" class="btn btn-primary">Volver a la página principal</a>
    </div>
</div>
@endsection
