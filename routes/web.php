<?php
use App\Http\Controllers\EmpleadoAuthController;
use App\Http\Controllers\CocinaController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Route;

// Página de inicio redirige al login de admin
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Rutas de autenticación para empleados
Route::get('/empleados', [EmpleadoAuthController::class, 'showLoginForm'])->name('empleados.empleados');
Route::post('/empleados', [EmpleadoAuthController::class, 'login']);
Route::post('/logout', [EmpleadoAuthController::class, 'logout'])->name('empleados.logout');

// Rutas para la sección de cocina
Route::get('/cocina', [CocinaController::class, 'showLogin'])->name('cocina.login');
Route::post('/cocina', [CocinaController::class, 'login']);
Route::get('/cocina/registros', [CocinaController::class, 'mostrarRegistros'])->name('cocina.registros');
Route::post('/cocina/logout', [CocinaController::class, 'logout'])->name('cocina.logout');
Route::get('/cocina/api/registros', [CocinaController::class, 'obtenerRegistros']);
Route::get('/cocina/api/buscar', [CocinaController::class, 'buscarEmpleado']);

// Rutas para editar
Route::get('/admin/empleados/edit', [EmpleadoAuthController::class, 'mostrarEdicion'])->name('admin.empleados.edit');
Route::get('/admin/empleados/{id}/formulario-editar', [EmpleadoAuthController::class, 'formularioEditar'])->name('admin.empleados.formulario');
Route::post('/admin/empleados/{id}/actualizar', [EmpleadoAuthController::class, 'actualizar'])->name('admin.empleados.actualizar');

// Rutas de autenticación para administradores
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Rutas para gestión de empleados en el panel admin
Route::get('/admin/empleados', [EmpleadoAuthController::class, 'index'])->name('admin.empleados');
Route::get('/admin/empleados/create', [EmpleadoAuthController::class, 'create'])->name('admin.empleados.create');
Route::post('/admin/empleados', [EmpleadoAuthController::class, 'store'])->name('admin.empleados.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/admin/empleados/{id}/toggle', [EmpleadoAuthController::class, 'toggleStatus'])->name('admin.empleados.toggle');
});

Route::get('/admin/reportes', function () {
    return view('admin.reportes');
})->name('admin.reportes');

// Área administrativa protegida por middleware de autenticación
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');
