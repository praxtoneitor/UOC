<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Cliente creado - Soporte</title>
</head>

<body>
    <p>Hola {{ $user->name }}, se ha generado un usuario para poder acceder a la gestión de su usuario.</p>
    <p>Estos son los datos de acceso:</p>
    <ul>
        <li>Nombre: {{ $user->name }}</li>
        <li>Correo electrónico: {{ $user->email }}</li>
        <li>Contraseña: <strong>{{ $password }}</strong></li>
    </ul>
    <p>Este es el acceso al login: <a href="{{ route('login') }}">{{ route('login') }}</a></p>
    <p><em>Recuerda que puedes cambiar la contraseña una vez dentro del portal.</em></p>
</body>

</html>