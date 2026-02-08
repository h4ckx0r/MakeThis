<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SolicitudPieza extends Model
{
    protected $table = 'solicitudes_piezas';

    protected $fillable = [
        'user_id',
        'pieza_id',
        'tipo',
        'material',
        'color',
        'indicaciones',
        'estado',
        'archivo_3d',
        'config_recomendada',
        'altura_capa',
        'porcentaje_relleno',
        'patron_relleno',
        'imagenes',
        'incluye_modelo_3d',
        'incluye_pieza',
    ];

    protected $casts = [
        'config_recomendada' => 'boolean',
        'incluye_modelo_3d' => 'boolean',
        'incluye_pieza' => 'boolean',
        'imagenes' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pieza(): BelongsTo
    {
        return $this->belongsTo(Pieza::class);
    }
}
