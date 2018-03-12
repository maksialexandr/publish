<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 26.02.2018
 * Time: 15:10
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Notice extends Model
{
    protected $fillable = ['id', 'user_id', 'created_at', 'updated_at', 'noticeable_id', 'noticeable_type', 'looked'];
    public $timestamps = false;
    protected $table = 'notice';

    public function noticeable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getLooked(){
        return $this->looked;
    }

}