<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $throttleKey = Str::transliterate(Str::lower($this->email) . '|' . request()->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('email', __('auth.throttle', ['seconds' => $seconds]));
            return;
        }

        if (! Auth::validate(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::hit($throttleKey);
            $this->addError('email', __('auth.failed'));
            return;
        }

        RateLimiter::clear($throttleKey);

        $user = Auth::getProvider()->retrieveByCredentials(['email' => $this->email]);

        // Si el usuario tiene 2FA habilitado, redirigir al challenge
        if ($user->two_factor_secret && $user->two_factor_confirmed_at) {
            session()->regenerate();
            session(['login.id' => $user->getKey(), 'login.remember' => $this->remember]);
            return $this->redirect(route('two-factor.login'), navigate: false);
        }

        Auth::login($user, $this->remember);
        session()->regenerate();

        return $this->redirect(config('fortify.home', '/'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
