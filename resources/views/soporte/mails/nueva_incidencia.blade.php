<!DOCTYPE html>
<html>

<head>
    <title>{{ $estado == 'nueva' ? 'Nueva' : 'Actualización' }} Incidencia</title>
</head>

<body>
    @if ($estado == 'nueva')
    <p>Se ha registrado una nueva incidencia.</p>
    @else
    <p>Se ha actualizado una incidencia.</p>
    @endif
</body>

</html>