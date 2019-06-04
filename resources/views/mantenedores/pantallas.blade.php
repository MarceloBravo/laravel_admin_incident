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
                    <legend>Pantallas</legend>
                    <div class="form-group row">
                        {{ Form::label("lblNombre","Nombre",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10">                            
                            {{ Form::text("nom bre",null,["id"=>"nombre", "name"=>"nombre", "class"=>"form-control", "placeholder"=>"Nombre de la categoría"])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblMenuId","Menú",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10"> 
                            <select id="menu_id" name="menu_id" class="form-control">
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblBtnNuevo","Posee botón Nuevo",["class"=>"col-sm-2 col-form-label form-checkbox form-icon form-text"]) }}
                        <div class="col-sm-3">
                            {{ Form::select("boton_nuevo",[1=>"Si",0=>"No"],null,["id"=>"boton_nuevo", "class"=>"form-control"])}}
                        </div>
                    </div>
                    <div class="form-group row">                        
                        {{ Form::label("lblBtnCrear","Posee botón Grabar",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-3">
                            {{ Form::select("boton_grabar",[1=>"Si",0=>"No"],null,["id"=>"boton_grabar", "class"=>"form-control"])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblBtnEliminar","Posee botón Eliminar",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-3">
                            {{ Form::select("boton_eliminar",[1=>"Si",0=>"No"],null,["id"=>"boton_eliminar","class"=>"form-control"])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblEscritorio","Es escritorio de la aplicación",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-3">
                            {{ Form::select("es_escritorio",[1=>"Si",0=>"No"],null,["id"=>"es_escritorio","class"=>"form-control"])}}
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
<script type='text/javascript' src="{{ asset('js/botones.js') }}"></script> <!-- Contiene los códigos para los botones Nuevo, Grabar, Modificar y Eliminar -->
<script type='text/javascript' src="{{ asset('js/mantenedores/pantallas.js') }}"></script>
@endsection

@section('jquery')
<script type='text/javascript' src="{{ asset('js/jquery.js') }}"></script>
@endsection

@section('style')
<link type='text/css' href="{{ asset('css/comboForm.css') }}" rel="stylesheet"/>
@endsection