<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
