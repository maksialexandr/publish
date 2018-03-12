<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 14.02.2018
 * Time: 14:27
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthTwit
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user() == $request->twit->user)
            return $next($request);
        else
            return redirect('profile/' . Auth::user()->id);
    }
}