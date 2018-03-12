<?php

namespace App\Listeners;

use App\Events\onDeleteComment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class EventDeleteCommentListener
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
     * @param  onDeleteFriend  $event
     * @return void
     */
    public function handle(onDeleteComment $event)
    {
        $notices = $event->getComment()->notices;
        foreach ($notices as $notice)
            $notice->delete();
    }
}
