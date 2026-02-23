<?php

namespace App\Http\Controllers;

use App\Models\Adjunto;
use App\Models\Color;
use App\Models\Estado;
use App\Models\Material;
use App\Models\PiezaCatalogo;
use App\Models\Solicitud;
use App\Models\Tag;
use App\Models\ThreeDModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PrintController extends Controller
{
    /**
     * Catálogo público con filtros de búsqueda y tags, paginado de 8.
     */
    public function catalog(Request $request)
    {
        $query = PiezaCatalogo::with(['adjunto', 'color', 'tags'])
            ->where('visible_catalogo', true);

        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('tags') && is_array($request->tags)) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('tags.id', $request->tags);
            });
        }

        $piezas = $query->paginate(8)->withQueryString();
        $availableTags = Tag::orderBy('nombre')->get();

        return view('prints.catalog', compact('piezas', 'availableTags'));
    }

    /**
     * Formulario para modelo 3D propio.
     */
    public function ownForm()
    {
        $materiales = Material::with('colores')->get();

        return view('prints.own', compact('materiales'));
    }

    /**
     * Formulario para diseño personalizado.
     */
    public function customForm()
    {
        $materiales = Material::with('colores')->get();

        return view('prints.custom', compact('materiales'));
    }

    /**
     * Valida los datos del formulario y los guarda en sesión para el preview.
     */
    public function storePreview(Request $request)
    {
        $tipo = $request->input('tipo');

        $rules = [
            'tipo'         => 'required|in:propia,personalizada',
            'materialId'   => 'required|uuid|exists:materials,id',
            'colorId'      => 'required|uuid|exists:colors,id',
            'indicaciones' => 'nullable|string|max:2000',
        ];

        if ($tipo === 'propia') {
            $rules['archivo_path']   = 'required|string';
            $rules['archivo_nombre'] = 'required|string';
            $rules['altura_capa']         = 'nullable|numeric|min:0.05|max:0.5';
            $rules['porcentaje_relleno']  = 'nullable|integer|min:0|max:100';
            $rules['patron_relleno']      = 'nullable|in:linear,grid,gyroid,honeycomb';
        } else {
            $rules['archivo_path']   = 'nullable|string';
            $rules['archivo_nombre'] = 'nullable|string';
            $rules['indicaciones']   = 'required|string|max:2000';
        }

        $validated = $request->validate($rules);

        $material = Material::find($validated['materialId']);
        $color    = Color::find($validated['colorId']);

        $previewData = [
            'tipo'           => $validated['tipo'],
            'materialId'     => $validated['materialId'],
            'materialNombre' => $material?->nombre,
            'colorId'        => $validated['colorId'],
            'colorNombre'    => $color?->nombre,
            'colorHex'       => $color?->hexColor,
            'indicaciones'   => $validated['indicaciones'] ?? null,
            'archivo_path'   => $validated['archivo_path'] ?? null,
            'archivo_nombre' => $validated['archivo_nombre'] ?? null,
        ];

        if ($tipo === 'propia') {
            $previewData['altura_capa']        = $validated['altura_capa'] ?? null;
            $previewData['porcentaje_relleno'] = $validated['porcentaje_relleno'] ?? null;
            $previewData['patron_relleno']     = $validated['patron_relleno'] ?? null;
        } else {
            $previewData['incluye_modelo_3d'] = $request->boolean('incluye_modelo_3d');
            $previewData['incluye_pieza']     = $request->boolean('incluye_pieza');
        }

        session(['preview' => $previewData]);

        return redirect()->route('prints.preview');
    }

    /**
     * Muestra el resumen de la solicitud desde sesión.
     */
    public function showPreview()
    {
        if (!session('preview')) {
            return redirect()->route('prints.request')
                ->with('error', 'No hay datos de solicitud. Por favor vuelve a completar el formulario.');
        }

        return view('prints.preview');
    }

    /**
     * Persiste la solicitud. Requiere autenticación.
     */
    public function store(Request $request)
    {
        $preview = session('preview');

        if (!$preview) {
            return redirect()->route('prints.request')
                ->with('error', 'La sesión ha expirado. Por favor vuelve a completar el formulario.');
        }

        $estadoPendiente = Estado::where('nombreEstado', 'Pendiente')->firstOrFail();
        $tipo = $preview['tipo'];

        $solicitudData = [
            'userId'            => Auth::id(),
            'estadoId'          => $estadoPendiente->id,
            'detalles'          => $preview['indicaciones'] ?? 'Sin indicaciones adicionales.',
            '3dModelId'         => null,
            'porcentajeRelleno' => $preview['porcentaje_relleno'] ?? 20,
            'alturaCapa'        => $preview['altura_capa'] ?? 0.2,
            'patronRelleno'     => $preview['patron_relleno'] ?? null,
        ];

        if ($tipo === 'propia' && !empty($preview['archivo_path'])) {
            $tempPath  = $preview['archivo_path'];
            $extension = pathinfo($tempPath, PATHINFO_EXTENSION);
            $finalName = (string) Str::uuid() . '.' . $extension;
            $finalPath = 'models/' . $finalName;

            if (Storage::disk('public')->exists($tempPath)) {
                Storage::disk('public')->move($tempPath, $finalPath);
            }

            $threeDModel = ThreeDModel::create([
                'nombreModelo' => $preview['archivo_nombre'],
                'tipo'         => strtolower($extension),
                'modelo'       => $finalPath,
                'colorId'      => $preview['colorId'],
            ]);

            $solicitudData['3dModelId'] = $threeDModel->id;
        }

        $solicitud = Solicitud::create($solicitudData);

        if ($tipo === 'personalizada' && !empty($preview['archivo_path'])) {
            $tempPath  = $preview['archivo_path'];
            $extension = pathinfo($tempPath, PATHINFO_EXTENSION);
            $finalName = (string) Str::uuid() . '.' . $extension;
            $finalPath = 'adjuntos/' . $finalName;

            if (Storage::disk('public')->exists($tempPath)) {
                Storage::disk('public')->move($tempPath, $finalPath);
            }

            Adjunto::create([
                'nombreFichero' => $preview['archivo_nombre'],
                'idSolicitud'   => $solicitud->id,
                'fichero'       => $finalPath,
            ]);
        }

        session()->forget('preview');

        return redirect()->route('client.requests')
            ->with('success', 'Tu solicitud ha sido enviada correctamente. Te contactaremos pronto.');
    }
}
