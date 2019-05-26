@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3>Roles</h3>
            <div class="row">
                <div class="col-md-6">

                    <a class="btn btn-default" href="/roles/create">
                        Nuevo
                    </a>
                </div>
                <div class="col-md-6">
                    <form id="formFiltro" action="/roles/filtro" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input id="txtFiltro" name="txtFiltro" type="text" class="form-control" placeholder="Ingrese el texto a buscar" value="{{ $filtro }}"/>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Nombre
                        </th>
                        <th class='colAccion'>
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $rol)
                    <tr>
                        <td>
                            {{ $rol->nombre }}
                        </td>
                        <td class='colAccion'>
                            {{link_to_route("roles.edit", $title="Editar", $parameters=$rol->id, $attributes=['class'=>'btn btn-primary btn-xs'])}}
                        </td>
                    </tr>
                   @endforeach
                    
                </tbody>
                @if(!isset($filtro))
                    {{ $roles->links() }}
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