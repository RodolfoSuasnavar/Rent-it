<!DOCTYPE html>
<html>
<head>
    <title>Pago con Stripe</title>
</head>
<body>
    <h1>Pago con Stripe</h1>

    @if (Session::has('success'))
        <div>{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
        <div>{{ Session::get('error') }}</div>
    @endif

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Correo Electrónico" required>
        <input type="hidden" name="amount" value="{{ $total }}" required> <!-- Monto del total desde tu formulario -->
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ config('services.stripe.key') }}"
            data-name="Rent-it"
            data-description="Pagar ahora"
            data-amount="{{ $total * 100 }}"
            data-currency="mxn"
            data-locale="auto"
            data-email="{{ auth()->user()->email ?? '' }}"
            data-success-url="{{ route('payment.success') }}"
            data-cancel-url="{{ route('payment.cancel') }}">
        </script>
    </form>
</body>
</html>
<!-- linea 25 Asegúrate de ajustar el monto Stripe usa centavos -->
<!-- Correo del usuario si está autenticado -->
<!-- Ruta a redirigir en caso de éxito -->
<!-- Ruta a redirigir en caso de cancelación -->


