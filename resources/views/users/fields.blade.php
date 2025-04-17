<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Rol:') !!}
    {!! Form::select('role', ['0' => 'Superadmin', '1' => 'Administrador ', '2' => 'Logistica ', '3' => 'Empleado'], null, ['class' => 'form-control custom-select']) !!}
</div>
@if( Auth::user()->id_user_master===0 &&  Auth::user()->is_master)
<div class="form-group col-sm-6">
    <div class="form-check">
        @if(isset($user) && ($user->id ===$user->id_user_master))
        {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('active', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('active', 'Activar cuenta Empresarial', ['class' => 'form-check-label']) !!}
        @elseif (isset($user) && ($user->id_user_master ===0 && $user->is_master))

        @else
        {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('active', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('active', 'Activar cuenta', ['class' => 'form-check-label']) !!}
      
        @endif
    </div>
</div>
@if(isset($editar))
<div class="form-group col-sm-6">
    {!! Form::label('id_user_master', 'Conectado:') !!}
    {!! Form::select('id_user_master',$usuarioscon, null, ['class' => 'form-control custom-select']) !!}
</div>
@endif

@else
@if (Auth::user()->id=== Auth::user()->id_user_master)
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('active', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('active', 'Activar', ['class' => 'form-check-label']) !!}
    </div>
</div>
@else

@endif
@endif


<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Contraseña') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-6">
      {!! Form::label('password', 'Confirmar contraseña') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
</div>
