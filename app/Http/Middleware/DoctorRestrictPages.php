<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DoctorRestrictPages
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Only apply restriction for doctor role; admins unaffected
        if (! $user || ! method_exists($user, 'isDoctor') || ! $user->isDoctor()) {
            return $next($request);
        }

        // Pages protected by this rule
        $protected = [
            'rawat.jalan',
            'emr',
            'procedures.index',
        ];

        $routeName = $request->route() ? $request->route()->getName() : null;

        // If current route is not one of the protected pages, allow
        if (! $routeName || ! in_array($routeName, $protected)) {
            return $next($request);
        }

        $allowed = session('doctor_allowed');

        // If no allowed page yet, set current as allowed and proceed
        if (! $allowed) {
            session(['doctor_allowed' => $routeName]);
            return $next($request);
        }

        // If allowed matches current route, proceed
        if ($allowed === $routeName) {
            return $next($request);
        }

        // Otherwise redirect to allowed page
        return redirect()->route($allowed)->with('warning', 'Anda hanya boleh membuka halaman yang dipilih.');
    }
}
