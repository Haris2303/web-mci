<?php

namespace App\Providers;

use App\Models\Background;
use App\Models\Devision;
use App\Models\LeadershipStructure;
use App\Models\VisionMision;
use App\Policies\BackgroundPolicy;
use App\Policies\DevisionPolicy;
use App\Policies\LeadershipStrcuturePolicy;
use App\Policies\VisionMisionPolicy;
use App\Providers\Guard\TokenGuard;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Background::class => BackgroundPolicy::class,
        VisionMision::class => VisionMisionPolicy::class,
        Devision::class => DevisionPolicy::class,
        LeadershipStructure::class => LeadershipStrcuturePolicy::class
    ];

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
