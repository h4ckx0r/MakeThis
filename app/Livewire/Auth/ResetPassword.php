<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ResetPassword extends Component
{
    public string $password = '';
    public string $password_confirmation = '';

    public function mount()
    {
        $verifiedAt = session('password_reset_verified');

        if (! $verifiedAt || (now()->timestamp - $verifiedAt) > 600) {
            session()->forget(['password_reset_email', 'password_reset_verified']);
            return $this->redirect(route('password.request'), navigate: false);
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ]);

        $email = session('password_reset_email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            return $this->redirect(route('password.request'), navigate: false);
        }

        $user->forceFill([
            'password' => Hash::make($this->password),
        ])->save();

        Cache::forget("password_reset_sends:{$email}");

        session()->invalidate();
        session()->regenerateToken();

        session()->flash('status', 'Tu contraseña ha sido actualizada correctamente. Inicia sesión con tu nueva contraseña.');
        return $this->redirect(route('login'), navigate: false);
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
