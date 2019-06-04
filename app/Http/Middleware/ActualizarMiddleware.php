<?php

namespace App\Http\Middleware;

use Closure;
use App\Permiso;
use Auth;

class ActualizarMiddleware
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
        if(!Permiso::permisosActualizar(Auth::user()->role_id, $request->path()))
        {
            abort(403, "No pósee los permisos para actualizar el registro.");
        }
                
        return $next($request);
    }
}
