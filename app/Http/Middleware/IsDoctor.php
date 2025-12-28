<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDoctor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        // allow admin as well, since admins should see doctor pages
        if (! $user || ! method_exists($user, 'isDoctor') || (! $user->isDoctor() && ! $user->isAdmin())) {
            abort(403, 'Akses ditolak. Hanya dokter atau admin.');
        }

        return $next($request);
    }
}
