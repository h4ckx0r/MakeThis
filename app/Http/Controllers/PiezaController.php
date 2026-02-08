<?php

namespace App\Http\Controllers;

use App\Models\Pieza;
use App\Models\SolicitudPieza;
use App\Models\Tag;
use Illuminate\Http\Request;

class PiezaController extends Controller
{
    public function catalogo(Request $request)
    {
        $query = Pieza::with('tags')->where('visible_catalogo', true);

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->has('tags') && !empty($request->tags)) {
            $query->whereHas('tags', fn($q) =>
                $q->whereIn('tags.id', (array) $request->tags)
            );
        }

        $piezas = $query->paginate(8);
        $availableTags = Tag::all();

        return view('piezas.catalogo', compact('piezas', 'availableTags'));
    }

    public function preview(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:propia,personalizada',
            'material' => 'required|string',
            'color' => 'required|string',
            'indicaciones' => 'nullable|string',
        ]);

        session(['preview' => $validated]);
        return view('piezas.preview');
    }

    public function store(Request $request)
    {
        $previewData = session('preview');

        if (!$previewData) {
            return redirect()->route('piezas.solicitar')
                ->with('error', 'Sesión expirada.');
        }

        $solicitud = SolicitudPieza::create([
            'user_id' => auth()->id(),
            'tipo' => $previewData['tipo'],
            'material' => $previewData['material'],
            'color' => $previewData['color'],
            'indicaciones' => $previewData['indicaciones'] ?? null,
            'estado' => 'pendiente',
        ]);

        session()->forget('preview');

        return redirect()->route('solicitudes-cliente')
            ->with('success', 'Solicitud enviada. ID: #' . $solicitud->id);
    }
}
