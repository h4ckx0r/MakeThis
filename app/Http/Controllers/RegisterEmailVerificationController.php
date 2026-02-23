<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class RegisterEmailVerificationController extends Controller
{
    public function verify(string $token): View
    {
        $email = cache("reg_verify_token_{$token}");

        if (! $email) {
            return view('auth.email-verified', ['success' => false]);
        }

        cache()->forget("reg_verify_token_{$token}");
        cache()->put('reg_email_ok_' . hash('sha256', $email), true, now()->addMinutes(60));

        return view('auth.email-verified', ['success' => true]);
    }
}
