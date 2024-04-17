<?php

namespace App\Providers;

use App\Providers\Guard\TokenGuard;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Auth::extend('token', function (Application $app, string $name, array $config) {
            $tokenGuard = new TokenGuard(Auth::createUserProvider($config['provider']), $app->make(Request::class));
            $app->refresh('request', $tokenGuard, 'setRequest');
            return $tokenGuard;
        });
    }
}
