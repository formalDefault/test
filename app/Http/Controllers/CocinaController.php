<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CocinaController extends Controller
{
    // Muestra el login de cocina
    public function showLogin()
    {
        return view('cocina.login');
    }

    // Autenticación de cocina
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:4|max:4'
        ]);

        if ($request->password === env('COCINA_PASSWORD')) {
            session(['cocina' => true]);
            return redirect()->route('cocina.registros');
        }

        return back()->withErrors(['password' => 'Contraseña incorrecta']);
    }

    // Logout de cocina
    public function logout()
    {
        session()->forget('cocina'); // Elimina la sesión de cocina
        return redirect()->route('cocina.login'); // Redirige al login
    }

    // Muestra la vista de registros
    public function mostrarRegistros()
    {
        return view('cocina.registros');
    }

    // API para obtener los últimos 20 registros
    public function obtenerRegistros()
    {
        $registros = DB::table('registros_comida')
            ->join('empleados', 'registros_comida.id_empleado', '=', 'empleados.id_empleado')
            ->select('registros_comida.id', 'empleados.id_empleado', 'empleados.nombre_empleado', 'registros_comida.fecha', 'registros_comida.hora')
            ->orderByDesc('registros_comida.id')
            ->limit(20)
            ->get();

        return response()->json($registros);
    }

    // API para buscar un empleado por número
    public function buscarEmpleado(Request $request)
    {
        $empleado = DB::table('registros_comida')
            ->join('empleados', 'registros_comida.id_empleado', '=', 'empleados.id_empleado')
            ->where('empleados.id_empleado', $request->id_empleado)
            ->select('registros_comida.id', 'empleados.id_empleado', 'empleados.nombre_empleado', 'registros_comida.fecha', 'registros_comida.hora')
            ->first();

        return response()->json($empleado);
    }

}
