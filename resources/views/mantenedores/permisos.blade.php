@extends('layouts.app')

@section('content')

@include('includes.msg')

<div id="divForm" class="container-fluid">
    <div class="row">
        <div class="form">
            <form id='form'>
                <legend>Configurando los permisos para el rol <b id='bRolName'></b></legend>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" id="rol_id" name="rol_id" value=""/>
                
                <div class='col-md-12 row titulos'>  
                    <label class='col-md-4 control-label'>Pantalla</label>
                    <label class='col-md-2 control-label'>Ingresar</label>
                    <label class='col-md-2 control-label'>Crear</label>
                    <label class='col-md-2 control-label'>Editar</label>
                    <label class='col-md-2 control-label'>Eliminar</label>
                </div>
                <div id="divCheckPermisos" class="container-fluid">
                    
                </div>  
                <br/>
                <div class='col-md-12 row'>  
                    <label class='col-md-3 control-label checkAll'>Marcar/desmarcar todos</label>
                    <input type='checkbox' id='checkAll' class='col-md-2 checkbox'/>
                    <label class='col-md-7'></label>
                </div>
            </form>        
        </div>
        @include('includes.buttons_enable_delete')
    </div>
</div>


@include('includes.grid')

@endsection

@section('script')
<script type='text/javascript' src="{{ asset('js/botones.js') }}"></script> <!-- Contiene los códigos para los botones Nuevo, Grabar, Modificar y Eliminar -->
<script type='text/javascript' src="{{ asset('js/mantenedores/permisos.js') }}"></script>
@endsection

@section('jquery')
<script type='text/javascript' src="{{ asset('js/jquery.js') }}"></script>
@endsection

@section('style')
<link type='text/css' href="{{ asset('css/comboForm.css') }}" rel="stylesheet"/>
<link type='text/css' href="{{ asset('css/permisos.css') }}" rel="stylesheet"/>
@endsection