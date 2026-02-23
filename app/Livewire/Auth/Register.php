<?php

namespace App\Livewire\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Mail\EmailVerificationMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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

    public bool $emailVerified = false;
    public bool $verificationSent = false;
    public string $verificationStatus = '';
    public bool $polling = false;

    public function sendVerificationEmail(): void
    {
        $this->validate([
            'email' => ['required', 'email', Rule::unique(User::class)],
        ]);

        $throttleKey = 'reg-verify-' . Str::lower($this->email);

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('email', "Demasiados intentos. Espera {$seconds} segundos.");
            return;
        }

        RateLimiter::hit($throttleKey, 3600);

        $token = Str::random(64);
        cache()->put("reg_verify_token_{$token}", $this->email, now()->addMinutes(30));

        Mail::to($this->email)->send(new EmailVerificationMail(
            link: route('register.verify-email', ['token' => $token]),
            nombre: $this->nombre ?: $this->email,
        ));

        $this->verificationSent = true;
        $this->verificationStatus = 'sent';
        $this->polling = true;
    }

    public function checkVerification(): void
    {
        if (! $this->polling || $this->emailVerified) {
            return;
        }

        $hash = hash('sha256', $this->email);

        if (cache("reg_email_ok_{$hash}")) {
            cache()->forget("reg_email_ok_{$hash}");
            $this->emailVerified = true;
            $this->verificationStatus = 'verified';
            $this->polling = false;
        }
    }

    public function updatedEmail(): void
    {
        $this->emailVerified = false;
        $this->verificationSent = false;
        $this->verificationStatus = '';
        $this->polling = false;
    }

    public function register(): void
    {
        if (! $this->emailVerified) {
            $this->addError('email', 'Debes verificar tu correo antes de registrarte.');
            return;
        }

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

        $this->redirect(config('fortify.home', '/'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
