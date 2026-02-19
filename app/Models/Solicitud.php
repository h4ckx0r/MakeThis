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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estadoId');
    }
}
