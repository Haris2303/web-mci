<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        return view('admin.login.index');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $response = Http::post('http://localhost:8000/api/users/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($response->status() === 401) {
            $response = json_decode($response);
            return response()->redirectTo('/administrator/login')->withErrors(['message' => $response->errors->message]);
        }

        if ($response->ok()) {
            $response = json_decode($response);

            Cookie::queue('X-TOKEN', $response->data->remember_token, 500);

            return response()->redirectTo('/dashboard/admin');
        }

        return redirect('/kocak');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->withoutCookie('X-TOKEN');
    }
}
