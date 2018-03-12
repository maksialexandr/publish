<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 01.03.2018
 * Time: 16:21
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{

    public function index(){

        $notice = Auth::user()->getUnvisibleAndVisibleNotice();

        $params = $notice;
        $params['user'] = Auth::user();

        return view('message.index', $params);
    }

}