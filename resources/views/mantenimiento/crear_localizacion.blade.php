@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">
        Agregar Localización</h1>
</div>


<form id="formulario-localizacion" method="POST" action="{{ route('store_localizacion') }}" class="formulario">
    @csrf

    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control">
    </div>

    <div class="form-group">
        <label for="geolocalizacion">Geoposicionamiento:</label>
        <input type="text" id="geoposicionamiento" name="geoposicionamiento" value="{{ old('geoposicionamiento') }}"
            class="form-control">
    </div>

    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='add_servicio'] .fa-map-location-dot");
    addButton.style.color = '#B92A0C'
});
</script>
@endsection