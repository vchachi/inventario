<!-- Nombre Field -->
<div class="col-sm-12">
    {!! Form::label('nombre', 'Nombre:') !!}
    <p>{{ $invoiceSeries->nombre }}</p>
</div>

<!-- Shortname Field -->
<div class="col-sm-12">
    {!! Form::label('shortname', 'Nombre Corto:') !!}
    <p>{{ $invoiceSeries->shortname }}</p>
</div>

<!-- Tax Type Field -->
<div class="col-sm-12">
    {!! Form::label('tax_type', 'tipo de Impuesto:') !!}
    <p>{{ $invoiceSeries->tax_type }}</p>
</div>

<!-- Default Repairs Field -->
<div class="col-sm-12">
    {!! Form::label('default_repairs', 'Reparacioens :') !!}
    <p>{{ $invoiceSeries->default_repairs }}</p>
</div>

<!-- Default Sells Field -->
<div class="col-sm-12">
    {!! Form::label('default_sells', 'Ventas:') !!}
    <p>{{ $invoiceSeries->default_sells }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado') !!}
    <p>{{ $invoiceSeries->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $invoiceSeries->updated_at }}</p>
</div>

