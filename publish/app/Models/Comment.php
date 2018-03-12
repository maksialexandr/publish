<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 16.02.2018
 * Time: 23:17
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Comment extends Model
{
    protected $fillable = ['id', 'comment', 'user_id', 'created_at', 'twit_id'];
    //public $timestamps = false;
    protected $table = 'comments';

    public function notices()
    {
        return $this->morphMany('App\Models\Notice', 'noticeable');
    }

    public function twit(){
        return $this->belongsTo(Twit::class);
    }

    public function getUser(){
        return User::find($this->user_id);
    }
    public function users_like()
    {
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id');
    }

    public function getCountLikes(){
        return count($this->users_like);
    }

    public function hasUserLike($user){
        foreach ($this->users_like as $us)
            if ($us->id == $user->id)
                return true;
        return false;
    }

    public function isUserComment($user){
        if ($this->user_id == $user->id)
            return true;
        return false;
    }

}