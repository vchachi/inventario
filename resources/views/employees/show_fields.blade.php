<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombres:') !!}
    <p>{{ $employees->name }}</p>
</div>

<!-- Lastname Field -->
<div class="col-sm-12">
    {!! Form::label('lastname', 'Apellidos:') !!}
    <p>{{ $employees->lastname }}</p>
</div>

<!-- Position Field -->
<div class="col-sm-12">
    {!! Form::label('position', 'Posicion:') !!}
    <p>{{ $employees->position }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $employees->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $employees->updated_at }}</p>
</div>

