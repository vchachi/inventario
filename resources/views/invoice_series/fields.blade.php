<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombres:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Shortname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shortname', 'Nombre corto:') !!}
    {!! Form::text('shortname', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax_type', 'Tipo de Impuesto:') !!}
    {!! Form::select('tax_type', ['1' => 'IVA (21%)', 'IGIC (7%)' => 'IGIC (7%)', '2' => 'IGI General (4.5%)', '3' => 'Excento/No Sujeto'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Default Repairs Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('default_repairs', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('default_repairs', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('default_repairs', 'Default Repairs', ['class' => 'form-check-label']) !!}
    </div>
</div>


<!-- Default Sells Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('default_sells', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('default_sells', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('default_sells', 'Default Sells', ['class' => 'form-check-label']) !!}
    </div>
</div>
