@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categorías </h1>
                </div>
                <div class="col-sm-1">
                    <a class="btn btn-primary float-right"
                       href="{{ route('categories.create') }}">
                        Nuevo
                    </a>
                </div>
                <div class="col-sm-1">
                 <div class="dropdown ActionCSV">
                 <a href="#" class="btn btn-secondary dropdown-toggle" id="navbardr" role="button" aria-haspopup="true" aria-expanded="false">
                     CSV
                  </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="navbardr">
                        <a class="dropdown-item" href="{{ route('exportcategories.csv') }}">Plantilla CSV</a>
                        
                        <a class="dropdown-item" href="javascript:MostrarModal();">Importar CSV</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('categories.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('modals.uploadfile')
    <script>
        
        var url="{{route('importcategories.csv')}}";
    document?.addEventListener('DOMContentLoaded', function() {
        $('.ActionCSV').click(function(){
            $('.ActionCSV .dropdown-menu').toggleClass('show');
        });
    })
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

