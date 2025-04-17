@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                </div>
                <div class="col-sm-6 d-flex gap-2 align-items-center justify-content-end">
                    <a class="btn btn-primary"
                       href="{{ route('clients.create') }}">
                       Nuevo
                    </a>
                    <a class="btn btn-primary"
                       href="{{ route('exportcliente.create') }}">
                       Exportar
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
                @include('clients.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

