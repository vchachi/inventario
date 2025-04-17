<!-- Fullname Field -->
<div class="col-sm-12">
    {!! Form::label('fullname', 'Nombre Completo:') !!}
    <p>{{ $clients->fullname }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', 'Telefono:') !!}
    <p>{{ $clients->phone }}</p>
</div>

<!-- Nif Field -->
<div class="col-sm-12">
    {!! Form::label('NIF', 'NIF:') !!}
    <p>{{ $clients->NIF }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Dirección:') !!}
    <p>{{ $clients->address }}</p>
</div>

<!-- Localidad Field -->
<div class="col-sm-12">
    {!! Form::label('localidad', 'Localidad:') !!}
    <p>{{ $clients->localidad }}</p>
</div>

<!-- Provincia Field -->
<div class="col-sm-12">
    {!! Form::label('provincia', 'Provincia:') !!}
    <p>{{ $clients->provincia }}</p>
</div>

<!-- Postal Code Field -->
<div class="col-sm-12">
    {!! Form::label('postal_code', 'Código postal:') !!}
    <p>{{ $clients->postal_code }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $clients->email }}</p>
</div>

<!-- Observations Field -->
<div class="col-sm-12">
    {!! Form::label('observations', 'Observacioens:') !!}
    <p>{{ $clients->observations }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creado:') !!}
    <p>{{ $clients->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizado:') !!}
    <p>{{ $clients->updated_at }}</p>
</div>


