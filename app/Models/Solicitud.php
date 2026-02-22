<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solicitud extends Model
{
    /** @use HasFactory<\Database\Factories\SolicitudFactory> */
    use HasFactory, HasUuids;

    protected $table = "solicitudes";

    protected $fillable = [
        'userId',
        'estadoId',
        'detalles',
        '3dModelId',
        'porcentajeRelleno',
        'alturaCapa',
        'patronRelleno',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estadoId');
    }

    public function threeDModel(): BelongsTo
    {
        return $this->belongsTo(ThreeDModel::class, '3dModelId');
    }
}
