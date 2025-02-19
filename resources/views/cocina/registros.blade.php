<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros Cocina</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Últimos 20 Registros</h3>
        <form action="{{ route('cocina.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>

    <input type="text" id="buscarEmpleado" placeholder="Buscar ID" class="form-control mb-3">

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Empleado</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody id="tablaRegistros"></tbody>
    </table>

    <script>
        function cargarRegistros() {
            $.get("{{ url('/cocina/api/registros') }}", function(data) {
                let rows = "";
                data.forEach(reg => {
                    rows += `<tr>
                        <td>${reg.id}</td>
                        <td>${reg.id_empleado}</td>
                        <td>${reg.nombre_empleado}</td>
                        <td>${reg.fecha}</td>
                        <td>${reg.hora}</td>
                    </tr>`;
                });
                $("#tablaRegistros").html(rows);
            });
        }
        
        setInterval(cargarRegistros, 5000);
        cargarRegistros();
    </script>
    
</body>
</html>
