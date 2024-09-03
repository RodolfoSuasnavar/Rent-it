@extends('layouts.admin-form')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Eliminar Categoría</h1>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-3">
                        <p>¿Estás seguro de que quieres eliminar la categoría <strong>{{ $categoria->nombre }}</strong>?</p>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
