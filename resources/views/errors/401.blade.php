@extends('layouts.app')

@section('content')

<div id="container" class="cls-container">
            <!-- CONTENT -->
            <!--===================================================-->
            <div class="cls-content">
                <div class="error-full-page">
                    <!-- start: 404 -->
                    <div class="col-sm-12 page-error pad-30">
                        <div class="error-number text-primary"> 401 </div>
                        <div class="error-details col-sm-6 col-sm-offset-3">
                            <h3> Oops! No posees los permisos para acceder a este formulario.</h3>
                            <p> Acceso denegado!
                                <br> Contactate con el administrador de la aplicación para gestionar
                                <br> los permisos necesarios para que puedas acceder a ésta pantalla.
                                <br>                                
                            </p>
                        </div>
                    </div>
                    <!-- end: 401 -->
                </div>
            </div>
            <!--===================================================-->
            <!-- CONTENT -->
        </div>


@endsection

@section('style')
<link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet"/>
<link type="text/css" href="{{ asset('css/errors_pages.css') }}" rel="stylesheet"/>
@endsection