<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <div class="container">
        <h3>Empleados Activos</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="#" onclick="mostrarSeccion('empleados/create')"  class="btn btn-primary mb-3">Agregar Empleado</a>
        
        <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>RFC</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($empleados as $empleado)
            <tr id="empleado-{{ $empleado->id_empleado }}">
                <td>{{ $empleado->id_empleado }}</td>
                <td>{{ $empleado->nombre_empleado }}</td>
                <td>{{ $empleado->rfc }}</td>
                <td>
                    <span id="estado-{{ $empleado->id_empleado }}" class="badge {{ $empleado->activo ? 'bg-success' : 'bg-danger' }}">
                        {{ $empleado->activo ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <button id="boton-{{ $empleado->id_empleado }}" 
                        class="btn btn-sm {{ $empleado->activo ? 'btn-danger' : 'btn-success' }}"
                        onclick="toggleStatus('{{ $empleado->id_empleado }}')">
                        {{ $empleado->activo ? 'Deshabilitar' : 'Habilitar' }}
                    </button>
                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function toggleStatus(id) {
        $.ajax({
            url: '/admin/empleados/' + id + '/toggle',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    // Actualizar el estado del badge
                    let estadoBadge = $('#estado-' + id);
                    let boton = $('#boton-' + id);

                    if (response.activo) {
                        estadoBadge.text('Activo').removeClass('bg-danger').addClass('bg-success');
                        boton.text('Deshabilitar').removeClass('btn-success').addClass('btn-danger');
                    } else {
                        estadoBadge.text('Inactivo').removeClass('bg-success').addClass('bg-danger');
                        boton.text('Habilitar').removeClass('btn-danger').addClass('btn-success');
                    }
                } else {
                    alert('Error al actualizar el estado.');
                }
            },
            error: function(xhr) {
                console.error("Error AJAX:", xhr.status, xhr.statusText);
            }
        });
    }
</script>


    </div>
</body>
</html>
