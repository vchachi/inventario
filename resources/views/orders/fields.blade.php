<!-- Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('number', 'Número:') !!}
    {!! Form::text('number', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Fecha:') !!}
    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', 'Estado:') !!}
    {!! Form::select('state', ['1' => 'Pendiente', '2' => 'Pedido Realizado', '3' => 'Recibido'], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Provider Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider', 'Proveedor:') !!}
    {!! Form::text('provider', null, ['class' => 'form-control']) !!}
</div>

<!-- Store Field -->
<div class="form-group col-sm-6">
    {!! Form::label('store', 'Almacén:') !!}
    {!! Form::text('store', null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Costs Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_costs', 'Coste de envío:') !!}
    {!! Form::number('delivery_costs', null, ['class' => 'form-control']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observations', 'Observaciones:') !!}
    {!! Form::textarea('observations', null, ['class' => 'form-control']) !!}
</div>