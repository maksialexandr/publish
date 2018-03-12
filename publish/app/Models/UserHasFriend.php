<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 01.03.2018
 * Time: 0:01
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasFriend extends Model
{
    protected $fillable = ['id', 'user_id', 'friend_id'];
    public $timestamps = false;
    protected $table = 'user_has_friend';

    public function notices()
    {
        return $this->morphMany('App\Models\Notice', 'noticeable');
    }

    public function getUser(){
        return User::find($this->user_id);
    }

}