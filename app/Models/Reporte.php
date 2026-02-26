<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reporte extends Model
{
    /** @use HasFactory<\Database\Factories\ReporteFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'solicitudId',
        'fecha',
        'titulo',
        'descripcion',
    ];

    public function solicitud(): BelongsTo
    {
        return $this->belongsTo(Solicitud::class, 'solicitudId');
    }

    public function resolveRouteBinding($value, $field = null): ?self
    {
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $value)) {
            return static::where('id', $value)->first();
        }

        if (preg_match('/^[0-9a-f]{12}$/i', $value)) {
            return static::whereRaw('RIGHT(id::text, 12) = ?', [strtolower($value)])->first();
        }

        return null;
    }
}
