@extends('layouts.app')

@section('content')
@include('partials.menu_admin')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Servicio</title>
    <style>
    body,
    html {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .error-container {
        text-align: center;
        margin: auto;
        width: 50%;
        height: 50%;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    h1 {
        color: #ff6347;
    }

    p {
        color: #333;
    }
    </style>
</head>

<body>
    <div class="error-container">
        <h1>Error de Borrado</h1>
        <p>El servicio no puede ser borrado porque está siendo utilizado por algún cliente.</p>
    </div>
</body>

</html>
@endsection