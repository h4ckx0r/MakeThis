<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PiezaCatalogo extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pieza_catalogos';

    protected $fillable = [
        'nombre',
        'adjuntoId',
        'colorId',
    ];

    /**
     * Get the adjunto associated with the pieza.
     */
    public function adjunto(): BelongsTo
    {
        return $this->belongsTo(Adjunto::class, 'adjuntoId');
    }

    /**
     * Get the color associated with the pieza.
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'colorId');
    }

    /**
     * Get the tags associated with the pieza.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'pieza_catalogo_tag', 'id_PiezaCatalogo', 'id_tag');
    }
}
