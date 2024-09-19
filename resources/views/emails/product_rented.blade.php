<!DOCTYPE html>
<html>
<head>
    <title>Producto alquilado</title>
</head>
<body>
    <p>Hola usuario</p>
    <p>Se ha rentado el producto:</p>
    <ul>
        <li>Nombre del producto: {{ $renta->producto->nombre }}</li>
        <li>Fecha de inicio: {{ $renta->fecha_inicio->format('d-m-Y') }}</li>
        <li>Fecha final: {{ $renta->fecha_final->format('d-m-Y') }}</li>
        <li>Precio total: {{ $renta->precio_total }} MXN</li>
    </ul>
    <p>Gracias por usar nuestro servicio.</p>
</body>
</html>
