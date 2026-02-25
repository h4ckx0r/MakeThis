<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'nombreFichero',
        'idSolicitud',
        'fichero',
    ];
}
