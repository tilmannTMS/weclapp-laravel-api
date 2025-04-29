<?php

namespace TilmannTMS\WeclappLaravelApi;

use Illuminate\Support\ServiceProvider;

class WeclappServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__.'/../config/weclapp.php' => config_path('weclapp.php'),
        ], 'config');
    }

    public function register()
    {
        // Merge configuration
        $this->mergeConfigFrom(__DIR__.'/../config/weclapp.php', 'weclapp');

        // Register the main class
        $this->app->singleton('weclapp', function ($app) {
            return new Weclapp($app);
        });
    }
}