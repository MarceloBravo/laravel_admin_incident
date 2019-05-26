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
                    <legend>Asignar proyectos</legend>

                    <div class="form-group row col-sm-12">
                        <div class="form-group row  col-sm-5">
                            <label class="control-label col-md-2"> Proyecto </label>
                            <div class="col-md-10">
                                <!-- Bootstrap Select with Search Input -->
                                <!--===================================================-->
                                <select class="form-control selectpicker" data-live-search="true">
                                    <option>HTML</option>
                                    <option>CSS</option>
                                    <option>jQuery</option>
                                    <option>Javascript</option>
                                </select>
                                <!--===================================================-->
                            </div>
                        </div>
                        <div class="form-group row  col-sm-5">
                            <label class="control-label col-md-2"> Nivel </label>
                            <div class="col-md-10">
                                <!-- Bootstrap Select with Search Input -->
                                <!--===================================================-->
                                <select class="form-control selectpicker" data-live-search="true">
                                    <option>HTML</option>
                                    <option>CSS</option>
                                    <option>jQuery</option>
                                    <option>Javascript</option>
                                </select>
                                <!--===================================================-->
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="divButtonAddProject">
                                <button class="btn btn-primary" >Agregar proyecto</button>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
</div>

@include('includes.grid')

@endsection


@section('jquery')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('bootstrap/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/movimientos/asignar_proyectos.js') }}"></script>
@endsection


@section('style')

<link href="{{ asset('bootstrap/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"/>
<link href="{{ asset('css/asignar_proyectos.css') }}" rel="stylesheet"/>
@endsection

