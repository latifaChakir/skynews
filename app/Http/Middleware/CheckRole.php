<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié et a le rôle avec l'ID spécifié
        if (Auth::check() && Auth::user()->role_id === 1) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have permission to access this page.');
    }
}
