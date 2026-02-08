<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pieza extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'imagen', 'visible_catalogo'];

    protected $casts = [
        'visible_catalogo' => 'boolean',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function solicitudes(): HasMany
    {
        return $this->hasMany(SolicitudPieza::class);
    }
}
