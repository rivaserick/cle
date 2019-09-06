<?php

namespace App\Http\Middleware;

use Closure;

class CheckDocente
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="docencia")
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('docencia.login'));
        }
        return $next($request);
    }
}
