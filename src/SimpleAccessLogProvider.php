<?php

namespace aliirfaan\LaravelSimpleAccessLog;

use Illuminate\Support\ServiceProvider;
use aliirfaan\LaravelSimpleAccessLog\Providers\EventServiceProvider;

class SimpleAccessLogProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/simple-access-log.php' => config_path('simple-access-log.php'),
        ]);
    }
}
