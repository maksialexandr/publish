<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 15.02.2018
 * Time: 16:02
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language  extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    protected $table = 'language';

}