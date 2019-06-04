<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErroresController extends Controller
{
    
    public function error401()
    {
        return view("errors.401");
    }
}
