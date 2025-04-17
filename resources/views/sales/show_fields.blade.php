<!-- Client Id Field -->
<div class="col-sm-12">
    {!! Form::label('client_id', 'Cliente:') !!}
    <p>{{ $client }}</p>
</div>

<!-- Product Service Field -->
<div class="col-sm-12">
    {!! Form::label('product_service', 'Producto servicio:') !!}
    <p>{{ $sales->product_service }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Precio:') !!}
    <p>{{ $sales->price }}</p>
</div>

<!-- Units Field -->
<div class="col-sm-12">
    {!! Form::label('units', 'Units:') !!}
    <p>{{ $sales->units }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $sales->date }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $sales->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $sales->updated_at }}</p>
</div>

