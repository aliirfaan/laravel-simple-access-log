<?php

namespace aliirfaan\LaravelSimpleAccessLog\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use aliirfaan\LaravelSimpleAccessLog\Events\LoginSucceeded;
use aliirfaan\LaravelSimpleAccessLog\Events\LoginFailed;
use aliirfaan\LaravelSimpleAccessLog\Events\LoggedOut;

class AccessLogSubscriber
{
    private $model;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = app(config('simple-access-log.access_log_model'));
    }

    public function handleAccessLogEvent($event)
    {
        $data = [
            'success' => false,
            'result' => null,
            'message' => null
        ];

        try {
            $eventData = $event->eventData;
            $insertLog = $this->model::create($eventData);
        } catch (\Exception $e) {
            report($e);
    
            $data['message'] = 'Access could not be logged.';
        }
    
        return $data;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $events->listen(
            LoginSucceeded::class,
            [AccessLogSubscriber::class, 'handleAccessLogEvent']
        );

        $events->listen(
            LoginFailed::class,
            [AccessLogSubscriber::class, 'handleAccessLogEvent']
        );

        $events->listen(
            LoggedOut::class,
            [AccessLogSubscriber::class, 'handleAccessLogEvent']
        );
    }
}
