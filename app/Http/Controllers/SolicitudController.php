<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $solicitudes = Solicitud::with(['user', 'estado'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($uq) use ($request) {
                      $uq->where('nombre', 'like', '%' . $request->search . '%')
                         ->orWhere('apellidos', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%');
                  });
            })
            ->when($request->estado, function ($q) use ($request) {
                $q->whereHas('estado', function ($eq) use ($request) {
                    $eq->where('nombreEstado', $request->estado);
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.requests', compact('solicitudes'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'estado' => 'required|string|in:pendiente,en_proceso,completada,rechazada',
            'detalles' => 'nullable|string',
        ]);

        $estado = \App\Models\Estado::where('nombreEstado', $request->estado)->first();

        if ($estado) {
            $solicitud->estadoId = $estado->id;
        }

        if ($request->filled('detalles')) {
            $solicitud->detalles = $request->detalles;
        }

        $solicitud->save();

        return redirect()->route('admin.requests')->with('success', 'Solicitud actualizada correctamente.');
    }
}
