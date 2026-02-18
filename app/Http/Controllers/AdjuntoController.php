<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use Illuminate\Http\Request;

class AdjuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Adjunto::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreFichero' => 'required|string|max:64',
            'idSolicitud' => 'nullable|uuid',
            'fichero' => 'required|string|max:256',
        ]);

        return Adjunto::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Adjunto $adjunto)
    {
        return $adjunto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adjunto $adjunto)
    {
        $validated = $request->validate([
            'nombreFichero' => 'sometimes|required|string|max:64',
            'idSolicitud' => 'sometimes|nullable|uuid',
            'fichero' => 'sometimes|required|string|max:256',
        ]);

        $adjunto->update($validated);

        return $adjunto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adjunto $adjunto)
    {
        $adjunto->delete();

        return response()->noContent();
    }
}
