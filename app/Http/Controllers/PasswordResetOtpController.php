<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class PasswordResetOtpController extends Controller
{
    private const OTP_TTL = 600;       // 10 minutos
    private const ATTEMPTS_TTL = 1800; // 30 minutos
    private const SENDS_TTL = 3600;    // 60 minutos
    private const MAX_ATTEMPTS = 5;
    private const MAX_SENDS = 3;

    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower($request->email);

        $sendsKey = "password_reset_sends:{$email}";
        $sends = Cache::get($sendsKey, 0);

        if ($sends >= self::MAX_SENDS) {
            return back()->withErrors([
                'email' => 'Has solicitado demasiados códigos. Inténtalo de nuevo más tarde.',
            ])->withInput();
        }

        $user = User::where('email', $email)->first();

        // Siempre guardar email en sesión y redirigir (anti-enumeración)
        $request->session()->put('password_reset_email', $email);

        if ($user) {
            $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            Cache::put("password_reset_otp:{$email}", $code, self::OTP_TTL);
            Cache::forget("password_reset_attempts:{$email}");
            Cache::put($sendsKey, $sends + 1, self::SENDS_TTL);

            Mail::to($email)->send(new PasswordResetOtpMail($code, $user->nombre));
        }

        return redirect()->route('password.verifyForm')
            ->with('status', 'Si el email existe en nuestro sistema, recibirás un código de verificación.');
    }

    public function showVerifyForm(Request $request)
    {
        if (!$request->session()->has('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp', [
            'email' => $request->session()->get('password_reset_email'),
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $email = $request->session()->get('password_reset_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        $attemptsKey = "password_reset_attempts:{$email}";
        $attempts = Cache::get($attemptsKey, 0);

        if ($attempts >= self::MAX_ATTEMPTS) {
            Cache::forget("password_reset_otp:{$email}");
            $request->session()->forget('password_reset_email');

            return redirect()->route('password.request')
                ->withErrors(['email' => 'Demasiados intentos fallidos. Solicita un nuevo código.']);
        }

        $storedCode = Cache::get("password_reset_otp:{$email}");

        if (!$storedCode || $storedCode !== $request->code) {
            Cache::put($attemptsKey, $attempts + 1, self::ATTEMPTS_TTL);

            $remaining = self::MAX_ATTEMPTS - $attempts - 1;
            return back()->withErrors([
                'code' => "Código incorrecto. Te quedan {$remaining} intentos.",
            ]);
        }

        // Código correcto
        Cache::forget("password_reset_otp:{$email}");
        Cache::forget("password_reset_attempts:{$email}");
        $request->session()->put('password_reset_verified', true);

        return redirect()->route('password.resetForm');
    }

    public function resendOtp(Request $request)
    {
        $email = $request->session()->get('password_reset_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        $sendsKey = "password_reset_sends:{$email}";
        $sends = Cache::get($sendsKey, 0);

        if ($sends >= self::MAX_SENDS) {
            return back()->withErrors([
                'code' => 'Has solicitado demasiados códigos. Inténtalo de nuevo más tarde.',
            ]);
        }

        $user = User::where('email', $email)->first();

        if ($user) {
            $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            Cache::put("password_reset_otp:{$email}", $code, self::OTP_TTL);
            Cache::forget("password_reset_attempts:{$email}");
            Cache::put($sendsKey, $sends + 1, self::SENDS_TTL);
            Mail::to($email)->send(new PasswordResetOtpMail($code, $user->nombre));
        }

        return back()->with('status', 'Se ha enviado un nuevo código a tu correo electrónico.');
    }

    public function showResetForm(Request $request)
    {
        if (!$request->session()->get('password_reset_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password-otp');
    }

    public function resetPassword(Request $request)
    {
        if (!$request->session()->get('password_reset_verified')) {
            return redirect()->route('password.request');
        }

        $request->validate([
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ]);

        $email = $request->session()->get('password_reset_email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request');
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->save();

        // Limpiar sesión y cache
        $request->session()->forget(['password_reset_email', 'password_reset_verified']);
        Cache::forget("password_reset_sends:{$email}");

        return redirect()->route('auth.login')
            ->with('status', 'Tu contraseña ha sido actualizada correctamente. Inicia sesión con tu nueva contraseña.');
    }
}
