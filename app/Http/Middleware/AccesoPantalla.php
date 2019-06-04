<?php

namespace App\Http\Middleware;

use Closure;
use App\Rol;
use App\Permiso;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AccesoPantalla
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
        $rol = Rol::find(Auth::user()->role_id);
        if(!Permiso::accesoPantalla(!is_null($rol) ? $rol->id : -1 , $request->path()))
        {
            return Redirect::to("/error401");
        }
       
        return $next($request);
    } 
}
