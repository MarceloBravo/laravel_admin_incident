@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3>Usuarios</h3>
            <div class="row">
                <div class="col-md-6">

                    <a class="btn btn-default" href="/usuarios/create">
                        Nuevo
                    </a>
                </div>
                <div class="col-md-6">
                    <form id="formFiltro" action="/usuarios/filtro" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input id="txtFiltro" name="txtFiltro" type="text" class="form-control" placeholder="Ingrese el texto a buscar" value="{{ $filtro }}"/>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Fecha creación</th>
                        <th class='colAccion'>
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->rol }}</td>
                        <td>{{ date('m-d-Y',strtotime($user->created_at)) }}</td>
                        <td class='colAccion'>
                            {{link_to_route("asignar_proyecto.show", $title="Asignar proyecto", $parameters=$user->id, $attributes=['class'=>'btn btn-default btn-xs'])}}
                            {{link_to_route("usuarios.edit", $title="Editar", $parameters=$user->id, $attributes=['class'=>'btn btn-primary btn-xs'])}}                            
                        </td>
                    </tr>
                   @endforeach
                    
                </tbody>
                @if(!isset($filtro))
                    {{ $usuarios->links() }}
                @endif
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/grid.js') }}"></script>
@endsection

@section('jquery')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
@endsection

@section('style')
<link type="text/css" href="{{ asset('css/usuarios.css') }}" rel="stylesheet"/>
@endsection