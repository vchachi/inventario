<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Nombre:') !!}
    <p>{{ $products->title }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_name', 'Categoría:') !!}
    <p>{{ $category }}</p>
</div>

<!-- Brand Field -->
<div class="col-sm-12">
    {!! Form::label('brand', 'Marca:') !!}
    <p>{{ $products->brand }}</p>
</div>

<!-- Model Field -->
<div class="col-sm-12">
    {!! Form::label('model', 'Modelo:') !!}
    <p>{{ $products->model }}</p>
</div>

<!-- Color Field -->
<div class="col-sm-12">
    {!! Form::label('color', 'Color:') !!}
    <p>{{ $products->color }}</p>
</div>

<!-- Bar Code Field -->
<div class="col-sm-12">
    {!! Form::label('bar_code', 'Código de barra:') !!}
    <p>{{ $products->bar_code }}</p>
</div>

<!-- Reference Field -->
<div class="col-sm-12">
    {!! Form::label('reference', 'Referencia:') !!}
    <p>{{ $products->reference }}</p>
</div>

<!-- Units Field -->
<div class="col-sm-12">
    {!! Form::label('units', 'Unidades:') !!}
    <p>{{ $products->units }}</p>
</div>

<!-- Buy Price Field -->
<div class="col-sm-12">
    {!! Form::label('buy_price', 'Precio de compra:') !!}
    <p>{{ $products->buy_price }}</p>
</div>

<!-- Sell Price Field -->
<div class="col-sm-12">
    {!! Form::label('sell_price', 'Precio de venta:') !!}
    <p>{{ $products->sell_price }}</p>
</div>

<!-- Invoicing Field -->
<div class="col-sm-12">
    {!! Form::label('invoicing', 'Factura:') !!}
    <p>{{ $products->invoicing == 1 ? 'Por Defecto' : ($products->invoicing == 2?'Serie Principal(21%)':'') }}</p>
</div>

<!-- State Field -->
<div class="col-sm-12">
    {!! Form::label('state', 'Estados:') !!}
    <p>{{ $products->state == 1 ? "Funcional" : ($products->state == 2 ? "Reacondicionado" : ($products->state == 3 ? "Seminuevo" : ($products->state == 4 ? "Perfecto estado" : ($products->state == 5 ? "Nuevo" : ""))))}}</p>
</div>

<!-- Storage Field -->
<div class="col-sm-12">
    {!! Form::label('storage', 'Alamacenamiento:') !!}
    <p>{{ $products->storage == 1 ? "Sin especificar" : ($products->storage == 2 ? "8GB" :($products->storage == 3 ? "16GB" :($products->storage == 4 ? "32GB" :($products->storage == 5 ? "64GB" :($products->storage == 6 ? "128GB" :($products->storage == 7 ? "256GB" :($products->storage == 8 ? "512GB" :($products->storage == 9 ? "1TB" : ($products->storage == 10 ? "2TB" : ""))))))))) }}</p>
</div>

<!-- Warranty Field -->
<div class="col-sm-12">
    {!! Form::label('warranty', 'Garantía:') !!}
    <p>{{ $products->warranty == 1 ? "Ninguna" : "" }}</p>
</div>

<!-- Observations Field -->
<div class="col-sm-12">
    {!! Form::label('observations', 'Observaciones:') !!}
    <p>{{ $products->observations }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creada:') !!}
    <p>{{ $products->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizada:') !!}
    <p>{{ $products->updated_at }}</p>
</div>

