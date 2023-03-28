<?php

namespace App\Http\Middleware;

use Closure;

class checkSuper
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
        if($request->user()->role <= 2)
        {
            return $next($request);
        }
        else
        {
            $request->session()->flash('perm_alert', 'You are not allowed to go to this page!');
            return redirect('/admin');
        }
    }
}
