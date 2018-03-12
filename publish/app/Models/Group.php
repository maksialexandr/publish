<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 02.03.2018
 * Time: 13:35
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Group extends Model
{

    protected $fillable = ['user_id', 'name', 'preview'];
    protected $table = 'groups';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function twits()
    {
        return $this->hasMany(Twit::class);
    }

}