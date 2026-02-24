<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $fillable = [
        'key_hash',
        'descripcion',
        'activa',
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    /**
     * Devuelve todas las keys activas.
     */
    public static function getActive(): ?self
    {
        return self::where('activa', true)->latest()->first();
    }

    /**
     * Valida una key en texto plano contra TODAS las keys activas.
     * Así funcionan múltiples keys simultáneas.
     */
    public static function validate(string $plainKey): bool
    {
        $hash = hash('sha256', $plainKey);

        return self::where('activa', true)
            ->get()
            ->contains(fn ($key) => hash_equals($key->key_hash, $hash));
    }
}
