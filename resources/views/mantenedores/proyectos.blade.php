@extends('layouts.app')

@section('content')

@include('includes.msg')


<div id="divForm" class="container-fluid">
    <div class="row">
        <div class="form">
            <form id='form' method="POST" >
                
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" id="id" name="id" value=""/>
                <fieldset>
                    <legend>Proyectos</legend>
                    <div class="form-group row">
                        {{ Form::label("lblNombre","Nombre",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10">                            
                            {{ Form::text("nombre",null,["id"=>"nombre", "name"=>"nombre", "class"=>"form-control", "placeholder"=>"Ingresa el nombre del rol"])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblDescripcion","Descripción",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10">                            
                            {{ Form::text("descripcion",null,["id"=>"descripcion", "class"=>"form-control", "placeholder"=>"Ingresa la descripción del proyecto"])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblFechaInicio","Fecha de inicio",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-3">                            
                            {{ Form::date("fecha_inicio",null,["id"=>"fecha_inicio", "class"=>"form-control"])}}
                        </div>
                    </div>
                </fieldset>
                
            </form>        
        </div>
        @include('includes.buttons_enable_delete')
    </div>
</div>

@include('includes.grid')

@endsection

@section('style')
<link type="text/css" href="{{ asset('css/comboForm.css') }}" rel="stylesheet" />
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/mantenedores/proyectos.js') }}"></script>
@endsection

@section('jquery')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
@endsection