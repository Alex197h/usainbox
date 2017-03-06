<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin{
    public function handle($request, Closure $next, $guard = null){
        if(!Auth::user()->is_admin) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
