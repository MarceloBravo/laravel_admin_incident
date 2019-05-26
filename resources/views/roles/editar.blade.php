@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="form">
        {{ Form::model($rol,["id"=>"form", "method"=>"PUT", "route"=>["roles.update",$rol->id]]) }}
            @include('roles.form')
        {{ Form::close() }}
        </div>
        <form id="formDelete" action='/roles/{{ $rol->id }}' method="post">
            <input type="hidden" name='_method' value='DELETE'/>
            <input type="hidden" name='_token' value='{{ csrf_token() }}'/>
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