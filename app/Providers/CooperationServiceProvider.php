<?php

namespace App\Providers;

use App\Services\CooperationService;
use App\Services\Impl\CooperationServiceImpl;
use Illuminate\Support\ServiceProvider;

class CooperationServiceProvider extends ServiceProvider
{

    public array $singletons = [
        CooperationService::class => CooperationServiceImpl::class
    ];

    public function provides()
    {
        return [CooperationService::class];
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
