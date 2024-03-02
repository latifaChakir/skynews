<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class JwtAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

            if (!$request->session()->has('token')) {
                return redirect('/login');
            }

            $token = $request->session()->get('token');

            try {
                // Decode the JWT token
                $user = JWTAuth::parseToken($token)->authenticate();


                // Find the user by user ID


                if (!$user) {
                    // If user not found, redirect to login
                    return redirect('/login');
                }

                // Authenticate the user
                Auth::login($user);

                return $next($request);
            } catch (\Exception $e) {
                // Handle JWT decoding errors
                return redirect('/login');
            }

    }
}
