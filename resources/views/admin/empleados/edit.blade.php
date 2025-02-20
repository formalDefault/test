 
<form action="#" method="POST">
    @csrf
    <div class="mb-3">
        <label for="id_empleado" class="form-label">ID Empleado</label>
        <input type="text" class="form-control" id="id_empleado" name="id_empleado" value="{{ $employee->id_empleado }}" required>
    </div>
    <div class="mb-3">
        <label for="nombre_empleado" class="form-label">Nombre Empleado</label>
        <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" value="{{ $employee->nombre_empleado }}" required>
    </div>
    <div class="mb-3">
        <label for="rfc" class="form-label">RFC</label>
        <input type="text" class="form-control" id="rfc" name="rfc" value="{{ $employee->rfc }}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" value="{{ $employee->contraseña }}" required>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="activo" name="activo" {{ $employee->activo ? 'checked' : '' }}>
        <label class="form-check-label" for="activo">
            Activo
        </label>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form> 