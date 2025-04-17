

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', 'Cliente:') !!}
    <div class="select-wrapper" style="width:100%;">
                                <select class="select-arrow js-example-basic-single"style="width:100%;" name="client_id" id="client_id">
                                <option value="" selected>Selecciona Cliente</option>
        @foreach ($clientsOption as $clientsption)
                        <option value="{{ $clientsption->id }}" >{{ $clientsption->fullname }}  </option>
        @endforeach
                                </select>
                            </div>
                            
</div>
                 

<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Categoria:') !!}
    <div class="select-wrapper" style="width:100%;">
                                <select class="select-arrow js-example-basic-single"style="width:100%;" name="category_id" id="category_id">
                                <option value="" selected>Selecciona Categoria</option>
        @foreach ($categoriesOption as $categoriesOptions)
                        <option value="{{ $categoriesOptions->id }}" >{{ $categoriesOptions->title }}  </option>
        @endforeach
                                </select>
                            </div>
                            
</div>


<!-- Brand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand', 'Marca:') !!}
    {!! Form::text('brand', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', 'Modelo:') !!}
    {!! Form::text('model', null, ['class' => 'form-control']) !!}
</div>

<!-- Imei Serie Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imei_serie', 'Número de serie:') !!}
    {!! Form::text('imei_serie', null, ['class' => 'form-control']) !!}
</div>

<!-- Repair Cost Field -->
<div class="form-group col-sm-6">
    {!! Form::label('repair_cost', 'Coste de Reparación:') !!}
    {!! Form::text('repair_cost', null, ['class' => 'form-control']) !!}
</div>

<!-- Concept Field -->
<div class="form-group col-sm-6">
    {!! Form::label('concept', 'Concepto:') !!}
    {!! Form::text('concept', null, ['class' => 'form-control']) !!}
</div>

<!-- Observations Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observations', 'Observaciones:') !!}
    {!! Form::textarea('observations', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6 d-none">
    {!! Form::label('status', 'Estados:') !!}
    {!! Form::select('status', ['1' => 'Ingresado', '2' => 'Taller', '3' => 'Reparado', '4' => 'Irreparable', '5' => 'Entregado', '6' => 'Facturado'], null, ['class' => 'form-control custom-select']) !!}
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
        $(document).ready(function() {
    $('.js-example-basic-single').select2();

  } )
  function changevalue(datorepairs){

    $('#client_id').val(datorepairs.client_id)
    $('#client_id').trigger('change');
    $('#category_id').val(datorepairs.category_id)
    $('#category_id').trigger('change');
}
  @if (isset($repairs))
changevalue({!! json_encode($repairs) !!})
        @else
        @endif
    </script>
@endpush