<?php

namespace App\Listeners;

use App\Events\onVisibleNotice;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventVisibleNoticeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  onVisibleNotice  $event
     * @return void
     */
    public function handle(onVisibleNotice $event)
    {

    }
}
