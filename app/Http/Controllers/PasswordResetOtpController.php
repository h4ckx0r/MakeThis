<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetOtpController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function showVerifyForm(Request $request)
    {
        if (!$request->session()->has('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp');
    }

    public function showResetForm(Request $request)
    {
        if (!$request->session()->get('password_reset_verified')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password-otp');
    }
}
