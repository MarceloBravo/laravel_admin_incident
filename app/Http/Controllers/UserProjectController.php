<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserProjectRequest;
use App\UserProject;
use App\Proyecto;
use App\User;
use App\Rol;
use App\Nivel;
use Auth;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::find(Auth::user()->id);
        $proyectosUsuario = UserProject::where("user_id",Auth::user()->id)->get();
        $proyectos = Proyecto::pluck("nombre","id");
        $users = User::pluck("name","id");
        $niveles = Nivel::pluck("nombre","id");
        $rol = Rol::find($usuario->role_id);
        
        return view("movimientos.asignar_proyecto", compact("proyectosUsuario","proyectos","users", "niveles", "usuario","rol"));            
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserProjectRequest $request)
    {
        //dd($request);
        $proyecto = UserProject::where("user_id",$request["user_id"])->where("proyecto_id",$request["proyecto_id"])->first();
        if(is_null($proyecto))
        {
            $proyecto = new UserProject();
            $proyecto->fill($request->all())->save();            
            $resp = ["message-ok","El proyecto fue asignado al usuario."];
        }else{
            $resp = ["message-error","El proyecto ya se encuentra asignado."];
        }
        
        return response()->json($resp);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null($id)){$id = Auth::user()->id;}
        $usuario = User::find($id);
        $proyectosUsuario = UserProject::where("user_id",$id)->get();
        $proyectos = Proyecto::select("nombre","id")->get();
        $users = User::select("name","id")->where("deleted_at","is null")->get();
        $niveles = Nivel::select("nombre","id")->get();
        $rol = Rol::find($usuario->role_id);
        
        return response()->json(compact("proyectosUsuario","proyectos","users", "niveles", "usuario","rol"));
        //return view("movimientos.asignar_proyecto", compact("proyectosUsuario","proyectos","users", "niveles", "usuario","rol"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit";
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
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyectoUsuario = UserProject::find($id);
        $proyectoUsuario->delete();
        return response()->json(["message-ok","El registro ha sido eliminado"]);
    }
    
    
    public function listar($userId){
        $proyectos = UserProject::listarAsignaciones($userId);
        return response()->json($proyectos);
    }
    
    
    public function filtrar(Request $request)
    {
        $filtro = $request['txtFiltro'];
        if($filtro == ""){
            $resp = UserProject::listarAsignaciones($request['userId']);            
        }else{
            $resp = UserProject::filtro($filtro,$request['userId']);
        }
        return response()->json($resp);
    }
}
