<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function adminIndex(Request $request)
    {
        $query = Reporte::query();

        if ($request->fecha_desde) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }
        if ($request->fecha_hasta) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $reportesRecientes = $query->with('solicitud.user')->latest()->take(20)->get();

        $totalSolicitudes = Solicitud::count();
        $solicitudesCompletadas = Solicitud::whereHas('estado', fn($q) => $q->where('nombreEstado', 'completada'))->count();
        $solicitudesPendientes = Solicitud::whereHas('estado', fn($q) => $q->where('nombreEstado', 'pendiente'))->count();
        $totalUsuarios = User::count();

        return view('admin.reports', compact(
            'reportesRecientes',
            'totalSolicitudes',
            'solicitudesCompletadas',
            'solicitudesPendientes',
            'totalUsuarios'
        ));
    }
}
