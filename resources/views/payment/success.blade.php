@extends('layouts.base')

@section('content')
<div class="container mt-5">
    <div class="alert alert-success">
        <h1>¡Pago Exitoso!</h1>
        <p>Gracias por tu compra. Tu pago se ha procesado correctamente.</p>
        <a href="{{ route('welcome') }}" class="btn btn-primary">Volver a la página principal</a>
    </div>
</div>
@endsection
