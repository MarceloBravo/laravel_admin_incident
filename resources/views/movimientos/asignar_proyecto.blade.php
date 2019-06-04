@extends('layouts.app')

@section('content')

<div id="divForm" class="container-fluid">
    <div class="row">
        <div class="form">
            <form id='form' method="POST" >

                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                <!-- <input type="hidden" id="_method" name="_method" value=""/> -->
                <input type="hidden" id="id" name="id" value=""/>
                <fieldset>
                    <legend>Asignar proyectos</legend>

                    <div class="form-group row col-sm-12">
                        <div class="form-group row  col-sm-4">
                            <label class="control-label col-md-2"> Usuario </label>
                            <div class="col-md-10">
                                {{ Form::select('user_id',$users,$usuario->id,['id'=>'user_id', 'class'=>'form-control selectpicker','data-live-search'=>'true','placeholder'=>'Selecciona el usuario']) }}
                            </div>
                        </div>
                        <div class="form-group row  col-sm-4">
                            <label class="control-label col-md-2"> Rol </label>
                            <div class="col-md-10">
                                {{ Form::text('rol',$rol->nombre,['id'=>'rol','class'=>'form-control','disabled'=>'true'])}}
                            </div>
                        </div>
                        <div class="form-group row  col-sm-4">
                            <label class="control-label col-md-2"> Email </label>
                            <div class="col-md-10">
                                {{ Form::text('email',$usuario->email,['id'=>'email','class'=>'form-control','disabled'=>'true'])}}
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group row col-sm-12">
                        <div class="form-group row  col-sm-5">
                            <label class="control-label col-md-2"> Proyecto </label>
                            <div class="col-md-10">
                                {{ Form::select('proyecto_id',$proyectos,null,['id'=>'proyecto_id', 'class'=>'form-control selectpicker','data-live-search'=>'true','placeholder'=>'Selecciona un proyecto']) }}
                            </div>
                        </div>
                        <div class="form-group row  col-sm-5">
                            <label class="control-label col-md-2"> Nivel </label>
                            <div class="col-md-10">
                                {{ Form::select('nivel_id',$niveles,null,['id'=>'nivel_id','class'=>'form-control','placeholder'=>'Seleccione un nivel']) }}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="divButtonAddProject">
                                <button type="button" id="btnAsignarProyecto" class="btn btn-primary" >Asignar proyecto</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>
@include('includes.msg')
@include('includes.grid')

@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/movimientos/asignar_proyectos.js') }}"></script>
@endsection


@section('style')
<link href="{{ asset('css/asignar_proyectos.css') }}" rel="stylesheet"/>
@endsection

