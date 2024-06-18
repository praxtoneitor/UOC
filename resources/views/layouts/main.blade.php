<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu aplicación</title>

    <style>
    .top-barra {
        height: 150px;
        background-color: #3a2fa8;
        position: relative;
        /* Añadido position:relative; */
    }

    .logo {
        position: absolute;
        left: 20px;
        top: 20px;
        /* Ajuste de margen superior */
    }
    </style>
</head>

<body>

    <div class="top-barra">
        <img src="{{ asset('images/logo_helpdesk.png') }}" alt="Logotipo de la aplicación" class="logo">
    </div>



</body>

</html>