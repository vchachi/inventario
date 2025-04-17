@extends('layouts.app')
<style>
    .btn-label {
        position: relative;
        left: -7px;
        display: inline-block;
        border-radius: 3px 0 0 3px;
    }
    select:focus{
        outline: none;
    }
    form {
        margin: 0;
    }
</style>
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Información de la reparación</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-end align-items-center">    
                    {!! Form::model($repairs, ['route' => ['repairs.update', $repairs->id], 'method' => 'patch', 'id' => 'change-status-form']) !!}
                        @csrf
                        <div class="d-none">
                            <!-- Client Id Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('client_id', 'Cliente:') !!}
                                {!! Form::text('client_id', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Category Id Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('category_id', 'Categoria:') !!}
                                {!! Form::select('category_id', ['1' => 'Smartphone', '2' => 'Tablet', '3' => 'Portatil', '4' => 'Monitor', '5' => 'Televisor', '6' => 'Consola'], null, ['class' => 'form-control custom-select']) !!}
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
                                {!! Form::label('imei_serie', 'Imei Serie:') !!}
                                {!! Form::text('imei_serie', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Repair Cost Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('repair_cost', 'Reparacion costo:') !!}
                                {!! Form::text('repair_cost', null, ['class' => 'form-control']) !!}  € 
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

                            <!-- Date Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('date', 'Fecha:') !!}
                                {!! Form::datetimeLocal('date', null, ['class' => 'form-control','id'=>'date']) !!}
                            </div>
                        </div>
                        <input type="hidden" name="status" id="repair-status">
                        <button type="submit" class="btn btn-success mr-2" id="change-status"><span class="btn-label"><i class="fa fa-exchange-alt"></i></span>Cambiar Estado</button>
                    {!! Form::close() !!}
                        <a class="btn btn-default"
                        href="{{ route('repairs.index') }}">
                            Atras
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('repairs.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document?.addEventListener('DOMContentLoaded', function() {
        $('#change-status').click(async function(event) {
            event.preventDefault();
            let valorEstatus={!! $repairs->status !!}
            if(valorEstatus==6){
                alert("Esta reparacion fue generada como factura")
            }else{
                const { value: status } = await Swal.fire({
                title: '<h3 class="font-weight-bold display-5">Cambiar estado</h3>',
                input: 'select',
                inputOptions: {
                    1: 'Ingresado',
                    2: 'Taller',
                    3: 'Reparado',
                    4: 'Irreparable',
                    5: 'Entregado',
                    6: 'Facturar',
                },
                inputValue:  {!! $repairs->status !!},
                inputPlaceholder: 'Reparacion Estado',
                showCancelButton: true,
                cancelButtonText: "Cancelar"
            })
            if (status) {
                $('#repair-status').val(status);
                $('#change-status-form').submit();
            }
            }
         
        });
    })   
</script>
