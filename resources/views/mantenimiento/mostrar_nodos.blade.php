@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #4e4e4e; font-family: 'Arial Black', sans-serif; font-size: 24px;">Mostrar
        nodos
    </h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Localización</th>
                                    <th>Equipo</th>
                                    <th>IP</th>
                                    <th>MAC</th>
                                    <th>Alias</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $prevNodoId = null;
                                $colorToggle = true;
                                @endphp
                                @foreach($nodos as $nodo)
                                @foreach($nodo->material as $materialNodo)
                                @php
                                if ($prevNodoId !== $nodo->id) {
                                $colorToggle = !$colorToggle;
                                $prevNodoId = $nodo->id;
                                }
                                $rowColor = $colorToggle ? 'background-color: #f0f0f0;' : 'background-color: #e3fbfd;';
                                @endphp
                                <tr>
                                    <td style="{{ $rowColor }}">
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $nodo->geoposicionamiento }}"
                                            target="_blank">
                                            {{ $nodo->nombre }}
                                        </a>
                                    </td>
                                    <td style="{{ $rowColor }}">{{ $materialNodo->marca }} {{ $materialNodo->modelo }}
                                    </td>
                                    <td style="{{ $rowColor }}">{{ $materialNodo->pivot->ip }}</td>
                                    <td style="{{ $rowColor }}">{{ $materialNodo->mac }}</td>
                                    <td style="{{ $rowColor }}">{{ $materialNodo->pivot->alias }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='mostrar_nodos'] .fa-wifi");
    addButton.style.color = '#B92A0C';
});
</script>
@endsection