<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NivelesRequest;
use App\Nivel;

class NivelController extends Controller
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
        return view("mantenedores.niveles");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NivelesRequest $request)
    {
        $nivel = new Nivel();
        $nivel->fill($request->all())->save();
        
        return response()->json(["message-ok","El registro ha sido grabado exitosamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivel = Nivel::find($id);
        return response()->json($nivel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $nivel = Nivel::find($id);
        $nivel->fill($request->all())->save();
        
        return response()->json(["message-ok","El registro ha sido actualizado."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivel = Nivel::find($id);
        $nivel->delete();
        
        return response()->json(["message-ok","El registro ha sido eliminado!"]);
    }
    
    
    public function listar(){
        $niveles = Nivel::all();
        return response()->json($niveles->toArray());
    }
    
    public function filtrar(Request $request)
    {
        $filtro = $request["txtFiltro"];
        if($filtro == "")
        {
            $res = Nivel::all();
        }else{
            $res = Nivel::filtro($filtro);
        }
        
        return response()->json($res);
        
    }
}
