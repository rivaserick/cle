<?php

namespace App\Http\Middleware;

use Closure;

class CheckObservador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="observacion")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('observacion.login'));
        }
        return $next($request);
    }
}
