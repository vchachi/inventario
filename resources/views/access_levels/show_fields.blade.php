<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{{ $accessLevels->name }}</p>
</div>

<!-- Pin Field -->
<div class="col-sm-12">
    {!! Form::label('pin', 'Pin:') !!}
    <p>{{ $accessLevels->pin }}</p>
</div>

<!-- Permisions Json Field -->
<div class="col-sm-12">
    {!! Form::label('permisions_json', 'Permiso Json:') !!}
    <p>{{ $accessLevels->permisions_json }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $accessLevels->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $accessLevels->updated_at }}</p>
</div>

