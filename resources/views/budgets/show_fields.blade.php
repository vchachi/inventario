<!-- Number Field -->
<div class="col-sm-12">
    {!! Form::label('number', 'Número:') !!}
    <p>{{ $budgets->number }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Fecha:') !!}
    <p>{{ $budgets->date }}</p>
</div>

<!-- State Field -->
<div class="col-sm-12">
    {!! Form::label('state', 'Estado:') !!}
    <p>{{ $budgets->state == 1 ? "Pendiente de enviar" : ($budgets->state == 2 ? "Pendiente de aceptar" : ($budgets->state == 3 ? "Aceptado" : "Rechazado")) }}</p>
</div>

<!-- Client Id Field -->
<div class="col-sm-12">
    {!! Form::label('client_id', 'Cliente:') !!}
    <p>{{ $client }}</p>
</div>

<!-- Observations Field -->
<div class="col-sm-12">
    {!! Form::label('observations', 'Observaciones:') !!}
    <p>{{ $budgets->observations }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $budgets->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $budgets->updated_at }}</p>
</div>

