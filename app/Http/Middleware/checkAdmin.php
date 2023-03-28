<?php

namespace App\Http\Middleware;

use Closure;

class checkAdmin
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
        if($request->user()->role === 1)
        {
            return $next($request);
        }
        else
        {
            $request->session()->flash('message', 'You are not allowed to go to this page');
            return redirect('/admin');
        }
    }
}
