<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\Reporte;
use App\Models\Solicitud;
use App\Models\User;
use App\Rules\ShortOrFullUuid;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function adminIndex(Request $request)
    {
        $query = Reporte::query();

        if ($request->fecha_desde) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }
        if ($request->fecha_hasta) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $reportesRecientes = $query->with('solicitud.user')->latest()->take(20)->get();

        $totalSolicitudes = Solicitud::count();
        $solicitudesCompletadas = Solicitud::whereHas('estado', fn($q) => $q->where('nombreEstado', 'completada'))->count();
        $solicitudesPendientes = Solicitud::whereHas('estado', fn($q) => $q->where('nombreEstado', 'pendiente'))->count();
        $totalUsuarios = User::count();
        $apiKeys = ApiKey::latest()->get();

        return view('admin.reports', compact(
            'reportesRecientes',
            'totalSolicitudes',
            'solicitudesCompletadas',
            'solicitudesPendientes',
            'totalUsuarios',
            'apiKeys'
        ));
    }

    // ── API Key Management ────────────────────────────────────────────────────

    public function generateApiKey(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);

        $plainKey = bin2hex(random_bytes(32));
        $keyHash  = hash('sha256', $plainKey);

        $apiKey = ApiKey::create([
            'key_hash'    => $keyHash,
            'descripcion' => $request->nombre,
            'activa'      => true,
        ]);

        return response()->json([
            'key'        => $plainKey,
            'id'         => $apiKey->id,
            'nombre'     => $apiKey->descripcion,
            'created_at' => $apiKey->created_at->format('d/m/Y H:i'),
        ]);
    }

    public function toggleApiKey(ApiKey $apiKey): JsonResponse
    {
        $apiKey->update(['activa' => !$apiKey->activa]);

        return response()->json([
            'id'     => $apiKey->id,
            'activa' => $apiKey->activa,
        ]);
    }

    public function deleteApiKey(ApiKey $apiKey): JsonResponse
    {
        $apiKey->delete();

        return response()->json(['deleted' => true]);
    }

    // ── API Methods ───────────────────────────────────────────────────────────

    public function apiIndex(Request $request): JsonResponse
    {
        $query = Reporte::query()->with('solicitud.user');

        if ($request->fecha_desde) {
            $query->whereDate('fecha', '>=', $request->fecha_desde);
        }
        if ($request->fecha_hasta) {
            $query->whereDate('fecha', '<=', $request->fecha_hasta);
        }

        $reportes = $query->latest()->paginate($request->integer('per_page', 15));

        return response()->json($reportes);
    }

    public function apiShow(Reporte $reporte): JsonResponse
    {
        return response()->json($reporte->load('solicitud.user'));
    }

    public function apiStore(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'solicitudId' => ['required', new ShortOrFullUuid('solicitudes')],
            'fecha'       => 'required|date',
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $validated['solicitudId'] = ShortOrFullUuid::resolveToFullUuid('solicitudes', $validated['solicitudId']);

        $reporte = Reporte::create($validated);

        return response()->json($reporte->load('solicitud'), 201);
    }

    public function apiUpdate(Request $request, Reporte $reporte): JsonResponse
    {
        $validated = $request->validate([
            'solicitudId' => ['sometimes', new ShortOrFullUuid('solicitudes')],
            'fecha'       => 'sometimes|date',
            'titulo'      => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
        ]);

        if (isset($validated['solicitudId'])) {
            $validated['solicitudId'] = ShortOrFullUuid::resolveToFullUuid('solicitudes', $validated['solicitudId']);
        }

        $reporte->update($validated);

        return response()->json($reporte->fresh()->load('solicitud'));
    }
}
