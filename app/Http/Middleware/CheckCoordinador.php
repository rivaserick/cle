<?php

namespace App\Http\Middleware;

use Closure;

class CheckCoordinador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="coordinacion")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('coordinacion.login'));
        }
        return $next($request);
    }
}
