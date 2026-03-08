<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RoleSessionManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register RoleSessionManager as a singleton
        $this->app->singleton(RoleSessionManager::class, function ($app) {
            return new RoleSessionManager();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
