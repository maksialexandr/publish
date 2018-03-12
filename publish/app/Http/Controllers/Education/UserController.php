<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index(){

        return view('education.user.index');
    }

}