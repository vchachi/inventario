<!-- Client Id Field -->
<div class="col-sm-12">
    {!! Form::label('client_name', 'Cliente:') !!}
    <p>{{ $client }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_name', 'Categoria:') !!}
    <p>{{ $category }}</p>
</div>

<!-- Brand Field -->
<div class="col-sm-12">
    {!! Form::label('brand', 'Marca:') !!}
    <p>{{ $repairs->brand }}</p>
</div>

<!-- Model Field -->
<div class="col-sm-12">
    {!! Form::label('model', 'Modelo:') !!}
    <p>{{ $repairs->model }}</p>
</div>

<!-- Imei Serie Field -->
<div class="col-sm-12">
    {!! Form::label('imei_serie', 'Número de serie:') !!}
    <p>{{ $repairs->imei_serie }}</p>
</div>

<!-- Repair Cost Field -->
<div class="col-sm-12">
    {!! Form::label('repair_cost', 'Coste de Reparación:') !!}
    <p>{{ $repairs->repair_cost }}  € </p>
</div>

<!-- Concept Field -->
<div class="col-sm-12">
    {!! Form::label('concept', 'Concepto:') !!}
    <p>{{ $repairs->concept }}</p>
</div>

<!-- Observations Field -->
<div class="col-sm-12">
    {!! Form::label('observations', 'Observaciones:') !!}
    <p>{{ $repairs->observations }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Estados:') !!}
    <p>{{ $repairs->status == '1' ? 'Ingresado' : ($repairs->status == '2' ? 'Taller' : ($repairs->status == '3' ? 'Reparado' : ($repairs->status == '4' ? 'Irreparable' : ($repairs->status == '5' ? 'Entregado' : 'Facturado')))) }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Fecha:') !!}
    <p>{{ $repairs->date }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $repairs->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $repairs->updated_at }}</p>
</div>

