<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the token from the Authorization header
        $token = $request->header('Authorization');
        $authenticate = true;

        // Check if the token does not exist
        if (!$token) {
            $authenticate = false;
        }

        // Attempt to find the user by their remember token
        $user = User::where('remember_token', $token)->first();
        if (!$user) {
            // If no user is found, authentication fails
            $authenticate = false;
        } else {
            // If a user is found, log them in
            Auth::login($user);
        }

        // If authentication is successful, proceed with the request
        // Otherwise, abort with a 401 Unauthorized response
        if ($authenticate) {
            return $next($request);
        } else {
            return abort(401);
        }
    }
}
