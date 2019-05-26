@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="form">
        {{ Form::open(["id"=>"form", "method"=>"POST", "route"=>"roles.store"]) }}
            @include('roles.form')
        {{ Form::close() }}
        </div>
        @include('includes.buttons_disable_delete')
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/forms.js') }}"></script>
@endsection

@section('jquery')
<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
@endsection