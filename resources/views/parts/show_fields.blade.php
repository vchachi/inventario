<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{{ $parts->name }}</p>
</div>

<!-- Observations Field -->
<div class="col-sm-12">
    {!! Form::label('observations', 'Observaciones:') !!}
    <p>{{ $parts->observations }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creada:') !!}
    <p>{{ $parts->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizada:') !!}
    <p>{{ $parts->updated_at }}</p>
</div>

