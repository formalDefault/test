<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background: #343a40;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            padding: 10px;
            text-decoration: none;
            color: white;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar (Menú Lateral) -->
    <div class="sidebar">
        <h4 class="text-center">Admin</h4>
        <a href="#" onclick="mostrarSeccion('empleados')">Gestionar Empleados</a>
        <a href="#" onclick="mostrarSeccion('empleados/create')">Agregar Empleado</a>
        <a href="#" onclick="mostrarSeccion('empleados/edit')">Editar</a>
        <a href="#" onclick="mostrarSeccion('empleados/reportes')">Reportes</a>

        <form action="{{ route('admin.logout') }}" method="POST" class="text-center mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
       <h3>Bienvenido, {{ auth()->user()->nombre }}</h3>

        <!-- Sección de contenido dinámico -->
        <div id="contenido-dinamico"></div>
    </div>

    <script>
    $(document).ready(function() {
        // Cargar automáticamente la sección de empleados al iniciar
        mostrarSeccion('empleados');
    });

    function mostrarSeccion(seccion) {
        $.ajax({
            url: '/admin/' + seccion,  // Se asegura de usar el prefijo correcto
            type: 'GET',
            success: function (data) {
                $('#contenido-dinamico').html(data);
            },
            error: function (xhr) {
                console.error("Error AJAX:", xhr.status, xhr.statusText);
                $('#contenido-dinamico').html('<p class="text-danger">Error al cargar la sección: ' + xhr.status + '</p>');
            }
        });
    }
    </script>

</body>
</html>

