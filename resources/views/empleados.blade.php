<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Para mensajes bonitos -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .logo {
            width: 100px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/LogoExp.png') }}" alt="Expoalimentos" class="logo">
        <h3>EXPOALIMENTOS</h3>
        <p>Ingrese sus credenciales</p>
        
        <!-- Formulario de Login -->
        <form id="loginForm" action="{{ route('empleados.empleados') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" id="id_empleado" name="id_empleado" class="form-control" placeholder="ID de Empleado" required maxlength="4">
            </div>
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required maxlength="4">
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
    </div>

    <script>
        document.getElementById("password").addEventListener("input", function() {
            if (this.value.length === 4) {
                document.getElementById("loginForm").submit();
            }
        });

        // Mensajes de éxito o error
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Autenticación exitosa',
                text: 'Registro realizado con éxito',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                document.getElementById("id_empleado").value = "";
                document.getElementById("password").value = "";
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Datos incorrectos, inténtelo de nuevo'
            });
        @endif
    </script>
</body>
</html>
