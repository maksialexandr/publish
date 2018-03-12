<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Twit extends Model
{
    protected $fillable = ['content', 'twit_id', 'picture'];
    //public $timestamps = false;
    protected $table = 'twits';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function hash_tags()
    {
        return $this->hasMany(HashTag::class);
    }

    public function reposts()
    {
        return $this->hasMany(Twit::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function twit()
    {
        return $this->belongsTo(Twit::class);
    }

    public function users_comment()
    {
        return $this->belongsToMany(User::class, 'comments', 'twit_id', 'user_id')->withPivot('comment', 'created_at');
    }

    public function users_likes()
    {
        return $this->belongsToMany(User::class, 'user_has_twit_likes', 'twit_id', 'user_id');
    }

    public function getCountRepost(){
        return count($this->reposts);
    }

    public function hasUserTwit($user){
        foreach ($this->reposts as $twit)
            if ($twit->user->id == $user->id)
                return true;
        return false;
    }

    public function getDate(){
        return $this->created_at->format('j F Y G:i');
    }

    public function getDateTwitShare(){
        return Twit::find($this->twit_id)->created_at->format('j F Y G:i');
    }

    public function getUserByTwitShareId(){
        return Twit::find($this->twit_id)->user;
    }

    public function getCountLikes(){
        return count($this->users_likes);
    }

    public function hasUserLike($user){
        foreach ($this->users_likes as $us)
            if ($us->id == $user->id)
                return true;
        return false;
    }

    public function getComments(){
        return Comment::where('twit_id', $this->id)->orderBy('created_at')->get();
    }
}