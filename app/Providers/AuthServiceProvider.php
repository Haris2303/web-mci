<?php

namespace App\Providers;

use App\Models\AboutUs;
use App\Models\Background;
use App\Models\Cooperation;
use App\Models\Devision;
use App\Models\Gallery;
use App\Models\LeadershipStructure;
use App\Models\Project;
use App\Models\VisionMision;
use App\Policies\AboutUsPolicy;
use App\Policies\BackgroundPolicy;
use App\Policies\CooperationPolicy;
use App\Policies\DevisionPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\LeadershipStrcuturePolicy;
use App\Policies\LeadershipStructurePolicy;
use App\Policies\ProjectPolicy;
use App\Policies\VisionMisionPolicy;
use App\Providers\Guard\TokenGuard;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Background::class => BackgroundPolicy::class,
        VisionMision::class => VisionMisionPolicy::class,
        Devision::class => DevisionPolicy::class,
        LeadershipStructure::class => LeadershipStructurePolicy::class,
        Cooperation::class => CooperationPolicy::class,
        Gallery::class => GalleryPolicy::class,
        Project::class => ProjectPolicy::class,
        AboutUs::class => AboutUsPolicy::class,
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
