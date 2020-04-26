<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLoginEmployer
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
        if(Auth::check()) {
            if(!Auth::user()->is_employee) {
                return $next($request);
            }
            else {
                return redirect()->route('profile');
            }

        }
        else {
            return redirect()->route('index');
        }
    }
}
