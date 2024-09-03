@extends('layouts.base')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Detalle del Producto -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-lg border-light">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('/imagen/' . $producto->foto) }}" class="img-fluid rounded-start" alt="{{ $producto->nombre }}" style="object-fit: cover; height: 200px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title"> {{ $producto->nombre }}</h4>
                            <p class="card-text mb-2">Descripción: {{ $producto->descripcion }}</p>
                            <p class="card-text mb-2"><strong>Certificado de Confiabilidad:</strong> <a href="{{ asset('storage/' . $producto->certificado_confiabilidad) }}" target="_blank">Ver certificado</a></p>
                            <p class="card-text mb-2">Precio por día: {{ $producto->precio_por_dia }} pesos</p>
                            <br>
                            {{-- Formulario de pago con Stripe --}}
                            <form action="{{ route('payment.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <input type="hidden" id="price-per-day" value="{{ $producto->precio_por_dia }}">
                                <input type="hidden" id="commission" value="10"> <!-- Ajusta la comisión según sea necesario -->

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

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="total" class="form-label">Total</label>
                                        <input type="text" class="form-control" id="total" name="amount" readonly>
                                    </div>
                                </div>

                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="{{ config('services.stripe.key') }}"
                                    data-name="Rent-it"
                                    data-description="Pagar ahora"
                                    data-currency="mxn"
                                    data-amount="{{ old('amount', 0) }}"> <!-- Monto en centavos (se inicializa en 0) -->
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-light">
                    <small class="text-muted">Revise la información antes de confirmar.</small>
                </div>
            </div>
        </div>

        <!-- Productos Relacionados -->
        @if($productosRelacionados->isNotEmpty())
            <div class="col-lg-8">
                <h5 class="mb-4">Productos Relacionados</h5>
                <div class="row">
                    @foreach($productosRelacionados as $productoRelacionado)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-light">
                                <img src="{{ asset('/imagen/' . $productoRelacionado->foto) }}" class="card-img-top" alt="{{ $productoRelacionado->nombre }}" style="object-fit: cover; height: 150px;">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $productoRelacionado->nombre }}</h6>
                                    <p class="card-text">{{ Str::limit($productoRelacionado->descripcion, 75) }}</p>
                                    <a href="{{ route('renta.index', $productoRelacionado->id) }}" class="btn btn-primary btn-sm" style="background-color: #002366;">Ver Producto</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    const pricePerDay = parseFloat(document.getElementById('price-per-day').value);
    const commission = parseFloat(document.getElementById('commission').value);
    const totalInput = document.getElementById('total');

    function calculateTotal() {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        if (startDate && endDate && startDate <= endDate) {
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Incluye el primer día

            const total = (diffDays * pricePerDay) + commission;
            totalInput.value = total.toFixed(2); // Aquí solo el valor numérico, sin 'pesos'
        } else {
            totalInput.value = '';
        }
    }

    startDateInput.addEventListener('change', calculateTotal);
    endDateInput.addEventListener('change', calculateTotal);
});
</script>

@endsection
