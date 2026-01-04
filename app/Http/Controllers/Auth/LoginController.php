<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Check if input is email or username
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $credentials = [
            $fieldType => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            // Redirect doctor users to doctor dashboard, admins to admin dashboard
            if (method_exists($user, 'isDoctor') && $user->isDoctor()) {
                return redirect()->intended(route('doctor.dashboard'));
            }

            if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
                return redirect()->intended(route('dashboard'));
            }

            // Fallback: arahkan ke beranda (sama seperti register)
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email/username atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Setelah logout kembalikan ke halaman beranda
        return redirect('/');
    }
}
