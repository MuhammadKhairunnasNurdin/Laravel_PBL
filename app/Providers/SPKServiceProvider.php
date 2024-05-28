<?php

namespace App\Providers;

use App\Services\MabacServices;
use App\Services\SAWServices;
use Illuminate\Support\ServiceProvider;

class SPKServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MabacServices::class, function ($app) {
            return new MabacServices();
        });

        $this->app->singleton(SAWServices::class, function ($app) {
            return new SAWServices();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
