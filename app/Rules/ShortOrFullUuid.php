<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ShortOrFullUuid implements ValidationRule
{
    public function __construct(
        private string $table,
        private string $column = 'id'
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $value)) {
            if (! DB::table($this->table)->where($this->column, $value)->exists()) {
                $fail('El :attribute no existe.');
            }
            return;
        }

        if (preg_match('/^[0-9a-f]{12}$/i', $value)) {
            if (! DB::table($this->table)->whereRaw("RIGHT({$this->column}::text, 12) = ?", [strtolower($value)])->exists()) {
                $fail('El :attribute no existe.');
            }
            return;
        }

        $fail('El :attribute debe ser un UUID completo o un short ID de 12 caracteres.');
    }

    public static function resolveToFullUuid(string $table, string $value, string $column = 'id'): ?string
    {
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $value)) {
            return $value;
        }

        if (preg_match('/^[0-9a-f]{12}$/i', $value)) {
            $row = DB::table($table)
                ->selectRaw("{$column}::text as uuid")
                ->whereRaw("RIGHT({$column}::text, 12) = ?", [strtolower($value)])
                ->first();

            return $row?->uuid;
        }

        return null;
    }
}
