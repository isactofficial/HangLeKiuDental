<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (! $user || ! method_exists($user, 'isAdmin') || ! $user->isAdmin()) {
            // If the user is a doctor, redirect them to the doctor dashboard instead of showing 403
            if ($user && method_exists($user, 'isDoctor') && $user->isDoctor()) {
                return redirect()->route('doctor.dashboard');
            }

            abort(403, 'Akses ditolak. Hanya admin.');
        }

        return $next($request);
    }
}
