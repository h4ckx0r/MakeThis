<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\Estado;
use App\Models\Solicitud;
use App\Models\ThreeDModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolicitudController extends Controller
{
    public function index(Request $request)
    {
        $solicitudes = Solicitud::with(['user', 'estado', 'adjuntos', 'threeDModel.color', 'piezaCatalogo'])
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
            'estado_id'          => 'required|uuid|exists:estados,id',
            'detalles'           => 'nullable|string',
            'altura_capa'        => 'nullable|numeric|min:0.05|max:1.0',
            'porcentaje_relleno' => 'nullable|integer|min:0|max:100',
            'patron_relleno'     => 'nullable|string|in:rejilla,giroide,cubico,panal_de_abeja,panal_de_abeja_3d',
        ]);

        $solicitud->estadoId = $request->estado_id;

        if ($request->has('detalles')) {
            $solicitud->detalles = $request->detalles;
        }
        if ($request->filled('altura_capa')) {
            $solicitud->alturaCapa = $request->altura_capa;
        }
        if ($request->filled('porcentaje_relleno')) {
            $solicitud->porcentajeRelleno = $request->porcentaje_relleno;
        }
        if ($request->has('patron_relleno')) {
            $solicitud->patronRelleno = $request->patron_relleno ?: null;
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

    public function downloadModel(ThreeDModel $model)
    {
        if (!Storage::disk('public')->exists($model->modelo)) {
            abort(404, 'Archivo no encontrado.');
        }

        return Storage::disk('public')->download($model->modelo, $model->nombreModelo);
    }
}
