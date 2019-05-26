@extends('layouts.app')

@section('content')

@include('includes.msg')

<div id="divForm" class="container-fluid" style="display: block;">
    <div class="row">
        <div class="form">
            <h3 id='titulo'>Ingreso de incidencia</h3>
            <br/>
            <form id="form" name="form" class="form-horizontal" action="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>                
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="categoria_id">Categoría:</label>
                        <div class="col-sm-9">
                            <select id="categoria_id" name="categoria_id" class="form-control">                    
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="severidad">Severidad:</label>
                        <div class="col-sm-9">
                            <select id="severidad" name="severidad" class="form-control">
                                <option value=''> -- Seleccione -- </option>
                                <option value='A'>Alta</option>
                                <option value='M'>Media</option>
                                <option value='B'>Baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="titulo">Titulo</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Titulo" id="titulo_incidente" name="titulo" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="descripcion">Descripción</label>
                        <div class="col-sm-9">
                            <textarea placeholder="Descripción" id="descripcion" name="descripcion" class="form-control">
                            </textarea>
                            <label class="col-sm-3 control-label" for="descripcion">Carácteres restantes <span id="restChar">255</span></label>
                        </div>
                    </div>
                </div>
            </form>
            <div class='divButton'>
                <button type="button" id='btnGrabar' class="btn btn-primary">Reportar incidente</button>
                <button type="button" id='btnNuevo' class="btn btn-danger">Limpiar formulario</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jquery')
<script type="text/javascript" src="{{ url('js/jquery.js') }}"></script>
@endsection

@section('script')
<script type="text/javascript" src="{{ url('js/movimientos/ingresar_incidencias.js') }}"></script>
@endsection

@section('style')
<link type="text/css" href="{{ url('css/ingresar_incidencias.css') }}" rel="stylesheet"/>
@endsection