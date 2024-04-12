<?php

namespace App\Providers;

use App\Services\Impl\VisionMisionServiceImpl;
use App\Services\VisionMisionService;
use Illuminate\Support\ServiceProvider;

class VisionMisionServiceProvider extends ServiceProvider
{
    public array $singletons = [
        VisionMisionService::class => VisionMisionServiceImpl::class
    ];

    public function provides()
    {
        return [VisionMisionService::class];
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
