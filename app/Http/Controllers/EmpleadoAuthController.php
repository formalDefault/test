<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoAuthController extends Controller
{
    // Mostrar la vista del login
    public function showLoginForm()
    {
        return view('empleados');
    }

    // En tu controlador de administración (AdminAuthController o el que gestionas la vista de dashboard)
    public function showDashboard()
    {
        $empleado = auth()->user(); // Asegúrate de que esto devuelva un objeto válido
        if (!$empleado) {
            return redirect()->route('login')->withErrors('Usuario no autenticado');
        }
        return view('admin.dashboard', compact('empleado'));
    }

    public function index()
    {
        $empleados = Empleado::all();
        return view('admin.empleados.index', compact('empleados'));
    }

    public function mostrarEdicion()
    {
        $empleados = Empleado::all();
        return view('admin.empleados.edit', compact('empleados'));
    }

    // Mostrar formulario para editar un empleado específico
    public function formularioEditar($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('admin.empleados.formulario', compact('empleado'));
    }

    // Actualizar empleado
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'id_empleado' => 'required|string|size:4|unique:empleados,id_empleado,' . $id,
            'nombre_empleado' => 'required|string|max:100',
            'rfc' => 'required|string|size:13|unique:empleados,rfc,' . $id,
            'password' => 'required|string|size:4',
        ]);

        $empleado = Empleado::findOrFail($id);
        $empleado->id_empleado = $request->id_empleado;
        $empleado->nombre_empleado = $request->nombre_empleado;
        $empleado->rfc = $request->rfc;
        $empleado->contraseña = $request->password; // Considera usar bcrypt() si quieres mayor seguridad
        $empleado->activo = $request->has('activo') ? true : false;
        $empleado->save();

        return redirect()->route('admin.empleados')->with('success', 'Empleado actualizado correctamente.');
    }

    public function create()
    {
        return view('admin.empleados.create');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|string|size:4|exists:empleados,id_empleado',
            'password' => 'required|string|size:4'
        ]);

        // Buscar el empleado por ID
        $empleado = Empleado::where('id_empleado', $request->id_empleado)->first();

        // Verificar si el empleado existe y la contraseña es correcta
        if ($empleado && $empleado->contraseña === $request->password) {
            // Verificar si está activo
            if (!$empleado->activo) {
                return back()->withErrors(['id_empleado' => 'Tu cuenta ha sido deshabilitada. Contacta al administrador.']);
            }

            // Autenticación exitosa
            return back()->with('success', 'Autenticación exitosa');
        }

        // Si la contraseña no coincide
        return back()->withErrors(['password' => 'Credenciales incorrectas']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|string|size:4|unique:empleados,id_empleado',
            'nombre_empleado' => 'required|string|max:100',
            'rfc' => 'required|string|size:13|unique:empleados,rfc',
            'password' => 'required|string|size:4',
        ]);

        Empleado::create([
            'id_empleado' => $request->id_empleado,
            'nombre_empleado' => $request->nombre_empleado,
            'rfc' => $request->rfc,
            'contraseña' => $request->password, // Considera usar bcrypt() si quieres mayor seguridad
            'activo' => true,
        ]);

        return redirect()->route('admin.empleados')->with('success', 'Empleado registrado correctamente.');
    }

    public function toggleStatus($id)
    {
        $empleado = Empleado::findOrFail($id);

        // Cambia el estado (activo/inactivo)
        $empleado->activo = !$empleado->activo;
        $empleado->save();

        return response()->json([
            'success' => true,
            'activo' => $empleado->activo
        ]);
    }
}
