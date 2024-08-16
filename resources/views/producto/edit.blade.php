@extends('layouts.app')

@section('content')
<h1>Editar Producto</h1>
<form method="POST" action="{{ route('productos.update', $producto->id_producto) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label>Producto:</label>
    <input type="text" name="producto" value="{{ $producto->producto }}" required>
    <label>Tipo:</label>
    <input type="text" name="Tipo" value="{{ $producto->Tipo }}" required>
    <label>Precio por día:</label>
    <input type="number" name="Precio_dia" value="{{ $producto->Precio_dia }}" required>
    <label>Descripción:</label>
    <textarea name="Descripcion">{{ $producto->Descripcion }}</textarea>
    <label>Calendario inicio:</label>
    <input type="date" name="Calendario_inicio" value="{{ $producto->Calendario_inicio }}">
    <label>Calendario fin:</label>
    <input type="date" name="Calendario_fin" value="{{ $producto->Calendario_fin }}">
    <label>Certificado:</label>
    <input type="text" name="Certificado" value="{{ $producto->Certificado }}">
    <label>Foto:</label>
    <input type="file" name="Foto">
    <button type="submit">Actualizar</button>
</form>
@endsection
