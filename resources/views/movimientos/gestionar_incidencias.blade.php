@extends('layouts.app')

@section('content')

@include('includes.msg')

<div id="detalle-incidencias" class="card-body">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
    <div class="panel-body">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblCodigo">Código</label>
                <label id="lblCodigo" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->id }}</label>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblProyecto">Proyecto</label>                                
                <label id="lblProyecto" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->proyecto()->nombre }}</label>                                
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblCategoria">Categoría</label>
                <label id="lblCategoria" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->categoria()->nombre }}</label>                                
            </div>
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblNivel">Nivel</label>
                <label id="lblNivel" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->nivel()->nombre }}</label>                                
            </div>
        </div>
        <div class="row">    
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblSeveridad">Severidad</label>
                <label id="lblSeveridad" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->severidad_nombre }}</label>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblFechaIngreso">Fecha de ingreso</label>
                <label id="lblFechaIngreso" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->created_at }}</label>                                
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblReportadoPor">Reportado por</label>
                <label id="lblReportadoPor" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->cliente()->name }}</label>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblAsignadoA">Asignada a</label>
                <label id="lblAsignadoA" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->nombre_soporte }}</label>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblTitulo">Titulo</label>
                <label id="lblTitulo" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->titulo }}</label>
            </div>            
            <div class="form-group col-sm-6">
                <label class="col-sm-3 control-label" for="lblEstado">Estado</label>
                <label id="lblEstado" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->estado }}</label>
            </div>
        </div>


        <div class="row">
            <div class="form-group col-sm-12">                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="lblDescripcion">Descripción</label>
                    <label id="lblDescripcion" class="col-sm-10 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->descripcion }}</label>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="lblAdjuntos">Adjuntos</label>
                    <label id="lblAdjuntos" class="col-sm-10 control-label lblValue" for="demo-hor-inputemail">Sin archivos adjuntos</label>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer text-right">
        <div class="form-group">
            
            @if($incidencia->activa)
                @if($incidencia->soporte_id != Auth::user()->id  && Auth::user()->puedeAtender($incidencia))  
                
                    <button id="btnAtender" class="btn btn-primary" type="button" @if(!is_null($incidencia->soporte_id))style="display:none"@endif>Atender</button>
                    <button id="btnDerivar" class="btn btn-primary" type="button" @if(is_null($incidencia->soporte_id)) style="display:none" @endif>Derivar</button>
                @endif
                @if($incidencia->cliente_id == Auth::user()->id)
                    <button id="btnCerrarIncidencia" class="btn btn-primary" type="button">Finalizar incidencia</button>
                    <button id="btnEditar" class="btn btn-primary" type="button">Editar</button>
                @endif
            @else
                @if($incidencia->cliente_id == Auth::user()->id)
                <button id="btnReabrir" class="btn btn-primary" type="button">Reabrir</button>
                @endif
            @endif
            <button id="btnCerrar" class="btn btn-danger" type="button">cerrar</button>
        </div>
    </div>

</div>



<div id="editar-incidencias" class="card-body">
    <form id="updateForm" class="form-horizontal"> 
        <input type="hidden" id="tokenUpdate" name="_token" value="{{ csrf_token() }}"/>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lblCodigo">Código</label>
                <label id="lblCodigo" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->id }}</label>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lblProyecto">Proyecto</label>                                
                <label id="lblProyecto" class="col-sm-9 control-label lblValue" for="demo-hor-inputemail">{{ $incidencia->proyecto()->nombre }}</label>                                
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lblCategoria">Categoría</label>    
                <div class="col-sm-9">
                    {{ Form::select('categoria_id',$categorias,$incidencia->categoria_id,['id'=>'categoria_id','class'=>'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lblSeveridad">Severidad</label>
                <div class="col-sm-9">
                    {{ Form::select('severidad',['B'=>'Baja','M'=>'Media','A'=>'Alta'],$incidencia->severidad ,['id'=>'severidad','class'=>'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lblTitulo">Titulo</label>                
                <div class="col-sm-9">
                    {{ Form::text('titulo', $incidencia->titulo, ['id'=>'titulo','class'=>'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="lblDescripcion">Descripción</label>
                <div class="col-sm-9">
                    {{ Form::textarea('descripcion', $incidencia->descripcion, ['id'=>'descripcion','class'=>'form-control']) }}
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <div class="form-group">                
                <button id="btnActualizar" class="btn btn-primary" type="button">Grabar cambios</button>
                <button id="btnVolver" class="btn btn-danger" type="button">Cancelar</button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('style')
<link type="text/css" href="{{ asset('css/gestionar_incidencias.css') }}" rel="stylesheet"/>
@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/movimientos/gestionar_incidencias.js') }}"></script>
@endsection