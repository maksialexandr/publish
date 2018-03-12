<?php

namespace App\Http\Controllers;

use App\Models\Twit;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\HashTag;

class SearchController extends Controller
{
    public function index(Request $request){
        $users = User::where('name', 'LIKE', '%'.$request->name.'%')->get();

        $notice = Auth::user()->getUnvisibleAndVisibleNotice();

        $params = $notice;
        $params['user'] = Auth::user();
        $params['users'] = $users;

        return view('search.index', $params);
    }

    public function getTwitByHashTag(Request $request){
        $twits = [];
        $hts = HashTag::where('name', '=', $request->name)->get();
        foreach ($hts as $hs)
            $twits[] = $hs->twit;

        $notice = Auth::user()->getUnvisibleAndVisibleNotice();

        $params = $notice;
        $params['user'] = Auth::user();
        $params['twits'] = $twits;

        return view('search.twits', $params);
    }

}
