<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        if (empty(config('services.google.client_id')) || empty(config('services.google.client_secret'))) {
            return redirect()->route('login')->withErrors([
                'email' => 'Google Login belum dikonfigurasi. Isi GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET di .env.',
            ]);
        }

        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            // Common causes: missing client_id/secret, invalid redirect URI, or state mismatch.
            return redirect()->route('login')->withErrors([
                'email' => 'Login dengan Google gagal. Silakan coba lagi.',
            ]);
        }

        $email = $googleUser->getEmail();
        if (!$email) {
            return redirect()->route('login')->withErrors([
                'email' => 'Google tidak mengembalikan email. Silakan gunakan metode login lain.',
            ]);
        }

        $name = $googleUser->getName() ?: $googleUser->getNickname() ?: Str::before($email, '@');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make(Str::random(40)),
                'role' => User::ROLE_USER,
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
            ]);
        } else {
            // Link Google account to existing user (by email).
            $updates = [];

            if (empty($user->google_id)) {
                $updates['google_id'] = $googleUser->getId();
            }

            if (empty($user->email_verified_at)) {
                $updates['email_verified_at'] = now();
            }

            if (!empty($updates)) {
                $user->forceFill($updates)->save();
            }
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        // Redirect logic consistent with LoginController
        if (method_exists($user, 'isDoctor') && $user->isDoctor()) {
            return redirect()->intended(route('doctor.dashboard'));
        }

        if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->intended('/');
    }
}
