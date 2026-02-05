<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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