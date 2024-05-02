<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsNotAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('Authorization')) {
            return response('Header not found', 400);
        }

        $token = $request->header('Authorization');
        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            abort(401);
        }

        if ($user->roles[0]->name == 'admin') {
            abort(403);
        }

        return $next($request);
    }
}
