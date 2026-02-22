<?php

namespace App\Livewire\Auth;

use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ForgotPassword extends Component
{
    private const OTP_TTL = 600;
    private const SENDS_TTL = 3600;
    private const MAX_SENDS = 3;

    public string $email = '';

    public function sendOtp()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $email = strtolower($this->email);

        $sendsKey = "password_reset_sends:{$email}";
        $sends = Cache::get($sendsKey, 0);

        if ($sends >= self::MAX_SENDS) {
            $this->addError('email', 'Has solicitado demasiados códigos. Inténtalo de nuevo más tarde.');
            return;
        }

        session()->put('password_reset_email', $email);

        $user = User::where('email', $email)->first();

        if ($user) {
            $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            Cache::put("password_reset_otp:{$email}", $code, self::OTP_TTL);
            Cache::forget("password_reset_attempts:{$email}");
            Cache::put($sendsKey, $sends + 1, self::SENDS_TTL);

            Mail::to($email)->send(new PasswordResetOtpMail($code, $user->nombre));
        }

        return $this->redirect(
            route('password.verifyForm'),
            navigate: false,
        );
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
