<?php

namespace App\Http\Controllers;

use App\Models\ThreeDModel;
use Illuminate\Http\Request;

class ThreeDModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ThreeDModel::with('color')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombreModelo' => 'required|string|max:64',
            'tipo' => 'required|string|max:3',
            'modelo' => 'required|string|max:256',
            'colorId' => 'required|uuid|exists:colors,id',
        ]);

        return ThreeDModel::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(ThreeDModel $threeDModel)
    {
        return $threeDModel->load('color');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ThreeDModel $threeDModel)
    {
        $validated = $request->validate([
            'nombreModelo' => 'sometimes|required|string|max:64',
            'tipo' => 'sometimes|required|string|max:3',
            'modelo' => 'sometimes|required|string|max:256',
            'colorId' => 'sometimes|required|uuid|exists:colors,id',
        ]);

        $threeDModel->update($validated);

        return $threeDModel;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThreeDModel $threeDModel)
    {
        $threeDModel->delete();

        return response()->noContent();
    }
}