<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\onAddComment' => [
            'App\Listeners\EventAddCommentListener',
        ],
        'App\Events\onDeleteComment' => [
            'App\Listeners\EventDeleteCommentListener',
        ],
        'App\Events\onVisibleNotice' => [
            'App\Listeners\EventVisibleNoticeListener',
        ],
        'App\Events\onDeleteTwit' => [
            'App\Listeners\EventDeleteTwitListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
