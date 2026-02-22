<?php

use App\Http\Controllers\PasswordResetOtpController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SolicitudController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Support\Facades\Route;


// VISTAS
Route::view('/', 'home')
    ->name('home');

Route::view('terms-conditions', 'terms-conditions')
    ->name('terms-conditions');

Route::prefix('about')->group(function () {
    Route::view('', 'about-us.about-us')
        ->name('about-us');
    Route::view('machinery', 'about-us.machinery.machinery')
        ->name('about-us.machinery');
    Route::view('team', 'about-us.team.team')
        ->name('about-us.team');
    Route::view('collaborations', 'about-us.collaborations.collaborations')
        ->name('about-us.collaborations');
});

Route::prefix('auth')->group(function () {
    Route::view('login', 'auth.login')
        ->name('auth.login');
    Route::get('register', function () {
        return view('auth.register');
    })->name('auth.register');
    Route::view('login-options', 'auth.login-options')
        ->name('auth.login-options');
});

// Flujo OTP de recuperación de contraseña
Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('forgot-password', [PasswordResetOtpController::class, 'showRequestForm'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordResetOtpController::class, 'sendOtp'])
        ->name('password.sendOtp');
    Route::get('verify-code', [PasswordResetOtpController::class, 'showVerifyForm'])
        ->name('password.verifyForm');
    Route::post('verify-code', [PasswordResetOtpController::class, 'verifyOtp'])
        ->name('password.verifyOtp');
    Route::post('resend-code', [PasswordResetOtpController::class, 'resendOtp'])
        ->name('password.resendOtp');
    Route::get('reset-password', [PasswordResetOtpController::class, 'showResetForm'])
        ->name('password.resetForm');
    Route::post('reset-password', [PasswordResetOtpController::class, 'resetPassword'])
        ->name('password.reset');
});

Route::prefix('client')->group(function () {
    Route::view('requests', 'client.requests')
        ->name('client.requests');
    Route::view('likes', 'client.likes')
        ->name('client.likes');
});

Route::prefix('prints')->group(function () {
    Route::view('catalog', 'prints.catalog')
        ->name('prints.catalog');

    Route::prefix('request')->group(function () {
        Route::view('', 'prints.request')
            ->name('prints.request');
        Route::view('custom', 'prints.custom')
            ->name('prints.custom');
        Route::view('own', 'prints.own')
            ->name('prints.own');
        Route::view('preview', 'prints.preview')
            ->name('prints.preview');
    });
});

Route::prefix('admin')->middleware(EnsureIsAdmin::class)
    ->group(function () {
        // Rutas para catálogo
        Route::view('catalog', 'admin.catalog')
            ->name('admin.catalog');

        // Rutas para usuarios
        Route::view('users', 'admin.users')
            ->name('admin.users');

        // Rutas para solicitudes
        Route::get('requests', [SolicitudController::class, 'index'])
            ->name('admin.requests');
        Route::put('requests/{solicitud}', [SolicitudController::class, 'update'])
            ->name('admin.requests.update');

        // Rutas para reportes
        Route::get('reports', [ReporteController::class, 'adminIndex'])
            ->name('admin.reports');
    });


// CONTROLADORES


require __DIR__ . '/settings.php';

// DEPRECADO ;)

/*
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
Route::get('/piezas/solicitar', fn () => view('piezas.solicitar'))
    ->name('piezas.solicitar');

// Formularios
Route::get('/piezas/propia', fn () => view('piezas.propia'))
    ->name('piezas.propia');

Route::get('/piezas/personalizada', fn () => view('piezas.personalizada'))
    ->name('piezas.personalizada');

// Preview (público para permitir edición antes de registrarse)
Route::post('/piezas/preview', [PiezaController::class, 'preview'])
    ->name('piezas.preview');

// Store (autenticado)
Route::middleware('auth')->group(function () {
    Route::post('/piezas/store', [PiezaController::class, 'store'])
        ->name('piezas.store');
});

*/
