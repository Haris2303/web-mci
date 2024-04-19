<?php

namespace App\Providers;

use App\Services\GalleryService;
use App\Services\Impl\GalleryServiceImpl;
use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider
{
    public array $singletons = [
        GalleryService::class => GalleryServiceImpl::class
    ];

    public function provides()
    {
        return [GalleryService::class];
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
