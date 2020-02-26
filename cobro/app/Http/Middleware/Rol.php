<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Rol
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
      /*
      if (Auth::check()) {
        if (Auth::user()->rol=='admin') {
          return $next($request);
       }
     }
      else {
         return redirect('login');
      }*/
      return $next($request);
    }
}