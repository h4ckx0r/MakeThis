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
}
