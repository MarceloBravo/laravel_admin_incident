@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div id="listado-incidencias" class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-12">
                            <!--Default Tabs (Left Aligned)-->
                            <!--===================================================-->
                            <div class="tab-base">
                                <!--Nav Tabs-->
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#demo-lft-tab-1">Incidentes pendientes </a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#demo-lft-tab-2">Incidentes asignados a mi</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#demo-lft-tab-3">Incidentes reportados por mi</a>
                                    </li>
                                </ul>
                                <!--Tabs Content-->
                                <div class="tab-content">
                                    <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                        <h4 class="text-thin">Incidentes pendientes</h4>                                        
                                        <div class="panel">                                            
                                            <div class="panel-body">
                                                <table id="demo-dt-selection" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Categoría</th>
                                                            <th>Severidad</th>
                                                            <th>Estado</th>
                                                            <th>Fecha creación</th>
                                                            <th>Título</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($incidentesPendientes as $incidente)
                                                        <tr onclick="detalleIncidencia({{ $incidente->id }}, 1)">
                                                            <td>{{ $incidente->id }}</td>
                                                            <td>{{ $incidente->categoria()->nombre }}</td>
                                                            <td>{{ $incidente->severidad_nombre }}</td>
                                                            <td>{{ $incidente->estado }}</td>
                                                            <td>{{ $incidente->created_at }}</td>
                                                            <td>{{ $incidente->titulo_corto }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="demo-lft-tab-2" class="tab-pane fade">
                                        <h4 class="text-thin">Incidentes asignados a mi</h4>                                        
                                        <div class="panel">                                            
                                            <div class="panel-body">
                                                <table id="demo-dt-selection" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Categoría</th>
                                                            <th>Severidad</th>
                                                            <th>Estado</th>
                                                            <th>Fecha creación</th>
                                                            <th>Título</th>
                                                            <!-- <th>Opción</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($misIncidencias as $incidente)
                                                        <tr onclick="detalleIncidencia({{ $incidente->id }}, 2)">
                                                            <td>{{ $incidente->id }}</td>
                                                            <td>{{ $incidente->categoria()->nombre }}</td>
                                                            <td>{{ $incidente->severidad_nombre }}</td>
                                                            <td>{{ $incidente->estado }}</td>
                                                            <td>{{ $incidente->created_at }}</td>
                                                            <td>{{ $incidente->titulo_corto }}</td>
                                                            <!--
                                                            <td>
                                                                <button type="button" class="btn btn-primary btn-sm" value="{{ $incidente->id }}">Atender</button>
                                                            </td>
                                                            -->
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="demo-lft-tab-3" class="tab-pane fade">
                                        <h4 class="text-thin">Incidentes reportados por mi</h4>                                        
                                        <div class="panel">                                            
                                            <div class="panel-body">
                                                <table id="demo-dt-selection" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Categoría</th>
                                                            <th>Severidad</th>
                                                            <th>Estado</th>
                                                            <th>Fecha creación</th>
                                                            <th>Título</th>
                                                            <th>Responsable</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($misIncidentesReportados as $incidente)                                                        
                                                        <tr onclick="detalleIncidencia({{ $incidente->id }}, 3)">
                                                            <td>{{ $incidente->id }}</td>
                                                            <td>{{ $incidente->categoria()->nombre }}</td>
                                                            <td>{{ $incidente->severidad_nombre }}</td>
                                                            <td>{{ $incidente->estado }}</td>
                                                            <td>{{ $incidente->created_at }}</td>
                                                            <td>{{ $incidente->titulo_corto }}</td>
                                                            <td>{{ !is_null($incidente->soporte()) ? $incidente->soporte()->name : 'Sin asignar' }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @include('includes.detalle_incidencias')
            </div>
        </div>
        @include('includes.chat')
    </div>
</div>
@endsection

@section('jquery')
<script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
@endsection

@section('style')
<link href="{{ asset('bootstrap/plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('bootstrap/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection


@section('script')        
<script src="{{ asset('bootstrap/plugins/fast-click/fastclick.min.js') }}"></script>
<script src="{{ asset('bootstrap/plugins/nanoscrollerjs/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ asset('bootstrap/plugins/metismenu/metismenu.min.js') }}"></script>
<script src="{{ asset('bootstrap/plugins/datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('bootstrap/plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('bootstrap/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>

<!--DataTables Sample [ SAMPLE ]-->

<script src="{{ asset('js/movimientos/dashboard.js') }}"></script>
<script src="{{ asset('js/movimientos/chat.js') }}"></script>
@endsection
