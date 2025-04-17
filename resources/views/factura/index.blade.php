@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Facturas</h1>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-2">
                <a class="btn btn-secondary " href="javascript:MostrarModal();" role="button">Facturas Descargas</a>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('factura.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('modals.exportFacturas')
    <script>
        var url="{{route('importproductplan.csv')}}";
 
    function datoEnviar(){
        $('#formId').attr('action',url );
        $('#formId').trigger( "submit" )
        $('#demoModal').modal('hide')
    }   
    function MostrarModal(){    
       $('#demoModal').modal('show')
    }
    function closeModal(){
        $('#demoModal').modal('hide')
    }
</script>
@endsection

