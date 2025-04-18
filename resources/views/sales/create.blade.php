@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Crear Ventas</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')
            {!! Form::open(['route' => 'sales.paid']) !!}
            @include('sales.new_fields')
        
        {!! Form::close() !!}
    </div>
@endsection
