<?php

namespace aliirfaan\LaravelSimpleAccessLog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use aliirfaan\LaravelSimpleAccessLog\Listeners\AccessLogSubscriber;

class EventServiceProvider extends ServiceProvider
{
    protected $subscribe = [
        AccessLogSubscriber::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
