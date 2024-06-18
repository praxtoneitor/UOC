@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')

<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">Introducir
        datos de equipamiento</h1>
</div>


<form id="formulario-material" method="POST" action="{{ route('store_material') }}" class="formulario">
    @csrf

    <div class="form-group">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="{{ old('marca') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="{{ old('modelo') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="num_serie">Número de Serie:</label>
        <input type="text" id="num_serie" name="num_serie" value="{{ old('num_serie') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="mac">MAC:</label>
        <input type="text" id="mac" name="mac" value="{{ old('mac') }}" class="form-control">
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
</div>

<style>
body,
html {
    height: 100%;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}

.formulario-container {
    width: 100%;
    max-width: 200px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn-primary {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.getElementById("formulario-material");

    formulario.addEventListener("submit", function(event) {
        event.preventDefault();

        // Obtener los valores del formulario
        const marca = document.getElementById("marca").value;
        const modelo = document.getElementById("modelo").value;
        const numSerie = document.getElementById("num_serie").value;
        const mac = document.getElementById("mac").value;

        // Mostrar confirmación con Swal
        Swal.fire({
            title: 'Confirmar datos',
            html: `<p>Marca: ${marca}</p><p>Modelo: ${modelo}</p><p>Número de Serie: ${numSerie}</p><p>MAC: ${mac}</p>`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si confirma, realizar la solicitud AJAX
                $.ajax({
                        url: "{{ route('store_material') }}",
                        method: "POST",
                        data: $(formulario).serialize(),
                    })
                    .done(function(response) {
                        Swal.fire({
                            title: "Éxito",
                            text: "Equipo insertado correctamente",
                            icon: "success"
                        }).then(() => {
                            window.location.reload();
                        });
                    })
                    .fail(function(xhr, status, error) {
                        if (xhr.status === 409) { // Capturar el error 409 específicamente
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseJSON.error,
                                icon: "error"
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "No se pudo guardar.",
                                icon: "error"
                            });
                        }
                    });
            }
        });
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='crear_material'] .fa-server");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection