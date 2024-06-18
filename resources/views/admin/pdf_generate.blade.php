<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Generar PDFs de Clientes</title>
</head>

<body>
    <form action="{{ route('pdf.generate') }}" method="POST">
        @csrf
        <label for="estado_id">Seleccionar Estado del Cliente:</label>
        <select name="estado_id" id="estado_id" required>
            <option value="">Seleccione un estado</option>
            @foreach($estados as $estado)
            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
            @endforeach
        </select>
        <button type="submit">Generar PDFs</button>
    </form>
</body>

</html>