<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        /* Estilo del fondo del modal */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Estilo del contenido del modal */
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 30vw;
            text-align: center;
        }

        /* Botón de cerrar */
        .close {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }

        .close:hover {
            color: red;
        }
    </style>
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
                <td>
                    <button onclick="showUser({{ $empleado->id_empleado }})" class="btn btn-sm btn-primary">Editar</button>
                </td>
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

    <!-- Contenedor del modal -->
    <div id="myModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header" style="width: 100%; display: flex; justify-content: space-between; align-items: center;">
                <div style="font-size: 14px;"><strong>Edición de usuario</strong></div>
                <div ><span class="close">&times;</span></div>
            </div>
            @if (isset($employee))
                @include('admin.empleados.form', ['employee' => $employee])
            @endif
        </div>
    </div>
</table>

<script>
        // Obtener elementos
        const modal = document.getElementById("myModal"); 
        const closeModal = document.querySelector(".close");
 
        function showUser(id)
        {
            
            fetch(`/admin/empleados/edit/${id}`)
                .then(response => alert(response.text()))
                .then(html => {
                    alert(html)
                    modal.style.display = "flex"; 
                })
                .catch(error => alert("Error:" + error));
        }

        // Cerrar el modal al hacer clic en la "X"
        closeModal.addEventListener("click", () => {
            modal.style.display = "none";
        });

        // Cerrar el modal si el usuario hace clic fuera del contenido
        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    </script>

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
