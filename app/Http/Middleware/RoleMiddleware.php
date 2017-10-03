<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {

        if(!Auth::check()){
           return redirect('home');
        }

        if(!$request->user()->hasRole($role)){
            return redirect()->back();
        }
        return $next($request);
    }
}