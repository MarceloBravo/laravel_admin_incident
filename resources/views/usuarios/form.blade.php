<fieldset>
    <legend>Usuarios</legend>
    <div class='form-group row'>
        {{ Form::label('lblNombre','Nombre',['class'=>'col-sm-2 col-form-label'])}}
        <div class='col-sm-10'>
            {{ Form::text('name',null,['id'=>'nombre', 'class'=>'form-control','placeholder'=>'Ingrese el nombre de usuario'])}}
        </div>
    </div>
    <div class='form-group row'>
        {{ Form::label('lblEmail','Email',['class'=>'col-sm-2 col-form-label'])}}
        <div class='col-sm-10'>
            {{ Form::text('email',null,['id'=>'email', 'class'=>'form-control','placeholder'=>'Correo electrónico'])}}
        </div>
    </div>
    <div class='form-group row'>
        {{ Form::label('lblRol','Rol',['class'=>'col-sm-2 col-form-label'])}}
        <div class='col-sm-10'>
            {{ Form::select('role_id',$roles,null,['id'=>'role_id', 'class'=>'form-control col-md-5','placeholder'=>'Seleccione'])}}
        </div>
    </div>
    <div class='form-group row'>
        {{ Form::label('lblPassword','Password',['class'=>'col-sm-2 col-form-label'])}}
        <div class='col-sm-10'>
            {{ Form::password('password',['id'=>'password', 'class'=>'form-control col-sm-4','placeholder'=>'Contraseña'])}}
        </div>
    </div>
    <div class='form-group row'>
        {{ Form::label('lblConfirmPassword','ConfirmPassword',['class'=>'col-md-2 col-form-label'])}}
        <div class='col-sm-10'>
            {{ Form::password('confirmPassword',['id'=>'confirmPassword', 'class'=>'form-control col-md-4','placeholder'=>'Confirmación contraseña'])}}
        </div>
    </div>
</fieldset>