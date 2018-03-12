<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'created_at', 'updated_at', 'birthday', 'nickname', 'confirmed',
    ];
    protected $dates = ['created_at', 'updated_at', 'birthday'];
    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'user_has_friend', 'user_id', 'friend_id');
    }

    public function comments_like()
    {
        return $this->belongsToMany(Comment::class, 'comment_likes', 'user_id', 'comment_id');
    }

    public function twits()
    {
        return $this->hasMany(Twit::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Twit::class, 'comments', 'user_id', 'twit_id');
    }

    public function twits_likes()
    {
        return $this->belongsToMany(Twit::class, 'user_has_twit_likes', 'user_id', 'twit_id');
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'user_has_subscriber', 'user_id', 'subscriber_id');
    }

    public static function hasFriends(Collection $users, $id){
        foreach ($users as $user){
            if ($user->id == $id)
                return false;
        }
        return true;
    }

    public function getCountFriends(){
        return count($this->friends);
    }

    public function getCountSubscribers(){
        return count($this->subscribers);
    }

    public function getCountPosts(){
        return count($this->posts);
    }

    public function getBirthday(){
        return $this->birthday->format('Y-m-d');
    }

    public function getStatus(){
        $last_activity = DB::table('sessions')->where('user_id', $this->id)->max('last_activity');

        if ($last_activity) {
            if ($last_activity + (60 * 5) > time())
                $status = 'Online';
            else
                $status = 'Offline';
        }
        else
            $status = 'Offline';

        return $status;
    }

    public function getUnvisibleAndVisibleNotice(){
        $notices_looked = Notice::where('looked', true)->where('user_id', $this->id)->orderBy('id', 'DESC')->get();
        $notices_unlooked = Notice::where('looked', false)->where('user_id', $this->id)->orderBy('id', 'DESC')->get();

        return ['notices_looked' => $notices_looked,
            'notices_unlooked' => $notices_unlooked,
            'count_notice' => count($notices_unlooked),
        ];
    }

}
