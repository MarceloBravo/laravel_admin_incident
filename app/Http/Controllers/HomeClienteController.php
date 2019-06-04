<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Incidente;
use Auth;

class HomeClienteController extends Controller
{
    
    public function __construct()
    {
        $this->middleware("auth");
    }
    
    public function index()
    {
        $misIncidentesReportados = Incidente::where("cliente_id",Auth::user()->id)->where("proyecto_id",Auth::user()->selected_project_id)->get();
        
        return view("home_cliente",compact("misIncidentesReportados"));
    }
}
