<?php

namespace App\Providers;

use App\Services\Impl\ProjectServiceImpl;
use App\Services\ProjectService;
use Illuminate\Support\ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{
    public array $singletons = [
        ProjectService::class => ProjectServiceImpl::class
    ];

    public function provides()
    {
        return [ProjectService::class];
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
