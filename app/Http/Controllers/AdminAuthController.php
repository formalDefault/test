<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }
  

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        $usuario = Usuario::where('usuario', $request->usuario)->first();

        if ($usuario && $usuario->contraseña === $request->contraseña) {
            Auth::login($usuario);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['usuario' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
