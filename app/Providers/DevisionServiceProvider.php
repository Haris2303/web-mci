<?php

namespace App\Providers;

use App\Services\DevisionService;
use App\Services\Impl\DevisionServiceImpl;
use Illuminate\Support\ServiceProvider;

class DevisionServiceProvider extends ServiceProvider
{

    public array $singletons = [
        DevisionService::class => DevisionServiceImpl::class
    ];

    public function provides()
    {
        return [DevisionService::class];
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
