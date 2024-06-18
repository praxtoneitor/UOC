<div class="container mt-4 {{ isset($fullWidth) && $fullWidth ? 'container-fluid' : '' }}">
    <div class="row justify-content-center">
        <div class="col-md-8 {{ isset($fullWidth) && $fullWidth ? 'col-md-12' : '' }}">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>
                            <button class="btn-toggle" data-target="crear_material"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('crear_material') }}" style="border: none; outline: none;">
                                    <i class="fa-solid fa-server" style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>
                        </th>

                        <th>
                            <button class="btn-toggle" data-target="mostrar_material"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('mostrar_material') }}" style="border: none; outline: none;">
                                    <i class="fa-solid fa-store" style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>
                        </th>


                        <th>
                            <button class="btn-toggle" data-target="add_servicio"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('crear_localizacion') }}" style="border: none; outline: none;">
                                    <i class="fa-solid fa-map-location-dot"
                                        style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>
                        </th>
                        <th>
                            <button class="btn-toggle" data-target="ver_nodos"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('ver_nodos') }}" style="border: none; outline: none;">
                                    <i class="fa-solid fa-eye"
                                        style="font-size: 3rem; color: {{ request()->is('ver_nodos') ? '#B92A0C' : '#181ca0' }};"></i>
                                </a>
                            </button>
                        </th>
                        <th>
                            <button class="btn-toggle" data-target="add_material"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('formulario_asignar_material') }}"
                                    style="border: none; outline: none;">
                                    <i class="fa-solid fa-paperclip" style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>
                        </th>
                        <th>
                            <button class="btn-toggle" data-target="del_material"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('formulario_eliminar_material') }}"
                                    style="border: none; outline: none;">
                                    <i class="fa-solid fa-paperclip" style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>
                        </th>
                        <th>
                            <button class="btn-toggle" data-target="mostrar_nodos"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('mostrar_nodos') }}" style="border: none; outline: none;">
                                    <i class="fa-solid fa-wifi" style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>

                        <th>
                            <button class="btn-toggle" data-target="averias"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('averias') }}" style="border: none; outline: none;">
                                    <i class="fa-solid fa-circle-exclamation"
                                        style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>
                        </th>
                        <th>
                            <button class="btn-toggle" data-target="cons_averias"
                                style="border: none; outline: none; background-color: transparent;">
                                <a href="{{ route('averias_lista') }}" style="border: none; outline: none;">
                                    <i class="fa-solid fa-list" style="font-size: 3rem; color: #181ca0;"></i>
                                </a>
                            </button>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td id="styled-cell-text">Añadir Dispositivos</td>
                        <td id="styled-cell-text">Equipamiento Disponible</td>
                        <td id="styled-cell-text">Añadir Localización</td>
                        <td id="styled-cell-text">Visualizar Localizaciones</td>
                        <td id="styled-cell-text">Asignar material a nodo</td>
                        <td id="styled-cell-text">Retirar material de nodo</td>
                        <td id="styled-cell-text">Equipamiento de red</td>
                        <td id="styled-cell-text">Añadir avería</td>
                        <td id="styled-cell-text">Consultar averías</td>

                    </tr>

                </tbody>
            </table>