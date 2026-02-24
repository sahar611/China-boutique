<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PasswordOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showEmailForm()
    {
        return view('front.auth.email');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required','email','exists:users,email'],
        ]);

        $otp = (string) random_int(100000, 999999);

        PasswordOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10),
                'used' => false,
            ]
        );

        Mail::to($request->email)->send(new \App\Mail\SendOtpMail($otp));
        // لو مش عايزة تعمل Mailable دلوقتي: استخدمي view بسيطة أو Notification

        session([
            'fp_email' => $request->email,
        ]);

        return redirect()->route('front.auth.form')->with('success', __('home.otp_sent'));
    }

    public function showVerifyForm()
    {
        $email = session('fp_email');
        if (!$email) {
            return redirect()->route('front.forgot.email.form');
        }
        return view('front.auth.verify', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'otp'   => ['required','digits:6'],
        ]);

        $record = PasswordOtp::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('used', false)
            ->first();

        if (!$record || $record->expires_at->isPast()) {
            return back()->withErrors(['otp' => __('home.invalid_or_expired_otp')])->withInput();
        }

        session([
            'fp_verified' => true,
            'fp_email' => $request->email,
        ]);

        return redirect()->route('front.forgot.reset.form')->with('success', __('home.otp_verified'));
    }

    public function showResetForm()
    {
        $email = session('fp_email');
        $verified = session('fp_verified');

        if (!$email || !$verified) {
            return redirect()->route('front.forgot.email.form');
        }

        return view('front.auth.reset', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required','email','exists:users,email'],
            'password' => ['required','min:6','confirmed'], // uses password_confirmation
        ]);

        $email = session('fp_email');
        $verified = session('fp_verified');

        if (!$email || !$verified || $email !== $request->email) {
            return redirect()->route('front.forgot.email.form');
        }

        $otpRecord = PasswordOtp::where('email', $request->email)
            ->where('used', false)
            ->first();

        if (!$otpRecord || $otpRecord->expires_at->isPast()) {
            return redirect()->route('front.auth.form')->withErrors(['otp' => __('home.invalid_or_expired_otp')]);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        $otpRecord->update(['used' => true]);

        session()->forget(['fp_email','fp_verified']);

        return redirect()->route('login')->with('success', __('home.password_reset_success'));
    }
}