<?php

namespace App\Http\Middleware;

use Closure;
use App\Permiso;
use Auth;

class GrabarMiddleware
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
        if(!Permiso::permisosGrabar(Auth::user()->role_id, $request->path()))
        {
            abort(403,"No pósee los permisos para grabar el registro.");
        }
        
        return $next($request);
    }
}
