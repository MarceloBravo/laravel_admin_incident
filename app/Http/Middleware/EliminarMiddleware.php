<?php

namespace App\Http\Middleware;

use Closure;
use App\Permiso;
use Auth;

class EliminarMiddleware
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
        if(!Permiso::permisosEliminar(Auth::user()->role_id, $request->path()))
        {
            abort(403, "No pósee los permisos para eliminar el registro.");
        }
        return $next($request);
    }
}
