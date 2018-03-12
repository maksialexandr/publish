<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 19.02.2018
 * Time: 23:13
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HashTag extends Model
{
    protected $fillable = ['name', 'twit_id'];
    public $timestamps = false;
    protected $table = 'hash_tags';

    public function twit()
    {
        return $this->belongsTo(Twit::class);
    }

}