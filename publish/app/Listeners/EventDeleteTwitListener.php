<?php

namespace App\Listeners;

use App\Events\onDeleteTwit;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventDeleteTwitListener
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
     * @param  onDeleteTwit  $event
     * @return void
     */
    public function handle(onDeleteTwit $event)
    {
        //
    }
}
