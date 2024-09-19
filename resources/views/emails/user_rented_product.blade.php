<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmación de Renta</title>
</head>
<body>
    <h1>¡Renta Confirmada!</h1>
    <p>Hola, {{ $renta->user->name }}.</p>
    <p>Tu renta del producto {{ $renta->producto->nombre }} ha sido confirmada con éxito.</p>
    <p>Detalles de la renta:</p>
    <ul>
        <li>Fecha de inicio: {{ $renta->fecha_inicio }}</li>
        <li>Fecha de fin: {{ $renta->fecha_fin }}</li>
        <li>Precio: {{ $renta->precio }}</li>
    </ul>
    <p>Gracias por usar nuestro servicio.</p>
</body>
</html>
