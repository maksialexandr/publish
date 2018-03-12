<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 01.03.2018
 * Time: 14:00
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHasTwitLikes extends Model
{

    protected $fillable = ['id', 'user_id', 'twit_id'];
    public $timestamps = false;
    protected $table = 'user_has_twit_likes';

    public function notices()
    {
        return $this->morphMany('App\Models\Notice', 'noticeable');
    }

    public function getUser(){
        return User::find($this->user_id);
    }

    public function getTwit(){
        return Twit::find($this->twit_id);
    }

}