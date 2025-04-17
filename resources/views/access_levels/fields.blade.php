<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Pin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pin', 'Pin:') !!}
    {!! Form::text('pin', null, ['class' => 'form-control']) !!}
</div>

<!-- Permisions Json Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permisions_json', 'JSON Permisos:') !!}
    {!! Form::text('permisions_json', null, ['class' => 'form-control']) !!}
</div>