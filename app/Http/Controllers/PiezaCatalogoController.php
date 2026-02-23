<?php

namespace App\Http\Controllers;

use App\Models\PiezaCatalogo;
use App\Models\Tag;
use Illuminate\Http\Request;

class PiezaCatalogoController extends Controller
{
    /**
     * Display a listing of the resource (API).
     */
    public function index()
    {
        return PiezaCatalogo::with(['adjunto', 'color'])->get();
    }

    /**
     * Store a newly created resource in storage (API).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:64',
            'adjuntoId' => 'required|uuid|exists:adjuntos,id',
            'colorId' => 'required|uuid|exists:colors,id',
        ]);

        return PiezaCatalogo::create($validated);
    }

    /**
     * Display the specified resource (API).
     */
    public function show(PiezaCatalogo $piezaCatalogo)
    {
        return $piezaCatalogo->load(['adjunto', 'color']);
    }

    /**
     * Update the specified resource in storage (API).
     */
    public function update(Request $request, PiezaCatalogo $piezaCatalogo)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:64',
            'adjuntoId' => 'sometimes|required|uuid|exists:adjuntos,id',
            'colorId' => 'sometimes|required|uuid|exists:colors,id',
        ]);

        $piezaCatalogo->update($validated);

        return $piezaCatalogo;
    }

    /**
     * Remove the specified resource from storage (API).
     */
    public function destroy(PiezaCatalogo $piezaCatalogo)
    {
        $piezaCatalogo->delete();

        return response()->noContent();
    }

    // ── Admin panel methods ───────────────────────────────────────────────────

    public function adminIndex(Request $request)
    {
        $piezas = PiezaCatalogo::with(['tags'])
            ->when($request->search, function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $availableTags = Tag::orderBy('nombre')->get();

        return view('admin.catalog', compact('piezas', 'availableTags'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:64',
            'descripcion'      => 'nullable|string|max:1000',
            'tags'             => 'nullable|array',
            'tags.*'           => 'uuid|exists:tags,id',
            'visible_catalogo' => 'nullable|boolean',
        ]);

        $pieza = PiezaCatalogo::create([
            'nombre'           => $request->nombre,
            'descripcion'      => $request->descripcion,
            'visible_catalogo' => $request->boolean('visible_catalogo'),
        ]);

        if ($request->filled('tags')) {
            $pieza->tags()->sync($request->tags);
        }

        return redirect()->route('admin.catalog')
            ->with('success', 'Pieza añadida correctamente.');
    }

    public function adminUpdate(Request $request, PiezaCatalogo $pieza)
    {
        $request->validate([
            'nombre'           => 'required|string|max:64',
            'descripcion'      => 'nullable|string|max:1000',
            'tags'             => 'nullable|array',
            'tags.*'           => 'uuid|exists:tags,id',
            'visible_catalogo' => 'nullable|boolean',
        ]);

        $pieza->update([
            'nombre'           => $request->nombre,
            'descripcion'      => $request->descripcion,
            'visible_catalogo' => $request->boolean('visible_catalogo'),
        ]);

        $pieza->tags()->sync($request->tags ?? []);

        return redirect()->route('admin.catalog')
            ->with('success', 'Pieza actualizada correctamente.');
    }

    public function adminDestroy(PiezaCatalogo $pieza)
    {
        $pieza->tags()->detach();
        $pieza->delete();

        return redirect()->route('admin.catalog')
            ->with('success', 'Pieza eliminada correctamente.');
    }
}
