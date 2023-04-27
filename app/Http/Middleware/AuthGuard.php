<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthGuard
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
         //Agr id nhi h to nhi janay dena
         if(session()->has('user_id')){
            return redirect()->route('home');
        }else{
            return $next($request);
        }
    }
}
