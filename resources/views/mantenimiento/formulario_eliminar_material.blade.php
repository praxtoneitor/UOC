@extends('layouts.app')

@section('content')
@include('partials.menu_mantenimiento')
<div style="background-color: #f2f2f2; padding: 20px;">
    <h1 style="text-align: center; color: #333; font-family: 'Arial Black', sans-serif; font-size: 24px;">Eliminar
        Material del Nodo</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">


                <div class="card-body">
                    @if (session('success'))
                    <div>{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                    <div>{{ session('error') }}</div>
                    @endif
                    <label for="nodo_id">Seleccionar Nodo:</label>
                    <select name="nodo_id" id="nodo_id" onchange="obtenerMateriales(this.value)" required>
                        <option value="">Seleccionar</option>
                        @foreach ($nodos as $nodo)
                        <option value="{{ $nodo->id }}">{{ $nodo->nombre }}</option>
                        @endforeach
                    </select>
                    <div id="materiales"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function obtenerMateriales(nodoId) {
    fetch(`/nodo/${nodoId}/materiales`)
        .then(response => response.json())
        .then(data => {
            const materialesDiv = document.getElementById('materiales');
            materialesDiv.innerHTML = data.length > 0 ? data.map(material => `
                        <div>
                            <p>${material.marca} (IP: ${material.pivot.ip}, MAC: ${material.mac} Alias: ${material.pivot.alias})</p>
                            <button onclick="eliminarMaterial(${material.id})">Eliminar</button>
                        </div>
                    `).join('') : '<p>No hay materiales asignados a este nodo.</p>';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al obtener los materiales.');
        });
}

function eliminarMaterial(materialId) {
    if (confirm('¿Estás seguro de que quieres eliminar este material?')) {
        $.post("{{ route('eliminar_material') }}", {
                _token: "{{ csrf_token() }}",
                id: materialId
            })
            .done(function(response) {
                Swal.fire({
                    title: 'Material eliminado correctamente',
                    icon: "success"
                }).then(() => {
                    window.location.reload();
                })
            })
            .fail(function(error) {
                console.error('Error:', error);
                alert('Hubo un problema al eliminar el material.');
            });
    }
}
</script>
@endsection
<script>
document.addEventListener("DOMContentLoaded", function() {
    const addButton = document.querySelector(".btn-toggle[data-target='del_material'] .fa-paperclip");
    addButton.style.color = '#B92A0C';
});
</script>