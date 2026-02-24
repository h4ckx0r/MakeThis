<?php

use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Todas las rutas tienen prefijo /api automáticamente.
| Los endpoints de reportes requieren header X-API-Key válido.
|--------------------------------------------------------------------------
*/

Route::middleware('api.key')->group(function () {
    Route::get('reportes', [ReporteController::class, 'apiIndex']);
    Route::get('reportes/{reporte}', [ReporteController::class, 'apiShow']);
    Route::post('reportes', [ReporteController::class, 'apiStore']);
    Route::put('reportes/{reporte}', [ReporteController::class, 'apiUpdate']);
    Route::patch('reportes/{reporte}', [ReporteController::class, 'apiUpdate']);
    // DELETE no disponible por diseño
});
