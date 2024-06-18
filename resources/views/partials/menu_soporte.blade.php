<div class="content-container">
    <!-- Tabla con cinco columnas -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>
                                <button class="btn-toggle" data-target="buscar_cliente"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('buscar_cliente') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-magnifying-glass"
                                            style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="add_client"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('add_client') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-user-plus" style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>
                            </th>
                            <th>
                                <button class="btn-toggle" data-target="altas_pendientes"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('altas_pendientes') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-stopwatch" style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>

                            </th>
                            <th>
                                <button class="btn-toggle" data-target="incidencias_abiertas"
                                    style="border: none; outline: none; background-color: transparent;">
                                    <a href="{{ route('incidencias_abiertas') }}" style="border: none; outline: none;">
                                        <i class="fa-solid fa-triangle-exclamation"
                                            style="font-size: 3rem; color: #181ca0;"></i>
                                    </a>
                                </button>


                            </th>

                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td id="styled-cell-text">Buscar cliente</td>
                            <td id="styled-cell-text">Añadir cliente</td>
                            <td id="styled-cell-text">Altas Pendientes</td>
                            <td id="styled-cell-text">Visualizar incidencias</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Barra inferior -->
    <div class="bottom-bar"></div>
</div>