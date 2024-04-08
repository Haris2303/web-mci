<?php

namespace App\Providers;

use App\Services\BackgroundService;
use App\Services\Impl\BackgroundServiceImpl;
use Illuminate\Support\ServiceProvider;

class BackgroundServiceProvider extends ServiceProvider
{
    public array $singletons = [
        BackgroundService::class => BackgroundServiceImpl::class
    ];

    public function provides()
    {
        return [BackgroundService::class];
    }

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
        //
    }
}
