<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRolMiddleware
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
        if(!$request->user()->autorizarRol(Auth::user()->role_id)){  //LLama a la función autoriza rol del modelo ususario 
            abort(403, "No posees los permisos para acceder.".Auth::user()->role_id);
            //return redirect('/');
        }
        return $next($request);
    }
}
