<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Warraty For Field -->
<div class="form-group col-sm-6">
    {!! Form::label('warraty_for', 'Garantías  para:') !!}
    {!! Form::select('warraty_for', ['1' => 'Todo', '2' => 'Reparaciones', '3' => 'Ventas'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duracion:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control']) !!}
</div>

<!-- Conditions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('conditions', 'Condiciones:') !!}
    {!! Form::select('conditions', ['1' => 'Sitio Web', '2' => 'Texto'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Url Conditions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url_conditions', 'Url Condiciones:') !!}
    {!! Form::text('url_conditions', null, ['class' => 'form-control']) !!}
</div>