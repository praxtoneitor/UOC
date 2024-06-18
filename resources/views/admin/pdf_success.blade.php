@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">PDFs Generados
    </h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <!-- Tu contenido aquí -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>PDFs Generados</title>
    <!-- Incluir SweetAlert2 desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
    // Mostrar el mensaje de éxito usando SweetAlert2
    Swal.fire({
        title: 'Éxito',
        text: 'PDFs generados y guardados correctamente para todos los clientes.',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirigir a otra página si es necesario
            window.location.href = '/'; // Cambia la ruta según sea necesario
        }
    });
    </script>
</body>

</html>