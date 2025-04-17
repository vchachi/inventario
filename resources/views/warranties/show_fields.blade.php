<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{{ $warranties->name }}</p>
</div>

<!-- Warraty For Field -->
<div class="col-sm-12">
    {!! Form::label('warraty_for', 'Garantías  para:') !!}
    <p>{{ $warranties->warraty_for }}</p>
</div>

<!-- Duration Field -->
<div class="col-sm-12">
    {!! Form::label('duration', 'Duracion:') !!}
    <p>{{ $warranties->duration }}</p>
</div>

<!-- Conditions Field -->
<div class="col-sm-12">
    {!! Form::label('conditions', 'Condiciones:') !!}
    <p>{{ $warranties->conditions }}</p>
</div>

<!-- Url Conditions Field -->
<div class="col-sm-12">
    {!! Form::label('url_conditions', 'Url Condiciones:') !!}
    <p>{{ $warranties->url_conditions }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $warranties->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $warranties->updated_at }}</p>
</div>

