<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use RyanChandler\LaravelCloudflareTurnstile\Rules\Turnstile;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
            'cf-turnstile-response' => ['required', new Turnstile()],
        ], [
            'cf-turnstile-response.required' => 'Debes completar la verificación de seguridad.',
            'cf-turnstile-response' => 'La verificación de seguridad ha fallado. Inténtalo de nuevo.',
        ])->validate();

        $isFirstUser = User::query()->count() < 1;

        $user = User::create([
            'nombre' => $input['nombre'],
            'apellidos' => $input['apellidos'],
            'telefono' => $input['telefono'],
            'direccion' => $input['direccion'] ?? null,
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        if ($isFirstUser) {
            $user->isAdmin = true;
            $user->save();
        }

        return $user;
    }
}