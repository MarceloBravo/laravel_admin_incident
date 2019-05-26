<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PantallasRequest;
use App\Pantalla;

class PantallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("mantenedores.pantallas");
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
    public function store(PantallasRequest $request)
    {
        return response()->json($this->grabar($request, 0));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pantalla = Pantalla::find($id);
        return response()->json($pantalla->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PantallasRequest $request, $id)
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
        $pantalla = Pantalla::find($id);
        $pantalla->delete();
        return response()->json(["message-ok","El registro ha sido eliminado."]);
    }
    
    
    private function grabar(Request $request, $id){
        $pantalla = Pantalla::find($id);
        if(is_null($pantalla)){
            $pantalla = new Pantalla();
            $resp = ["message-ok","El registro ha sido creado."];
        }else{
            $resp = ["message-ok","El registro ha sido actualizado."];
        }
        $pantalla->fill($request->all())->save();
        
        return $resp;
    }
    
    public function listar(){
        $pantallas = Pantalla::listar();
        return response()->json($pantallas);
    }
    
    
    public function filtrar(Request $request){
        $filtro = $request['txtFiltro'];
        if($filtro == ""){
            $pantallas = Pantalla::all();
        }else{
            $pantallas = Pantalla::filtro($filtro);
        }
        return response()->json($pantallas);
    }
}
