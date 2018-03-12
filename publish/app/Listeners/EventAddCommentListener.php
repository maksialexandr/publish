<?php

namespace App\Listeners;

use App\Events\onAddComment;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventAddCommentListener
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
     * @param  onAddFriend  $event
     * @return void
     */
    public function handle(onAddComment $event)
    {
        if ($event->getUser() != Auth::user()) {
            $notice = new Notice();
            $notice->user()->associate($event->getUser());
            $event->getComment()->notices()->save($notice);
        }
        $users = $this->getUsersResponse($event->getComment());
        if (!empty($users)){
            foreach ($users as $user){
                if ($event->getUser() != $user) {
                    $notice = new Notice();
                    $notice->user()->associate($user);
                    $event->getComment()->notices()->save($notice);
                }
            }
        }
    }

    protected function getUsersResponse($comment){
        $nickname = $this->getNicknameResponse($comment->comment);
        foreach ($nickname[0] as &$nick)
            $nick = str_replace('@','',$nick);
        $users = User::whereIn('nickname', $nickname[0])->get();

        return $users;
    }

    private function getNicknameResponse($string){
        preg_match_all("(\@[a-zA-Z\_\-]*)", $string, $nickname);
        return $nickname;
    }

}
