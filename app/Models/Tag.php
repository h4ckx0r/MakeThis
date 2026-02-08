<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['nombre'];

    public function piezas(): BelongsToMany
    {
        return $this->belongsToMany(Pieza::class);
    }
}
