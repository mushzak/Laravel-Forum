<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(auth()->user()->role == $role)
        {
            return $next($request);
        } else {
           return redirect('/thread');
        }

    }
}
