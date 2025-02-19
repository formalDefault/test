<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Editar Empleado</h2>
        <form action="#" method="POST">
            @csrf
            <div class="mb-3">
                <label for="id_empleado" class="form-label">ID Empleado</label>
                <input type="text" class="form-control" id="id_empleado" name="id_empleado" value="{{ $empleado->id_empleado }}" required>
            </div>
            <div class="mb-3">
                <label for="nombre_empleado" class="form-label">Nombre Empleado</label>
                <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" value="{{ $empleado->nombre_empleado }}" required>
            </div>
            <div class="mb-3">
                <label for="rfc" class="form-label">RFC</label>
                <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $empleado->rfc }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $empleado->contraseña }}" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="activo" name="activo" {{ $empleado->activo ? 'checked' : '' }}>
                <label class="form-check-label" for="activo">
                    Activo
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
