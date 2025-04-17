<!-- Number Field -->
<div class="col-sm-12">
    {!! Form::label('number', 'Número:') !!}
    <p>{{ $orders->number }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Fecha:') !!}
    <p>{{ $orders->date }}</p>
</div>

<!-- State Field -->
<div class="col-sm-12">
    {!! Form::label('state', 'Estado:') !!}
    <p>{{ $orders->state }}</p>
</div>

<!-- Provider Field -->
<div class="col-sm-12">
    {!! Form::label('provider', 'Proveedor:') !!}
    <p>{{ $orders->provider }}</p>
</div>

<!-- Store Field -->
<div class="col-sm-12">
    {!! Form::label('store', 'Almacén:') !!}
    <p>{{ $orders->store }}</p>
</div>

<!-- Delivery Costs Field -->
<div class="col-sm-12">
    {!! Form::label('delivery_costs', 'Coste de envío:') !!}
    <p>{{ $orders->delivery_costs }}</p>
</div>

<!-- Observations Field -->
<div class="col-sm-12">
    {!! Form::label('observations', 'Observaciones:') !!}
    <p>{{ $orders->observations }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $orders->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $orders->updated_at }}</p>
</div>

