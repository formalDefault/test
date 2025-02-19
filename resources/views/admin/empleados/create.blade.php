<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h3>Agregar Empleado</h3>

        <form action="{{ route('admin.empleados.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>ID de Empleado</label>
                <input type="text" name="id_empleado" class="form-control" required maxlength="4">
            </div>

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre_empleado" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>RFC</label>
                <input type="text" name="rfc" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required minlength="4">
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('admin.empleados') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
