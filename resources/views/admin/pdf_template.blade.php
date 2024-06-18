<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        padding: 20px;
        background: white;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .header img {
        height: 100px;
        /* Ajusta según el tamaño de tu logo */
    }

    .header h1 {
        font-size: 32px;
        color: #333;
    }

    .invoice-details {
        margin-top: 20px;
    }

    .invoice-details p {
        margin: 5px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

<body>
    <div class="header">
        <!-- <img src="{{ asset('path/to/your/logo.jpg') }}" alt="Logo"> -->
        <h1>FACTURA</h1>
    </div>

    <div class="invoice-details">
        <p><strong>Fecha de Factura:</strong> {{ now()->toDateString() }}</p>
        <p><strong>Nombre:</strong> {{ $nombre }} {{ $apellidos }}</p>
        <p><strong>Dirección:</strong> {{ $direccion }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $descripcion_servicio }}</td>
                <td>1</td>
                <td>€{{ number_format($precio, 2, ',', '.') }}</td>
                <td>€{{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>€{{ number_format($total, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>