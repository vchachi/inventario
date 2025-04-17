@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reparaciones</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end align-items-center">
                    <a class="btn btn-success mr-2"
                       href="{{ route('repairs.exportRepairsCSVFile') }}">
                        Exportar CSV
                    </a>
                    <a class="btn btn-primary"
                       href="{{ route('repairs.create') }}">
                        Nuevo
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('repairs.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

