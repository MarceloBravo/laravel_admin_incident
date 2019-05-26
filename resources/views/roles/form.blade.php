<fieldset>
    <legend>Roles</legend>
    <div class="form-group row">
        {{ Form::label("lblNombre","Nombre",["class"=>"col-sm-2 col-form-label"]) }}
        <div class="col-sm-10">
            {{ Form::text("nombre",null,["name"=>"nombre", "class"=>"form-control", "placeholder"=>"Ingresa el nombre del rol"])}}
        </div>
    </div>
</fieldset>