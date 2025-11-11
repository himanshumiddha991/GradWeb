<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('web')->check()){
            return redirect()->route('login');
        }
        return $next($request);
    }
}
