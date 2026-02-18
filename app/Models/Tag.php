<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nombre',
    ];

    /**
     * Get the piezas catalogo associated with the tag.
     */
    public function piezaCatalogos(): BelongsToMany
    {
        return $this->belongsToMany(PiezaCatalogo::class, 'pieza_catalogo_tag', 'id_tag', 'id_PiezaCatalogo');
    }
}
