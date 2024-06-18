@if ($_SERVER["REQUEST_METHOD"] == "POST")
@php
// Verificar si se recibió el ID del estado
if (isset($_POST['estado_id'])) {
$estado_id = $_POST['estado_id'];

// Realizar la actualización en la base de datos
// Suponiendo que ya tienes un modelo Estado y una tabla estados en la base de datos
$estado = App\Models\Estado::find($estado_id);
if ($estado) {
$estado->default = 'si';
$estado->save();
echo "Estado actualizado correctamente";
} else {
echo "No se encontró el estado";
}
} else {
echo "ID del estado no recibido";
}
@endphp
@else
<p>Solicitud no válida</p>
@endif