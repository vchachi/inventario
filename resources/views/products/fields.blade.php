<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Nombre *:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Categoría :') !!}
    {!! Form::select('category_id', $categoriesOption, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Brand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand', 'Marca :') !!}
    {!! Form::text('brand', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', 'Modelo :') !!}
    {!! Form::text('model', null, ['class' => 'form-control']) !!}
</div>

<!-- Color Field -->
<div class="form-group col-sm-6">
    {!! Form::label('color', 'Color :') !!}
    {!! Form::text('color', null, ['class' => 'form-control']) !!}
</div>

<!-- Bar Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bar_code', 'Código de barra :') !!}
    {!! Form::text('bar_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Reference Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reference', 'Referencia *:') !!}
    {!! Form::text('reference', null, ['class' => 'form-control']) !!}
</div>

<!-- Units Field -->
<div class="form-group col-sm-6">
    {!! Form::label('units', 'Unidades *:') !!}
    {!! Form::text('units', null, ['class' => 'form-control']) !!}
</div>

<!-- Buy Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('buy_price', 'Precio de Compra :') !!}
    {!! Form::text('buy_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Sell Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sell_price', 'Precio de Venta *:') !!}
    {!! Form::text('sell_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Invoicing Field -->
<div class="form-group col-sm-6">
    {!! Form::label('invoicing', 'Factura :') !!}
    {!! Form::select('invoicing', ['1' => 'Por Defecto', '2' => 'Serie Principal(21%)'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'Estado :') !!}
    {!! Form::select('state', ['1' => 'Funcional', '2' => 'Reacondicionado', '3' => 'Seminuevo', '4' => 'Perfecto estado', '5 ' => 'Nuevo'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Storage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('storage', 'Almacenamiento :') !!}
    {!! Form::select('storage', ['1' => 'Sin especificar', '2' => '8GB', '3' => '16GB', '4' => '32GB', '5' => '64GB', '6' => '128GB', '7' => '256GB', '8' => '512GB', '9' => '1TB', '10' => '2TB'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Warranty Field -->
<div class="form-group col-sm-6">
    {!! Form::label('warranty', 'Garantía :') !!}
    {!! Form::select('warranty', ['1' => 'Ninguna'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Observations Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observations', 'Observaciones :') !!}
    {!! Form::textarea('observations', null, ['class' => 'form-control']) !!}
</div>