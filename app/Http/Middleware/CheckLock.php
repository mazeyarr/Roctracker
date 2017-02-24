<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckLock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (self::check()){
            return redirect()->route('lockscreen');
        }
        return $next($request);
    }

    public static function check () {
        if (Session::has('locked') && !empty(Session::get('locked'))) {
            return true;
        }
        return false;
    }
}
