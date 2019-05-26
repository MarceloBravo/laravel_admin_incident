<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Rol;



class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::paginate(15);
        $filtro = "";
        return view("roles.index", compact("roles","filtro"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol = new Rol();
        $rol->fill($request->all())->save();
        Session::flash("message-ok","El rol ha sido creado!");
        return Redirect::to("/roles");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::find($id);        
        return view("roles.editar", compact("rol"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);
        $rol->fill($request->all())->save();
        Session::flash("message-ok","El rol ha sido actualizado.");
        return Redirect::to("/roles");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);
        $rol->delete();
        Session::flash("message-ok","El rol ha sido eliminado.");
        return Redirect::to("/roles");
    }
    
    public function filtrar(Request $request){
        $filtro = $request['txtFiltro'];
        if($filtro == ""){
            return Redirect::to("/roles");
        }else{
            $roles = Rol::filtro($filtro);
            return view("roles.index", compact("roles","filtro"));
        }
    }
}
