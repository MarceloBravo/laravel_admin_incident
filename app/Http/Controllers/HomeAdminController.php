<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidente;
use App\UserProject;
use Auth;

class HomeAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $projectUser = UserProject::where("proyecto_id","=",Auth::user()->selected_project_id)->where("user_id","=",Auth::user()->id)->first();
        
        $incidentesPendientes = Incidente::where("soporte_id","=",null)->where("nivel_id","=",$projectUser->nivel_id)->get();
        
        $misIncidencias = Incidente::where("soporte_id","=",Auth::user()->id)->where("proyecto_id","=",Auth::user()->selected_project_id)->get();
        
        $misIncidentesReportados = Incidente::where("cliente_id","=",Auth::user()->id)->where("proyecto_id","=",Auth::user()->selected_project_id)->get();
        
        return view('home',compact("incidentesPendientes","misIncidencias","misIncidentesReportados"));
    }
}
