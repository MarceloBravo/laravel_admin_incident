@extends('layouts.app')

@section('content')

@include('includes.msg')

<div id="divForm" class="container-fluid">
    <div class="row">
        <div class="form">
            <form id='form' method="POST" >

                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" id="_method" name="_method" value=""/>
                <input type="hidden" id="id" name="id" value=""/>
                <fieldset>
                    <legend>Menus</legend>
                    <div class="form-group row">
                        {{ Form::label("lblNombre","Nombre",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10 col-md-3">                            
                            {{ Form::text("nombre",null,["id"=>"nombre", "class"=>"form-control", "placeholder"=>"Nombre del menú"])}}
                        </div>
                    </div>
                    <div class='form-group row'>
                        {{ Form::label('lblRuta','Ruta',['class'=>'col-sm-2 col-form-label']) }}
                        <div class='col-sm-10'>
                            {{ Form::text('ruta',null,['id'=>'ruta', 'class'=>'form-control', 'placeholder'=>'Ingresa la url a la que dirgirá el menú (Optativo)']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblMenuPadre","Menú pádre",["class"=>"col-sm-2 col-form-label form-checkbox form-icon form-text"]) }}
                        <div class="col-sm-10 col-md-4">
                            <select id="menu_padre_id" name="menu_padre_id" class="form-control">
                            </select>                            
                        </div>
                    </div>
                    <div class='form-group row'>
                        {{ Form::label('lblPosicion','Posición del menú',['class'=>'col-sm-2 col-form-label']) }}
                        <div class='col-sm-2'>                            
                            {{ Form::number('posicion',null,['id'=>'posicion', 'class'=>'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblOcultar","Ocultar",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-3">
                            {{ Form::select("ocultar",[0=>"No",1=>"Si"],null,["id"=>"ocultar","class"=>"form-control"])}}
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

@section('script')
<script type="text/javascript" src="{{ asset('js/botones.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mantenedores/menus.js') }}"></script>
@endsection

@section('style')
<link type="text/css" href="{{ asset('css/comboForm.css') }}" rel="stylesheet"/>    
@endsection