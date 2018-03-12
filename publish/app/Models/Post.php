<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['name', 'content', 'user_id'];
    //public $timestamps = false;
    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDate(){
        return $this->updated_at->format('j F Y');
    }

}
