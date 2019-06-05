<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidente;
use Auth;
use App\Http\Requests\IncidentesRequest;
use App\Proyecto;

class IncidenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("movimientos.ingresar_incidencias");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("incidencias.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IncidentesRequest $request)
    {
        $idNivel = Proyecto::find(Auth::user()->selected_project_id)->getFirstIdNivel();    //La incidencia siempre empezará por el nivel más bajo
        $incidente = new Incidente();
        $incidente->fill(array_merge($request->all(), ["cliente_id"=>Auth::user()->id,"proyecto_id"=>Auth::user()->selected_project_id,"nivel_id"=>$idNivel]));
        $incidente->save();
        
        return response()->json(["message-ok","El incidente ha sido registrado!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incidente = Incidente::find($id);
        return response()->json(['incidente'=>$incidente, 'severidad'=>$incidente->severidad_nombre,'proyecto'=>$incidente->proyecto(),'nivel'=>$incidente->nivel(),'estado'=>$incidente->getEstadoAttribute(),'soporte'=>$incidente->nombre_soporte,'categoria'=>$incidente->categoria()]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
}
