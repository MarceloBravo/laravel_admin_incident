<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Pantalla;
use App\Permiso;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $escritorios = Pantalla::escritorios();
        foreach($escritorios as $escritorio)
        {
            if(Permiso::accesoPantalla(Auth::user()->role_id, str_replace("/", "", $escritorio->menu()->ruta)))
            {
                return Redirect::to($escritorio->menu()->ruta);
            }
        }
        /*
        $projectUser = UserProject::where("proyecto_id",Auth::user()->selected_project_id)->where("user_id",Auth::user()->id)->first();
        
        $incidentesPendientes = Incidente::where("soporte_id",null)->where("nivel_id",$projectUser->nivel_id)->get();
        
        $misIncidencias = Incidente::where("soporte_id",Auth::user()->id)->where("proyecto_id",$projectUser->selected_project_id)->get();
        
        $misIncidentesReportados = Incidente::where("cliente_id",Auth::user()->id)->where("proyecto_id",Auth::user()->selected_project_id)->get();
        
        return view('home',compact("incidentesPendientes","misIncidencias","misIncidentesReportados"));
         */
        return view("welcome");
    }
    
    
}
