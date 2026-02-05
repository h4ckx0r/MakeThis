<?php

use Illuminate\Support\Facades\Route;

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
Route::view('sobre-nosotros', 'about-us')
    ->name('about-us');

Route::view('maquinaria', 'machinery')
    ->name('machinery');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('reportes', 'reportes')
    ->name('reportes');

Route::view('usuarios', 'usuarios')
    ->name('usuarios');

Route::view('solicitudes', 'solicitudes')
    ->name('solicitudes');

require __DIR__ . '/settings.php';