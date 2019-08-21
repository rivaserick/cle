<?php

namespace App\Http\Middleware;

use Closure;

class Permisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $clase)
    {
        if ($request->user()->clase() == 0) {
            return $next($request);
        }
        if (!($request->user()->clase() == $clase)) {
            abort(401, 'Permiso denegado.');
        }
        return $next($request);
    }
}
