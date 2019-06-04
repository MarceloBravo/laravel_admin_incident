<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proyecto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProyectosRequest;

class ProyectosController extends Controller
{
    public function __construct() {
        $this->middleware('acceso.pantalla',['only'=>'index']);
        $this->middleware('grabar',['only'=>['store']]);
        $this->middleware('actualizar',['only'=>['update']]);
        $this->middleware('eliminar',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {   
        $filtro = "";
        return view("mantenedores.proyectos",compact("filtro"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectosRequest $request)
    {
        return response()->json($this->grabar($request, $request['id']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = Proyecto::find($id);
        return response()->json($proyecto->toArray());
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
    public function update(ProyectosRequest $request, $id)
    {
        return response()->json($this->grabar($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Proyecto::find($id)->delete();
            $resp = ["message-ok","El proyecto ha sido eliminado."];            
        }catch(Exception $ex){
            $resp = ["message-error","Error al intentar eliminar el proyecto."];
        }
        return response()->json($resp);
    }
    
    
    public function listar()
    {        
        $proyectos = Proyecto::listar();        
        return response()->json($proyectos);
    }   
    
    
    public function optionsSelect(){
        $options = Proyecto::all(["id", "nombre"]);
        return response()->json($options);
    }
    
    
    public function filtrar(Request $request){
        $filtro = $request['txtFiltro'];
        if($filtro == ""){
            $resp = Proyecto::all();            
        }else{
            $resp = Proyecto::filtro($filtro);
        }
        return response()->json($resp);
    }
    
    
    
    private function grabar(ProyectosRequest $request, $id)
    {
        $proyecto = Proyecto::find($id);
        if(is_null($proyecto)){
            $proyecto = new Proyecto();
            $resp = array("message-ok","El registro ha sido creado.");
        }else{
            $resp = array("message-ok","El registro ha sido actualizado.");
        }
        $proyecto->fill($request->all());
        $proyecto->save();
        return $resp;
    }
}
