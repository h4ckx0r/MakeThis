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
        // Asegurar que el usuario está autenticado
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('warning', 'Debes ingresar para confirmar tu solicitud.');
        }

        $previewData = session('preview');

        if (!$previewData) {
            return redirect()->route('piezas.solicitar')
                ->with('error', 'Sesión expirada. Por favor, vuelve a llenar el formulario.');
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

    public function adminIndex(Request $request)
    {
        $query = Pieza::with('tags');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        $piezas = $query->orderBy('created_at', 'desc')->get();
        $availableTags = Tag::orderBy('nombre')->get();

        return view('admin.piezas', compact('piezas', 'availableTags'));
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'visible_catalogo' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['visible_catalogo'] = $request->has('visible_catalogo');

        $pieza = Pieza::create($validated);
        $pieza->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.piezas.index')
            ->with('success', 'Pieza creada exitosamente');
    }

    public function adminUpdate(Request $request, Pieza $pieza)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'visible_catalogo' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['visible_catalogo'] = $request->has('visible_catalogo');

        $pieza->update($validated);
        $pieza->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.piezas.index')
            ->with('success', 'Pieza actualizada exitosamente');
    }

    public function adminDestroy(Pieza $pieza)
    {
        $hasSolicitudes = SolicitudPieza::where('pieza_id', $pieza->id)->exists();

        if ($hasSolicitudes) {
            return redirect()->route('admin.piezas.index')
                ->with('error', 'No se puede eliminar porque tiene solicitudes asociadas');
        }

        $pieza->tags()->detach();
        $pieza->delete();

        return redirect()->route('admin.piezas.index')
            ->with('success', 'Pieza eliminada exitosamente');
    }
}
