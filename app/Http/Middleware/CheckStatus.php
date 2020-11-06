<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$status)
    {
        if(in_array($request->user()->status,$status)){
            return $next($request);
        }
            return redirect()->back()->withErrors(['warning' => 'Maaf akun anda telah Nonaktif']);
    }
}
