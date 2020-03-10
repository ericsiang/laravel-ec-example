<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {   
        //dd($guard);
         //後台管理員
        if ($guard == "account" && Auth::guard($guard)->check()) {
            return redirect('/manager/accounts');
        }

        //前台會員
        if ($guard == "user_account" && Auth::guard($guard)->check()) {
            return redirect('/');
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }

}
