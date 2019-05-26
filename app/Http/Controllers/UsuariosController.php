<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Rol;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = DB::Table("users")
                ->join("roles","roles.id","=","users.role_id")
                ->where("users.deleted_at","=",null)
                ->select("users.*","roles.nombre as rol")
                ->paginate(15);
        $filtro = "";
        return view("usuarios.index",compact("usuarios","filtro"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::pluck("nombre","id");
        return view("usuarios.crear",compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(strcmp($request['password'], $request['confirmPassword']) == 0){                
            $usuario = new User();
            $usuario->fill($request->all());
            $usuario->save();
            Session::flash("message-ok","El usuario ha sido creado");
            return Redirect::to("/usuarios");
        }else{
            Session::flash("message-warning","Las contrseñas no coinciden");
            return Redirect::back();
        }
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
        $usuario = User::find($id);
        $roles = Rol::pluck("nombre","id");
        return view("usuarios.editar",compact("usuario","roles"));
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
        if(strcmp($request['password'], $request['confirmPassword']) == 0){
            $usuario = User::find($id);
            if($request['password'] == ""){
                $usuario->fill($request->except("password"));
            }else{
                $usuario->fill($request->all());
            }
            $usuario->save();
            Session::flash("message-ok","El usuario ha sido actualizado");
            return Redirect::to("/usuarios");
        }else{
            Session::flash("message-warning","Las contrseñas no coinciden");
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        Session::flash("message-ok","El usuario ha sido eliminado.");
        return Redirect::to("/usuarios");
    }
    
    
    public function filtrar(Request $request){
        $filtro = $request['txtFiltro'];
        if($filtro == ""){
            return Redirect::to("/usuarios");
        }else{
            $usuarios = User::filtro($filtro);
            return view("usuarios.index",compact("usuarios","filtro"));
        }
    }
}
