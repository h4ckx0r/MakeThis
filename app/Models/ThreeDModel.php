<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThreeDModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'three_d_models';

    protected $fillable = [
        'nombreModelo',
        'tipo',
        'modelo',
        'colorId',
    ];

    /**
     * Get the color associated with the model.
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class , 'colorId');
    }
}