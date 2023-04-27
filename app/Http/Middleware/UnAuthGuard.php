<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UnAuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //Agr id h to janay dena h 
        if(session()->has('user_id')){
            return $next($request);
        }else{
            return redirect()->route('home');
        }
    }
}
