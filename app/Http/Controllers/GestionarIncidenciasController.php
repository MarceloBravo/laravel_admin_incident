<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateGestionRequest;
use App\Incidente;
use App\Categoria;
use App\UserProject;
use Auth;

class GestionarIncidenciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('actualizar',['only'=>['atender','derivar','update']]);
    }
    
    public function index()
    {
        
    }
    
    public function show($id)
    {
        $incidencia = Incidente::findOrFail($id);
        $categorias = Categoria::pluck("nombre","id");
        $estadoBotones = $this->estadoBotones($incidencia);
        return view('movimientos.gestionar_incidencias',compact("categorias","incidencia","estadoBotones"));
    }
    
    
    public function atender(Request $request)
    {
        $incidente = Incidente::findOrFail($request['id']);
        
        //Validar que el nivel del proyecto y el nivel del usuario sean iguales
        $userProyect = UserProject::where('proyecto_id', $incidente->proyecto()->id)
                ->where('user_id',Auth::user()->id)
                ->where('nivel_id',$incidente->nivel_id)
                ->first();
        
        if(!is_null($userProyect))
        {
            $res = ['message-ok','La incidencia a sido asignada exitosamente!'];
            $incidente->soporte_id = Auth::user()->id;
            $incidente->save();
            
            $datos = $incidente->getInfoIncidenteAttribute();
        }else{
            $datos = null;
            $res = ['message-error','No puede atender ésta incidencia!'];
        }
        $estadoBotones = $this->estadoBotones($incidente);
        return response()->json([$datos,$res,$estadoBotones]);
    }
    
    
    public function derivar(Request $request)
    {
        $incidente = Incidente::findOrFail($request['id']);
        $nextLevelId = $incidente->nivel_id;
        
        $nivelesProyecto = UserProject::where("proyecto_id",$incidente->proyecto_id)->OrderBy('nivel_id','ASC')->get();
        $cantProyectos = sizeof($nivelesProyecto);
        for($i = 0;$i < $cantProyectos; $i++)
        {
            if($incidente->nivel_id == $nivelesProyecto[$i]->nivel_id && $i < ($cantProyectos-1) )
            {
                $nextLevelId = $nivelesProyecto[$i+1]->nivel_id;
                break;
            }
        }
        if($incidente->soporte_id != $nextLevelId)
        {
            $incidente->nivel_id = $nextLevelId;
            $incidente->soporte_id = null;
            $incidente->save();
            
            $datos = $incidente->getInfoIncidenteAttribute();
            $resp = ['message-ok','La incidencia ha sido derivada.'];
        }else{
            $datos = null;
            $resp = ['error-ok','No existen más niveles a los cuales derivar'];
        }
        
        $estadoBotones = $this->estadoBotones($incidente);
        return response()->json([$datos,$resp,$estadoBotones]);
        
    }
    
    public function update(UpdateGestionRequest $request, $id)
    {
        $incidente = Incidente::find($id);
        $incidente->fill($request->all())->save();
        
        $estadoBotones = $this->estadoBotones($incidente);
        return response()->json([$incidente->getInfoIncidenteAttribute(),['message-ok','La incidencia ha sido actualizada'],$estadoBotones]);
    }
    
    
    public function finalizar(Request $request, $id)
    {
        $incidente = Incidente::find($id);
        $incidente->activa = false;
        $incidente->save();
        
        $estadoBotones = $this->estadoBotones($incidente);
        return response()->json([$incidente->getInfoIncidenteAttribute(),["message-ok","La incidencia se ha finalizado."],$estadoBotones]);
    }
    
    public function reabrir(Request $request, $id)
    {
        $incidente = Incidente::find($id);
        $incidente->activa = true;
        $incidente->save();
        
        $estadoBotones = $this->estadoBotones($incidente);
        return response()->json([$incidente->getInfoIncidenteAttribute(),["message-ok","La incidencia se ha reabierto."],$estadoBotones]);
    }
    
    public function consultarEstadoBotones(Request $request, $id)
    {
        $incidente = Incidente::find($id);
        $estadoBotones = $this->estadoBotones($incidente);
        return response()->json($estadoBotones);
    }
    
    private function estadoBotones($incidencia)
    {
        $atender = "none"; $derivar = "none"; $finalizar = "none"; $editar = "none"; $reabrir = "none";
        if($incidencia->activa)
        {
            if(is_null($incidencia->soporte_id)){$atender = "inline-block";}
            if(!is_null($incidencia->soporte_id) && Auth::user()->puedeAtender($incidencia)){$derivar = "inline-block";}
            if($incidencia->cliente_id == Auth::user()->id) {$editar = "inline-block";}
            if($incidencia->cliente_id == Auth::user()->id) {$finalizar = "inline-block";}
        }else{
            if($incidencia->cliente_id == Auth::user()->id){$reabrir = "inline-block";}
        }
        $estado = [
            "atender"=> $atender,
            "derivar"=>$derivar,
            "editar"=>$editar,
            "finalizar"=>$finalizar,
            "reabrir"=>$reabrir
            ];
        
        return $estado;
    }
    
}
