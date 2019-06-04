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
                    <legend>Niveles</legend>
                    <div class="form-group row">
                        {{ Form::label("lblNombre","Nombre",["class"=>"col-sm-2 col-form-label"]) }}
                        <div class="col-sm-10">                            
                            {{ Form::text("nombre",null,["id"=>"nombre", "class"=>"form-control", "placeholder"=>"Nombre del nivel"])}}
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


@section('jquery')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/mantenedores/niveles.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/botones.js') }}"></script>
@endsection

@section('style')
<link type="text/css" href="{{ asset('css/generic.css') }}" rel="stylesheet"></script>
<link type="text/css" href="{{ asset('css/comboForm.css') }}" rel="stylesheet"></script>
<link type="text/css" href="{{ asset('css/tables.css') }}" rel="stylesheet"></script>
@endsection

