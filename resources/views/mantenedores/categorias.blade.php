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
                    <legend>Categorías</legend>
                    <div class="form-group row">
                        {{ Form::label("lblNombre","Nombre",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10">                            
                            {{ Form::text("nombre",null,["id"=>"nombre", "name"=>"nombre", "class"=>"form-control", "placeholder"=>"Nombre de la categoría"])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label("lblDescripción", "Descripción",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10">
                            {{ Form::text("descripcion",null,["id"=>"descripcion","class"=>"form-control","placeholder"=>"Descripción de la categoría"])}}
                        </div>
                    </div>
                    <!--
                    <div class="form-group row">
                        {{ Form::label("lblProyecto", "Proyecto",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10">
                            <select id='proyecto_id' name='proyecto_id' class='col-sm-2 col-form-label'>
                                    
                            </select>
                        </div>
                    </div>
                    -->
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
<script type='text/javascript' src="{{ asset('js/mantenedores/categorias.js') }}"></script>
@endsection

@section('jquery')
<script type='text/javascript' src="{{ asset('js/jquery.js') }}"></script>
@endsection

@section('style')
<link type='text/css' href="{{ asset('css/comboForm.css') }}" rel="stylesheet"/>
@endsection