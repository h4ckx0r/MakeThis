<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\Estado;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $solicitudes = Solicitud::with(['user', 'estado', 'adjuntos'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($uq) use ($request) {
                      $uq->where('nombre', 'like', '%' . $request->search . '%')
                         ->orWhere('apellidos', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%');
                  });
            })
            ->when($request->estado_id, function ($q) use ($request) {
                $q->where('estadoId', $request->estado_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $estados = Estado::orderBy('nombreEstado')->get();

        return view('admin.requests', compact('solicitudes', 'estados'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $request->validate([
            'estado_id' => 'required|uuid|exists:estados,id',
            'detalles'  => 'nullable|string',
        ]);

        $solicitud->estadoId = $request->estado_id;

        if ($request->has('detalles')) {
            $solicitud->detalles = $request->detalles;
        }

        $solicitud->save();

        return redirect()->route('admin.requests')->with('success', 'Solicitud actualizada correctamente.');
    }

    public function downloadAdjunto(Adjunto $adjunto)
    {
        if (!Storage::disk('public')->exists($adjunto->fichero)) {
            abort(404, 'Archivo no encontrado.');
        }

        return Storage::disk('public')->download($adjunto->fichero, $adjunto->nombreFichero);
    }
}
