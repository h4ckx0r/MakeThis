<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PiezaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::post('/forgot-password', function () {
    // TODO: Implementar lógica de recuperación de contraseña
    return back()->with('status', 'Email enviado correctamente');
})->name('forgot-password.send');

Route::get('/login-options', function () {
    return view('auth.login-options');
})->name('login-options');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function () {
    // TODO: Implementar lógica de registro
    return redirect()->route('home')->with('status', 'Registro completado correctamente');
})->name('register.store');

Route::get('/terms-conditions', function () {
    return view('terms-conditions');
})->name('terms-conditions');

Route::get('/solicitudes-cliente', function () {
    return view('solicitudes-cliente');
})->name('solicitudes-cliente');

Route::get('/me-gusta-cliente', function () {
    return view('me-gusta-cliente');
})->name('me-gusta-cliente');

Route::view('sobre-nosotros', 'about-us')
    ->name('about-us');

Route::view('maquinaria', 'machinery')
    ->name('machinery');

Route::view('equipo', 'equipo')
    ->name('equipo');

Route::view('colaboraciones', 'colaboraciones')
    ->name('colaboraciones');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('reportes', 'reportes')
    ->name('reportes');

Route::view('usuarios', 'usuarios')
    ->name('usuarios');

Route::view('solicitudes', 'solicitudes')
    ->name('solicitudes');

// Rutas administrativas de piezas (protegidas)
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/piezas', [PiezaController::class, 'adminIndex'])
        ->name('admin.piezas.index');
    Route::post('/piezas', [PiezaController::class, 'adminStore'])
        ->name('admin.piezas.store');
    Route::put('/piezas/{pieza}', [PiezaController::class, 'adminUpdate'])
        ->name('admin.piezas.update');
    Route::delete('/piezas/{pieza}', [PiezaController::class, 'adminDestroy'])
        ->name('admin.piezas.destroy');
});

// Rutas para Catálogo de Piezas (públicas)
Route::get('/piezas/catalogo', [PiezaController::class, 'catalogo'])
    ->name('piezas.catalogo');

// Selección de tipo
Route::get('/piezas/solicitar', fn() => view('piezas.solicitar'))
    ->name('piezas.solicitar');

// Formularios
Route::get('/piezas/propia', fn() => view('piezas.propia'))
    ->name('piezas.propia');

Route::get('/piezas/personalizada', fn() => view('piezas.personalizada'))
    ->name('piezas.personalizada');

// Preview (público para permitir edición antes de registrarse)
Route::post('/piezas/preview', [PiezaController::class, 'preview'])
    ->name('piezas.preview');

// Store (autenticado)
Route::middleware('auth')->group(function () {
    Route::post('/piezas/store', [PiezaController::class, 'store'])
        ->name('piezas.store');
});

require __DIR__ . '/settings.php';