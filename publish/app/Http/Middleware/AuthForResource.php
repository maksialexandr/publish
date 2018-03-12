<?php
/**
 * Created by PhpStorm.
 * User: maksi
 * Date: 11.02.2018
 * Time: 22:37
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthForResource
{
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user() == $request->post->user)
            return $next($request);
        else
            return redirect('login');
    }
}