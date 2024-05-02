<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('X-TOKEN');
        $authenticate = true;

        // Check if the token does not exist
        if (!$token) {
            $authenticate = false;
        }

        // Attempt to find the user by their remember token
        $user = User::where('remember_token', $token)->first();
        if (!$user) {
            // If no user is found, authentication fails and logout
            $authenticate = false;
            Auth::logout();
        } else {
            if ($user->roles[0]->name !== 'admin') {
                return redirect()->to('/login')->with('failed', 'Anda');
            }
            // If a user is found, log them in
            Auth::login($user);
        }

        // If authentication is successful, proceed with the request
        // Otherwise, abort with a 401 Unauthorized response
        if ($authenticate) {
            return $next($request);
        } else {
            return redirect()->to('/administrator/login');
        }
    }
}
