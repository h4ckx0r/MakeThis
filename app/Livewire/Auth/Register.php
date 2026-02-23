<?php

namespace App\Livewire\Auth;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public string $nombre = '';
    public string $apellidos = '';
    public string $telefono = '';
    public string $direccion = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $turnstileResponse = '';

    public function register()
    {
        $user = app(CreateNewUser::class)->create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'cf-turnstile-response' => $this->turnstileResponse,
        ]);

        Auth::login($user);
        session()->regenerate();

        return $this->redirect(config('fortify.home', '/'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
