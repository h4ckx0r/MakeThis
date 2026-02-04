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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
