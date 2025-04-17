<!-- Text Field -->
<div class="col-sm-12">
    {!! Form::label('text', 'Texto:') !!}
    <p>{{ $invoiceCustom->text }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Creada:') !!}
    <p>{{ $invoiceCustom->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Actualizada:') !!}
    <p>{{ $invoiceCustom->updated_at }}</p>
</div>

