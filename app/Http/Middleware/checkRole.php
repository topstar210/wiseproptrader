<?php

namespace App\Http\Middleware;

use Closure;


class checkRole
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
        if($request->user()->role <= 3)
        {
            return $next($request);
        }
        else
        {
            $request->session()->flash('message', 'You are not allowed to go to this page');
            return redirect('/home');
        }

        
    }
}
