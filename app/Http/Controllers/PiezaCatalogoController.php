<?php

namespace App\Http\Controllers;

use App\Models\PiezaCatalogo;
use Illuminate\Http\Request;

class PiezaCatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PiezaCatalogo::with(['adjunto', 'color'])->get();
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(PiezaCatalogo $piezaCatalogo)
    {
        return $piezaCatalogo->load(['adjunto', 'color']);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(PiezaCatalogo $piezaCatalogo)
    {
        $piezaCatalogo->delete();

        return response()->noContent();
    }
}
