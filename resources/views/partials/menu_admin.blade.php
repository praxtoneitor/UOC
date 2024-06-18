<div class="content-container">
    <!-- Tabla con cinco columnas -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>
                                <button class="btn-toggle" data-target="add_servicio"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('add_servicio') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-coins" style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>




                            </th>
                            <th>
                                <button class="btn-toggle" data-target="add_estado"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('add_estado') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-handshake" style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="ver_servicios"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('view_servicio') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-folder-tree"
                                            style="font-size: 3rem; color: #181ca0;"></i></a>
                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="ver_estados"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('view_estado') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-money-bill-transfer"
                                            style="font-size: 3rem; color: #181ca0;"></i></a>

                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="usuarios"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('admin.users') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-user-large"
                                            style="font-size: 3rem; color: #181ca0;"></i></a>
                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="facturas"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('select_status') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-money-bill-1-wave"
                                            style="font-size: 3rem; color: #181ca0;"></i></a>
                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="app-name"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('admin.form_empresa') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-building"
                                            style="font-size: 3rem; color: #181ca0;"></i></a>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="styled-cell-text">Añadir Servicio</td>
                            <td id="styled-cell-text">Añadir Estados</td>
                            <td id="styled-cell-text">Visualizar Servicios</td>
                            <td id="styled-cell-text">Visualizar Estados</td>
                            <td id="styled-cell-text">Usuarios del Sistema</td>
                            <td id="styled-cell-text">Generar Facturas</td>
                            <td id="styled-cell-text">Nombre de Empresa</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


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