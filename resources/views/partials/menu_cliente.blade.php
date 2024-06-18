<div class="content-container">
    <!-- Tabla con cinco columnas -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>
                                <button class="btn-toggle" data-target="factura"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('facturas.index') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-money-bill-1-wave"
                                            style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="incidencia"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="#" onclick="mostrarModalIncidencias()" style="border: none; outline: none;">
                                        <i class="fa-solid fa-ticket" style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="styled-cell-text">Ver facturas</td>
                            <td id="styled-cell-text">Generar Incidencia</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('soporte.modals.modalAñadirIncidencia')


<!-- Script para manejar la generación de los PDFs y mostrar el mensaje de confirmación -->
<script>
// Cuando se hace clic en el botón etiquetado como "usuarios"
$('.btn-toggle[data-target="facturas"]').click(function(event) {
    event.preventDefault();


    var url = $(this).find('a').attr('href');

    // Realizar la solicitud AJAX para generar los PDFs
    $.ajax({
        type: 'GET',
        url: url, // Utilizar la URL obtenida del botón
        success: function(response) {
            // Mostrar mensaje de confirmación usando SweetAlert2
            Swal.fire({
                icon: 'success',
                title: 'PDFs Generados',
                text: response.message
            });
        },
        error: function(xhr, status, error) {
            // Manejar errores si es necesario
            console.error(xhr.responseText);
        }
    });
});
</script>