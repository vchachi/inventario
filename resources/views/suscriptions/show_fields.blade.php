<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Titulo:') !!}
    <p>{{ $suscriptions->title }}</p>
</div>

<!-- Frequency Field -->
<div class="col-sm-12">
    {!! Form::label('frequency', 'Frecuencia:') !!}
    <p>{{ $suscriptions->frequency == 1 ? "Mensual" : ($suscriptions->frequency == 2 ? "Semestral" : "Anual" ) }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Descripcion:') !!}
    <p>{{ $suscriptions->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $suscriptions->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $suscriptions->updated_at }}</p>
</div>

