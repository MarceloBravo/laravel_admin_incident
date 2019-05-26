@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="form">
        {{ Form::model($usuario, ["id"=>"form", "method"=>"PUT", "route"=>["usuarios.update",$usuario->id ]]) }}
            @include('usuarios.form')
        {{ Form::close() }}
        </div>
        <form id='formDelete' action="/usuarios/{{ $usuario->id }}" method="POST">
            <input type='hidden' name='_token' value='{{ csrf_token() }}'/>
            <input type='hidden' name='_method' value='DELETE'/>
        </form>
        @include('includes.buttons_enable_delete')
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/forms.js') }}"></script>
@endsection

@section('jquery')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
@endsection