<?php

namespace App\Livewire\Auth;

use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class VerifyOtp extends Component
{
    private const OTP_TTL = 600;
    private const ATTEMPTS_TTL = 1800;
    private const SENDS_TTL = 3600;
    private const MAX_ATTEMPTS = 5;
    private const MAX_SENDS = 3;

    public string $code = '';
    public string $email = '';
    public string $statusMessage = '';

    public function mount()
    {
        $this->email = session('password_reset_email', '');

        if (! $this->email) {
            return $this->redirect(route('password.request'), navigate: false);
        }
    }

    public function verifyOtp()
    {
        $this->validate([
            'code' => 'required|string|size:6',
        ]);

        $attemptsKey = "password_reset_attempts:{$this->email}";
        $attempts = Cache::get($attemptsKey, 0);

        if ($attempts >= self::MAX_ATTEMPTS) {
            Cache::forget("password_reset_otp:{$this->email}");
            session()->forget('password_reset_email');

            session()->flash('error', 'Demasiados intentos fallidos. Solicita un nuevo código.');
            return $this->redirect(route('password.request'), navigate: false);
        }

        $storedCode = Cache::get("password_reset_otp:{$this->email}");

        if (! $storedCode || $storedCode !== $this->code) {
            Cache::put($attemptsKey, $attempts + 1, self::ATTEMPTS_TTL);
            $remaining = self::MAX_ATTEMPTS - $attempts - 1;
            $this->addError('code', "Código incorrecto. Te quedan {$remaining} intentos.");
            return;
        }

        Cache::forget("password_reset_otp:{$this->email}");
        Cache::forget("password_reset_attempts:{$this->email}");
        session()->put('password_reset_verified', true);

        return $this->redirect(route('password.resetForm'), navigate: false);
    }

    public function resendOtp()
    {
        $sendsKey = "password_reset_sends:{$this->email}";
        $sends = Cache::get($sendsKey, 0);

        if ($sends >= self::MAX_SENDS) {
            $this->addError('code', 'Has solicitado demasiados códigos. Inténtalo de nuevo más tarde.');
            return;
        }

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            Cache::put("password_reset_otp:{$this->email}", $code, self::OTP_TTL);
            Cache::forget("password_reset_attempts:{$this->email}");
            Cache::put($sendsKey, $sends + 1, self::SENDS_TTL);
            Mail::to($this->email)->send(new PasswordResetOtpMail($code, $user->nombre));
        }

        $this->statusMessage = 'Se ha enviado un nuevo código a tu correo electrónico.';
    }

    public function render()
    {
        return view('livewire.auth.verify-otp');
    }
}
